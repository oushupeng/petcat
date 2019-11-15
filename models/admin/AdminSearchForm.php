<?php

namespace app\models\admin;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminSearchForm extends AdminCreateForm
{
    public function rules()
    {
        return [
            ['username' ,'safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AdminCreateForm::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this -> load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'username' => $this->username,
        ]);

        $query->andFilterWhere(['like','username',$this->username]);

        return $dataProvider;
    }

}