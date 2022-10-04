<?php

namespace backend\modules\sarabun\models;

use Yii;

/**
 * This is the model class for table "collection".
 *
 * @property int $id
 * @property string|null $mastername แฟ้มหลัก
 * @property string|null $name ชื่อแฟ้ม
 * @property string|null $detills รายละเอียดแฟ้ม
 *
 * @property Sarabun[] $sarabuns
 */
class Collection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'collection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['mastername', 'name'], 'string', 'max' => 45],
            [['detills'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mastername' => 'แฟ้มหลัก',
            'name' => 'ชื่อแฟ้ม',
            'detills' => 'รายละเอียดแฟ้ม',
        ];
    }

    /**
     * Gets query for [[Sarabuns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSarabuns()
    {
        return $this->hasMany(Sarabun::class, ['collection_id' => 'id']);
    }
    public function getFullname(){
        return $this->id.' '. $this->mastername .' - '.$this->name;
    }
}
