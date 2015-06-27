<?php
namespace johnitvn\settings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SettingSearch extends Setting
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['active'], 'boolean'],
            [['type', 'section', 'key', 'value', 'created', 'modified'], 'safe'],
        ];
    }
    /**
     * @return array
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Setting::find();
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere(
            [
                'id' => $this->id,
                'active' => $this->active,
                'section' => $this->section,
            ]
        );
        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);
        return $dataProvider;
    }
}