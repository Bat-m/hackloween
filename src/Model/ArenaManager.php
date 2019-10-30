<?php

namespace App\Model;

class ArenaManager extends AbstractManager
{

    const TABLE = 'arena';

    /** caracters
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function characterStats() : array
    {
        $query= $this->pdo->query("
       SELECT s.atk, s.def, s.HP, s.agility FROM stat s
       RIGHT JOIN player_stat ps
       ON s.id = ps.stat_id
       RIGHT JOIN player p
       ON ps.stat_id = p.id
       WHERE p.id = 3;
       ");
        return $query->fetch();
    }

    public function monsterStats(): array
    {
        return $this->pdo->query('SELECT m.atk, m.def, m.agility, m.HP FROM monster m
                                           WHERE m.is_in_fight = 1;' . $this->table)->fetchAll();
    }


    public function fight()
    {
        $monster = new MonsterManager();
        $character = new CharactersManager();

        $opponent = $monster->selectOneMonster();
        $hero = $character->usedHero();

        $monsterDmg = $opponent['atk'] - $hero['def'];
        $heroDmg = $hero['atk'] - $opponent['def'];

        if ($opponent['agility'] < $hero['agility']) {
            return $opponent['name'] . ' vous inflige ' . $monsterDmg;
        } else {
            return 'Vous infligez ' . $heroDmg . ' degat a ' . $opponent['name'];
        }
    }
}
