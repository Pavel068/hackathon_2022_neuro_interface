<?php

use app\models\Devices;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DevicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приборы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить Прибор', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'attribute' => 'type_id',
                'filter' => Html::activeDropDownList($searchModel, 'type_id', ArrayHelper::map(\app\models\Types::find()->asArray()->all(), 'id', 'name'), ['class'=>'form-control', 'prompt' => 'Выберите тип']),
                'value' => function ($model) {
                    if (!$model['type_id']) return null;
                    $value = \app\models\Types::find()->where(['id' => $model['type_id']])->one();
                    return $value->name;
                }
            ],
            'name',
            'brand',
            'model',
            'country',
            'unit',
            'scale_min',
            'scale_max',
            'error',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Devices $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
