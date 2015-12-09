<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%images}}".
 *
 * @property integer $id
 * @property string $real_path
 * @property string $preview_path
 *
 * @property Book[] $books
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['real_path', 'preview_path'], 'required'],
            [['real_path', 'preview_path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'real_path' => Yii::t('app', 'Real Path'),
            'preview_path' => Yii::t('app', 'Preview Path'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['image_id' => 'id']);
    }
}
