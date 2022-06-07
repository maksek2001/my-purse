<?php

namespace app\controllers;

use app\models\forms\office\AddCostForm;
use app\models\forms\office\AddCreditingMoneyForm;
use app\models\office\Cost;
use app\models\office\CreditingMoney;
use DateTime;
use DateTimeZone;
use yii;

class OfficeController extends SiteController
{

    public $layout = 'office';

    public function actionMain()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $addCostForm = new AddCostForm();

        if ($addCostForm->load(Yii::$app->request->post())) {
            if ($addCostForm->add(Yii::$app->user->id)) {
                return $this->redirect(['main']);
            }
        }

        $addCreditingMoneyForm = new AddCreditingMoneyForm();

        if ($addCreditingMoneyForm->load(Yii::$app->request->post())) {
            if ($addCreditingMoneyForm->add(Yii::$app->user->id)) {
                return $this->redirect(['main']);
            }
        }

        $lastMonth = [];
        $start = new DateTime('now', new DateTimeZone('Europe/Samara'));
        $end = new DateTime('now', new DateTimeZone('Europe/Samara'));
        $start->modify("-1 month");
        $lastMonth['cost_sum'] = Cost::getSumByPeriod($start->format("Y-m-d H:i:s"), $end->format("Y-m-d H:i:s"));
        $lastMonth['crediting_sum'] = CreditingMoney::getSumByPeriod($start->format("Y-m-d H:i:s"), $end->format("Y-m-d H:i:s"));

        $lastWeek = [];
        $start = new DateTime('now', new DateTimeZone('Europe/Samara'));
        $end = new DateTime('now', new DateTimeZone('Europe/Samara'));
        $start->modify("-1 week");
        $lastWeek['cost_sum'] = Cost::getSumByPeriod($start->format("Y-m-d H:i:s"), $end->format("Y-m-d H:i:s"));
        $lastWeek['crediting_sum'] = CreditingMoney::getSumByPeriod($start->format("Y-m-d H:i:s"), $end->format("Y-m-d H:i:s"));

        return $this->render('main', [
            'addCostForm' => $addCostForm,
            'addCreditingMoneyForm' => $addCreditingMoneyForm,
            'costs' => Cost::getAllCosts(),
            'credits' => CreditingMoney::getAllCrediting(),
            'lastMonth' => $lastMonth,
            'lastWeek' => $lastWeek
        ]);
    }

    public function actionDeleteCost()
    {
        Cost::deleteById($_GET['id']);
        return $this->redirect('main');
    }

    public function actionDeleteCrediting()
    {
        CreditingMoney::deleteById($_GET['id']);
        return $this->redirect('main');
    }
}
