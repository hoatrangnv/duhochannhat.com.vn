<?php
/**
 * @var $this \yii\web\View
 * @var $model \frontend\models\Article
 * @var $modelType string
 * @var $relatedItems \frontend\models\Article[]
 */
use frontend\models\ArticleCategory;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$addToBreadcrumb = function (\common\models\ArticleCategory $category) use (&$addToBreadcrumb) {
    if ($category->parent) {
        $addToBreadcrumb($category->parent);
    }
    $this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => $category->viewUrl()];
};
if ($model->articleCategory) {
    $addToBreadcrumb($model->articleCategory);
}
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="left">
    <?php
    echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);
    ?>
    <div class="story">
        <h2 class="name"><?= Html::encode($model->name) ?></h2>
        <div class="info">
            <?= $this->render('_info', compact('model')) ?>
        </div>
        <div class="top-shares">
            <?= $this->render('//layouts/likeShare') ?>
        </div>
        <div class="intro">
            <p><?= str_replace("\n", "</p><p>", Html::encode($model->description)) ?></p>
        </div>
        <?php
        switch ($modelType) {
            case ArticleCategory::TYPE_NEWS:
                /*
                ?>
                <div class="avatar">
                    <div class="image aspect-ratio __3x2">
                        <span>
                            <?= $model->avatarImg() ?>
                        </span>
                    </div>
                </div>
                <?php
                */
                break;
            case ArticleCategory::TYPE_VIDEO:
                ?>
                <div class="video-container">
                    <div class="video aspect-ratio __16x9">
                        <div>
                            <iframe src="<?= $model->video_src ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <?php
                break;
        }
        ?>
        <div class="content paragraph">
            <?= $model->content ?>
        </div>
        <?php
        if (count($model->tags) > 0) {
            ?>
            <div class="tags">
                <h3 class="tags-title">Tags</h3>
                <?php
                foreach ($model->tags as $tag) {
                    echo $tag->viewAnchor();
                }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="bottom-shares">
            <?= $this->render('//layouts/likeShare') ?>
        </div>
        <div class="comments">
            <?= $this->render('//layouts/fbComment') ?>
        </div>
    </div>

    <?php
    if (count($relatedItems) > 0) {
        ?>
        <section class="related-stories">
            <div class="heading clr">
                <div class="title">
                    <span>Xem thêm</span>
                </div>
            </div>
            <div class="body clr">
                <div class="thumbnail-story-list aspect-ratio __3x2">
                    <?= $this->render('_thumbnailList', ['models' => $relatedItems]) ?>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
</div>
<div class="right">
    <?= $this->render('//article/_asideFeaturedList') ?>
    <?= $this->render('//article/_asideCategoryBasedList') ?>
</div>

<script>
    window.addEventListener("load", function () {
        updateArticleCounter(<?= $model->id ?>, "view_count", 1);
    });
</script>