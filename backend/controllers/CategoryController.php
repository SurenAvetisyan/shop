<?php

namespace backend\controllers;

use Yii;
use common\models\Categories;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Categories model.
 */
class CategoryController extends Controller
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
     * Lists all Categories models.
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
        $dataProvider = new ActiveDataProvider([
            'query' => Categories::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();
        $categories = Categories::find()->asArray()->all();
        $categories_list = ArrayHelper::map($categories,'id','title');

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $imgFile = UploadedFile::getInstance($model, "image");

            if (!empty($imgFile) && $imgFile->error == 0) {

                $imgPath = Yii::getAlias("@frontend") . "/web/images/category/";
                //$image_name = (uniqid('logo').$imgPath->baseName.date('dHis') ). '.' . $imgPath->extension;

                $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;

                $path = $imgPath . $imgName;
                if ($imgFile->saveAs($path)) {
                    $model->image = $imgName;
                    $model->update(false);
                }
            }


            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories_list
        ]);
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = Categories::find()->asArray()->all();
        $categories_list = ArrayHelper::map($categories,'id','title');
        $old_image = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            $model->image = $old_image;
            $imgFile = UploadedFile::getInstance($model, "image");
            if (!empty($imgFile) && $imgFile->error == 0) {
                $imgPath = Yii::getAlias("@frontend") . "/web/images/category/";
                //$image_name = (uniqid('logo').$imgPath->baseName.date('dHis') ). '.' . $imgPath->extension;

                if ($old_image) {
                    $path = $imgPath . $old_image;
                    $imgFile->saveAs($path);
                } else {
                    $imgName = Yii::$app->security->generateRandomString() . '.' . $imgFile->extension;

                    $path = $imgPath . $imgName;
                    if ($imgFile->saveAs($path)) {
                        $model->image = $imgName;
                    }
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories'=> $categories_list
        ]);
    }

    /**
     * Deletes an existing Categories model.
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
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
