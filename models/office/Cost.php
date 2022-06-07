<?php

namespace app\models\office;

/**
 * Затраты
 * 
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property double $price
 * @property DateTime $datetime
 * 
 */
class Cost extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{costs}}';
    }

    public static function getAllCosts()
    {
        return static::find()->orderBy(['datetime' => SORT_DESC])->all();
    }

    public static function deleteById($id)
    {
        $cost = static::findOne(['id' => $id]);
        return $cost->delete();
    }

    public static function getSumByPeriod($start, $end)
    {
        return static::find()->where(['between', 'datetime', $start, $end])->sum('price');
    }

    public function create(): bool
    {
        return $this->save(false);
    }
}
