<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = Yii::$app->name;
?>
<div class="office-info">
    <div class="block-info">
        <h4>Расходы</h4>
        <?php $form = ActiveForm::begin([
            'id' => 'add-cost-form',
            'options' => [
                'class' => 'justify-content-center'
            ],
            'method' => 'post'
        ]); ?>

        <?= $form->field($addCostForm, 'content')->textInput(['autofocus' => true]) ?>

        <?= $form->field($addCostForm, 'price')->textInput() ?>

        <?= Html::submitButton('Записать', ['class' => 'btn btn-secondary']) ?>

        <?php ActiveForm::end(); ?>

        <div class="filter-block">
            <input class="filter-input form-control" id="cost-start-date" type="datetime-local">
            <input class="filter-input form-control" id="cost-end-date" type="datetime-local">
        </div>
        <button class="filter btn btn-primary" id="filter-cost">Фильтровать</button>
        <div id="elements-cost" class="elements">
            <?php foreach ($costs as $cost) : ?>
                <div class="element cost" data-date="<?= Html::encode($cost->datetime) ?>">
                    <div class="left-info">
                        <strong><?= Html::encode($cost->datetime) ?></strong>
                        <details>
                            <summary class="summary-shop">
                                Подробнее
                            </summary>
                            <?= Html::encode($cost->content) ?>
                        </details>
                    </div>
                    <div class="right-info">
                        <strong>
                            <?= Html::encode($cost->price) ?> ₽
                        </strong>
                        <br>
                        <a class="delete" href="delete-cost?id=<?= $cost->id ?>">Удалить</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="block-info">
        <h4>Зачисления</h4>
        <?php $form = ActiveForm::begin([
            'id' => 'add-crediting-money-form',
            'options' => [
                'class' => 'justify-content-center'
            ],
            'method' => 'post'
        ]); ?>

        <?= $form->field($addCreditingMoneyForm, 'message')->textInput(['autofocus' => true]) ?>

        <?= $form->field($addCreditingMoneyForm, 'amount')->textInput() ?>

        <?= Html::submitButton('Записать', ['class' => 'btn btn-secondary']) ?>

        <?php ActiveForm::end(); ?>

        <div class="filter-block">
            <input class="filter-input form-control" id="crediting-start-date" type="datetime-local">
            <input class="filter-input form-control" id="crediting-end-date" type="datetime-local">
        </div>
        <button class="filter btn btn-primary" id="filter-crediting">Фильтровать</button>
        <div id="elements-crediting" class="elements">
            <?php foreach ($credits as $credit) : ?>
                <div class="element crediting" data-date="<?= Html::encode($credit->datetime) ?>">
                    <div class="left-info">
                        <strong><?= Html::encode($credit->datetime) ?></strong>
                        <details>
                            <summary class="summary-shop">
                                Подробнее
                            </summary>
                            <?= Html::encode($credit->message) ?>
                        </details>
                    </div>
                    <div class="right-info">
                        <strong>
                            <?= Html::encode($credit->amount) ?> ₽
                        </strong>
                        <br>
                        <a class="delete" href="delete-crediting?id=<?= $credit->id ?>">Удалить</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="block-info analyze">
        <h4>Анализ финансов</h4>
        <div class="total">
            <h5>За последние 30 дней</h5>
            <p class="info-text">
                <strong>Поступило:</strong> <?= $lastMonth['crediting_sum'] ?> ₽
            </p>
            <p class="info-text">
                <strong>Потрачено:</strong> <?= $lastMonth['cost_sum'] ?> ₽
            </p>
            <p class="info-text">
                <strong>Остаток на конец периода (без учёта прошлых периодов):</strong> <?= $lastMonth['crediting_sum'] - $lastMonth['cost_sum'] ?> ₽
            </p>
        </div>
        <div class="total">
            <h5>За последние 7 дней</h5>
            <p class="info-text">
                <strong>Поступило:</strong> <?= $lastWeek['crediting_sum'] ?> ₽
            </p>
            <p class="info-text">
                <strong>Потрачено:</strong> <?= $lastWeek['cost_sum'] ?> ₽
            </p>
            <p class="info-text">
                <strong>Остаток на конец периода (без учёта прошлых периодов):</strong> <?= $lastWeek['crediting_sum'] - $lastWeek['cost_sum'] ?> ₽
            </p>
        </div>
    </div>
</div>