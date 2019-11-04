<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class CharactersManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'player';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    public function selectAllCharacters(): array
    {
        return $this->pdo->query('SELECT p.id, p.name, p.description, p.origin, p.image, s.atk, s.def, s.agility, s.HP 
                                    FROM player p
                                    JOIN player_stat ps ON p.id = ps.player_id
                                    JOIN stat s ON ps.stat_id = s.id;' . $this->table)->fetchAll();
    }


    public function usedHero()
    {
        return $this->pdo->query('SELECT p.id, p.isHero, p.name, p.description, p.origin, 
                                                p.image, s.atk, s.def, s.agility, s.HP 
                                    FROM player p
                                    JOIN player_stat ps ON p.id = ps.player_id
                                    JOIN stat s ON ps.stat_id = s.id where p.isHero = 1;
                                  ' . $this->table)->fetch();
    }

    public function isDead()
    {
        $character = new CharactersManager();
        $hero = $character->usedHero();
        if ($hero['HP'] < 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $character
     * @return bool
     */
    public function selectHero(array $character):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `isHero` = :isHero WHERE id=:id");
        $statement->bindValue('id', $character['id'], \PDO::PARAM_INT);
        $statement->bindValue('isHero', $character['isHero'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function updateCharacterHP(array $character):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE stat s 
                                                    LEFT JOIN player_stat ps ON s.id = ps.stat_id
		                                            LEFT JOIN player p ON p.id = ps.player_id SET 
                                                    HP = " . $character['HP'] . " WHERE p.id = " . $character['id'] . ";");

        $statement->bindValue('HP', $character['HP'], \PDO::PARAM_INT);
        $statement->bindValue('id', $character['id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
