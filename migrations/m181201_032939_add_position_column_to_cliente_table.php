<?php

use yii\db\Migration;

/**
 * Handles adding position to table `cliente`.
 */
class m181201_032939_add_position_column_to_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cliente', 'data_criacao', 'timestamp with time zone NOT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cliente', 'data_criacao');
    }
}
