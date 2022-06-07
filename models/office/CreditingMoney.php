<?php

namespace app\models\office;

/**
 * Затраты
 * 
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property double $amount
 * @property DateTime $datetime
 * 
 */
class CreditingMoney extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{crediting_money}}';
    }

    public static function getAllCrediting()
    {
        return static::find()->orderBy(['datetime' => SORT_DESC])->all();
    }

    public static function deleteById($id)
    {
        $crediting = static::findOne(['id' => $id]);
        return $crediting->delete();
    }

    public static function getSumByPeriod($start, $end)
    {
        return static::find()->where(['between', 'datetime', $start, $end])->sum('amount');
    }

    public function create(): bool
    {
        return $this->save(false);
    }
}
