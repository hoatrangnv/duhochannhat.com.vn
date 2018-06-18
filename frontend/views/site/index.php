<?php
use frontend\models\ArticleCategory;
use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $top_articles \frontend\models\Article[]
 * @var $article_categories ArticleCategory[]
 */

?>
<div class="left">
    <div class="top-stories aspect-ratio __3x2 clr">
        <?php
        $top_count = count($top_articles);
        ?>
        <div class="clr">
            <div class="hot">
                <?php
                if ($top_count > 0) {
                    echo $top_articles[0]->viewAnchor(
                        '<div class="image"><span>'
                        . $top_articles[0]->avatarImg()
                        . '</span></div>'

                        . '<h3 class="name">'
                        . Html::encode($top_articles[0]->name)
                        . '</h3>'

                        . '<div class="intro">'
                        . '<p>' . str_replace("\n", '</p><p>', Html::encode($top_articles[0]->description)) . '</p>'
                        . '</div>'
                    );
                }
                ?>
            </div>
            <div class="warm">
                <ul>
                    <?php
                    for ($i = 1; $i < 8 && $i < $top_count; $i++) {
                        ?>
                        <li class="clr">
                            <?php
                            echo $top_articles[$i]->viewAnchor(
                                (
                                    1 == $i
                                        ? ('<div class="image"><span>' . $top_articles[$i]->avatarImg() . '</span></div>')
                                        : ''
                                )

                                . '<h3 class="name">'
                                . Html::encode($top_articles[$i]->name)
                                . '</h3>'
                            );
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        if ($top_count > 8) {
            ?>
            <div class="more">
                <ul>
                    <?php
                    for ($i = 8; $i < 12 && $i < $top_count; $i++) {
                        ?>
                        <li>
                            <?php
                            echo $top_articles[$i]->viewAnchor(
                                '<div class="image"><span>'
                                . $top_articles[$i]->avatarImg()
                                . '</span></div>'

                                . '<h3 class="name">'
                                . Html::encode($top_articles[$i]->name)
                                . '</h3>'
                            );
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    foreach ($article_categories as $category) {
        /**
         * @var $articles \frontend\models\Article[]
         */
        switch ($category->type) {
            case ArticleCategory::TYPE_NEWS:

                $limit = 7;
                $articles = $category->getAllArticles()
                    ->andWhere(['active' => 1, 'visible' => 1])
                    ->andWhere(['<', 'published_time', date('Y-m-d H:i:s')])
                    ->orderBy('published_time desc')
                    ->limit($limit)
                    ->all();
                $article_count = count($articles);
                ?>
                <div class="stories-card aspect-ratio __3x2">
                    <div class="heading clr">
                        <?= $category->viewAnchor("<span>$category->name</span>", ['class' => 'title']) ?>
                        <div class="extra sm-hidden">
                            <ul>
                                <?php
                                /*
                                $i = 0;
                                foreach ($category->findChildren() as $child) {
                                    $i++;
                                    if ($i > 1) {
                                        ?>
                                        <li>
                                            <span>|</span>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li>
                                        <?= $child->viewAnchor() ?>
                                    </li>
                                    <?php
                                }
                                */
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="body clr">
                        <div class="hot">
                            <?php
                            if ($article_count > 0) {
                                echo $articles[0]->viewAnchor(
                                    '<div class="image"><span>'
                                    . $articles[0]->avatarImg()
                                    . '</span></div>'

                                    . '<h3 class="name">'
                                    . Html::encode($articles[0]->name)
                                    . '</h3>'

                                    . '<div class="intro">'
                                    . '<p>' . str_replace("\n", '</p><p>', Html::encode($articles[0]->description)) . '</p>'
                                    . '</div>'
                                );
                            }
                            ?>
                        </div>
                        <div class="warm">
                            <ul>
                                <?php
                                for ($i = 1; $i < $limit - 1 && $i < $article_count; $i++) {
                                    ?>
                                    <li class="clr">
                                        <?= $articles[$i]->viewAnchor(
                                            '<div class="image"><span>'
                                            . $articles[$i]->avatarImg()
                                            . '</span></div>'

                                            . '<h3 class="name">'
                                            . Html::encode($articles[$i]->name)
                                            . '</h3>'
                                        ) ?>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php

                break;

            case ArticleCategory::TYPE_VIDEO:

                $limit = 8;
                $articles = $category->getAllArticles()
                    ->andWhere(['active' => 1, 'visible' => 1])
                    ->andWhere(['<', 'published_time', date('Y-m-d H:i:s')])
                    ->orderBy('published_time desc')
                    ->limit($limit)
                    ->all();
                $article_count = count($articles);
                ?>
                <div class="stories-card aspect-ratio __3x2">
                    <div class="heading clr">
                        <?= $category->viewAnchor("<span>$category->name</span>", ['class' => 'title']) ?>
                        <div class="extra sm-hidden">
                            <ul>
                                <?php
                                $i = 0;
                                foreach ($category->findChildren() as $child) {
                                    $i++;
                                    if ($i > 1) {
                                        ?>
                                        <li>
                                            <span>|</span>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li>
                                        <?= $child->viewAnchor() ?>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="body clr">
                        <div class="slider video-slider"
                             data-page-size="3"
                             data-page-size-small="1"
                             data-slide-time="250"
                             data-display-navigator="true"
                             data-display-arrows="true"
                             data-display-arrows-small="false"
                             data-preview-right="0.2"
                             data-preview-left="0.2"
                        >
                            <?php
                            foreach ($articles as $article) {
                                echo $article->viewAnchor(
                                    '<div class="video-cover">'
                                    . "<div class='image'><span>{$article->avatarImg()}</span></div>"
                                    . '<div class="overlay"><div class="icon play-icon"></div></div>'
                                    . '</div>'
                                    . "<h3 class='name'>$article->name</h3>",
                                    ['class' => 'video-item']
                                );
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php

                break;
        }
    }
    ?>
</div>
<div class="right">
    <?= $this->render('//article/_asideFeaturedList') ?>
    <?= $this->render('//article/_asideCategoryBasedList') ?>
</div>