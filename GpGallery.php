<?php

namespace pafnow\widgets;

use pafnow\widgets\GpGalleryAsset;
use yii\web\View;
use yii\widgets\ListView;
use Yii;

class GpGallery extends \yii\base\Widget
{
    public $dataProvider;
    public $itemView;
    
    public function init()
    {
        parent::init();

        // Register required assets
        GpGalleryAsset::register($this->view);
    }

    public function run()
    {
        $this->view->registerJs('function refreshGpGallery() {
            $(".gpgallery").collagePlus({"targetHeight": 250, "allowPartialLastRow": true, "childrenFilterSelector": ".inline"});
            $(".gpgallery").collageCaption({"images": $(".inline:not(:has(div))")});
        }
        $(window).load(function() { refreshGpGallery(); });
        $(window).resize(function() { refreshGpGallery(); });');

        echo ListView::widget([
            'dataProvider' => $this->dataProvider,
            'itemOptions' => ['tag' => false],
            'itemView' => $this->itemView,
            'layout' => "<div class=\"gpgallery\">{items}</div>\n{pager}",
            'pager' => [
                'class' => \kop\y2sp\ScrollPager::className(),
                'triggerOffset' => 999999,
                'noneLeftText' => 'No more item to display',
                'noneLeftTemplate' => '<div class="clearfix"></div><div class="ias-noneleft" style="text-align: center;"><small class="text-muted">{text}</small>',
                'enabledExtensions' => [\kop\y2sp\ScrollPager::EXTENSION_TRIGGER, \kop\y2sp\ScrollPager::EXTENSION_SPINNER, \kop\y2sp\ScrollPager::EXTENSION_NONE_LEFT],
                'eventOnRendered' => "function() { refreshGpGallery(); }"
            ]
        ]);
    }
}