<?php use yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<div class="">
    <div class="privacy about">
        <h3><?= Html::encode($item->title) ?></h3>
        <p><?= Html::encode($item->content) ?></p>
        <div id="">

            <?php if (!Yii::$app->user->isGuest) { ?>
                <div id="blog-search-form">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($comment, 'content')->textarea(['data_blog_id' => $item["id"]])->label(false) ?>

                    <?= $form->field($comment, 'blog_id')->hiddenInput(['value' => $item["id"]])->label(false) ?>


                    <div class="form-group">
                        <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success form-send k']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <?php
            } ?>

            <div class="comment-table">
                <?php
                if (!empty($item->comments)) {
                    foreach ($item->comments as $com) { ?>

                        <p class="b-one"><?= !empty(Yii::$app->user->identity->username) ? '@' . Yii::$app->user->identity->username : ''; ?></p>
                        <p><?= Html::encode($com->content) ?></p>
                        <p class="b-one"><?= Html::encode($com->date) ?></p>


                        <?php
                    }
                }


                ?>

            </div>
        </div>


    </div>
</div>



