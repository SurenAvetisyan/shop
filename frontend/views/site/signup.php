<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="w3_login">
    <h3>Sign Up</h3>
    <div class="w3_login_module">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="module form-module">
            <div class="form">
                <h2>Create an account</h2>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<!--<input name="SignupForm[username]" type="text" value="--><?php //= !empty($model->username)?$model->username:"vardan"  ?><!-- ">-->
                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'dob') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
