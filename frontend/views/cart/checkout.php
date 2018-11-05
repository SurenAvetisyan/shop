<?php ?>

<div class="privacy about">
    <h3><?= Yii::t('app','Checkout') ?></h3>
<?php
if(Yii::$app->session->getFlash('mail_sent')){
   echo Yii::$app->session->getFlash('mail_sent');
}
?>
    <div class="checkout-right">
        <h4><?= Yii::t('app','our shopping cart contains:') ?> <span><?= count($cart) ?> <?= Yii::t('app','Products') ?></span></h4>
        <table class="timetable_sub">
            <thead>
            <tr>
                <th><?= Yii::t('app', 'SL No.') ?></th>
                <th><?= Yii::t('app', 'Product') ?></th>
                <th><?= Yii::t('app', 'Quantity') ?></th>
                <th><?= Yii::t('app', 'Product Name') ?></th>
                <th><?= Yii::t('app', 'Price') ?></th>
                <th><?= Yii::t('app', 'Remove') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $num = 1;
            if ($cart) {
                foreach ($cart as $item)
                {

                ?>
                <tr data-id="<?= $item['id'] ?>" class="rem1">
                    <td class="invert"><?= $num++
                        ?></td>
                    <td class="invert-image"><a href="#"><img src="/images/products/<?= $item['product']['image'] ?>" alt=" "
                                                                        class="img-responsive"></a></td>
                    <td class="invert">
                        <div class="quantity">
                            <div class="quantity-select">
                                <div class="entry value-minus p">&nbsp;</div>
                                <div class="entry value pr-color"><input type="text" value="<?= $item['qty'] ?>" class="pr-quantity p"></div>
                                <div class="entry value-plus active p">&nbsp;</div>
                            </div>
                        </div>
                    </td>
                    <td class="invert"><?=$item['product']['title'] ?></td>

                    <td class="invert">$<?= $item['product']['price'] ?></td>
                    <td class="invert">
                        <div class="rem">
                            <div  class="close"></div>
                        </div>

                    </td>
                </tr>
                <?php
            }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="checkout-left">
        <div class="col-md-4 checkout-left-basket">
            <h4><?= Yii::t('app', 'CONTINUE TO BASKET') ?></h4>
            <ul>
                <?php
                $total = 0;
                if ($cart) {
                    foreach ($cart as $item) {

                        $sub_total = ($item['product']['price'] * $item['qty']);
                        $total+= $sub_total;
                        ?>
                        <li data-id="<?= $item['id']; ?>"><?= $item['product']['title']; ?>
                            <span>$<?= $sub_total; ?></span>
                        </li>
                        <?php
                    }
                }
                ?>
                <li class="total-price"><?= Yii::t('app', 'Total') ?><span>$<?= $total;?></span></li>
            </ul>
        </div>
        <div class="col-md-8 address_form_agile">
            <h4>Add a new Details</h4>
            <?php
            $form = \yii\widgets\ActiveForm::begin(['action'=>'/'. Yii::$app->language .'/cart/order', 'class' => 'creditly-card-form agileinfo_form', 'options' => ['method' => 'post',]]);
            ?>
            <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                    <div class="information-wrapper">
                        <div class="first-row form-group">
                            <div class="controls">
                                <?= $form->field($model,'full_name')->textInput(['placeholder'=>'Full name','class'=>'billing-address-name form-control'])?>
                            </div>
                            <div class="w3_agileits_card_number_grids">
                                <div class="w3_agileits_card_number_grid_left">
                                    <div class="controls">
                                        <?= $form->field($model,'phone')->textInput(['placeholder'=>'Mobile number','class'=>'billing-address-name form-control'])?>
                                    </div>
                                </div>
                                <div class="w3_agileits_card_number_grid_right">
                                    <div class="controls">
                                        <?= $form->field($model,'email')->textInput(['placeholder'=>'Email','class'=>'billing-address-name form-control'])?>
                                    </div>
                                </div>
                                <div class="clear"> </div>
                            </div>
                            <div class="controls">
                                <?= $form->field($model,'town')->textInput(['placeholder'=>'Town','class'=>'billing-address-name form-control'])?>
                            </div>
                            <div class="controls">
                                <?= $form->field($model,'address')->textInput(['placeholder'=>'Address','class'=>'billing-address-name form-control'])?>
                            </div>
                        </div>
                        <button class="submit check_out">Order products </button>
                    </div>
                </section>
            <?php
            \yii\widgets\ActiveForm::end();
            ?>
        </div>

        <div class="clearfix"> </div>

    </div>

</div>