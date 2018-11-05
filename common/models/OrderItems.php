<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $orders_id
 * @property int $product_id
 * @property string $title
 * @property double $price
 * @property int $qty_item
 * @property double $sum_item
 */

class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orders_id', 'product_id', 'title', 'price', 'qty_item', 'sum_item'], 'required'],
            [['orders_id', 'product_id', 'qty_item'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orders_id' => Yii::t('app', 'Orders ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'qty_item' => Yii::t('app', 'Qty Item'),
            'sum_item' => Yii::t('app', 'Sum Item'),
        ];
    }
}
