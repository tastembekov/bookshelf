<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
    public $date_start;
    public $date_finish;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'image_id', 'status'], 'integer'],
            [['name', 'date_create', 'date_update', 'date', 'date_start', 'date_finish'], 'safe'],
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
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'date' => $this->date,
            'status' => Book::STATUS_ENABLED
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        if (!empty($this->date_start))
            $query->andFilterWhere(['>', 'date', $this->date_start]);

        if (!empty($this->date_finish))
            $query->andFilterWhere(['<', 'date', $this->date_finish]);

        return $dataProvider;
    }
}
