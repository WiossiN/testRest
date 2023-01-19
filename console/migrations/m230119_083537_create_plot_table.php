<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plot}}`.
 */
class m230119_083537_create_plot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    
        $this->createTable('{{%plot}}', [
            'id' => $this->primaryKey(),
            'cadastraNumber' => $this->string(64)->notNull(),
            'address' => $this->string(255)->notNull(),
            'price' => $this->double()->notNull(),
            'area' => $this->double()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%plot}}');
    }
}
