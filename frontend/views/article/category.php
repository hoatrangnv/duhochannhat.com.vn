<?php
/**
 * @var $this \yii\web\View
 * @var $category ArticleCategory
 * @var $models \frontend\models\Article[]
 * @var $jsonParams string
 * @var $hasMore boolean
 * @var $page integer
 */
use frontend\models\ArticleCategory;
use yii\helpers\Html;
?>
<div class="left">
    <section class="story-category">
        <div class="heading clr">
            <h2 class="title">
                <span><?= Html::encode($category->name) ?></span>
            </h2>
        </div>
        <div class="body clr">
            <div class="shares">
                <?= $this->render('//layouts/likeShare') ?>
            </div>
            <?php
            if ($category->long_description) {
                ?>
                <div class="long-desc paragraph">
                    <div class="expandable">
                        <?= $category->long_description ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="thumbnail-story-list aspect-ratio __3x2">
                <?php
                if (count($models) > 0) {
                    echo $this->render('_thumbnailList', compact('models'));
                } else {
                    echo 'Chưa có nội dung cho mục này.';
                }
                ?>
            </div>
            <?php
            if ($hasMore) {
                ?>
                <button
                    type="button"
                    class="see-more"
                    onclick="loadMore(this.previousElementSibling, this)"
                >Xem thêm</button>
                <?php
            }
            ?>
        </div>
    </section>
</div>
<div class="right">
    <?= $this->render('//article/_asideFeaturedList') ?>
    <?= $this->render('//article/_asideCategoryBasedList') ?>
</div>


<script>
    var jsonParams = <?= $jsonParams ?>;
    var page = <?= $page + 1 ?>;
    function loadMore(container, button) {
        loadMoreArticles(container, button, '_thumbnailList', jsonParams, page, function () {
            page++;
        });
    }
</script>
