<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Products'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $session = Yii::$app->session;

    if($session->hasFlash('alerts')){
        $msg = "";
        foreach (Yii::$app->session->getFlash('alerts') as $alert){
            $msg .= $alert."<br>";
        }

        echo \yii\bootstrap\Alert::widget([
            'options' => ['class' => 'alert-success'],
            'body' => $msg,
        ]);
    }

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' =>'table table-striped table-bordered tables-custom'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            ['class' => '\yii\grid\CheckboxColumn'],
//            ['class' => '\yii\grid\RadioButtonColumn'],
            [
                 'attribute' =>'price',
                'value' => function($model){
//                    return date('Y/m/d',strtotime($model->date));
                    return '$'.round($model->price,2);
                }
            ],
            [
                'attribute'=>'is_new',
                'filter'=> [0=>"Активно",1=>"Не активно"],
            ],

            'discount',
            'title',
            'SKU',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data){
                    if(!empty($data->image)){
                        return Html::img('/frontend/web/images/products/'.$data->image,['width'=>100]);
                    }

                }
            ],
//            [
//                'attribute' => 'updated_at',
//                'format' =>  ['date', 'HH:mm:ss dd.MM.YYYY'],
//                'options' => ['width' => '200']
//            ],

            'slug',
            //'description:ntext',
            //'is_new',
            //'is_sale',
            //'is_hit',
            //'brand_id',
            //'category_id',
            //'parent_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {view}',
                'buttons' => [
                    'update' => function ($url,$model) {

                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot"></span>',
                            $url);
                    },
                    'delete' => function ($url,$model) {

                        return Html::a(
                            '<span class="glyphicon glyphicon-glass"></span>',
                            $url);
                    },
                    'link' => function ($url,$model,$key) {
                        $url = '/';
                        return Html::a('link', $url);
                    },
                ],
            ],


        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
