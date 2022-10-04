<?php

namespace backend\modules\sarabun\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sarabun\models\unit;

/**
 * UnitSearch represents the model behind the search form of `backend\modules\sarabun\models\unit`.
 */
class UnitSearch extends unit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'codename', 'coordinator', 'tel', 'Scodename'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = unit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'codename', $this->codename])
            ->andFilterWhere(['like', 'coordinator', $this->coordinator])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'Scodename', $this->Scodename]);

        return $dataProvider;
    }
}
