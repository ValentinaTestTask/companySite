<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Company;
use app\models\CompanyForm;
use app\models\Login;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
        if (!Yii::$app->user->isGuest)
        {
            $form = new CompanyForm;
            if ($form->load(Yii::$app->request->post()) && $form->validate() && Yii::$app->user->identity->attributes['role'] == 'admin')
            {
                $companyNew = new Company();
                $companyNew->name = Html::encode($form->name);
                $companyNew->directory = Html::encode($form->directory);
                $companyNew->inn = Html::encode($form->inn);
                $companyNew->address = Html::encode($form->address);
                $companyNew->save();
            }
            $companys = Company::find()->all();
            $form->name = '';
            $form->directory = '';
            $form->inn = '';
            $form->address = '';
            return $this->render('companys',
                ['companys' => $companys,
                'form' => $form,
                'role' => Yii::$app->user->identity->attributes['role']]

            );
            Yii::$app->user->identity->attributes->roles;
            return $this->render('index');
        }
        else
        {
            return $this->redirect( Yii::$app->urlManager->createUrl(['site/login']) );
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();

            return $this->goHome();
        }
    }

    public function actionCompanys()
    {
        $form = new CompanyForm;
        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $companyNew = new Company();
            $companyNew->name = Html::encode($form->name);
            $companyNew->directory = Html::encode($form->directory);
            $companyNew->inn = Html::encode($form->inn);
            $companyNew->address = Html::encode($form->address);
            $companyNew->save();
        }
        $companys = Company::find()->all();

        return $this->render('companys',
            [
                'companys' => $companys,
                'form' => $form,
                'role' => Yii::$app->user->identity->attributes['role']
            ]

        );
    }

    public function actionCompany($id)
    {
        $form = new CompanyForm;
        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $company = Company::find()->where(['id' => $id])->one();
            $company->name = Html::encode($form->name);
            $company->directory = Html::encode($form->directory);
            $company->inn = Html::encode($form->inn);
            $company->address = Html::encode($form->address);
            $company->save();
        }
        else
        {
            $company = Company::find()->where(['id' => $id])->one();
        }        

        return $this->render('company',
            [
                'company' => $company,
                'form' => $form,
                'role' => Yii::$app->user->identity->attributes['role']
            ]
        );
    }


    
    public function actionDelcompany($id)
    {
        $company = Company::find()->where(['id' => $id])->one();  
        $company->delete();     

        return $this->redirect( Yii::$app->urlManager->createUrl(['site/companys']) );
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $loginModel = new Login();
        if (Yii::$app->request->post('Login'))
        {
            $loginModel->attributes = Yii::$app->request->post('Login');
            if ($loginModel->validate())
            {
                Yii::$app->user->login($loginModel->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login',
            ['loginModel' => $loginModel]
        );
    }
}
