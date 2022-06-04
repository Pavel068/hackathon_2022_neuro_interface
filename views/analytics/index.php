<?php

use yii\helpers\Html;

$this->title = 'Аналитика';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="analytics-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-header">Основная</div>
        <div class="card-body"></div>
    </div>

    <div class="card mt-2">
        <div class="card-header">По странам</div>
        <div class="card-body"></div>
    </div>

    <div class="card mt-2">
        <div class="card-header">По дате поверки</div>
        <div class="card-body"></div>
    </div>
</div>