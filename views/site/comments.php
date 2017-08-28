<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

?>
<h3>Комментарии.</h3>
<div class="row">
<?php


foreach ($count as $key => $value) {
echo '<div class="col-lg-5" >';
echo '<div class="panel panel-default" >';
echo '<div class="panel-body">';
echo '<p> Название:' . Html::encode($value["description"]);
echo  Html::img($value["url"], ['style' => 'width:400px;']);
echo '<h4> Количество комментариев:' . Html::encode($value["summ"]);
echo '</div>';
echo '</div>';
echo '</div>';

}
?>
</div>

