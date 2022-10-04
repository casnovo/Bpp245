<?php

namespace backend\modules\sarabun\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $id
 * @property string $name ชื่อหน่วยงาน
 * @property string $codename รหัสหน่วยงาน
 * @property string|null $coordinator ผู้ประสานงาน
 * @property string|null $tel เบอร์โทรหน่วยงาน/ผู้ประสานงาน
 * @property string|null $Scodename รหัสอ้างอิง
 *
 * @property Sarabun[] $sarabuns
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'codename'], 'required'],
            [['name', 'codename', 'coordinator', 'tel', 'Scodename'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อหน่วยงาน',
            'codename' => 'รหัสหน่วยงาน',
            'coordinator' => 'ผู้ประสานงาน',
            'tel' => 'เบอร์โทรหน่วยงาน/ผู้ประสานงาน',
            'Scodename' => 'รหัสอ้างอิง',
        ];
    }

    /**
     * Gets query for [[Sarabuns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSarabuns()
    {
        return $this->hasMany(Sarabun::class, ['unit_id' => 'id']);
    }
    public function getFullname(){
        return $this->id.' '. $this->name .' - '.$this->codename;
    }
}
