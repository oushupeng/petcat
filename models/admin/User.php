<?php


namespace app\models\admin;


use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['user_name','role_id'],'required','on'=>'Reg'],
            [['user_name'],'required','on' => 'Edit'],
            [['user_name','password'],'string'],
            [['role_id','pid','create_id','create_time','update_time'],'integer'],
        ];
    }

//    获取用户信息
    public static function getUser($where,$field=['*'])
    {
        return self::find()->where($where)->asArray->one();
    }

//    获取用户列表
    public static function getUserList($where)
    {
        return self::find()->where($where)->asArray->all();

    }

//    通过auth_key登录
    public static function loginByAuthKey($authKey)
    {
        return self::findOne(['auth_key' => $authKey]);

    }

//    生成auth_key
    public static function generateAuthKey()
    {
        return \Yii::$app->security->generateRandomString();
    }

//    通过更新
    public static function updateUserById($data,$id)
    {
        return self::updateAll($data,['id'=>$id]);
    }

//    获取用户的权限 菜单 按层分好了
    public static function getRulesTree($user)
    {
//        返回所有菜单
        $data = Roles::getRolesRulesTree($user['role_id']);
        return $data;
    }

    public static function getRules($user)
    {
//        返回所有菜单
        $data = Roles::getRolesRules($user['role_id']);
        return $data;
    }

}
