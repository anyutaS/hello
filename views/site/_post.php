<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
/* @var $model app\models\Image */
?>

<div class="news-item">
    <?php
    ?>
    <a href="<?= Url::to(['site/comments']) ?>" > <h3><?= Html::encode($model->img_name) ?></h3>  </a>
    <img src="<?php echo $model->url?>" width="300" >
   <?= Html::encode($model->description) ?>
</div>