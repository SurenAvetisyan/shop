<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $content
 * @property string $title
 * @property string $slug
 * @property string $menu_title
 * @property string $position
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'title', 'slug', 'menu_title'], 'required'],
            [['content', 'position'], 'string'],
            [['title', 'slug', 'menu_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'menu_title' => Yii::t('app', 'Menu Title'),
            'position' => Yii::t('app', 'Position'),
        ];
    }
}
