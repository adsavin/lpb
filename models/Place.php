<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property integer $id
 * @property string $name_lao
 * @property string $name_eng
 * @property double $lat
 * @property double $lon
 * @property string $village_lao
 * @property string $village_eng
 * @property string $description_lao
 * @property string $description_eng
 * @property integer $district_id
 * @property integer $user_id
 * @property string $last_update
 * @property string $logo
 *
 * @property Photo[] $photos
 * @property District $district
 * @property User $user
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_lao', 'name_eng', 'district_id', 'user_id'], 'required'],
            [['lat', 'lon'], 'number'],
            [['description_lao', 'description_eng'], 'string'],
            [['district_id', 'user_id'], 'integer'],
            [['last_update'], 'safe'],
            [['name_lao', 'name_eng', 'village_lao', 'village_eng', 'logo'], 'string', 'max' => 255],
            [['name_lao'], 'unique'],
            [['name_eng'], 'unique'],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_lao' => Yii::t('app', 'Name Lao'),
            'name_eng' => Yii::t('app', 'Name Eng'),
            'lat' => Yii::t('app', 'Lat'),
            'lon' => Yii::t('app', 'Lon'),
            'village_lao' => Yii::t('app', 'Village Lao'),
            'village_eng' => Yii::t('app', 'Village Eng'),
            'description_lao' => Yii::t('app', 'Description Lao'),
            'description_eng' => Yii::t('app', 'Description Eng'),
            'district_id' => Yii::t('app', 'District ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'last_update' => Yii::t('app', 'Last Update'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return PlaceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaceQuery(get_called_class());
    }
}
