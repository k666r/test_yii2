<?php

namespace app\models;


use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public static function tableName()
    {
        return 'authors';
    }

    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }

    public function getFullName()
    {
        return "{$this->last_name} {$this->first_name}";
    }

}