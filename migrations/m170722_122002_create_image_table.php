<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m170722_122002_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'img_name'=>$this->string(35),
            'url'=>$this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('image');
    }
}
