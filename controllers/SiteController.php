<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ContentMenu;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
//        $model = new ContentMenu();
//        $model = ContentMenu::find()->where(['status'=>'1'])->one();
//        var_dump($model);

        $model = ContentMenu::findOne(['status' => 1]);
//        var_dump($model);
        return $this->render('index',['model'=>$model]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
            return $this->redirect('/content-menu');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUpdateStatus()
    {
        $model_on = ContentMenu::findOne(['status' => 'on']);
//        var_dump($model_on->date_update);
//        var_dump(date('Y-m-d H:i:s'));

//        $interval = date('d', strtotime(date('Y-m-d H:i:s'))) - date('d', strtotime($model_on->date_update)-(2*24*60*60));
        $interval = date('d', strtotime(date('Y-m-d H:i:s'))) - date('d', strtotime($model_on->date_update));
//        var_dump($interval);
        if ($interval == 2) {
            $model_on->status = 'off';
            $model = ContentMenu::find()->where(['>','id',$model_on->id])->orderBy(['id' => SORT_ASC])->one();
            if(!$model) {
//            $model = $this->findModelContent('1');
                $model = ContentMenu::find()->orderBy(['id' => SORT_ASC])->one();
            }

            $model->status = 'on';
            $model->date_update = date('Y-m-d H:i:s');

            if($model->save() && $model_on->save()) {
                return true;
            }
        } else {
            echo 'Разница в днях ' . $interval;
        }


    }

    protected function findModelContent($id)
    {
        if (($model = ContentMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
