<?php



/* @var $this \yii\web\View */
/* @var $$model \app\models\UploadForm */
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']])?>
<?= $form->field($model ,'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
<button>Submit</button>
<?php ActiveForm::end()?>
