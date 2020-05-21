<?php
namespace App;
use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder {
    private static $queryFactory, $pdo;
    private $results;     
    public function __construct(QueryFactory $queryFactory, PDO $pdo)
    {
        self::$queryFactory = $queryFactory;
        self::$pdo = $pdo;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getAllFromTable($table)
    {
        $select = self::$queryFactory->newSelect();
        $select
            ->cols (['*'])
            ->from($table);

        $sth = self::$pdo->prepare($select->getStatement());
        $sth->execute();
        $this->results = $sth->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getOneById($table, $id)
    {
        # code...
    }


}