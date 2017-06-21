<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;
class MainController extends Controller {

    //action map
    /**
     * @inheritdoc
     */
    public function actions() {
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

    //main page actions
    public function actionIndex() {
        //render view
        return $this->render('index');
    }
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionContacts() {
        return $this->render('contacts');
    }

    public function actionLogin() {
        if(Yii::$app->user->isGuest){
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->login()) {
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('error', 'Возникала ошибка при авторизации');
                    Yii::error('Ошибка при регистрации');
                    return $this->refresh();
                }
            }
            return $this->render('login', ['model' => $model]);
        } else {
            return $this->goHome();
        }
    }
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup() {
        $model = new SignupForm();
        if (isset($_POST['SignupForm'])) {
            $model->attributes = Yii::$app->request->post('SignupForm');
            if ($model->validate()) {
                if ($model->signup()) {
                    Yii::$app->session->setFlash('success', 'Signup was successful, you can now log in');
                    return $this->redirect(Yii::$app->homeUrl . 'main/login');
                } else {
                    Yii::$app->session->setFlash('error', 'Signup was not successful');
                    Yii::error('Signup error');
                    return $this->refresh();
                }
            }
        }
        return $this->render('signup', ['model' => $model]);
    }
}