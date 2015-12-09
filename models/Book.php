<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%books}}".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property integer $image_id
 * @property string $date
 * @property integer $status
 *
 * @property Author $author
 * @property Image $image
 */
class Book extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ENABLED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'name', 'image_id'], 'required'],
            [['author_id', 'image_id', 'status'], 'integer'],
            [['date_create', 'date_update', 'date'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author'),
            'name' => Yii::t('app', 'Name'),
            'date_create' => Yii::t('app', 'Book Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
            'image_id' => Yii::t('app', 'Image preview'),
            'date' => Yii::t('app', 'Published date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        if(parent::beforeValidate())
        {
            $this->status = self::STATUS_DELETED;
            $this->save();
        }
        return false;
    }
}
