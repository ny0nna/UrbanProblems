<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "claim".
 *
 * @property int $id_claim
 * @property int $id_user
 * @property string $name
 * @property string $discr
 * @property int $id_cat
 * @property string $photo_after
 * @property string $photo_before
 * @property string $time
 * @property string $ststus
 *
 * @property Category $cat
 * @property User $user
 */
class Claim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'claim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'discr', 'id_cat', 'photo_before'], 'required'],
            [['id_user', 'id_cat'], 'integer'],
            [['time'], 'safe'],
            [['ststus'], 'string'],
            [['name', 'photo_after', 'photo_before'], 'string', 'max' => 100],
            [['discr'], 'string', 'max' => 1000],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_cat'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['id_cat' => 'id_cat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_claim' => 'Номер заявки',
            'id_user' => 'Пользователь',
            'name' => 'Наименование',
            'discr' => 'Описание',
            'id_cat' => 'Категория',
            'photo_after' => 'Фото (после)',
            'photo_before' => 'Фото (до)',
            'time' => 'Время',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::class, ['id_cat' => 'id_cat']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id_user' => 'id_user']);
    }
}
