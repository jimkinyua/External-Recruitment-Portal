<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <!-- <div class="jumbotron text-center bg-transparent">
        <h1 class="display-6">Congratulations!</h1>

        <p class="lead">Welcome to Our Portal </p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div> -->

    <div class="body-content">

        <!-- <div class="row"> -->
            <table id="example" class="display nowrap" style="width:100%"> </table>
        <!-- </div> -->

    </div>
</div>


<?php

$script = <<<JS

    $(function(){ 
    // SmartWizard initialize




        $('#example').DataTable({
            "ajax": '/site/get-vaccanices',
            paging: true,
            columns: [
                { title: '#' ,data: 'index'},
                { title: 'Job Title' ,data: 'Job_Description'},
                { title: 'Available Posts' ,data: 'No_Posts'},
                { title: 'Employment Type' ,data: 'Employment_Type'},
                { title: 'Contract_Period' ,data: 'Contract_Period'},
                
                { title: 'Application End Date' ,data: 'End_Date'},
                { title: 'Update Action', data: 'Update_Action' },

            ] ,                              
           language: {
                "zeroRecords": "No Vacancies available"
            },

            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ]
        });
         
    });//end jquery
   

        
JS;
$this->registerJs($script);
