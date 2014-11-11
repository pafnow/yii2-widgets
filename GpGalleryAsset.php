<?php

namespace pafnow\widgets;

/**
 * Asset bundle for GP Gallery Widget
 */
class GpGalleryAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/jquery-collagePlus';
    public $js = [
        'jquery.collagePlus.js',
        'extras/jquery.collageCaption.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
