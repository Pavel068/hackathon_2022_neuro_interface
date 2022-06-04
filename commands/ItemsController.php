<?php

namespace app\commands;

use app\models\Devices;
use app\models\Items;
use app\models\Types;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\rbac\Item;

class ItemsController extends Controller
{
    /**
     * @return int
     */
    public function actionMassCreate(): int
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/items.json'), true);

        foreach ($data as $elem) {
            // Добавить тип
            $type = Types::find()->where(['name' => $elem['device']['type']])->one();
            if (!$type) {
                $type = new Types();
                $type->load(['name' => $elem['device']['type']], '');
                $type->save();
            }

            // Добавить девайс
            $device = Devices::find()->where([
                'name' => $elem['device']['name'],
                'type_id' => $type->id
            ])->one();
            if (!$device) {
                $device = new Devices();
                $device->load(array_merge($elem['device'], ['type_id' => $type->id]), '');
                $device->save();
            }

            // Добавить единицу
            foreach ($elem['items'] as $i) {
                $item = new Items();
                $item->load(array_merge(['device_id' => $device->id], $i), '');
                $item->save();
            }
        }

        return ExitCode::OK;
    }
}