<?php

namespace app\controllers;

use app\models\Comments;
use Yii;
use app\models\Image;
use app\models\ImageSearch;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['view'],
//                'rules' => [
//                    [
//                        'actions' => ['view'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query = Image::find();
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 12
        ]);
        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination
        ]);
    }

    /**
     * Displays a single Image model.
     * @return mixed
     */
    public function actionView($id)
    {

        $query = Comments::find()->where(['idimage' => $id]);
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 5
        ]);
        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('view', [
                'model' => $this->findModel($id),
                'query' => $query,
//                'comForm' => $comForm,
                'models' => $models,
                'pagination' => $pagination
            ]
        );
    }

    public function actionComment()
    {
        $msg = Yii::$app->request->post('msg');
        $img_id = Yii::$app->request->post('img_id');
        if (!empty($msg)) {
            $comment = new Comments;
            $comment->idimage = $img_id;
            $comment->name = Yii::$app->user->identity->username;
            $comment->text = $msg;
            if ($comment->save()) {
                $msg_com = '<div class="col-lg-12">' . '<div class="panel panel-default">' . '<div class="panel-body">' . '<p>' . '<h4>' . 'Имя:' . ' ' . Html::encode($comment->name) . '</h4>' . '</p>' . '<p>' . '<h4>' . 'Комментарий:' . ' ' . Html::encode($comment->text) . '</h4>' . '</p>' . 'Дата создания:' . ' ' . Html::encode($comment->data) . "<br/>" . '</div>' . '</div>' . '</div>';
                return $msg_com;
            }
        }
    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Image();
        if ($model->load(Yii::$app->request->post())) {
//            print_r(Yii::$app->request->post());
//        exit();
            if (Yii::$app->user->identity) {
                $userId = Yii::$app->user->identity;
                $model->userId = $userId->id;
            }
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->upload()) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
////            return false;
//                echo 'загрузите фото';
                \Yii::$app->session->addFlash('info', 'Загрузите фото');
                return $this->redirect(['create', 'model' => $model,]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $usID = Yii::$app->user->identity;
        $userID = $this->findModel($id)->userId;

//        print_r(Yii::$app->user->identity->id);
//        exit();
        if ($usID->id == $userID) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->file = '';
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->upload()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->redirect(['site/error']);
        }
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $usID = Yii::$app->user->identity;
        $userID = $this->findModel($id)->userId;
//        print_r($this->findModel($id)->userId);
//        exit();
        if ($usID->id == $userID) {

            $this->findModel($id)->delete();
            Comments::deleteAll(['idimage' => $id]);
        } else {

            return $this->redirect(['site/error']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
