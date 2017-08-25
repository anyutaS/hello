<?php

use yii\db\Migration;

/**
 * Handles adding idimage to table `comments`.
 */
class m170726_103137_add_idimage_column_to_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('comments', 'idimage', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('comments', 'idimage');
    }
}
