<?php
namespace DejwCake\StandardCMS\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class MetaItemBehavior extends Behavior
{
    public function afterSave(Event $event, EntityInterface $entity)
    {
        $metaItem = $entity->meta_item;
        $metaItem = TableRegistry::get('DejwCake/StandardCMS.MetaItems')->patchEntity($metaItem, [
            'entity_class' => get_class($entity),
        ], [
            'validate' => false,
        ]);
        if (TableRegistry::get('DejwCake/StandardCMS.MetaItems')->save($metaItem)) {
            return;
        } else {
            return false;
        }
    }

    public function findMetaItem(Query $query, array $options)
    {
        return $query->contain(['MetaItems' => ['finder' => 'translations']]);
    }
}
