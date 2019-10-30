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
    const TABLE = 'characters';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    public function selectAllCharacters(): array
    {
        return $this->pdo->query('SELECT p.name, p.description, p.origin, p.image, s.atk, s.def, s.agility, s.HP 
                                    FROM player p
                                    JOIN player_stat ps ON p.id = ps.player_id
                                    JOIN stat s ON ps.stat_id = s.id;' . $this->table)->fetchAll();
    }

    public function usedHero()
    {
        return $this->pdo->query('SELECT p.name, p.description, p.origin, p.image, s.atk, s.def, s.agility, s.HP 
                                    FROM player p
                                    JOIN player_stat ps ON p.id = ps.player_id
                                    JOIN stat s ON ps.stat_id = s.id;' . $this->table)->fetch();
    }
}
