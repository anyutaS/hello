<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `image`.
 */
class m170722_115233_drop_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('upload', [
            'id' => $this->primaryKey(),
            'nameimg' => $this->string(),
            'url' => $this->string()
        ]);
            
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable('upload', [
            'id' => $this->primaryKey(),
            'nameimg' => $this->string()->notNull()->unique(),
            'url' => $this->string(32)->notNull(),
        ]);
    }
}
