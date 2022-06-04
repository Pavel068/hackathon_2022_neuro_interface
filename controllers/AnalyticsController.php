<?php

namespace app\controllers;

use yii\web\Controller;

class AnalyticsController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}