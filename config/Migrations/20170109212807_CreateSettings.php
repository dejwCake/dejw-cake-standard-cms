<?php
use Migrations\AbstractMigration;

class CreateSettings extends AbstractMigration
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
        $table = $this->table('settings');
        $table->addColumn('setting_key', 'string', [
            'limit' => 255,
        ]);
        $table->addIndex(['setting_key',], [
            'unique' => true,
        ]);
        $table->addColumn('value', 'text', [
            'null' => true,
        ]);
        $table->addColumn('enabled', 'boolean', [
            'default' => true,
        ]);
        $table->addColumn('created_by', 'integer', [
            'null' => true,
        ]);
        $table->addForeignKey('created_by', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addIndex(['created_by',]);
        $table->addColumn('created', 'datetime');
        $table->addColumn('modified', 'datetime', [
            'default' => null,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
