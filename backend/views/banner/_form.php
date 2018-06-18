<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'image_id')
                ->dropDownList(($image = $model->image) ? [$image->id => $image->name] : []) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'position')->dropDownList($model->getPositionLabels()) ?>

            <?= $form->field($model, 'active')->checkbox() ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'start_time')->textInput() ?>

            <?= $form->field($model, 'end_time')->textInput() ?>

            <?= $form->field($model, 'sort_order')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    initDatetimePicker("<?= Html::getInputId($model, 'start_time') ?>");
    initDatetimePicker("<?= Html::getInputId($model, 'end_time') ?>");
</script>

<?php
$this->registerJs(
    '
    initPortableImageUploader("' . Html::getInputId($model, 'image_id') . '");
    ',
    \yii\web\View::POS_READY
);
