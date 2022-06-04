<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items}}`.
 */
class m220604_075638_create_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer()->null(),
            'location' => $this->string(500)->null(),
            'inventory_number' => $this->string(255)->null(),
            'device_id' => $this->integer()->notNull(),
            'verified_at' => $this->date()->null(),
            'expired_at' => $this->date()->null(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB');

        $this->createIndex('items_file_id', 'items', 'file_id');
        $this->createIndex('items_device_id', 'items', 'device_id');

        $this->addForeignKey(
            'fk_items_file_id',
            'items',
            'file_id',
            'files',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_items_device_id',
            'items',
            'device_id',
            'devices',
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
        $this->dropTable('{{%items}}');
    }
}
