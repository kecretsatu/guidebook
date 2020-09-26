<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminLtePluginsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'datatables/datatables.min.css',
    ];
    public $js = [
        'datatables/datatables.min.js',
        'jQueryUI/jquery-ui.min.js',
		'highcharts/highcharts.js',
		'highcharts/exporting.js',
		'highcharts/drilldown.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'dmstr\web\AdminLteAsset',
    ];
}
