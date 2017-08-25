<?php

use yii\db\Migration;

/**
 * Handles adding countComents to table `image`.
 */
class m170731_091951_add_countComents_column_to_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('image', 'countComents', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('image', 'countComents');
    }
}
