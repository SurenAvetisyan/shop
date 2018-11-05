<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Mail Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail">
    <h3><?= $this->title;?></h3>
    <div class="agileinfo_mail_grids">
        <div class="col-md-4 agileinfo_mail_grid_left">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i></li>
                <li>address<span>868 1st Avenue NYC.</span></li>
            </ul>
            <ul>
                <li><i class="fa fa-envelope" aria-hidden="true"></i></li>
                <li>email<span><a href="mailto:info@example.com">info@example.com</a></span></li>
            </ul>
            <ul>
                <li><i class="fa fa-phone" aria-hidden="true"></i></li>
                <li>call to us<span>(+123) 233 2362 826</span></li>
            </ul>
        </div>
        <div class="col-md-8 agileinfo_mail_grid_right">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="col-md-6 wthree_contact_left_grid">
                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-md-6 wthree_contact_left_grid">
                    <?= $form->field($model, 'subject') ?>
                </div>
                <div class="clearfix"> </div>
                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                <input type="reset" value="Clear">
            <?php ActiveForm::end(); ?>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
</div>
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d96748.15352429623!2d-74.25419879353115!3d40.731667701988506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sshopping+mall+in+New+York%2C+NY%2C+United+States!5e0!3m2!1sen!2sin!4v1467205237951" style="border:0"></iframe>
</div>