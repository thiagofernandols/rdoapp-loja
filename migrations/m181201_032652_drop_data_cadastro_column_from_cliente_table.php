<?php

use yii\db\Migration;

/**
 * Handles dropping data_cadastro from table `cliente`.
 */
class m181201_032652_drop_data_cadastro_column_from_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('cliente', 'data_cadastro');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('cliente', 'data_cadastro', $this->timestamp());
    }
}
