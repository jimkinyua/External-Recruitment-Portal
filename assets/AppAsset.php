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
    ];
    public $js = [
        // 'https://code.jquery.com/jquery-3.5.1.js',
        'https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
