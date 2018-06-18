<?php
/**
 * @var $this \yii\web\View
 * @var $models \frontend\models\Article[]
 */

use yii\helpers\Html;

foreach ($models as $model) {
    ?>
    <div class="item">
        <?= $model->viewAnchor(
            '<div class="image"><span>'
            . $model->avatarImg()
            . '</span></div>'

            . '<h3 class="name">'
            . Html::encode($model->name)
            . '</h3>'

            . '<div class="info">'
            . $this->render('_info', compact('model'))
            . '</div>'

            . '<div class="intro">'
            . '<p>' . str_replace("\n", '</p><p>', Html::encode($model->description)) . '</p>'
            . '</div>',
            [
                'class' => 'clr'
            ]
        ); ?>
    </div>
    <?php
}
