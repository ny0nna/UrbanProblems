<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id_cat
 * @property string $name
 *
 * @property Claim[] $claims
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cat' => 'Id',
            'name' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Claims]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClaims()
    {
        return $this->hasMany(Claim::class, ['id_cat' => 'id_cat']);
    }
}
