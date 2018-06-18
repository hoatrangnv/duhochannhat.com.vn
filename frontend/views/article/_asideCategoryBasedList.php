<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2018
 * Time: 11:14 PM
 */

use frontend\models\ArticleCategory;

/**
 * @var $article_categories ArticleCategory[]
 */
$article_categories = array_filter(ArticleCategory::indexData(true), function ($item) {
    /**
     * @var $item ArticleCategory
     */
    return strpos($item->displaying_areas, json_encode(ArticleCategory::DISPLAYING_AREA__ASIDE)) !== false;
});

foreach ($article_categories as $category) {
    /**
     * @var $articles \frontend\models\Article[]
     */
    $articles = $category->getAllArticles()
        ->andWhere(['active' => 1, 'visible' => 1])
        ->andWhere(['<', 'published_time', date('Y-m-d H:i:s')])
        ->orderBy('published_time desc')
        ->limit(5)
        ->all();
    ?>
    <div class="aside-story-list aspect-ratio __3x2">
        <?= $category->viewAnchor(null, ['class' => 'title']) ?>
        <ul>
            <?php
            $i = 0;
            foreach ($articles as $article) {
                $i++;
                ?>
                <li>
                    <?php
                    if (1 == $i) {
                        echo $article->viewAnchor(
                            '<div class="image"><span>' . $article->avatarImg() . '</span></div>'
                            . '<h3 class="name">' . $article->name . '</h3>',
                            ['class' => 'clr']
                        );
                    } else {
                        echo $article->viewAnchor();
                    }
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

