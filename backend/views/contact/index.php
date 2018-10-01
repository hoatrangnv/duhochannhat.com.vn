<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\searchModels\Contact */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contact', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'customer_name',
            'customer_phone',
            //'customer_email:email',
            [
                'attribute' => 'type',
                'value' => function (\backend\models\Contact $model) {
                    if (isset(\backend\models\Contact::$allTypeLabels[$model->type])) {
                        return \backend\models\Contact::$allTypeLabels[$model->type];
                    }
                    return $model->type;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type',
                    \backend\models\Contact::$allTypeLabels,
                    ['class'=>'form-control', 'prompt' => '']
                )
            ],
            [
                'attribute' => 'status',
                'value' => function (\backend\models\Contact $model) {
                    if (isset(\backend\models\Contact::$allStatusLabels[$model->status])) {
                        return \backend\models\Contact::$allStatusLabels[$model->status];
                    }
                    return $model->status;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    \backend\models\Contact::$allStatusLabels,
                    ['class'=>'form-control', 'prompt' => '']
                )
            ],
            
            'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
