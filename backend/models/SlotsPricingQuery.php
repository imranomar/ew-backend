<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SlotsPricing]].
 *
 * @see SlotsPricing
 */
class SlotsPricingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SlotsPricing[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SlotsPricing|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
