<?php
/**
 * Created by PhpStorm.
 * User: ghost
 * Date: 10/5/18
 * Time: 7:13 PM
 */

namespace frontend\controllers;


use common\models\Categories;
use common\models\Products;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{


    public function actionIndex(){
        $categories = Categories::find();
        //$total_count = Products::find()->count();

        $pages = new Pagination(['totalCount' => count($categories->asArray()->all()), 'pageSize' =>12]);

        $categories = $categories->offset($pages->offset)->limit($pages->limit)->asArray()->all();

//        $categories = Categories::find()->asArray()->all();
        return $this->render('index', [
            'categories' => $categories,
            'pager' => $pages
        ]);
    }

    public function actionCategory($slug){

        $category = Categories::findOne(['slug'=>$slug]);
        if(!empty($category)){
            $cat_id = $category->id;
            $categories = Categories::find()->with('products')->where(['id'=>$cat_id])->asArray()->one();

            return $this->render('category',
                [
                    'categories' => $categories
                ]
            );

        }else{
            throw new NotFoundHttpException('Category Not found');
        }

    }

}