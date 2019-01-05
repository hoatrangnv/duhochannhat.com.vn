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
use frontend\models\Util;
use yii\helpers\Html;

$imageSize = '198x132';
?>
<div class="left">
    <section class="story-category">
        <div class="body clr">
            <div class="shares">
                <?= $this->render('//layouts/likeShare') ?>
            </div>
            <?php
            if ($category->introduction) {
                ?>
                <div class="long-desc">
                    <!--<div class="expandable-content expandable">-->
                    <div>
                        <div class="paragraph">
                            <?= Util::embedAdvisoryFormToContent($this, $category->introduction); ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="comments">
                <?= $this->render('//layouts/fbComment') ?>
            </div>
            <div class="thumbnail-story-list aspect-ratio __3x2">
                <?php
                if (count($models) > 0) {
                    echo $this->render('_thumbnailList', compact('models', 'imageSize'));
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

<script>
    !function (expandableList) {
        [].forEach.call(expandableList, function (expandable) {
            if (expandable.scrollHeight > expandable.clientHeight) {
                expandable.classList.add('expandable');
                var button = elm('button', 'Xem thêm', {
                    class: 'expand-button',
                    onclick: function () {
                        if (expandable.classList.contains('expanded')) {
                            expandable.classList.remove('expanded');
                            button.textContent = 'Xem thêm';
                        } else {
                            expandable.classList.add('expanded');
                            button.textContent = 'Thu gọn';
                        }
                    }
                });
                expandable.parentElement.appendChild(button);
            } else {
                expandable.classList.remove('expandable');

            }
        });
    }(document.querySelectorAll('.expandable-content'))
</script>