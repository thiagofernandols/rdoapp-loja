<?php

use yii\db\Migration;

/**
 * Handles dropping data_cadastro from table `cliente`.
 */
class m181201_034733_drop_data_cadastro_column_from_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('cliente', 'estado');
        $this->dropColumn('cliente', 'cidade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('cliente', 'estado', $this->string());
        $this->addColumn('cliente', 'cidade', $this->string());
    }
}
