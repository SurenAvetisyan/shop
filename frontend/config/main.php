<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'blog' => [
            'class' => 'frontend\modules\blog\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                ],
                'mydb*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    //'forceTranslation'=>true,
                ],
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en', 'ru', 'fr'],
            'enableDefaultLanguageUrlCode' => false,
            'rules' => [
                'blog/' => 'blog/blog',
                'blog/comment/<id:\d+>' => 'blog/blog/comment',
                'blog/<action>' => 'blog/blog/<action>',
                'product/<slug>' => 'products/product',
                'product/' => 'products/product',
                'category/' => 'category/',
                'category/index' => 'category/',
                'category/<slug>' => 'category/category',
                'category/<action>' => 'category/<action>',
                'brand/<slug>' => 'barnds/brand',
                '<controller>/<action>' => '<controller>/<action>',
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<controller>/<action>/<slug>' => '<controller>/<action>',
                '<slug>' => 'site/article',

            ],
        ],
    ],
    'params' => $params,
];
