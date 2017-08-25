<?php

use yii\db\Migration;

/**
 * Handles adding nameHach to table `image`.
 */
class m170816_190116_add_nameHach_column_to_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('image', 'nameHach', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('image', 'nameHach');
    }
}
