<?php


namespace app\controllers;


use app\models\admin\User;
use yii\rest\ActiveController;

class CoreController extends ActiveController
{
    public $modelClass = '';
    public $http_id;
    public $post;
    public $get;
    public $_user;
    public $_uid;
    public $request;
    public $db;

    public function beforeAction($action)
    {
        $this->request = array_merge(\Yii::$app->request->post(),\Yii::$app->request->get(),$_FILES);
        $this->http_id = DB::insert('http_log',[
           'method' => $_SERVER['REQUEST_METHOD'],
           'full_url' => \Yii::$app->request->absoluteUrl,
           'http_status' => \Yii::$app->response->statusCode,
           'ips' => \Yii::$app->request->userIP,
           'request' => json_encode($this->request,JSON_UNESCAPED_UNICODE),
           'create_at' => date('Y-m-d H:i:s')
        ]);

        $mod = ['common'];
        $actionMod = ['reg','login','test'];
        $controller = \Yii::$app->controller->id;
        $actionName = \Yii::$app->controller->action->id;
        if(in_array($controller,$mod) || in_array($actionName,$actionMod)) return true;

        if (!isset($this->request['auth_key'])) $this->error('auth_key is null.');
        $this->_user = User::loginByAuthKey($this->request['auth_key']);
        if (empty($this->_user)) $this->error('用户不存在','200','404');
        $this->_user = $this->_user->toArray();
        $this->_uid = $this->_user['id'];
        $this->db = new DB();

        return true;
    }

    public function request($key,$default='')
    {
        $request = array_merge(\Yii::$app->request->post(),\Yii::$app->request->get(),$_FILES);
        return isset($request[$key])?$request[$key]:$default;
    }

    public function out($msg='', $res = [], $extend=[])
    {
        $data = [
            'status' => '200',
            'code' => '0',
            'msg' => (string)$msg,
            'data' => $res,
            ];
        if ($extend) $data['extend'] = $extend;
        return $this->send($data);
    }

    public function error($msg='',$status = '200',$code='1')
    {
        $data = [
            'status' => $status."",
            'code' => $code,
            'msg' => (string)$msg,
        ];
        return $this->send($data);
    }

    public function send($data=[])
    {
        $out = json_encode($data,JSON_UNESCAPED_UNICODE);
        DB::update('http_log', [ 'http_status' => $data['status'], 'response' => $out,'finish_at'=>date("Y-m-d H:i:s") ], ['id'=>$this->http_id]);
        exit($out);
    }

}
