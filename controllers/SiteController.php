<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
//use app\models\LoginForm;
//use app\models\ContactForm;
use yii\web\HttpException;

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
        // Выбор категорий только верхнего уровня
        $categories = Categories::findAll(['parent_id' => 0, 'status' => 1]);
        //Определение массива для отображения во view
        $cats = [];
        foreach($categories as $category) {
            $cats[$category->parent_id][$category->id] =  $category;
        }

        return $this->render('index', ['cats' => $cats]);
    }

    public function actionCategory($alias)
    {
        //Поиск запрошенной категории
        $currentCategory = Categories::findOne(['alias' => $alias, 'status' => 1]);

        //Есди не найдено 404
        if(!$currentCategory) {
            throw new HttpException('Категория не найдена', 404);
        }

        //Информация о родительской категории
        $parentCategory = Categories::find()
            ->where(['id' => $currentCategory->parent_id, 'status' => 1])
            ->one();

        //Все категории для отображения во view
        $categories = Categories::findAll(['parent_id' => $currentCategory->id, 'status' => 1]);
        $cats = [];
        $products = [];

        //Если не найдены, то ищем товары
        if(!$categories) {
            $products = Product::find()->where(['category' => $currentCategory->id])->all();
        } else {
            foreach($categories as $category) {
                $cats[$category->parent_id][$category->id] =  $category;
            }
        }

        return $this->render('index', [
            'currentCategory' => $currentCategory,
            'cats' => $cats,
            'products' => $products,
            'parentCategory' => $parentCategory
        ]);
    }

    /*public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
    }*/
}
