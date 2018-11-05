<?php use yii\widgets\ActiveForm;
use \yii\helpers\Html;

foreach ($blog as $item) { ?>

    <div class="">
        <div class="privacy about">
            <h3><?= Html::encode($item->title) ?></h3>
            <p><?= Html::encode($item->content) ?></p>

            <?= Html::a(Yii::t('app', 'Read More'), '@web/blog/comment/' . $item->id, ['class' => 'btn btn-success k']) ?>
            

        </div>
    </div>

    <?php
}


