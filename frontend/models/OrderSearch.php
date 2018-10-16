<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Orders;

/**
 * OrderSearch represents the model behind the search form about `frontend\models\Orders`.
 */
class OrderSearch extends Orders {
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'customer_id', 'payment_id', 'status', 'pickup_at_door', 'pickup_time_from', 'pickup_time_to', 'pickup_type', 'pickup_price', 'drop_at_door', 'drop_time_from', 'drop_time_to', 'drop_type', 'drop_price', 'address_id', 'same_day_pickup', 'next_day_drop'], 'integer'],
            [['pickup_date', 'drop_date', 'comments'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Orders::find();

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

        /*$query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'facebook_id' , $this->facebook_id]);*/

        return $dataProvider;
    }
}
