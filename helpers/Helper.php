<?php

namespace app\helpers;

class Helper
{
    public static function callML()
    {
        $path = getcwd() . '/test.py';
        shell_exec("python $path > 1.txt");
    }

    public static function writeDB()
    {
        $path = getcwd();
        shell_exec("php $path/../yii items/mass-create > 1.txt");
    }
}