<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Job Details'
?>
      <div class="row">
        <div class="col-md-10 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title"><?= $model->Job_Description ?></h2>
                <p class="blog-post-meta"> Employment Type: <strong> <?= $model->Employment_Type ?> </strong> </p>
               
         
                <?= \yii\helpers\Html::a('Apply For This Role',Url::to(['application-methods', 'Key'=>$model->Key]),['class' => 'btn btn-success Apply']) ?>


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
        $('.Apply').on('click',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            console.log('clicking...');
            $('.modal').modal('show')
                            .find('.modal-body')
                            .load(url); 
         });
JS;

$this->registerJs($script);

