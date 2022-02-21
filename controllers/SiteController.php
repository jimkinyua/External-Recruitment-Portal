<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Html;
use yii\filters\ContentNegotiator;
use app\models\JobsCard;



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
                'only' => ['logout', 'get-vaccanices'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],

                        'actions' => ['get-vaccanices'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'contentNegotiator' =>[
                'class' => ContentNegotiator::class,
                'only' => ['get-vaccanices'],
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ]
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionGetVaccanices(){
        $service = Yii::$app->params['ServiceName']['JobsList'];

        $Vaccancies = Yii::$app->navhelper->getData($service);

        // echo '<pre>';
        // print_r($Vaccancies);
        // exit;


        $result = [];
        $count = 0;
      
        if(!is_object($Vaccancies)){
            foreach($Vaccancies as $Vaccancy){

                if(empty($Vaccancy->Job_Description) && empty($Vaccancy->Contract_Period)){ //Useless Vaccancy this One
                    continue;
                }
                ++$count;
                $link = $updateLink =  '';
                // $data = $this->ApplicantDetailWithDocNum($Vaccancy->Application_No);


                // if($data->Portal_Status == 'New'){
                    $updateLink = Html::a('View Details',['view','Key'=> urlencode($Vaccancy->Key) ],['class'=>'update btn btn-info btn-md']);
                // }else{
                //     $updateLink = '';
                //     $link = '';
                // }

                $result['data'][] = [
                    'index' => $count,
                    'Job_Description' => !empty($Vaccancy->Job_Description)?$Vaccancy->Job_Description:'',
                    'No_Posts' => !empty($Vaccancy->No_Posts)?$Vaccancy->No_Posts:'',
                    'Employment_Type' => !empty($Vaccancy->Employment_Type)?$Vaccancy->Employment_Type:'',
                    'Contract_Period' => !empty($Vaccancy->Contract_Period)?$Vaccancy->Contract_Period:'',
                    'End_Date' => !empty($Vaccancy->End_Date)?$Vaccancy->End_Date:'',                    
                    'Update_Action' => $updateLink,
                ];
            }
        
        }
        return $result;
    }

    public function actionView($Key){
        $model = new JobsCard();
        $service = Yii::$app->params['ServiceName']['JobsCard'];
        $result = Yii::$app->navhelper->readByKey($service, urldecode($Key));
        return $this->render('view',[
            'model' => $result,
        ]);
    }

    public function actionApplicationMethods($Key){
        $model = new JobsCard();
        $service = Yii::$app->params['ServiceName']['JobsCard'];
        $result = Yii::$app->navhelper->readByKey($service, urldecode($Key));
        return $this->renderAjax('application-method',[
            'model' => $result,
        ]);
    }

    public function actionApply($JobId, $ApplicationMethod){

        if(Yii::$app->user->isGuest){
            $RequisitionId = Yii::$app->request->get('JobId');
            $ApplicationMethod = Yii::$app->request->get('ApplicationMethod');
            Yii::$app->user->setReturnUrl(['site/apply','JobId'=> $RequisitionId, 'ApplicationMethod'=>$ApplicationMethod]);
           return Yii::$app->response->redirect(['site/login']);           
        }
        
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

    public function loadtomodel($obj,$model){

        if(!is_object($obj)){
            return false;
        }
        $modeldata = (get_object_vars($obj)) ;
        foreach($modeldata as $key => $val){
            if(is_object($val)) continue;
            $model->$key = $val;
        }

        return $model;
    }

    public function loadpost($post,$model){ // load model with form data


        $modeldata = (get_object_vars($model)) ;

        foreach($post as $key => $val){

            $model->$key = $val;
        }

        return $model;
    }
    
}
