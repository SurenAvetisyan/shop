<?php
/**
 * Created by PhpStorm.
 * User: ghost
 * Date: 10/1/18
 * Time: 7:25 PM
 */

namespace frontend\controllers;


use common\models\Products;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
use yii\data\Pagination;

class ProductsController extends Controller
{

    public function actionIndex(){
        $p_search = trim(Yii::$app->request->get('p_search'));
        $query = Products::find()->where(['like', 'title', $p_search]);
        $pages = new Pagination (['totalCount'=>$query->count(), 'pageSize'=>12 ,'forcePageParam'=>false, 'pageSizeParam'=>4]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', [
            'products' => $products,
            'pages' => $pages,
            'p_search' => $p_search,
        ]);

    }

    public function actionProduct($slug)
    {
        $product = Products::findOne(['slug' => $slug]);
        if (empty($product)) {
            throw new NotFoundHttpException('Product not found');
        }

        return $this->render('product', [
            'product' => $product
        ]);

    }



}