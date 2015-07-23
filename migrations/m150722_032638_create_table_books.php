<?php

use yii\db\Schema;
use yii\db\Migration;

class m150722_032638_create_table_books extends Migration
{
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_created' => Schema::TYPE_DATE,
            'date_added' => Schema::TYPE_DATE,
            'preview' => Schema::TYPE_STRING

        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown()
    {
        $this->dropTable('books');
    }
}
