<?php
use kartik\file\FileInput;
use yii\helpers\Url;
?>

<div id="example-basic">
    <h3>Keyboard</h3>
    <section>
        <p>Try the keyboard navigation by clicking arrow left or right!</p>
    </section>
    <h3>Effects</h3>
    <section>
        <p>Wonderful transition effects.</p>
    </section>
    <h3>Pager</h3>
    <section>
        <p>The next and previous buttons help you to navigate through your content.</p>
    </section>
</div>
 
    <div class="tab-content">

       <div id="step-1" class="tab-pane" role="tabpanel">
                <label class="control-label">Upload CV </label>
                <?=

                    FileInput::widget([
                        'name' => 'CV',
                        'id'=>'CVUpload',
                        'pluginOptions' => [
                            'multiple'=>false,
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false,
                            'accept' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats' ,'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
                        ]
                    ]);

                ?>
       </div>

       <div id="step-2" class="tab-pane" role="tabpanel">
          Step content
       </div>

       <div id="step-3" class="tab-pane" role="tabpanel">
          Step content
       </div>

       <div id="step-4" class="tab-pane" role="tabpanel">
          Step content
       </div>

    </div>



<?php

$script = <<<JS

$(function(){ 

    $("#example-basic").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true
    });
   
});




JS;
$this->registerJs($script);
