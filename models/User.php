<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $salt
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**s
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['username', 'password_hash', 'salt'], 'string', 'max' => 255],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'salt' => Yii::t('app', 'Salt'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ($this->isNewRecord)
            {
                $this->salt = Yii::$app->security->generateRandomString();
            }
            if (!empty($this->password_hash))
            {
                $this->password_hash =
                    Yii::$app->security->generatePasswordHash($this->salt . $this->password_hash);
            }
            return true;
        }
        return false;
    }
    
    /**
     * Password validation.
     * @param string $password
     * @return boolean
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($this->salt . $password, $this->password_hash);
    }

    /**
     * Find model by username
     * @param string $username
     * @return User
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }
}
