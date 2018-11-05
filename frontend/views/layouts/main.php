<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
//echo $lang = Yii::$app->language;
//echo "<br>";
//echo Yii::t('app','Hello, {username}!',[
//    'username' => Yii::$app->user->identity->username
//]);
//        echo "<br>";
//
//        echo Yii::t('mydb','message from db');
//        echo "<br>";
////
//        $username = 'Alexander';
//        // display a translated message with username being "Alexander"
//        echo \Yii::t('app', 'Hello, {username}!', [
//            'username' => $username,
//        ]);
//
//        $username = 'Qiang';
//        // display a translated message with username being "Qiang"
//        echo \Yii::t('app', 'Hello, {username}!', [
//            'username' => $username,
//        ]);
//
       // echo \Yii::t('app', 'Home');
?>
<div class="agileits_header">
    <div class="w3l_offers">

        <a href="/<?= Yii::$app->language;?>/category"><?= Yii::t('app','All Category !');  ?></a>
    </div>

    <div class="w3l_search">
        <form action="<?= \yii\helpers\Url::to(['/products/index'])?>" method="get">
            <input name='p_search' type="text" name="Product" value="<?= Yii::t('app', 'Search a product...') ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
            <input type="submit" value=" ">
        </form>
    </div>
    <?php
    if (!Yii::$app->user->isGuest){ ?>
        <div class="product_list_header">
        <a class="button" href="/<?= Yii::$app->language;?>/cart/checkout"><?= Yii::t('app','View your cart');  ?></a>
    </div>
    <?php
    }
    ?>

    <div class="w3l_header_right">
        <ul>
            <li class="dropdown language-drop">
                <a href="#" style="padding-top: 1em;display: block;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag f-color" aria-hidden="true"></i><span class="caret f-color"></span></a>
                <div class="mega-dropdown-menu">
                    <div class="w3ls_vegetables">
                        <ul class="dropdown-menu drp-mnu">
                            <li><a href="/en">EN</a></li>
                            <li><a href="/ru">RU</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="w3l_header_right">
        <ul>
            <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
                <div class="mega-dropdown-menu">
                    <div class="w3ls_vegetables">
                        <ul class="dropdown-menu drp-mnu">
                            <?php
                            if (Yii::$app->user->isGuest) {
                                echo '<li><a href="/'.Yii::$app->language.'/site/login">'. Yii::t('app','Login').'</a></li>';
                                echo '<li><a href="/'.Yii::$app->language.'/site/signup">'. Yii::t('app','Signup').'</a></li>';
                            } else {
                               echo '<li>'
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                       Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-link logout']
                                    )
                                    . Html::endForm()
                                    . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="w3l_header_right1">
        <h2><a href="/<?= Yii::$app->language;?>/site/contact"><?= Yii::t('app','Contact Us');?></a></h2>
    </div>
    <div class="clearfix"> </div>
</div>
<div class="logo_products">
    <div class="container">
        <div class="w3ls_logo_products_left">
            <h1><a href="/<?= Yii::$app->language;?>"><span>Grocery</span> Store</a></h1>
        </div>
        <div class="w3ls_logo_products_left1">
            <?php
                $menuItems = [
                    ['label' => Yii::t('app','Home'), 'url' => ['/']],
                    ['label' => Yii::t('app','Catalog'), 'url' => ['/products/index']],
                    ['label' => Yii::t('app','About'), 'url' => ['/site/about']],
                    ['label' => Yii::t('app','Blog'), 'url' => ['/blog']],
                    ['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']],
                ];
                echo Nav::widget([
                    'options' => ['class' => 'special_items'],
                    'items' => $menuItems,
                ]);
            ?>
        </div>
        <div class="w3ls_logo_products_left1">
            <?php echo \frontend\widgets\info\InfoWidget::widget(['info' => ['email' => 'yii-shop.@gmail.com','phone' => '+374-55-55-55-55']]) ?>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<?php
if(isset($this->params['breadcrumbs'])){
    ?>
    <div class="products-breadcrumb">
        <div class="container">
            <?= \yii\widgets\Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'],
                'options' => ['class'=>'']
        ]) ?>
        </div>
    </div>
    <?php
}
?>
<!-- banner -->
<div class="banner">
    <div class="w3l_banner_nav_left">
        <?php echo \frontend\widgets\sidebar\SidebarWidget::widget(['is_left' => true]); ?>
    </div>
    <div class="w3l_banner_nav_right">
        <?= $content;?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="footer">
    <div class="container">
        <?php echo \frontend\widgets\footer\FooterWidget::widget()  ?>


        <div class="clearfix"> </div>
        <div class="agile_footer_grids">
            <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
                <div class="w3_footer_grid_bottom">
                    <h4>100% secure payments</h4>
                    <img src="/images/card.png" alt=" " class="img-responsive" />
                </div>
            </div>
            <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
                <div class="w3_footer_grid_bottom">
                    <h5><?= Yii::t('app', 'connect with us') ?></h5>
                    <ul class="agileits_social_icons">
                        <li><a href="https://www.facebook.com/" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://twitter.com/" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://plus.google.com/discover" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.instagram.com/" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="https://dribbble.com/" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="wthree_footer_copy">
            <p>© 2018 Grocery Store. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
        </div>
    </div>
</div>
    <?php
//    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);
//    $menuItems = [
//        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
//        ['label' => 'Blog', 'url' => ['/blog']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
//    ];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//    } else {
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
//    }
//
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => $menuItems,
//    ]);
//    NavBar::end();
    ?>
<div class="popup"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
