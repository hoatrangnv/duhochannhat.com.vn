<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Banner;
use common\models\SiteParam;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);

/**
 * @var $seoInfo \frontend\models\SeoInfo
 */
$seoInfo = $this->context->seoInfo;
$seoInfo->registerMetaTags($this);
$seoInfo->registerLinkTags($this);

$this->title = $seoInfo->page_title ? $seoInfo->page_title : Yii::$app->name;

$hasPageHeadline = in_array(Yii::$app->requestedRoute, ['site/index', 'article/category']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="<?= $hasPageHeadline ? 'has-page-headline' : '' ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <!--<script src="http://hammerjs.github.io/dist/hammer.min.js" type="text/javascript"></script>
    <script src="https://cdn.rawgit.com/vanquyettran/slider/master/slider.js" type="text/javascript"></script>-->
    <?= $this->render('//layouts/js') ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div id="menu-mobile-backdrop"
         onclick="document.querySelector('html').classList.remove('menu-active')">
    </div>

    <?php
    if ($hasPageHeadline) {
        ?>
        <div id="page-headline"">
            <div class="container clr">
                <h1 class="content"><?= $seoInfo->heading ?></h1>
            </div>
        </div>
        <?php
    }
    ?>

    <div id="header">
        <div class="container">
            <a class="text-logo" href="<?= Url::home(true) ?>" title="<?= Yii::$app->name ?>">
                Du học Hàn Nhật
            </a>
        </div>
    </div>

    <?= $this->render('//layouts/topNav', ['menu' => $this->context->menu]) ?>

    <?= $this->render('//layouts/searchToolbar') ?>

    <div class="container clr" id="main-content">
        <?= $content ?>
    </div>

    <?= $this->render('//layouts/bottomDesc') ?>
    <?= $this->render('//layouts/footer') ?>

    <?= $this->render('//layouts/fbSDK') ?>
    <?= $this->render('//layouts/googlePlatform') ?>
    <?= $this->render('//layouts/twitterWidget') ?>
    <?= $this->render('//layouts/tracking') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
