<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignUpForm;
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

        if($ApplicationMethod == 'Auto'){
            //Redirect to upload CV Page
            return $this->render('upload-cv',[
                'JobId' => $JobId,
            ]);
        }
        
    }

    public function actionFileUpload(){
        if (isset($_FILES)) {
            $target_dir = "Applicant CVs/";
            $target_file = $target_dir . basename($_FILES["CV"]["name"]); //Where To Save the PDF
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if (!file_exists('Applicant CVs')) {
                mkdir('Applicant CVs', 0777, true);
            }

            if (move_uploaded_file($_FILES["CV"]["tmp_name"], $target_file)) {
                // echo "The file ". htmlspecialchars( basename( $_FILES["CV"]["name"])). " has been uploaded.";
                return $this->ParseCV($target_file);
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            
            // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        }
    }

    public function ParseCV($DocumentPath){
        // open the file
        $filepath = $DocumentPath;
        // exit($filepath);
        $handle = fopen($filepath, "r");
        $contents = fread($handle, filesize($filepath));
        fclose($handle);
        
        $modifiedDate = date("Y-m-d", filemtime($filepath));
        
        //encode to base64
        $base64str = base64_encode($contents);
        $data = ["DocumentAsBase64String" => $base64str, "DocumentLastModified" => $modifiedDate];
        //other options here (see https://sovren.com/technical-specs/latest/rest-api/resume-parser/api/)
        //use https://eu-rest.resumeparsing.com/v10/parser/resume if your account is in the EU data center or
        //use https://au-rest.resumeparsing.com/v10/parser/resume if your account is in the AU data center

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://au-rest.resumeparsing.com/v10/parser/resume',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER=> false,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'sovren-accountid: 15004599',
            'sovren-servicekey: GHM9Nn05W4aTUa1+3coOeB6ftcuJy2nsTsj7ucz1'
        ),
        CURLOPT_POSTFIELDS => json_encode($data),

        ));

        $response = curl_exec($curl);
        return $response;
        curl_close($curl);
        // echo '<pre>';
        // print_r($response);
        // exit;;

        
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
    public function actionSignup()
    {
        $model = new SignUpForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            $this->redirect(array('site/login'));
        }

        return $this->render('signup', [
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
