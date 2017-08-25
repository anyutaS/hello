<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Comments;
use Yii;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CommentsController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionDelete($q = 1)
    {
        if ($q != 1 AND $q != 2 AND $q != 3 AND $q != 5 AND $q != 15 AND $q != 30) {
            echo  'error';
        }
        $time = new \DateTime('now');
        date_sub($time, date_interval_create_from_date_string($q . ' days'));
        $today = $time->format('Y-m-d');
        echo $today;
        $comments = Comments::deleteAll(['<', 'data', $today]);
        echo "Was removed " . $comments . " records";
    }
}
