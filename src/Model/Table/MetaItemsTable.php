<?php
namespace DejwCake\StandardCMS\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaItems Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Entities
 *
 * @method \DejwCake\StandardCMS\Model\Entity\MetaItem get($primaryKey, $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\MetaItem newEntity($data = null, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\MetaItem[] newEntities(array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\MetaItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\MetaItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\MetaItem[] patchEntities($entities, array $data, array $options = [])
 * @method \DejwCake\StandardCMS\Model\Entity\MetaItem findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\Muffin/Trash.TrashBehavior
 * @mixin \Cake\ORM\Behavior\TranslateBehavior
 */
class MetaItemsTable extends Table
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

        $this->table('meta_items');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');
        $this->addBehavior('Translate', ['fields' => ['title', 'keywords', 'description'], 'translationTable' => 'MetaItemsI18n']);

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
            ->allowEmpty('title');
        $translationValidator
            ->requirePresence('keywords', 'create')
            ->allowEmpty('keywords');
        $translationValidator
            ->requirePresence('description', 'create')
            ->allowEmpty('description');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('keywords', 'create')
            ->notEmpty('keywords');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->addNestedMany('_translations', $translationValidator)
            ->requirePresence('_translations', 'false')
            ->allowEmpty('_translations');

        return $validator;
    }
}
