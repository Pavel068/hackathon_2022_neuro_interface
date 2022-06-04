<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property int $id
 * @property int|null $type_id
 * @property string|null $name
 * @property string|null $brand
 * @property string|null $model
 * @property string|null $country
 * @property string|null $unit
 * @property float|null $scale_min
 * @property float|null $scale_max
 * @property float|null $error
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Items[] $items
 * @property Types $type
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'devices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id'], 'integer'],
            [['scale_min', 'scale_max', 'error'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'brand', 'model', 'country'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 32],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Тип',
            'name' => 'Название',
            'brand' => 'Производитель',
            'model' => 'Модель',
            'country' => 'Страна',
            'unit' => 'Единица',
            'scale_min' => 'Шкала, мин',
            'scale_max' => 'Шкала, макс',
            'error' => 'Погрешность',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['device_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Types::className(), ['id' => 'type_id']);
    }
}
