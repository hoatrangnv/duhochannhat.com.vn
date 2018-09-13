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
    <!--<script src="http://hammerjs.github.io/dist/hammer.min.js" type="text/javascript"></script>
    <script src="https://cdn.rawgit.com/vanquyettran/slider/master/slider.js" type="text/javascript"></script>-->
    <?= $this->render('//layouts/js') ?>
    <?php $this->head() ?>
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

    <?php
//    if (in_array(Yii::$app->requestedRoute, ['site/index'])) {
        /**
         * @var $headerBanner Banner
         */
        /*
        $headerBanners = Banner::find()
            ->where(['active' => 1])
            ->andWhere(['position' => Banner::POSITION_HEADER])
            ->andWhere(['<', 'start_time', date('Y-m-d H:i:s')])
            ->andWhere(['>', 'end_time', date('Y-m-d H:i:s')])
            ->orderBy('sort_order asc')
            ->all();

        if (count($headerBanners) > 0) {
            ?>
            <div class="container clr aspect-ratio __5x2" id="top-banner">
                <div class="slider ratio-fixed"
                     data-slide-time="200"
                     data-display-arrows="true"
                     data-display-arrows-small="false"
                     data-display-navigator="true"
                     data-item-aspect-ratio="2.5"
                     data-autorun-delay="5000"
                >
                    <?php
                    foreach ($headerBanners as $headerBanner) {
                        if ($headerBanner->image) {
                            ?>
                            <div class="item-inner">
                                <div class="image">
                                    <span>
                                        <?= $headerBanner->image->img() ?>
                                    </span>
                                </div>
                                <a class="title" href="<?= $headerBanner->link ?>" title="<?= $headerBanner->title ?>">
                                    <?= nl2br($headerBanner->title) ?>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        */
//    }
    ?>

    <div class="container clr" id="main-content">
        <?= $content ?>
    </div>

    <div id="bottom-nav">
        <?= $this->render('//layouts/navBar', ['menu' => $this->context->bottomMenu]) ?>
    </div>

    <?= $this->render('//layouts/footer') ?>

    <?= $this->render('//layouts/fbSDK') ?>
    <?= $this->render('//layouts/googlePlatform') ?>
    <?= $this->render('//layouts/twitterWidget') ?>
    <?= $this->render('//layouts/tracking') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
