<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\CharactersManager;

/**
 * Class ItemController
 *
 */
class CharactersController
{

    /**
     * Retrieve characters listing
     *
     * @return string
     */
    public function everyone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $charactersManager = new CharactersManager();
            $characters = $charactersManager->selectAllCharacters();

            return json_encode($characters);
        }
        header('HTTP/1.1 405 Method Not Allowed');
    }

    public function hero()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $charactersManager = new CharactersManager();
            $hero = $charactersManager->usedHero();

            return json_encode($hero);
        }
        header('HTTP/1.1 405 Method Not Allowed');
    }

    public function selectHero(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            try {
                $characterManager = new CharactersManager();
                $character = $characterManager->selectOneById($id);
                $json = file_get_contents('php://input');
                $obj = json_decode($json);
                $character['isHero'] = $obj->isHero;
                $characterManager->selectHero($character);
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

    public function editCharacter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            try {
                $characterManager = new CharactersManager();
                $character = $characterManager->usedHero();
                $json = file_get_contents('php://input');
                $obj = json_decode($json);
                $character['HP'] = $obj->HP;
                $characterManager->updateCharacterHP($character);
                header('HTTP/1.1 204 resource updated successfully');
            } catch (\Exception $e) {
                /* var_dump should be delete in production */
                var_dump($e->getMessage());
                header('HTTP/1.1 500 Internal Server Error');
            }
        }
    }
}
