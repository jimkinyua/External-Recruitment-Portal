<?php

namespace app\models;
use Yii;
use yii\base\Model;

class JobsCard extends Model{
    public $Key;
    public $Requisition_No;
    public $Job_Id;
    public $Job_Description;
    public $Occupied_Position;
    public $No_Posts;
    public $Requisition_Type;
    public $Employment_Type;
    public $Reasons_For_Requisition;
    public $Status;
    public $Type;
    public $Previous_Requisition;
    public $Closed;
    public $Start_Date;
    public $Requisition_Period;
    public $End_Date;
    public $Probation_Period;
    public $Contract_Period;
    public $Job_Grade;
    public $J_G_Steps;
    public $Basic_Pay;
    public $Minimum_Years_of_Experience;
       
    public function rules(){
        return [  
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'Fixed_Period_M' => 'Fixed Period in Months',
            'FD_Type'=>'Fixed Deposit Type',
            'Source_Of_Funds'=> 'Bank Receipt No'
        ];
    }

 
}

?>

