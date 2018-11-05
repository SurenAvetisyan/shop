<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">

    <?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']] ); ?>

    <?= $form->field($model, 'title')->dropDownList($brands) ?>

    <?php
    if (!empty($model->image)){
        echo Html::img('/frontend/web/images/brands/'.$model->image,['width'=>100]);
    }
    ?>

    <?= $form->field($model, 'image')->fileInput() ?>


    <?= $form->field($model, 'slug')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
