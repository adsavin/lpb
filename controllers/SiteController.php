<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->language != Yii::$app->session->get("lang"))
            Yii::$app->language = Yii::$app->session->get("lang");

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

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
        if (Yii::$app->user->isGuest)
            return $this->redirect(["site/login"]);

        $this->layout = "index";
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->goBack();

        $this->layout = "login";
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $temp = Yii::$app->session->get("lang");
        Yii::$app->user->logout();
        Yii::$app->session->set("lang", $temp);
        Yii::$app->language = $temp;
        return $this->goHome();
    }

    public function actionChangelang($l = "en") {
        Yii::$app->language = $l == "la" ? "la-LA" : "en-US";
        Yii::$app->session->set("lang", Yii::$app->language);
        return $this->redirect(Yii::$app->request->referrer);
    }
}
