<?php

/*
 * 主页
 */

/* @var $this \yii\web\View */
/* @var $model  */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\admin\AdminSearchForm */

$this->title = 'Index';
$this->params['breadcrumbs'][] = $this->title;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

?>

<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'pager'=>[
//        //'options'=>['class'=>'hidden']//关闭分页
//        'firstPageLabel'=>"First",
//        'prevPageLabel'=>'Prev',
//        'nextPageLabel'=>'Next',
//        'lastPageLabel'=>'Last',
//        ],
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'username:text:123' ,
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//        'showFooter'=>true
//    ]); ?>

    <form action="/petcat/web/index.php?r=admin%2Fsearch" method="post">
        <div class="form-group">
            <label>编号:</label>
            <input type="text" class="form-control" id="AdminSearchForm[id]" name="AdminSearchForm[id]">
        </div>
        <div class="form-group">
            <label>分类名称:</label>
            <input type="text" class="form-control" id="AdminSearchForm[username]" name="AdminSearchForm[username]">
        </div>
        <div class="form-group">
<!--            <input  type="submit" class="btn btn-primary btn-sm" value="搜索">-->
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </form>
    <div id="w0" class="grid-view"><div class="summary">Showing <b>1-1</b> of <b>1</b> item.</div>
        <table class="table table-striped table-bordered"><thead>
            <tr>
                <th>#</th>
                <th><a href="/petcat/web/index.php?r=admin%2Findex&amp;sort=username" data-sort="username">username</a></th>
                <th><a href="/petcat/web/index.php?r=admin%2Findex&amp;sort=username" data-sort="username">password</a></th>
                <th class="action-column">&nbsp;</th>
            </tr>
            <tr id="w0-filters" class="filters">
                <td>&nbsp;</td>
                <td><input type="text" class="form-control" name="AdminSearchForm[username]"></td>
                <td><input type="text" class="form-control" name="AdminSearchForm[password]"></td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($user as $m): ?>
            <tr data-key="31">
                <td><?= $m->id ?></td>
                <td><?=Html::encode("{$m->username}") ?></td>
                <td><?= $m->password ?></td>
                <td>
                    <a href="/petcat/web/index.php?r=admin%2Fview&amp;id=<?= $m->id?>" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <?=Html::a('修改',['admin/update','id' => $m->id],['class' => 'btn btn=success'])?>
                    <?=Html::a('删除',['admin/delete','id' => $m->id],['class' => 'btn btn=success'])?>
                    <a href="/petcat/web/index.php?r=admin%2Fdelete&amp;id=<?= $m->id?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <?php endforeach;  ?>
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
            </tbody>
        </table>
    </div>



</div>
