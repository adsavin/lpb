<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property string $name_lao
 * @property string $name_eng
 *
 * @property Place[] $places
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_lao', 'name_eng'], 'required'],
            [['name_lao', 'name_eng'], 'string', 'max' => 255],
            [['name_lao'], 'unique'],
            [['name_eng'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_lao' => Yii::t('app', 'Lao Name'),
            'name_eng' => Yii::t('app', 'English Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['district_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DistrictQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DistrictQuery(get_called_class());
    }

    public static function getName() {
        return Yii::$app->language == "la-LA"? 'name_lao':'name_eng';
    }
}
