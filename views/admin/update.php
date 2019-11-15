<?php

/* @var $this \yii\web\View */
/* @var $model  */
use yii\helpers\Html;
$this->title = 'update';
?>

<div class="country-update">
    <h1><?=Html::encode($this->title)?></h1>

    <?= $this->render('create',['model' => $model])?>
</div>
