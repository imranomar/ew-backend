<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Addresses;

/**
 * AddressesSearch represents the model behind the search form about `app\models\Addresses`.
 */
class AddressesSearch extends Addresses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'city_id', 'pobox', 'unit_number', 'as_default'], 'integer'],
            [['street_name', 'floor'], 'safe'],
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
        $query = Addresses::find();

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
            'customer_id' => $this->customer_id,
            'city_id' => $this->city_id,
            'pobox' => $this->pobox,
            'unit_number' => $this->unit_number,
            'as_default' => $this->as_default,
        ]);

        $query->andFilterWhere(['like', 'street_name', $this->street_name])
            ->andFilterWhere(['like', 'floor', $this->floor]);

        return $dataProvider;
    }
}
