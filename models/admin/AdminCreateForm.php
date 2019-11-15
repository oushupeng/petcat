<?php

namespace app\models\admin;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class AdminCreateForm extends ActiveRecord
{
    /*
     * 表名
     */
    public static function tableName()
    {
        return 'user';
    }

    /*
     * 规则
     */
    public function rules()
    {
        return [
            ['username','filter','filter' => 'trim'],
            ['username','required','message' => '用户名不可以为空'],
            ['username','string','min' => 2,'max' => 255],
            ['username','unique','message' => '已存在用户'],
            [['password','repassword'],'required','message' => '密码不可以为空'],
            [['password','repassword'],'string','min' => 6,'tooShort' => '密码至少6位'],
            ['repassword', 'compare', 'compareAttribute' => 'password','message' => '两次输入的密码不一致！'],
//            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'username',
            'password' => 'password',
            'repasswprd' => 'repassword',
        ];

    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression(time()),
//                'value'   => function(){return date('Y-m-d H:i:s',time());},
            ]
        ];
    }

}