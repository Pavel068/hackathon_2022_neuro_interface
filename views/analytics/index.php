<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;

$this->title = 'Аналитика';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="analytics-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row mt-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Типы приробов</div>
                <div class="card-body">
                    <?=
                    ChartJs::widget([
                        'type' => 'doughnut',
                        'id' => uniqid(true),
                        'options' => [
                            'responsive' => true,
                            'maintainAspectRatio' => false,
                        ],
                        'data' => [
                            'labels' => ['Счетчик газа бытовой', 'Линейка деревянная'],
                            'datasets' => [
                                [
                                    'data' => [6600, 1000254],
                                    'backgroundColor' => [
                                        'rgb(255, 99, 132)',
                                        'rgb(0, 205, 86)'
                                    ]
                                ]
                            ]
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">По странам</div>
                <div class="card-body">
                    <?=
                    ChartJs::widget([
                        'type' => 'doughnut',
                        'id' => uniqid(true),
                        'options' => [
                            'responsive' => true,
                            'maintainAspectRatio' => false,
                        ],
                        'data' => [
                            'labels' => ['Россия', 'США', 'Германия', 'Китай'],
                            'datasets' => [
                                [
                                    'data' => [55, 2, 25, 50],
                                    'backgroundColor' => [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 205, 86)',
                                        'rgb(0, 205, 86)'
                                    ]
                                ]
                            ]
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">По странам</div>
                <div class="card-body">
                    <?=
                    ChartJs::widget([
                        'type' => 'doughnut',
                        'id' => uniqid(true),
                        'options' => [
                            'responsive' => true,
                            'maintainAspectRatio' => false,
                        ],
                        'data' => [
                            'labels' => ['Россия', 'США', 'Германия', 'Китай'],
                            'datasets' => [
                                [
                                    'data' => [55, 2, 25, 50],
                                    'backgroundColor' => [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 205, 86)',
                                        'rgb(0, 205, 86)'
                                    ]
                                ]
                            ]
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">До окончания поверки</div>
                <div class="card-body">
                    <?=
                    ChartJs::widget([
                        'type' => 'doughnut',
                        'id' => uniqid(true),
                        'options' => [
                            'responsive' => true,
                            'maintainAspectRatio' => false,
                        ],
                        'data' => [
                            'labels' => ['< 1 месяца', '< 3 месяцев', '< 6 месяцев', '< 12 месяцев'],
                            'datasets' => [
                                [
                                    'data' => [10, 22, 15, 25],
                                    'backgroundColor' => [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 205, 86)',
                                        'rgb(0, 205, 86)'
                                    ]
                                ]
                            ]
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>