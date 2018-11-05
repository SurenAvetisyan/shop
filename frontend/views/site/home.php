<?php

/* @var $this yii\web\View */

$this->title = 'yii-shop';

?>
<section class="slider">
    <div class="flexslider">
        <ul class="slides">
            <?php
            if(!empty($slider)){
                foreach ($slider as $slide){
                    ?>
                    <li>
                        <div class="w3l_banner_nav_right_banner" style="background:url(<?= '/frontend/web/images/slides/'.$slide['image']?>) no-repeat 0px 0px">
                            <h3><?= $slide['title'];?></h3>

                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</section>
</div>
</div>
<div class="banner_bottom">
    <div class="wthree_banner_bottom_left_grid_sub">
    </div>
    <div class="wthree_banner_bottom_left_grid_sub1">
        <div class="col-md-4 wthree_banner_bottom_left">
            <div class="wthree_banner_bottom_left_grid">
                <img src="images/4.jpg" alt=" " class="img-responsive" />
                <div class="wthree_banner_bottom_left_grid_pos">
                    <h4>Discount Offer <span>25%</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 wthree_banner_bottom_left">
            <div class="wthree_banner_bottom_left_grid">
                <img src="images/5.jpg" alt=" " class="img-responsive" />
                <div class="wthree_banner_btm_pos">
                    <h3>introducing <span>best store</span> for <i>groceries</i></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 wthree_banner_bottom_left">
            <div class="wthree_banner_bottom_left_grid">
                <img src="images/6.jpg" alt=" " class="img-responsive" />
                <div class="wthree_banner_btm_pos1">
                    <h3>Save <span>Upto</span> $10</h3>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="clearfix"> </div>
</div>
<!-- top-brands -->
<div class="top-brands">
    <div class="container">
        <h3><?= Yii::t('app', 'Hot Offers') ?></h3>
        <div class="agile_top_brands_grids">
            <?php
            \yii\widgets\Pjax::begin(['enablePushState' => false]);
            if(!empty($hot_products)){
                foreach ($hot_products as $product){
                    ?>
                    <div class="col-md-3 top_brand_left d_pad">
                        <div class="hover14 column d_pad">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid1 snipcart-details">
                                    <figure>
                                        <div class="snipcart-item block" >
                                            <div class="snipcart-thumb">
                                                <a href="<?= \yii\helpers\Url::to(['/product/'.$product['slug']]) ?>"><img title=" " alt=" " src="images/products/<?= $product['image'] ?>" />
                                                    <p><?= $product['title'] ?></p>
                                                    <h4>$<?= $product['price'] ?></h4>
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
            ?>
            <div class="clearfix"> </div>
            <?php

            echo \yii\widgets\LinkPager::widget(['pagination' => $pager]);

            \yii\widgets\Pjax::end();
            ?>
        </div>
    </div>
</div>
<!-- //top-brands -->
<!-- fresh-vegetables -->
<div class="fresh-vegetables">
    <div class="container">
        <h3><?= Yii::t('app', 'Top Products')?></h3>
        <div class="agile_top_brands_grids">
            <?php
            \yii\widgets\Pjax::begin(['enablePushState' => false]);
            if(!empty($top_products)){
                foreach ($top_products as $product){
                    ?>
                    <div class="col-md-3 top_brand_left d_pad">
                        <div class="hover14 column d_pad">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid1 snipcart-details">
                                    <figure>
                                        <div class="snipcart-item block" >
                                            <div class="snipcart-thumb">
                                                <a href="<?= \yii\helpers\Url::to(['/product/'.$product['slug']]) ?>"><img class="image-width" title=" " alt=" " src="images/products/<?= $product['image'] ?>" />
                                                    <p><?= $product['title'] ?></p>
                                                    <h4>$<?= $product['price'] ?></h4>
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
            ?>
            <div class="clearfix"> </div>
            <?php

            echo \yii\widgets\LinkPager::widget(['pagination' => $pager]);

            \yii\widgets\Pjax::end();
            ?>
        </div>

        <div class="w3l_fresh_vegetables_grids">
            <div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
<!--                <div class="w3l_fresh_vegetables_grid2">-->

<!--                    <ul>-->
<!---->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">All Brands</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.html">Vegetables</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="vegetables.html">Fruits</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="drinks.html">Juices</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="pet.html">Pet Food</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="bread.html">Bread & Bakery</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="household.html">Cleaning</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Spices</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Dry Fruits</a></li>-->
<!--                        <li><i class="fa fa-check" aria-hidden="true"></i><a href="products.html">Dairy Products</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
<!--            <div class="col-md-9 w3l_fresh_vegetables_grid_right">-->
<!--                <div class="col-md-4 w3l_fresh_vegetables_grid">-->
<!--                    <div class="w3l_fresh_vegetables_grid1">-->
<!--                        <img src="images/8.jpg" alt=" " class="img-responsive" />-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-4 w3l_fresh_vegetables_grid">-->
<!--                    <div class="w3l_fresh_vegetables_grid1">-->
<!--                        <div class="w3l_fresh_vegetables_grid1_rel">-->
<!--                            <img src="images/7.jpg" alt=" " class="img-responsive" />-->
<!--                            <div class="w3l_fresh_vegetables_grid1_rel_pos">-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="w3l_fresh_vegetables_grid1_bottom">-->
<!--                        <img src="images/10.jpg" alt=" " class="img-responsive" />-->
<!--                        <div class="w3l_fresh_vegetables_grid1_bottom_pos">-->
<!--                            <h5>Special Offers</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-4 w3l_fresh_vegetables_grid">-->
<!--                    <div class="w3l_fresh_vegetables_grid1">-->
<!--                        <img src="images/9.jpg" alt=" " class="img-responsive" />-->
<!--                    </div>-->
<!--                    <div class="w3l_fresh_vegetables_grid1_bottom">-->
<!--                        <img src="images/11.jpg" alt=" " class="img-responsive" />-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="clearfix"> </div>-->
<!--                <div class="agileinfo_move_text">-->
<!--                    <div class="agileinfo_marquee">-->
<!--                        <h4>get <span class="blink_me">25% off</span> on first order and also get gift voucher</h4>-->
<!--                    </div>-->
<!--                    <div class="agileinfo_breaking_news">-->
<!--                        <span> </span>-->
<!--                    </div>-->
<!--                    <div class="clearfix"></div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //fresh-vegetables -->