<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;


$this->title = 'Галерея';
$this->params['breadcrumbs'][] = $this->title;?>

<?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
<?php echo $f->field($form,'file')->fileInput();?>
<?= $f->field($form, 'description')->textarea(['rows' => 5, 'cols' => 2])->label('Описание') ?>
<?= Html::submitButton('Отправить')?>
<?php ActiveForm::end();


?>

