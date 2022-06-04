<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%devices}}`.
 */
class m220604_074006_create_devices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%devices}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->null(),
            'name' => $this->string(255)->null(),
            'brand' => $this->string(255)->null(),
            'model' => $this->string(255)->null(),
            'country' => $this->string(255)->null(),
            'unit' => $this->string(32)->null(),
            'scale_min' => $this->integer()->null(),
            'scale_max' => $this->integer()->null(),
            'error' => $this->integer()->null(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB');

        $this->createIndex('devices_type_id', 'devices', 'type_id');
        $this->addForeignKey(
            'fk_devices_type_id',
            'devices',
            'type_id',
            'types',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%devices}}');
    }
}
