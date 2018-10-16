<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tasks;

/**
 * TaskSearch represents the model behind the search form about `frontend\models\Tasks`.
 */
class TaskSearch extends Tasks {
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'type', 'assigned_to'], 'integer'],
            [['at', 'order_id', 'assigned_to'], 'safe'],
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
        $query = Tasks::find();
        $query->joinWith('orders');

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

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'at', $this->at])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
            ->andFilterWhere(['like', 'orders.pickup_date', $this->order_id]);

        return $dataProvider;
    }
}
