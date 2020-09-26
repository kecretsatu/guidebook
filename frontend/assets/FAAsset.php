<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FAAsset extends AssetBundle
{
    public $sourcePath = '@vendor/rmrevin/yii2-fontawesome/assets';
    public $css = [
        'css/font-awesome.min.css',
    ];
}
