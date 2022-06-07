<?php

namespace app\assets;

use yii\web\AssetBundle;

class AuthenticationAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/scroll.css'
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
