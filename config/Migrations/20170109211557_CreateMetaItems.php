<?php
use Migrations\AbstractMigration;

class CreateMetaItems extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('meta_items');
        $table->addColumn('entity_id', 'integer', [
            'null' => true,
        ]);
        $table->addIndex(['entity_id',]);
        $table->addColumn('entity_class', 'string', [
            'null' => true,
        ]);
        $table->addIndex(['entity_class',]);
        $table->addIndex(['entity_id', 'entity_class'], [
            'name' => 'I18N_ENTITY_UNIQUE',
            'unique' => true,
        ]);
        $table->addColumn('title', 'string', [
            'limit' => 255,
        ]);
        $table->addColumn('keywords', 'string', [
            'limit' => 255,
        ]);
        $table->addColumn('description', 'text', [
            'limit' => 255,
        ]);
        $table->addColumn('enabled', 'boolean', [
            'default' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();

        $table = $this->table('meta_items_i18n');
        $table->addColumn('locale', 'string', [
            'default' => null,
            'limit' => 6,
            'null' => false,
        ]);
        $table->addColumn('model', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('foreign_key', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('field', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addIndex(['locale',], [
            'name' => 'locale',
            'unique' => false,
        ]);
        $table->addIndex(['model',], [
            'name' => 'model',
            'unique' => false,
        ]);
        $table->addIndex(['foreign_key',], [
            'name' => 'row_id',
            'unique' => false,
        ]);
        $table->addIndex(['field',], [
            'name' => 'field',
            'unique' => false,
        ]);
        $table->addIndex(['locale', 'model', 'foreign_key', 'field',], [
            'name' => 'I18N_LOCALE_FIELD',
            'unique' => true,
        ]);
        $table->addIndex(['model', 'foreign_key', 'field',], [
            'name' => 'I18N_FIELD',
            'unique' => false,
        ]);
        $table->create();
    }
}
