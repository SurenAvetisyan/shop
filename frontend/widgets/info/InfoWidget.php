<?php
/**
 * Created by PhpStorm.
 * User: ghost
 * Date: 9/14/18
 * Time: 6:44 PM
 */

namespace frontend\widgets\info;

class InfoWidget extends \yii\base\Widget
{
    public $info;

    public function init(){
        parent::init();
    }

    public function run(){

        if(!empty($this->info)){
            $email = !empty($this->info['email'])?$this->info['email']:"";
            $phone = !empty($this->info['phone'])?$this->info['phone']:"";
            $info = !empty($this->info['info'])?$this->info['info']:"";

            return $this->render('info',[
                'email' => $email,
                'phone' => $phone,
                'info' => $info,
            ]);
        }

        return $this->render('info');

    }

}