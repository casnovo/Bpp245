<?php

namespace backend\modules\sarabun\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sarabun\models\sarabun;

/**
 * SarabunSearch represents the model behind the search form of `backend\modules\sarabun\models\sarabun`.
 */
class SarabunSearch extends sarabun
{
    public $bookname;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit_id', 'collection_id'], 'integer'],
            [['years', 'books', 'detills', 'bookdate', 'docurl', 'kinds', 'kinds2', 'created_at', 'updated_at', 'created_by', 'updated_by','bookname'], 'safe'],
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
        $query = sarabun::find();

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
            'bookdate' => $this->bookdate,
            'unit_id' => $this->unit_id,
            'collection_id' => $this->collection_id,
        ]);

        $query->andFilterWhere(['like', 'years', $this->years])
            ->andFilterWhere(['like', 'books', $this->books])
            ->andFilterWhere(['like', 'detills', $this->detills])
            ->andFilterWhere(['like', 'docurl', $this->docurl])
            ->andFilterWhere(['like', 'kinds', $this->kinds])
            ->andFilterWhere(['like', 'kinds2', $this->kinds2])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
