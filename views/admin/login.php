<?php

/*
 * 登录页面
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\AdminCreateForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '登录';

?>

<div>
    <?php $form = ActiveForm::begin() ?>
        <h1><?=Html::encode($this->title) ?></h1>
        <?= $form->field($model,'username')->textInput()->label('用户名')?>
        <?= $form->field($model,'password')->passwordInput()->label('密码')?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('reset',['class' => 'btn btn-primary'])?>
            <?=Html::a('注册',['admin/create'],['class' => 'btn btn=success'])?>
        </div>
    <?php ActiveForm::end() ?>
</div>

