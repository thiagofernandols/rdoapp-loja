<?php

use yii\db\Migration;

/**
 * Handles adding position to table `cliente`.
 */
class m181201_034743_add_position_column_to_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cliente', 'id_estado', $this->integer());
        $this->addColumn('cliente', 'id_cidade', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cliente', 'id_estado');
        $this->dropColumn('cliente', 'id_cidade');
    }
}
