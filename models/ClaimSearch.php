<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Claim;

/**
 * ClaimSearch represents the model behind the search form of `app\models\Claim`.
 */
class ClaimSearch extends Claim
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_claim', 'id_user', 'id_cat'], 'integer'],
            [['name', 'discr', 'photo_after', 'photo_before', 'time', 'ststus'], 'safe'],
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
        $query = Claim::find();

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
            'id_claim' => $this->id_claim,
            'id_user' => $this->id_user,
            'id_cat' => $this->id_cat,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'discr', $this->discr])
            ->andFilterWhere(['like', 'photo_after', $this->photo_after])
            ->andFilterWhere(['like', 'photo_before', $this->photo_before])
            ->andFilterWhere(['like', 'ststus', $this->ststus]);

        return $dataProvider;
    }
}
