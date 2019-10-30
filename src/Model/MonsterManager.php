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
class MonsterManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'monster';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectOneMonster(): array
    {
        return $this->pdo->query('SELECT m.name, m.image, m.atk, m.def, m.agility, m.HP AS onemMonster FROM monster m
                                            WHERE killed = 0 ;' . $this->table)->fetch();
    }
}
