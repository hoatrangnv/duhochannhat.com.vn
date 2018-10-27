<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/17/2018
 * Time: 1:14 AM
 */
use frontend\models\Util;

/**
 * @var $this \yii\web\View
 * @var $seoInfo \frontend\models\SeoInfo
 */
$seoInfo = $this->context->seoInfo;
if ($seoInfo->long_description) {
    ?>
    <div class="container" id="bottom-desc">
        <div class="content paragraph">
            <?= Util::embedAdvisoryFormToContent($this, $seoInfo->long_description); ?>
        </div>
    </div>
    <?php
}