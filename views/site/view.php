<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Job Details'
?>
      <div class="row">
        <div class="col-md-10 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title"><?= $model->Job_Description ?></h2>
                <p class="blog-post-meta"> Employment Type: <strong> <?= $model->Employment_Type ?> </strong> </p>
                <p><a class="btn btn-lg btn-success pull-right" href="#">Apply</a></p>

                <hr>
                <table class="table table-bordered">
        
                        <tr>
                            <td><b>Closing Date: </b> <?= !empty($model->End_Date)?date_format( date_create($model->End_Date), 'l jS F Y') : ' Not Set' ?></td>
                            <td><b>Contract Period </b> <?= !empty($model->Contract_Period)?$model->Contract_Period: 'Not Set' ?></td>
                        </tr>

                        <tr>
                            <td><b>Probation Period : </b> <?= !empty($model->Probation_Period)?$model->Probation_Period: 'Not Set' ?></td>
                        </tr>

                </table> 
                <blockquote>
                <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </blockquote>
        
                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                
                <h2>Job Requirements</h2>

                <?php if(!empty($model->Hr_Job_Responsibilities->Hr_Job_Responsibilities) && sizeof($model->Hr_Job_Responsibilities->Hr_Job_Responsibilities)): ?>
                    <ul>
                        <?php foreach($model->Hr_Job_Responsibilities->Hr_Job_Responsibilities as $resp): ?>
                            <?php 
                        

                            ?>
                            <li><?= $resp->Responsibility_Description ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <?php else: ?>
                    <p> No responsibilities set yet.</p>
                <?php endif; ?>


                <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            
                <h3> Responsibilitties </h3>

                <?php if(!empty($model->Hr_job_requirements->Hr_job_requirements) && sizeof($model->Hr_job_requirements->Hr_job_requirements)): ?>
                    <ul>
                        <?php foreach($model->Hr_job_requirements->Hr_job_requirements as $resp): ?>
                            <?php 
                        //    echo '<pre>';
                        //    print_r($resp);
                        //    exit;

                            ?>
                            <li><?= @$resp->Requirment_Description ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <?php else: ?>
                    <p> No responsibilities set yet.</p>
                <?php endif; ?>


                <p>If this sounds like the perfect job opportunity then apply today! </p>
                <p>We are looking forward to hearing from you soon!</p>

            </div>
        </div>
        </div>


<?php

$script = <<<JS
    /*Parent-Children accordion*/ 
    
    $('td.parent').find('span').text('+');
    $('td.parent').find('span').css({"color":"red", "font-weight":"bolder", "margin-right": "10px"});    
    $('td.parent').nextUntil('td.parent').slideUp(1, function(){});    
    $('td.parent').click(function(){
            $(this).find('span').text(function(_, value){return value=='-'?'+':'-'}); //to disregard an argument -event- on a function use an underscore in the parameter               
            $(this).nextUntil('td.parent').slideToggle(100, function(){});
     });
JS;

$this->registerJs($script);

