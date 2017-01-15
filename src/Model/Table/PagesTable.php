<?php
namespace DejwCake\StandardCMS\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \DejwCake\StandardCMS\Model\Entity\Page get($primaryKey, $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Page newEntity($data = null, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Page[] newEntities(array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Page|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Page patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Page[] patchEntities($entities, array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\Page findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\Muffin/Trash.TrashBehavior
 * @mixin \Cake\ORM\Behavior\TranslateBehavior
 */
class PagesTable extends Table
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

        $this->table('pages');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');
        $this->addBehavior('DejwCake/Helpers.Sluggable');
        $this->addBehavior('DejwCake/StandardCMS.MetaItem');
        $this->addBehavior('Translate', ['fields' => ['title', 'slug', 'perex', 'text'], 'translationTable' => 'PagesI18n']);

        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'className' => 'Users'
        ]);
        $this->hasOne('MetaItems', [
            'className' => 'DejwCake/StandardCMS.MetaItems',
            'foreignKey' => 'entity_id',
            'conditions' => ['MetaItems.entity_class' => 'DejwCake\\StandardCMS\\Model\\Entity\\Page'],
            'dependent' => true,
            'cascadeCallbacks' => true,
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
        $translationValidator = new Validator();
        $translationValidator
            ->requirePresence('title', 'create')
            ->notEmpty('title');
//        $translationValidator
//            ->requirePresence('slug', 'create')
//            ->notEmpty('slug');
        $translationValidator
            ->allowEmpty('perex');
        $translationValidator
            ->allowEmpty('text');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title')
            ->add('title', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

//        $validator
//            ->requirePresence('slug', 'create')
//            ->notEmpty('slug')
//            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('perex');

        $validator
            ->allowEmpty('text');

        $validator
            ->requirePresence('view', 'create')
            ->notEmpty('view');

        $validator
            ->addNestedMany('_translations', $translationValidator)
            ->requirePresence('_translations', 'false')
            ->allowEmpty('_translations');

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
        $rules->add($rules->isUnique(['title', 'deleted'], ['allowMultipleNulls' => false, 'message' => 'This value is not unique']));
        $rules->add($rules->isUnique(['slug', 'deleted'], ['allowMultipleNulls' => false, 'message' => 'This value is not unique']));
        $rules->add($rules->existsIn(['created_by'], 'Users'));

        return $rules;
    }
}
