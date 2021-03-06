<?php

namespace backend\controllers;

use Yii;
use common\models\Brands;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BrandController implements the CRUD actions for Brands model.
 */
class BrandController extends Controller
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
     * Lists all Brands models.
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
//        $brands = Brands::find()->with('products')->where(['id'=>6])->asArray()->one();
//
//        echo "<pre>";
//        var_dump($brands);
//        die;

        $dataProvider = new ActiveDataProvider([
            'query' => Brands::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brands model.
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
     * Creates a new Brands model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brands();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $imgFile = UploadedFile::getInstance($model,'image');

            if (!empty($imgFile)){
                $imgPath = Yii::getAlias('$frontend') . '/web/images/brands/';
                $imgName = Yii::$app->security->generateRandomString(). '.' . $imgFile->extension;

                $path = $imgPath.$imgName;
                if ($imgFile->saveAs($path)){
                    $model->image = $imgName;
                    $model->update(false);
                }
            }
//            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,

        ]);
    }

    /**
     * Updates an existing Brands model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $brands = Brands::find()->asArray()->all();

        $brands = ArrayHelper::map($brands,'id','title');
        $old_foto = $model->image;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $imgFile = UploadedFile::getInstance($model,'image');

            if (!empty($imgFile)){
                $imgPath = Yii::getAlias('@frontent') . '/web/images/brands';

                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;

                $path = $imgPath . $imgName;

                if ($imgFile->saveAs($path)){
                    $model->image = $imgName;
                    $model->update(false);
                    if (!empty($old_foto)){
                        unlink($imgPath.$old_foto);
                    }
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'brands' => $brands
        ]);
    }

    /**
     * Deletes an existing Brands model.
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
     * Finds the Brands model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brands the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brands::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
