<?php

namespace backend\modules\sarabun\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sarabun\models\Collection;

/**
 * CollectionSearch represents the model behind the search form of `backend\modules\sarabun\models\Collection`.
 */
class CollectionSearch extends Collection
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['mastername', 'name', 'detills'], 'safe'],
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
        $query = Collection::find();

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

        $query
            ->andFilterWhere(['like', 'mastername', $this->mastername])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detills', $this->detills]);

        return $dataProvider;
    }
}
