<?php

use Phinx\Migration\AbstractMigration;

class SampleData extends AbstractMigration
{
    public function up()
    {
        $cards = [
            ['name' => 'First Card']
        ];

        $tasks = [
            [
                'name' => 'add a new card',
                'isDone' => false,
                'priority' => 900,
                'cardId' => 1,
            ],
            [
                'name' => 'add some tasks to the new card',
                'isDone' => false,
                'priority' => 500,
                'cardId' => 1,
            ],
            [
                'name' => 'comple all tasks of the new card',
                'isDone' => false,
                'priority' => 100,
                'cardId' => 1,
            ]
        ];

        $this->table('cards')->insert($cards)->save();
        $this->table('tasks')->insert($tasks)->save();
    }

    public function down()
    {
        $this->execute('DELETE FROM tasks');
        $this->execute('DELETE FROM cards');
    }
}
