<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;



echo ListView::widget([
    'dataProvider' => $listDataProvider,
    'itemView' => '_post',
    
]);

