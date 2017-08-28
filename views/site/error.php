<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
\Yii::$app->session->addFlash('info','Вы не можете редактировать/удалять чужие фотографии');
echo '<h4>' .Html::img('photo/deny.jpg');

