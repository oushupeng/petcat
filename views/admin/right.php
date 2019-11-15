<?php
use kartik\select2\Select2;
use yii\web\JsExpression;
?>
<?php
//echo $form->field($model, 'title')->widget(Select2::classname(), [
//    'options' => ['placeholder' => '请输入标题名称 ...'],
//    'pluginOptions' => [
//        'placeholder' => 'search ...',
//        'allowClear' => true,
//        'language' => [
//            'errorLoading' => new JsExpression("function () { return 'Waiting...'; }"),
//        ],
//        'ajax' => [
//            'url' => '这里是提供数据源的接口',
//            'dataType' => 'json',
//            'data' => new JsExpression('function(params) { return {q:params.term}; }')
//        ],
//        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//        'templateResult' => new JsExpression('function(res) { return res.text; }'),
//        'templateSelection' => new JsExpression('function (res) { return res.text; }'),
//    ],
//]);
//?>

<form action="admin/search" method="get">
    <div class="form-group">
        <label>编号:</label>
        <input type="text" class="form-control" id="user[id]" name="user[id]">
    </div>
    <div class="form-group">
        <label>分类名称:</label>
        <input type="text" class="form-control" id="user[username]" name="user[username]">
    </div>
    <div class="form-group">
        <input  type="submit" class="btn btn-primary btn-sm" value="搜索">
    </div>
</form>
