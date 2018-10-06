<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LaundryPricing]].
 *
 * @see LaundryPricing
 */
class LaundrypricingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Laundrypricing[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Laundrypricing|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
