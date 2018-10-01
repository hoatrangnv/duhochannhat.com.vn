<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(\backend\models\Contact::$allStatusLabels) ?>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">&nbsp;</label>
                <div class="clearfix">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'message',
            'customer_name',
            'customer_phone',
            'customer_email:email',
            'status',
            'type',
            'updated_user_id',
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>
