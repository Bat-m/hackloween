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

    public function selectOneMonster(int $isInFight): array
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT m.name, m.image, m.atk, m.def, m.agility, m.HP  
                                                    FROM monster m WHERE is_in_fight = :is_in_fight");
        $statement->bindValue('is_in_fight', $isInFight, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function updateMonster(array $monster):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE  monster SET `HP` = :HP  WHERE is_in_fight=:is_in_fight");
        $statement->bindValue('is_in_fight', 1, \PDO::PARAM_INT);
        $statement->bindValue('HP', $monster['HP'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function fightMonster(array $monster):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE  monster SET `is_in_fight` = " . $monster['is_in_fight'] . "  
        WHERE id= " . $monster['id'] . ";");

        $statement->bindValue('id', $monster['id'], \PDO::PARAM_INT);
        $statement->bindValue('is_in_fight', $monster['is_in_fight'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
