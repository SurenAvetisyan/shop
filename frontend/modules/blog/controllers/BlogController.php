<?php

namespace frontend\modules\blog\controllers;

use frontend\modules\blog\models\Blog;
use common\models\Articles;
use common\models\Comment;
use frontend\modules\blog\models\ArticleControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Default controller for the `blog` module
 */
class BlogController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
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

    public function actionAddComment()
    {
        if(\Yii::$app->user->isGuest){
            return json_encode(['error' => 'Please Login to your account!']);
        }else{
            if (Yii::$app->request->isAjax) {
                $res = [
                    'status' => 'error',
                ];

                $comment = new Comment();
                $username = Yii::$app->user->identity->username;

                if ($comment->load(Yii::$app->request->post())) {
                    $comment->user_id = Yii::$app->user->id;
                    $date = date('Y-m-d H:i:s');
                    if ($comment->save()) {

                        $res = [
                            'status' => 'ok',
                            'user_name' => $username,
                            'date' => $date,
                        ];
                    } else {
                        $res['message'] = 'Can\'t save comment';
                    }
                } else {
                    $res['message'] = 'Can\'t load data';
                }

                return json_encode($res);
            }
        }



    }

    /**
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {

        $comment = new Comment();
        $blog = Blog::find()->all();

        return $this->render('index', [
            'comment' => $comment,
            'blog' => $blog,
        ]);

    }

    public function actionComment($id){
        $comment = new Comment();
        $blog = Blog::findOne($id);

        return $this->render('comment', [
            'comment' => $comment,
            'item' => $blog,
        ]);

    }

}
