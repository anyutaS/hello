<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m170725_085541_create_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(15),
            'text'=>$this->text(),
            'data'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comments');
    }
}
