<?php
namespace DejwCake\StandardCMS\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use DejwCake\StandardCMS\Model\Table\MetaItemsTable;

/**
 * DejwCake\StandardCMS\Model\Table\MetaItemsTable Test Case
 */
class MetaItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \DejwCake\StandardCMS\Model\Table\MetaItemsTable
     */
    public $MetaItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.dejw_cake/standard_c_m_s.meta_items',
        'plugin.dejw_cake/standard_c_m_s.meta_items_title_translation',
        'plugin.dejw_cake/standard_c_m_s.meta_items_keywords_translation',
        'plugin.dejw_cake/standard_c_m_s.meta_items_description_translation',
        'plugin.dejw_cake/standard_c_m_s.meta_items_i18n'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MetaItems') ? [] : ['className' => 'DejwCake\StandardCMS\Model\Table\MetaItemsTable'];
        $this->MetaItems = TableRegistry::get('MetaItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MetaItems);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
