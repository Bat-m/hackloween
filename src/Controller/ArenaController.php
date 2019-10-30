<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\ArenaManager;

class ArenaController
{
    public function playersStats()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $arenaManager = new ArenaManager();
            $playersStats = $arenaManager->characterStats();
            return json_encode($playersStats);
        }
        header('HTTP/1.1 405 Method Not Allowed');
    }
}


