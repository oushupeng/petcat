<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\admin\AdminCreateForm|null */
use yii\helpers\Html;
$this->title = '登录成功';

?>

<div>
    <h1><?=Html::encode($this->title)?></h1>
    <ul>
        <li><label>用户名：</label><?=Html::encode($model->username) ?></li>
        <li><label>密码：</label><?=Html::encode($model->password) ?></li>
        <li><label>再密码：</label><?=Html::encode($model->repassword) ?></li>
<!--        --><?//= $model->repassword ?>
        <li><label>时间：</label><?= date('Y-m-d H:i:s', $model['update_at']) ?></li>
    </ul>
</div>
