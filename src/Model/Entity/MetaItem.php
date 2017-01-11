<?php
namespace DejwCake\StandardCMS\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\Behavior\Translate\TranslateTrait;
use DejwCake\Helpers\Model\Entity\EnableTrait;

/**
 * MetaItem Entity
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_class
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property bool $enabled
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 *
 * @property \DejwCake\StandardCMS\Model\Entity\Entity $entity
 */
class MetaItem extends Entity
{
    use TranslateTrait;
    use EnableTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
