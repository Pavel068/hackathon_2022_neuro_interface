<?php

use yii\db\Migration;

/**
 * Class m220604_112427_alter_tables_fix_column_types
 */
class m220604_112427_alter_tables_fix_column_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('devices', 'scale_min', $this->float()->null());
        $this->alterColumn('devices', 'scale_max', $this->float()->null());
        $this->alterColumn('devices', 'error', $this->float()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220604_112427_alter_tables_fix_column_types cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220604_112427_alter_tables_fix_column_types cannot be reverted.\n";

        return false;
    }
    */
}
