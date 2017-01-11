<?php
namespace DejwCake\StandardCMS\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Settings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \DejwCake\StandardCMS\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Setting findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\Muffin/Trash.TrashBehavior
 */
class SettingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('settings');
        $this->displayField('setting_key');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');

        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'className' => 'Users'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('setting_key', 'create')
            ->notEmpty('setting_key')
            ->add('setting_key', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //TODO change to support deleted
        $rules->add($rules->isUnique(['setting_key', 'deleted'], ['allowMultipleNulls' => false, 'message' => 'This value is not unique']));
        $rules->add($rules->existsIn(['created_by'], 'Users'));

        return $rules;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     */
    public function afterSave(Event $event, EntityInterface $entity, ArrayObject $options) {
        $lastUpdate = $this->find()->where(['Settings.setting_key' => 'lastUpdate'])->first();
        if(!empty($lastUpdate) && $entity->id != $lastUpdate->id) {
            if(!empty($lastUpdate)) {
                $lastUpdate->value = $entity->modified;
                if ($this->save($lastUpdate)) {
                }
            }
            else {
                $setting = $this->newEntity(['setting_key' => 'lastUpdate', 'value' => $entity->modified,
                    'created_by' => $entity->created_by, 'enabled' => true,]);

                if ($this->save($setting)) {
                    $id = $setting->id;
                }
            }
        }
    }

    /**
     * @param $inputSettings
     * @param $controllers
     * @return array|null
     */
    public function getSettings($inputSettings, $controllers) {
        $options = ['conditions' => ['Settings.setting_key' => 'lastUpdate'], 'fields' => ['Settings.setting_key','Settings.value']];
        $lastUpdate = $this->find('all', $options)->first();
        if(!empty($lastUpdate)) {
            if (empty($inputSettings) || empty($inputSettings['lastUpdate']) ||
                ($inputSettings['lastUpdate'] != $lastUpdate->value)) {
                $options = ['conditions' => ['Settings.enabled' => '1'], 'fields' => ['setting_key','value']];
                $settingsOrg = $this->find('list', [
                    'conditions' => ['enabled' => '1'],
                    'keyField' => 'setting_key',
                    'valueField' => 'value'
                ])->toArray();
                $settings = array();
                $settingsToExpand = array();

                foreach ($settingsOrg as $keyString => $value) {
                    if(substr( $keyString, 0, 5 ) === "hide.") {
                        $settingsToExpand[$keyString] = $value;
                    }
                    else {
                        $settings[$keyString] = $value;
                    }
                }
                $settings = array_merge($settings, $this->_settingsExpanded($settingsToExpand, $settings, $controllers));
                return $settings;
            } else {
                return $inputSettings;
            }
        } else {
            return null;
        }
    }

    protected function _settingsExpanded($settingsToExpand, $otherSettings, $controllers) {
        $settings = array();

        $rolesTable = TableRegistry::get('Roles');
        $roles = $rolesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'order' => ['id' => 'asc']
        ])->toArray();

        foreach ($settingsToExpand as $keyString => $value) {
            $key = explode('.', $keyString);
            if($key[0] == 'hide' && !empty($key[1]) && !empty($key[2]) && !empty($key[3]) && !empty($key[4]))
            {
                $newControllers = [];
                $newActions = [];
                $newRoles = [];

                /* Get controllers */
                if($key[1] == '*') {
                    foreach ($controllers as $controller) {
                        $newControllers[$controller] = $this->getActionsForController($controller);
                    }
                } else if(substr($key[1], 0, 1 ) === "$" && substr( $key[1], -1, 1 ) === "$" && !empty($otherSettings[trim($key[1],'$')]))  {
                    foreach (array_filter(explode(';',$otherSettings[trim($key[1],'$')])) as $controller) {
                        $newControllers[$controller] = $this->getActionsForController($controller);
                    }
                } else {
                    $newControllers = [$key[1] => $this->getActionsForController($key[1])];
                }

                /* Get actions */
                if($key[2] == '*') {
                    $newActions = '*';
                } else if(substr($key[2], 0, 1) === "$" && substr($key[2], -1, 1) === "$" && !empty($otherSettings[trim($key[2],'$')]))  {
                    $newActions = array_filter(explode(';',$otherSettings[trim($key[2],'$')]));
                } else {
                    $newActions = [$key[2]];
                }

                /* Get roles */
                if($key[4] == '*') {
                    $newRoles = $roles;
                } else if(substr($key[4], 0, 1) === "$" && substr($key[4], -1, 1) === "$" && !empty($otherSettings[trim($key[4],'$')]))  {
                    $newRoles = array_filter(explode(';',$otherSettings[trim($key[4],'$')]));
                } else {
                    $newRoles = [$key[4]];
                }

                if(!empty($newControllers)) {
                    foreach ($newControllers as $controller => $actions) {
                        if ($newActions == '*') {
                            $newActions = $actions;
                        }
                        if(!empty($newActions)) {
                            foreach ($newActions as $action) {
                                foreach ($newRoles as $group) {
                                    $settings[$key[0].'.'.str_replace('Controller', '', $controller).'.'.$action.'.'.$key[3].'.'.$group] = $value;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $settings;
    }

    protected function getActionsForController($controller) {
        $actions = get_class_methods($controller);
        $parentMethods = get_class_methods(get_parent_class($controller));
        if(!empty($actions)) {
            if(!empty($parentMethods)) {
                return array_diff($actions, $parentMethods);
            } else {
                return $actions;
            }
        } else {
            return $actions;
        }
    }
}
