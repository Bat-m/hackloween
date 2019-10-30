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
}
