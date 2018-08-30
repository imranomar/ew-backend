<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SlotsPricing;

/**
 * SlotsPricingSearch represents the model behind the search form about `app\models\SlotsPricing`.
 */
class SlotsPricingSearch extends SlotsPricing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time_from', 'time_to', 'type', 'price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = SlotsPricing::find();

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
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            'type' => $this->type,
            'price' => $this->price,
        ]);

        return $dataProvider;
    }
}
