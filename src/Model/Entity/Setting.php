<?php
namespace DejwCake\StandardCMS\Model\Entity;

use Cake\ORM\Entity;
use DejwCake\Helpers\Model\Entity\EnableTrait;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string $setting_key
 * @property string $value
 * @property bool $enabled
 * @property int $created_by
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 *
 * @property \DejwCake\StandardCMS\Model\Entity\User $user
 */
class Setting extends Entity
{
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
