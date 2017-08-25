<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    ]);?>
<!--  --><?//= $form->field($model,'file')->fileInput()->label('Фото');?>
    
    <?= $form->field($model, 'img_name')->textInput(['maxlength' => true])->label('Название') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
