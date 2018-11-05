
<?php
\yii\widgets\Pjax::begin(['enablePushState' => false]);
if(!empty($categories)){ ?>
    <div class="privacy about">
    <h3>All Category</h3>

</div>
    <?php
    foreach ($categories as $category){
        ?>
        <div class="col-md-3 top_brand_left d_pad">
            <div class="hover14 column d_pad">
                <div class="agile_top_brand_left_grid">
<!--                    <div class="tag"><img src="--><?//= $category['image'] ?><!--" alt=" " class="img-responsive" /></div>-->
                    <div class="agile_top_brand_left_grid1 snipcart-details">
                        <figure>
                            <div class="snipcart-item block" >
                                <div class="snipcart-thumb">
                                    <a href="<?= \yii\helpers\Url::to(['/category/'.$category['slug']]) ?>"><img title=" " alt=" " src="/images/category/<?= $category['image'] ?>" />
                                        <p><?= $category['title'] ?></p>
                                    </a>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<div class="clearfix"> </div>
<?php

echo \yii\widgets\LinkPager::widget(['pagination' => $pager]);

\yii\widgets\Pjax::end();
?>