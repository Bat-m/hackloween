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
class MonsterController extends ItemController
{

    /**
     * Retrieve monster listing
     *
     * @return string
     */
    public function everyone($isInFight)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $monsterManager = new MonsterManager();
            $monster = $monsterManager->selectOneMonster($isInFight);

            return json_encode($monster);
        }
        header('HTTP/1.1 405 Method Not Allowed');
    }


    public function editMonster($isInFight)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            try {
                $monsterManager = new MonsterManager();
                $monster = $monsterManager->selectOneMonster($isInFight);
                $json = file_get_contents('php://input');
                $obj = json_decode($json);
                $monster['HP'] = $obj->HP;
                $monster['is_in_fight'] = $obj->is_in_fight;
                $monsterManager->updateMonster($monster);
                header('HTTP/1.1 204 resource updated successfully');
            } catch (\Exception $e) {
                /* var_dump should be delete in production */
                var_dump($e->getMessage());
                header('HTTP/1.1 500 Internal Server Error');
            }
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
        }
    }

    public function chooseMonster($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            try {
                $monsterManager = new MonsterManager();
                $monster = $monsterManager->selectOneMonster($id);
                $json = file_get_contents('php://input');
                $obj = json_decode($json);
                $monster['id'] = $obj->id;
                $monster['is_in_fight'] = $obj->is_in_fight;
                $monsterManager->updateMonster($monster);
                header('HTTP/1.1 204 resource updated successfully');
            } catch (\Exception $e) {
                /* var_dump should be delete in production */
                var_dump($e->getMessage());
                header('HTTP/1.1 500 Internal Server Error');
            }
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
        }
    }

}
