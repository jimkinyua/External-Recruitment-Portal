<?php
use kartik\file\FileInput;
use yii\helpers\Url;
?>
<div class="file-loading">

    <label class="control-label">Upload Document</label>';
    <?=
     FileInput::widget([
        'name' => 'CV',
        'options'=>[
            'multiple'=>false,
            'accept' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats' ,'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
        ],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/site/file-upload']),
            'uploadExtraData' => [
                // 'album_id' => 20,
                // 'cat_id' => 'Applicant CV'
            ],
            'maxFileCount' => 1
        ]
    ]);

    ?>

</div>


<?php

$script = <<<JS


JS;
$this->registerJs($script);
