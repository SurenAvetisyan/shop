<?php // var_dump($product['image']);die(); ?>

<div class="agileinfo_single">
    <h5><?= $product['title']?></h5>
    <div class="col-md-4 agileinfo_single_left">
        <img id="example" src="/images/products/<?= $product['image'] ?>" alt=" " class="img-responsive">
    </div>
    <div class="col-md-8 agileinfo_single_right">
        <div class="w3agile_description">
            <h4>Description :</h4>
            <p><?= $product['description']?></p>

        </div>
        <div class="snipcart-item block">

            <div class="snipcart-thumb agileinfo_single_right_snipcart">
                <h4>Price - $<?= (!empty($product['discount'])?($product['price'] - (($product['price'] * $product['discount'])/100)):$product['price']); ?> <span><?= (!empty($product['discount'])?'$'.$product['price']:'' ) ?></span></h4>
            </div>

            <?php
            //           var_dump($product->stock);die;
            if ($product['stock'] != 0){ ?>
                <div class="snipcart-details agileinfo_single_right_details">
                    <input type="button" value="Add to cart" data-id="<?= $product['id'] ?>" class="add-to-cart button">
                </div>
            <?php
            } else{
            echo 'No product presently !';
            }
            ?>





        </div>
    </div>
    <div class="clearfix"> </div>
</div>