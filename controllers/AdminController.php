<?php

namespace app\controllers;

use app\models\admin\User;
use app\models\UploadForm;
use Yii;
use app\models\admin\AdminCreateForm;
use app\models\admin\AdminLoginForm;
use app\models\admin\AdminSearchForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\data\Pagination;

class AdminController extends Controller
{
    public function actionIndex()
    {
//        $searchModel = new AdminSearchForm();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        return $this->render('index' ,['dataProvider' => $dataProvider ,'searchModel' => $searchModel]);

        $query = User::find();

//        $querys = Yii::$app->request->get('query');
//        if (count($querys) > 0) {
//            $i=1;
//            foreach ($querys as $key => $value) {
//                $value = trim($value);
//                if (empty($value) == false) {
//                    if($i){
//                        $i=0;
//                        $query = $query->where(array('like', $key, $value));
//                    }else{
//                        $query = $query->andWhere(array('like', $key, $value));
//                    }
//                }
//            }
//        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $user = $query->orderBy('username')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->render('index', [
            'user' => $user,
            'pagination' => $pagination,
        ]);



    }

    public function actionView($id)
    {
        return $this->render('success', ['model' => $this->findModel($id),]);
    }

    /*
     * 注册添加
     */
    public function actionCreate()
    {

        $model = new AdminCreateForm();
        $model->load(\Yii::$app->request->post());

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if (Yii::$app->request->isPost && $model->save()){
            return $this->redirect(['admin/login']);
        }else{
            return $this->render('create' ,['model' => $model]);
        }
    }

    /*
     * 登录
     */
    public function actionLogin()
    {
        $model = new AdminLoginForm();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if($model -> login($post)){
                echo '登录成功';
                return $this->render('success',['model' => $model]);
            }else{
                echo '登录失败';
                return $this->render('login',['model' => $model]);
            }
        }else{
            return $this->render('login',['model' => $model]);
        }
    }

    /*
     * 删除
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['admin/index']);
    }

    /*
     * 更新
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['admin/index']);
        }else{
            return $this->render('update',['model' => $model]);
        }
    }

    public function actionSearch(){
        $command = (new \yii\db\Query())
            ->select(['id', 'username'])
            ->from('user')

            ->limit(10)
            ->createCommand();

// 打印 SQL 语句
        echo $command->sql;

    }

    public function findModel($id)
    {
        if (($model = AdminCreateForm::findOne($id)) !== null){
            return $model;
        }
        throw new NotFoundHttpException('does not exit');
    }

    /*
     * getInstances 单个
     * getInstances 多文件
     * 上传
     */
    public function actionUpload()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost){
            $model->imageFile = UploadedFile::getInstances($model, 'imageFile');
            if ($model->upload()){
                return;
            }
        }
        return $this->render('upload',['model' => $model]);
    }

}
