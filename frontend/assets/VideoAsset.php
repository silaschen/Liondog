<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class VideoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'video/css/bootstrap.min.css',
        'video/css/style.css',
        'video/owl-carousel/owl.carousel.css',
        'video/owl-carousel/owl.theme.css',
        'video/font-awesome-4.4.0/css/font-awesome.min.css',
    ];
    public $js = [
    'video/js/jquery-2.1.1.js',
    'video/js/bootstrap.min.js'

    ];
  
}
