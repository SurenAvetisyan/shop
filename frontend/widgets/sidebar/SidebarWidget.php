<?php

namespace frontend\widgets\sidebar;

use common\models\Categories;

class SidebarWidget extends \yii\base\Widget
{

    public $is_left;

    public function init(){
        parent::init();
$this->is_left = 'dd';
    }

    public function run(){

        $categories = Categories::find()->asArray()->all();

        if($this->is_left){
            $email = !empty($this->is_left['email'])?:"";
            return $this->render('sidebar',[
                'email' => $email,
                'categories' => $categories

            ]);
        }
    }

}