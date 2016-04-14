<?php

use Phinx\Migration\AbstractMigration;

class Init extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('cards')
            ->addColumn('name', 'string')
            ->create();

        $this->table('tasks')
            ->addColumn('name', 'string')
            ->addColumn('isDone', 'boolean', ['default' => false])
            ->addColumn('priority', 'integer', ['default' => 500])
            ->addColumn('cardId', 'integer')
            ->addForeignKey('cardId', 'cards', 'id')
            ->addIndex(['name'])
            ->create();
    }


}
