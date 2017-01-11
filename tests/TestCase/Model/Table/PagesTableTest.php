<?php
namespace DejwCake\StandardCMS\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use DejwCake\StandardCMS\Model\Table\PagesTable;

/**
 * DejwCake\StandardCMS\Model\Table\PagesTable Test Case
 */
class PagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \DejwCake\StandardCMS\Model\Table\PagesTable
     */
    public $Pages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.dejw_cake/standard_c_m_s.pages',
        'plugin.dejw_cake/standard_c_m_s.pages_title_translation',
        'plugin.dejw_cake/standard_c_m_s.pages_slug_translation',
        'plugin.dejw_cake/standard_c_m_s.pages_perex_translation',
        'plugin.dejw_cake/standard_c_m_s.pages_text_translation',
        'plugin.dejw_cake/standard_c_m_s.pages_i18n',
        'plugin.dejw_cake/standard_c_m_s.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pages') ? [] : ['className' => 'DejwCake\StandardCMS\Model\Table\PagesTable'];
        $this->Pages = TableRegistry::get('Pages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pages);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
