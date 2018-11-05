<?php

namespace frontend\widgets\footer;

use common\models\Articles;

class FooterWidget extends \yii\base\Widget
{

    public $is_bottom;

    public function init(){
        parent::init();
        $this->is_bottom = 'footer';
    }

    public function run(){

        $footer_1 = Articles::find()->where(['position' => 'footer_1'])->asArray()->all();
        $footer_2 = Articles::find()->where(['position' => 'footer_2'])->asArray()->all();

        if($this->is_bottom){

            return $this->render('footer',[
                'footer_1' => $footer_1,
                'footer_2' => $footer_2

            ]);
        }
    }

}