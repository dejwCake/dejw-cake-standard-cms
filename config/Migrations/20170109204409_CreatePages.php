<?php
use Migrations\AbstractMigration;

class CreatePages extends AbstractMigration
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
        $table = $this->table('pages');
        $table->addColumn('title', 'string', [
            'limit' => 255,
        ]);
        $table->addIndex(['title',], [
            'name' => 'title',
            'unique' => true,
        ]);
        $table->addColumn('slug', 'string', [
            'limit' => 255,
        ]);
        $table->addIndex(['slug',], [
            'name' => 'slug',
            'unique' => true,
        ]);
        $table->addColumn('perex', 'text', [
            'null' => true,
        ]);
        $table->addColumn('text', 'text', [
            'null' => true,
        ]);
        $table->addColumn('view', 'string', [
            'limit' => 255,
            'default' => 'default',
        ]);
        $table->addColumn('enabled', 'boolean', [
            'default' => true,
        ]);
        $table->addColumn('created_by', 'integer', [
            'null' => true,
        ]);
        $table->addForeignKey('created_by', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addIndex(['created_by',]);
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

        $table = $this->table('pages_i18n');
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
