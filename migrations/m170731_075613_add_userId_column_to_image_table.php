<?php

use yii\db\Migration;

/**
 * Handles adding userId to table `image`.
 */
class m170731_075613_add_userId_column_to_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('image', 'userId', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('image', 'userId');
    }
}
