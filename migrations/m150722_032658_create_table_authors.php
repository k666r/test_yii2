<?php

use yii\db\Schema;
use yii\db\Migration;

class m150722_032658_create_table_authors extends Migration
{
    public function safeUp()
    {
        $this->createTable('authors', [
            'id' => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING . ' NOT NULL',
            'last_name' => Schema::TYPE_STRING . ' NOT NULL',

        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown()
    {
        $this->dropTable('authors');
    }
}
