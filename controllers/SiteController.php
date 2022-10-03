<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Image;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
        $dataProvider = new ActiveDataProvider([
            'query' => Image::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAdd()
    {
        $model = new \app\models\Image();
    
        if ($model->load(Yii::$app->request->post())) {
            if($model->add()){
                return $this->redirect('index');

            }
        }
    
        return $this->render('add', [
            'model' => $model,
        ]);
    }
    
    public function actionView($id){
        $model = Image::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
