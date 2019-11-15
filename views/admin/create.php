<?php

/*
 * 注册页面
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\admin\AdminCreateForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '注册';

?>

<?php //$form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
<div>
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
    <?=Html::encode($this->title) ?>
    <?= $form->field($model,'username')->textInput()->label('用户名')?>
    <?= $form->field($model,'password')->passwordInput()->label('密码')?>
    <?= $form->field($model,'repassword')->passwordInput()->label('确认密码')?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('reset',['class' => 'btn btn-primary'])?>
    </div>
    <?php ActiveForm::end() ?>
</div>
