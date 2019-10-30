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

    public function characterStats()
    {
        $query= $this->pdo->query("
       SELECT s.atk, s.def, s.HP, s.agility FROM stat s
       RIGHT JOIN player_stat ps
       ON s.id = ps.stat_id
       RIGHT JOIN player p
       ON ps.stat_id = p.id
       WHERE p.id = 3;
       ");
        return $query->fetchAll();
    }
}

