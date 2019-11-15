<?php


namespace app\controllers;


use app\models\admin\Roles;
use app\models\admin\User;

class UserController extends CoreController
{
    public function actionList()
    {
        $where = ['create_id' =>$this->_uid];
        $list = User::getUserList($where);
        $roles = Roles::getRoles($this->_user);
        $roleList = array();
        foreach ($roles as  $val){
            $roleList[$val['id']] = $val['role_name'];
        }
        $this->out('用户列表',$list,array('role_list'=>$roleList));
        return $this->render('index',['model' => $list]);
    }

    public function actionView($id){
        return User::findOne($id);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        $behaviors['authenticator'] = $auth;
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'],$actions['create']);
        $actions['index']['prepareDataProvider'] = [$this,'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {

    }

}
