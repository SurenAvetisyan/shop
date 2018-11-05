<?php

namespace backend\controllers;

use common\models\Brands;
use common\models\Categories;
use Yii;
use common\models\Products;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */

//    public function beforeAction($action)
//    {
//        if(!Yii::$app->user->isGuest){
//
//            if(Yii::$app->user->identity->rols != '1'){
//                return $this->goHome();
//            }
//        }
//        return parent::beforeAction($action);
//    }

    public function actionIndex()
    {
        $this->enableCsrfValidation = false;

        $dataProvider = new ActiveDataProvider([
            'query' => Products::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        $brands = Brands::find()->asArray()->all();
        $categories = Categories::find()->asArray()->all();
        $products = Products::find()->asArray()->all();
        $products_list = ArrayHelper::map($products,'id','title');
        $brands_list = ArrayHelper::map($brands,'id','title');
        $categories_list = ArrayHelper::map($categories,'id','title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $imgFile = UploadedFile::getInstance($model, "image");

            if (!empty($imgFile)) {

                $imgPath = Yii::getAlias("@frontend") . "/web/images/products/";
                //$image_name = (uniqid('logo').$imgPath->baseName.date('dHis') ). '.' . $imgPath->extension;

                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;

                $path = $imgPath . $imgName;
                if($imgFile->saveAs($path)){
                    $model->image = $imgName;
                    $model->update(false);
                }
            }


            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'brands_list' => $brands_list,
            'products' => $products_list,
            'categories_list' => $categories_list
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_photo = $model->image;
        $brands = Brands::find()->asArray()->all();
        $categories = Categories::find()->asArray()->all();
        $products = Products::find()->where(['<>','id', $model->id])->asArray()->all();
        $products_list = ArrayHelper::map($products,'id','title');
        $brands_list = ArrayHelper::map($brands,'id','title');
        $categories_list = ArrayHelper::map($categories,'id','title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $imgFile = UploadedFile::getInstance($model, "image");

            if (!empty($imgFile)) {

                $imgPath = Yii::getAlias("@frontend") . "/web/images/products/";
                //$image_name = (uniqid('logo').$imgPath->baseName.date('dHis') ). '.' . $imgPath->extension;

                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;

                $path = $imgPath . $imgName;
                if($imgFile->saveAs($path)){

                    $model->image = $imgName;
                    $model->update(false);
                    if(!empty($old_photo)){
                        unlink($imgPath.$old_photo);
                    }

                }
            }else{
                $model->image = $old_photo;
                $model->save(false);
            }

            $session = Yii::$app->session;

// Request #1
// set a flash message named as "postDeleted"
            //$session->setFlash('postDeleted', 'You have successfully updated your product.');
            $session->addFlash('alerts', 'You have successfully deleted your post.');
            $session->addFlash('alerts', 'You have successfully added a new friend.');
            $session->addFlash('alerts', 'You are promoted.');

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'brands_list' => $brands_list,
            'products' => $products_list,
            'categories_list' => $categories_list
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
