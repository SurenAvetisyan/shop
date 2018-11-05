<?php
/**
 * Created by PhpStorm.
 * User: ghost
 * Date: 10/7/18
 * Time: 8:23 PM
 */

namespace frontend\models;


use yii\base\Model;

/**
 * OrderForm is the model behind the order form.
 */

class OrderForm extends Model
{

    public $full_name;
    public $phone;
    public $email;
    public $town;
    public $address;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['full_name', 'email', 'phone', 'town', 'address'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

}