<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/creditly.css',
        'css/easy-responsive-tabs.css',
        'css/flexslider.css',
        'css/font-awesome.css',
        'css/style.css'
    ];
    public $js = [
        'js/counterup.min.js',
        'js/creditly.js',
        'js/easing.js',
        'js/easyResponsiveTabs.js',
        'js/jquery.flexslider.js',
        'js/jquery.wmuSlider.js',
        'js/minicart.js',
        'js/move-top.js',
        'js/okzoom.js',
        //'js/waypoints.min.js',
        'js/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
