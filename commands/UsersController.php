<?php

namespace app\commands;

use app\models\Users;
use yii\console\Controller;
use yii\console\ExitCode;

class UsersController extends Controller
{
    /**
     * @return int
     */
    public function actionCreate(): int
    {
        $user = new Users();
        $user->load([
            'name' => 'Pavel',
            'email' => 'test@example.com',
            'password' => '123456'
        ], '');
        $user->save();

        return ExitCode::OK;
    }
}