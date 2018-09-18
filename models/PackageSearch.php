<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Package;

/**
 * PackageSearch represents the model behind the search form of `app\models\Package`.
 */
class PackageSearch extends Package
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company', 'phone', 'status'], 'integer'],
            [['sn', 'address', 'received_at', 'signing_at'], 'safe'],
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
        $query = Package::find();

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
            'company' => $this->company,
            'status' => $this->status,
        ]);

        if ($this->received_at) {
            $receivedTime = strtotime($this->received_at);
            $query->andFilterWhere(['between', 'received_at', $receivedTime, $receivedTime + 60*60*24]);
        }

        if ($this->signing_at) {
            $signTime = strtotime($this->signing_at);
            $query->andFilterWhere(['between', 'received_at', $signTime, $signTime + 60*60*24]);
        }

        $query->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address]);
        $query->orderBy('updated_at DESC');

        return $dataProvider;
    }
}
