<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\models\Image */

$this->title = $model->img_name;
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-view">

    <h1><?= Html::encode($model->img_name) ?></h1>

    <?php
    if (!Yii::$app->user->isGuest) {
        ?>

        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?php
    }
    ?>

    <img src="<?php echo $model->url ?>" width="600" id="img1">
    <h4> Описание: <?= Html::encode($model->description) ?></h4>

</div>

<?php
if (!empty ($models)) {
    ?>
    
    <h3>
        <a href="<?= Url::to(['site/comments']) ?>"> Комментарии: </a>
    </h3>
    <?php
}
?>

<div class="com">
    <?php
    if (!Yii::$app->user->isGuest) {
        ?>
        <?php
        Modal::begin([
            'header' => '<h2>Введите текст комментария.</h2>',
            'id' => 'myModal',
            'toggleButton' => [
                'label' => 'Добавить комментарий',
                'tag' => 'button',
                'class' => 'btn btn-success'],
        ]);
        echo '<div class="php">
        <form name="test" method="post">
            <textarea name="comment" cols="60" rows="6" id="new_comment_msg"></textarea></p>
            <p><input type="button" class="btn btn-success" id="form_comment_submit" value="Отправить" data-id="' . $model->id . '">
        </form>
    </div>';
        Modal::end();
    }
    ?>
</div>
<div class="row" id="comments">
    <?php
    foreach ($models as $value) {
        echo '<div class="col-lg-12">';
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '<p>' . '<h4>' . 'Имя:' . ' ' . Html::encode($value->name) . '</h4>' . '</p>';
        echo '<p>' . '<h4>' . 'Комментарий:' . ' ' . Html::encode($value->text) . '</h4>' . '</p>';
        echo '<p>' . '<h5>' . 'Дата создания:' . ' ' . Yii::$app->formatter->asDate($value->data, 'php:d-m-Y') . '</h5>' . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
<div class="pagination">
    <?php
    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>
</div>







