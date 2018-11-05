
<?php

if(!empty($products)){ ?>
    <div class="privacy about">
    <h3>Products</h3>

</div>
   <?php foreach ($products as $product){
        ?>

        <div class="col-md-3 top_brand_left d_pad">
            <div class="hover14 column d_pad">
                <div class="agile_top_brand_left_grid">
                    <div class="agile_top_brand_left_grid1 snipcart-details">
                        <figure>
                            <div class="snipcart-item block" >
                                <div class="snipcart-thumb">
                                    <a href="<?= \yii\helpers\Url::to(['/product/'.$product['slug']]) ?>"><img title=" " alt=" " src="/images/products/<?= $product['image'] ?>" />
                                        <p class="d-height"><?= $product['title'] ?></p>
                                        <h4 class="p-price"><?= '$' . $product['price'] ?></h4>
                                    </a>
                                    <input type="button" class="button add-to-cart" data-id="<?= $product['id'] ?>" value="Add to cart">
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
else {
    echo '<h2>'. Yii::t('app', 'No results matching your search ...' ) . '</h2>';
}
?>


<div class="clearfix"> </div>
<?php

echo \yii\widgets\LinkPager::widget(['pagination' => $pages]);

?>
            