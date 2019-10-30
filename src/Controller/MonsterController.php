<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\MonsterManager;

/**
 * Class MonsterController
 *
 */
class MonsterController
{

    /**
     * Retrieve monster listing
     *
     * @return string
     */
    public function everyone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $monsterManager = new MonsterManager();
            $monster = $monsterManager->selectOneMonster();

            return json_encode($monster);
        }
        header('HTTP/1.1 405 Method Not Allowed');
    }

}

