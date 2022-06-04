<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property int|null $file_id
 * @property string|null $location
 * @property string|null $inventory_number
 * @property int $device_id
 * @property string|null $verified_at
 * @property string|null $expired_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Devices $device
 * @property Files $file
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'device_id'], 'integer'],
            [['device_id'], 'required'],
            [['verified_at', 'expired_at', 'created_at', 'updated_at'], 'safe'],
            [['location'], 'string', 'max' => 500],
            [['inventory_number'], 'string', 'max' => 255],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'Файл',
            'location' => 'Расположение',
            'inventory_number' => 'Инвентарный №',
            'device_id' => 'Прибор',
            'verified_at' => 'Поверка',
            'expired_at' => 'Действителен',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Device]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['id' => 'device_id']);
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
