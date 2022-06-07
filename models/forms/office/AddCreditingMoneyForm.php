<?php

namespace app\models\forms\office;

use app\models\office\CreditingMoney;
use yii\base\Model;

class AddCreditingMoneyForm extends Model
{
    /** @var string $message */
    public $message;

    /** @var double $amount */
    public $amount;

    public function attributeLabels()
    {
        return [
            'message' => 'Сообщение',
            'amount' => 'Сумма'
        ];
    }

    public function rules()
    {
        return [
            [['message', 'amount'], 'required',  'message' => 'Обязательное поле!']
        ];
    }

    public function add($user_id)
    {
        $crediting = new CreditingMoney();
        $crediting->user_id = $user_id;
        $crediting->message = $this->message;
        $crediting->amount = $this->amount;
        $crediting->datetime = date("Y-m-d H:i:s");

        return $crediting->create();
    }
}
