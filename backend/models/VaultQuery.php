<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Vault]].
 *
 * @see Vault
 */
class VaultQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Vault[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Vault|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
