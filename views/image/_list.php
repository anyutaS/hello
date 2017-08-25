<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="news-item">
    <h4> <?= Html::encode($model->name) ?> </h4>
    <p>  <?= HtmlPurifier::process($model->text) ?></p>
    <p>  <?= HtmlPurifier::process($model->data) ?> <br/> </p>
</div>