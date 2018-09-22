<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Package */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company')->dropDownList($model->getCompanies()) ?>

    <?= $form->field($model, 'sn')->textInput(['maxlength' => true, 'id' => 'sn']) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $model->isNewRecord ? null : $form->field($model, 'status')->dropDownList($model->getStatus()) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(function () {
        $('#sn').focus().click();
    })
</script>
