<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Галерея';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if (!Yii::$app->user->isGuest) {
        ?>
        <p>
            <?= Html::a('Добавить фото', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php
    }
    ?>
    <div class="row">
        <?php
        foreach ($models as $model) {
            echo '<div class="col-lg-4" >';
            echo '<div class="panel panel-default" >';
            echo '<div class="panel-body-img">';
//            echo '<div class="img" style="background-image: url(' . $model->url . ')">';
//            echo '</div>';
            echo '<h4>' . Html::a(Html::img($model->url, [
                        'style' => 'width:300px;',
                    ]) . "<br/>", ['image/view', 'id' => $model->id], ['class' => 'profile-link']) . '</h4>' . "<br/>";
            echo '<p id="img_name">' . Html::encode($model->img_name);
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="pagination">
        <?php
        // отображаем постраничную разбивку
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>
</div>