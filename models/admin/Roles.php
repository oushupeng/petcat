<?php


namespace app\models\admin;


use yii\db\ActiveRecord;
use yiier\rbac\models\AuthRule;

class Roles extends ActiveRecord
{
    public static function tableName()
    {
        return 'fx_role';
    }

    public function rules()
    {
        return [
            ['role_name','required'],
            [['role_name','role_desc'],'string'],
        ];
    }

    /*
     * 获取角色列表
     */
    public static function getRoles($user)
    {
        $where = ['uid'=>$user['id']];
        $list = self::find()->where($where)->asArray()->all();
        return $list;
    }

    /*
     * 角色权限
     */
    public static function getRolesRules($roleId,$isTree=false)
    {
        $role = self::findOne(['id' => $roleId]);
        if($roleId=='1'){
            $where = ['>','id','0'];
        }else{
            $ruleIds = explode(',',$role['rule_ids']);
            $where = ['in','id',$ruleIds];
        }

        $data = AuthRule::getAuthRules($where);
        if($isTree) $data=self::getTree($data);
        return $data;
    }


    /*
     * 角色权限 树状结构的
     */
    public static function getRolesRulesTree($roleId)
    {
        $role = self::findOne(['id'=>$roleId]);
        if($roleId=='1'){
            $where = ['and',"is_menu='1'",['>','id','0']];
        }else{
            $ruleIds = explode(',',$role['rule_ids']);
            $where = ['and',"is_menu='1'",['in','id',$ruleIds]];
        }

        $data = AuthRule::getAuthRules($where);
        $rules = self::getTree($data);
        return $rules;
    }

    public static function getTree($items,$pid='pid')
    {
        $map = [];
        $tree = [];
        foreach ($items as &$it)
        {
            $map[$it['id']] = &$it;
        }
        foreach ($items as &$it)
        {
            $parent = &$map[$it[$pid]];

            if($it[$pid]>0 && !$parent){
                $parentMenu = self::getParent($it[$pid]);
                $map[$parentMenu['id']] = $parentMenu;
                $tree[] = &$map[$it[$pid]];
                $parent = &$map[$it[$pid]];
            }

            if($parent){
                $parent['children'][] = &$it;
            }else{
                $tree[] = &$it;
            }
        }
        return $tree;

    }

    public static function getParent($id)
    {
        return AuthRule::getAuthRule($id);
    }

    /*
     * 显示角色权限，并显示出来，此角色的所以权限
     */
    public static function showRoleAuth($roleId)
    {
        $role = self::findOne(['id'=>$roleId]);
        $curRules = explode(',',$role['rule_ids']);

        $createUSer = User::getUSer(['id'=>$role['uid']]);
        $createRole = self::findOne(['id'=>$createUSer['role_id']]);

        $authRuleTree = self::getRolesRules($createRole['id'],true);

        return array('auth_tree'=>$authRuleTree,'role_auth'=>$curRules);

    }

    /*
     * 修改角色权限
     */
    public static function editRoleAuth($id,$data)
    {
        return self::updateAll($data,['id'=>$id]);
    }

}
