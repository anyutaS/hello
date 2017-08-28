<?php

namespace app\controllers;

use app\models\Comments;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Image;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest):
            return $this->goHome();
        endif;
        $loginWithEmail = Yii::$app->params['loginWithEmail'];
        $model = $loginWithEmail ? new LoginForm(['scenario' => 'loginWithEmail']) : new LoginForm();
       
        if ($model->load(Yii::$app->request->post()) && $model->login()):
            return $this->goBack();
        endif;
        return $this->render(
            'login',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAddAdmin()
    {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@кодер.укр';
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionUpload()
    {
        $form = new Image();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->file = UploadedFile::getInstance($form, 'file');
            if ($form->upload()) {
                return $this->redirect(['post']);
            }
        }

        return $this->render('upload',
            ['form' => $form]
        );

    }

    public function actionPost()
    {
        $image = Image::find()->all();
        if (!empty($image)) {
            $dataProvider = new ActiveDataProvider([
                    'query' => Image::find(),
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'defaultOrder' => [
                            'id' => SORT_DESC,
                        ],
                    ],
                ]
            );
        } else {
            return $this->redirect(['image/create']);
        }

        return $this->render('post',
            ['listDataProvider' => $dataProvider]);


    }

    public function actionComments()
    {
        $count = Image::find()
        ->addSelect(["img_name","url","description","userId",'summ' => "count(*)"])
        ->leftJoin('comments', 'comments.idimage=image.id')
        ->groupBy(['image.id'])
        ->orderBy(['summ' => SORT_DESC])
        ->asArray()
        ->all();
        $comForm = new Comments();
        if ($comForm->load(Yii::$app->request->post()) && $comForm->save()) {
        }
        return $this->render('comments',
            [
                'comForm' => $comForm,
                'count' => $count,
            ]
        );
    }
}


