<?php
use yii\helpers\Url;
?>

<a class="btn btn-primary btn-lg btn-block" href="<?= Url::to(['apply', 'JobId'=>$model->Requisition_No, 'ApplicationMethod'=>'Auto']) ?>" role="button">AutoFill From Resume</a>
<a class="btn btn-primary btn-lg btn-block" href="<?= Url::to(['apply', 'JobId'=>$model->Requisition_No, 'ApplicationMethod'=>'Manual']) ?>" role="button">Apply Manually </a>