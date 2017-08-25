<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

?>
<h3>Комментарии.</h3>
<div class="row">
<?php


foreach ($count as $key => $value) {
//print_r($value);
//exit();
echo '<div class="col-lg-5" >';
echo '<div class="panel panel-default" >';
echo '<div class="panel-body">';
echo '<p> Название:' . Html::encode($value["description"]);
echo  Html::img($value["url"], ['style' => 'width:400px;']);
echo '<h4> Количество комментариев:' . Html::encode($value["summ"]);
echo '</div>';
echo '</div>';
echo '</div>';


//        ])
//            \'style\' => \'width:400px;\'
//        ])'
//    <p> Название: <?php echo Html::encode($value["description"]); ?><!--</p>-->
<!--    <p> --><?php //echo Html::img($value["url"], [
//            ; ?>
<!--    </p>-->
    <!--    <p> Количество комментариев: <strong>--><?php //echo Html::encode($value["summ"]); ?><!-- </strong></p>-->
<!--   <p class="q">------------------------------------------</p>-->

<?php
}
?>
</div>

