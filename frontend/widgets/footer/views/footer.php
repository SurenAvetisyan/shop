<div class="col-md-4 w3_footer_grid">
    <h3><?= Yii::t('app', 'information') ?></h3>
    <ul class="w3_footer_grid_list">
    <?php
        if ($footer_1){

            foreach ($footer_1 as $item) { ?>
                <li><a href="<?= \yii\helpers\Url::to(['/'. $item['slug']])  ?>"><?= $item['title']  ?></a></li>
             <?php
            }
        }

    ?>


    </ul>
</div>
<div class="col-md-4 w3_footer_grid">
    <h3>policy info</h3>
    <ul class="w3_footer_grid_list">
        <?php
        if ($footer_2){
            foreach ($footer_2 as $item){ ?>
                <li><a href="<?= \yii\helpers\Url::to(['/'. $item['slug']])  ?>"><?= $item['title']  ?></a></li>

         <?php
            }
        }

        ?>

    </ul>
</div>