<?php

namespace frontend\modules\blog\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $content
 * @property string $title
 * @property string $slug
 * @property string $menu_title
 */



class Articles extends \yii\db\ActiveRecord
{

    const STATUS_INACTIVE = 'active';

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
            [['content'], 'string'],
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
            'content' => Yii::t('app', 'Content text'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'menu_title' => Yii::t('app', 'Menu Title'),
        ];
    }

    function getAllArticles(){

    }

}
