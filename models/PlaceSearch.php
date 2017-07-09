<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Place;

/**
 * PlaceSearch represents the model behind the search form about `app\models\Place`.
 */
class PlaceSearch extends Place
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_id', 'user_id'], 'integer'],
            [['name_lao', 'name_eng', 'village_lao', 'village_eng', 'description_lao', 'description_eng', 'last_update', 'logo'], 'safe'],
            [['lat', 'lon'], 'number'],
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
        $query = Place::find();

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
            'lat' => $this->lat,
            'lon' => $this->lon,
            'district_id' => $this->district_id,
            'user_id' => $this->user_id,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'name_lao', $this->name_lao])
            ->andFilterWhere(['like', 'name_eng', $this->name_eng])
            ->andFilterWhere(['like', 'village_lao', $this->village_lao])
            ->andFilterWhere(['like', 'village_eng', $this->village_eng])
            ->andFilterWhere(['like', 'description_lao', $this->description_lao])
            ->andFilterWhere(['like', 'description_eng', $this->description_eng])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
