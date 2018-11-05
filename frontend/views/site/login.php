<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="w3_login">
    <h3>Sign In</h3>
    <div class="w3_login_module">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="module form-module">
            <div class="form">
                <h2>Login to your account</h2>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => 'asdasdasd']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <div class="cta" style="color:#999;margin:1em 0">
                 <?= Html::a('Forgot your password?', ['site/request-password-reset']) ?>.
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
