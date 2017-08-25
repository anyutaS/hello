<?php

use yii\db\Migration;

/**
 * Handles adding description to table `image`.
 */
class m170725_071346_add_description_column_to_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('image', 'description', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('image', 'description');
    }
}
