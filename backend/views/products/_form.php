<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SKU')->textInput() ?>

    <?= $form->field($model, 'price')->textInput()->label('Price') ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?php
    if(!empty($model->image)){
        echo Html::img('/frontend/web/images/products/'.$model->image,['width'=>100]);
    }
    ?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_new')->dropDownList([ '0', '1', ]) ?>

    <?= $form->field($model, 'is_sale')->dropDownList([ '0', '1', ]) ?>

    <?= $form->field($model, 'is_hit')->dropDownList([ '0', '1', ]) ?>

    <?= $form->field($model, 'brand_id')->dropDownList($brands_list); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories_list); ?>

    <?= $form->field($model, 'parent_id')->dropDownList($products,['prompt' => 'select parent product']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
