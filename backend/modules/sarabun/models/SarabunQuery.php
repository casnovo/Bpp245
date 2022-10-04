<?php

namespace backend\modules\sarabun\models;

/**
 * This is the ActiveQuery class for [[Sarabun]].
 *
 * @see Sarabun
 */
class SarabunQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Sarabun[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Sarabun|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
