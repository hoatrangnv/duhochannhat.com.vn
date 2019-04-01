<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/1/2019
 * Time: 7:13 AM
 */

/**
 * @var $relatedArticles \frontend\models\Article[]
 */
?>
<ul class="inline-related-stories">
    <?php
    foreach ($relatedArticles as $article) {
        ?>
        <li>
            <div class="tick"></div>
            <div class="text">
                <?= $article->viewAnchor() ?>
            </div>
        </li>
        <?php
    }
    ?>
</ul>
