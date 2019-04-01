<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/1/2019
 * Time: 7:13 AM
 */

/**
 * @var $article \frontend\models\Article
 */
?>
<ul class="inline-related-stories">
    <?php
    foreach ($article->relatedArticles as $article) {
        ?>
        <li>
            <?= $article->viewAnchor() ?>
        </li>
        <?php
    }
    ?>
</ul>
