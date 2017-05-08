<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m170508_103336_create_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    private $_table_name = "categories";

    public function up ()
    {
        $this->createTable($this->_table_name, [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(),
            'parent_id' => $this->integer(),
        ]);
        $this->addForeignKey("parent_id-id-fk", $this->_table_name, "parent_id", $this->_table_name,
            "id", "CASCADE", "CASCADE");

        $this->createIndex("parent_id-inx", $this->_table_name, "parent_id");
    }

    /**
     * @inheritdoc
     */
    public function down ()
    {
        $this->dropIndex("parent_id-inx", $this->_table_name);
        $this->dropForeignKey("parent_id-id-fk", $this->_table_name);
        $this->dropTable('categories');
    }
}
