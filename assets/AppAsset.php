<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/floating-labels.css',
        //Datatable
        'https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css',
        'https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css',

        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',

        //Smart Wizard
        'https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css',

        // the fileinput plugin styling CSS file -->
        // 'https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css',
    ];
    public $js = [
        // 'https://code.jquery.com/jquery-3.5.1.js',
        'https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js',

        'https://use.fontawesome.com/releases/v5.3.1/js/all.js',

        //Smart Wizard
        'https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js',

        'JquerySteps/jquery.steps.js',
        'JquerySteps/jquery.steps.min.js'



    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
