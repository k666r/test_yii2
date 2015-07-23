<?php

namespace app\models;


use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public $date_created_from,
        $date_created_to;

    public static function tableName()
    {
        return 'books';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'author_id' => 'Автор',
            'date_created' => 'Дата выхода книги',
            'date_added' => 'Дата добавления',
            'authorName' => 'Автор',
            'preview' => 'Превью',

        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    public function getAuthorName()
    {
        if ($this->author) {
            return $this->author->fullName;
        }
        return '';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date_added = date('Y-m-d');
            return true;
        } else {
            return false;
        }
    }

    public function rules()
    {
        return [
            [['title', 'author_id', 'date_created', 'preview'], 'required',],
            [['date_added', 'date_created_from', 'date_created_to'], 'safe'],
        ];
    }

    public function search()
    {
        $query = Book::find();
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'author_id');
        if ($this->date_created_from) {
            $query->andWhere(['>=', 'date_created', $this->date_created_from]);
        }
        if ($this->date_created_to) {
            $query->andWhere(['<=', 'date_created', $this->date_created_to]);
        }
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }

    public function addCondition($query, $attribute, $partial = false)
    {
        $value = $this->$attribute;
        if ($value) {
            if ($partial) {
                $query->andWhere(['like', $attribute, $value]);
            } else {
                $query->andWhere([$attribute => $value]);
            }
        }
    }

    public function getArrayForLink()
    {
        $array = $this->attributes;
        $array['date_created_from'] = $this->date_created_from;
        $array['date_created_to'] = $this->date_created_to;
        return $array;
    }
}