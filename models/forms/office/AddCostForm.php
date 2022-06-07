<?php

namespace app\models\forms\office;

use app\models\office\Cost;
use yii\base\Model;


class AddCostForm extends Model
{
    /** @var string $content */
    public $content;

    /** @var double $price */
    public $price;

    public function attributeLabels()
    {
        return [
            'content' => 'Пункт расходов',
            'price' => 'Стоимость'
        ];
    }

    public function rules()
    {
        return [
            [['content', 'price'], 'required', 'message' => 'Обязательное поле!'],
        ];
    }

    public function add($user_id)
    {
        $cost = new Cost();
        $cost->user_id = $user_id;
        $cost->content = $this->content;
        $cost->price = $this->price;
        $cost->datetime = date("Y-m-d H:i:s");
        return $cost->create();
    }
}
