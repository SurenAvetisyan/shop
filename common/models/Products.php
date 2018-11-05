<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\AttributesBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property double $price
 * @property double $discount
 * @property string $title
 * @property int $SKU
 * @property int $stock
 * @property string $image
 * @property string $slug
 * @property string $description
 * @property string $is_new
 * @property string $is_sale
 * @property string $is_hit
 * @property int $brand_id
 * @property int $category_id
 * @property int $parent_id
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    public function behaviors()
    {
        return [
//            [
//                'class' => BlameableBehavior::className(),
//                'createdByAttribute' => 'user_id',
//                'updatedByAttribute' => 'user_id',
//            ],
//            [
//                'class' => SluggableBehavior::className(),
//                'attribute' => 'title',
//                'slugAttribute' => 'slug',
//            ],
//            [
//                'class' => AttributesBehavior::class,
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => 'title',
//                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'user_id',
//                ],
//                'value' => function ($event) {
//                    return Yii::$app->user->id;
//                },
//            ],
//            [
//                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'created_at',
//                'updatedAtAttribute' => 'updated_at',
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'created_at',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
//                ],
//                'value' => date('Y-m-d H:i:s'),
//            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'title', 'SKU', 'description','brand_id', 'category_id'], 'required'],
            [['price', 'discount','stock'], 'number'],
            [[ 'brand_id', 'category_id', 'parent_id'], 'integer'],
            [['description', 'is_new', 'is_sale', 'is_hit'], 'string'],
            [['title', 'image', 'slug','SKU'], 'string', 'max' => 255],
            ['image', 'image','mimeTypes'=>['image/*'] ,'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
            [['SKU'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'price' => Yii::t('app', 'Price $'),
            'discount' => Yii::t('app', 'Discount'),
            'title' => Yii::t('app', 'Title'),
            'SKU' => Yii::t('app', 'Sku'),
            'image' => Yii::t('app', 'Image'),
            'slug' => Yii::t('app', 'Slug'),
            'description' => Yii::t('app', 'Description'),
            'is_new' => Yii::t('app', 'Is New'),
            'is_sale' => Yii::t('app', 'Is Sale'),
            'is_hit' => Yii::t('app', 'Is Hit'),
            'brand_id' => Yii::t('app', 'Brand'),
            'category_id' => Yii::t('app', 'Category'),
            'parent_id' => Yii::t('app', 'Parent'),
        ];
    }

    public function getBrands(){
        return $this->hasOne(Brands::class,['id'=>'brand_id']);
    }

    public function getAllCategories(){
        return $this->hasOne(Categories::class,['id'=>'category_id']);
    }
}
