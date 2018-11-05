<?php



if(!empty($categories['image'])){
    ?>
    <div class="w3l_banner_nav_right_banner4">
        <h3>Best Deals For New Products<span class="blink_me"></span></h3>
    </div>
    <?php
}
?>


<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub">
    <h3><?= $categories['title']; ?></h3>
    <div class="w3ls_w3l_banner_nav_right_grid1">
        <?php
        foreach ($categories['products'] as $product ){
           ?>
            <div class="col-md-3 w3ls_w3l_banner_left">
                <div class="hover14 column d_pad">
                    <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
<!--                        <div class="agile_top_brand_left_grid_pos">-->
<!--                            <img src="images/offer.png" alt=" " class="img-responsive">-->
<!--                        </div>-->
                        <div class="agile_top_brand_left_grid1">
                            <figure>
                                <div class="snipcart-item block">
                                    <div class="snipcart-thumb">
                                        <a href="/product/<?= $product['slug'];?>"><img src="/images/products/<?= $product['image'] ?>" alt=" " class="img-responsive">
                                            <p><?= $product['title']?></p>
                                            <h4>$<?= $product['price']?></h4>
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

        ?>

        <div class="clearfix"> </div>
    </div>
</div>