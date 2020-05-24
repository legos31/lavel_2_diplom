<?php
namespace App\model;
use Aura\SqlQuery\QueryFactory;
use PDO;

class Product {

    private static $queryFactory, $pdo;
    private $results;
    private $category;

    public function __construct(QueryFactory $queryFactory, PDO $pdo)
    {
        self::$queryFactory = $queryFactory;
        self::$pdo = $pdo;

        //get category
        $this->category();
        $this->getCategory();
    }

    public function category()
    {
        $select = self::$queryFactory->newSelect();
        $select
            ->cols (['*'])
            ->from('category');

        $sth = self::$pdo->prepare($select->getStatement());
        $sth->execute();
        $this->category = $sth->fetchAll(PDO::FETCH_ASSOC);     
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getCategory()
    {
        return $this->category;
    }


    public function getById($table, $id)
    {
        $select = self::$queryFactory->newSelect();
        $select
            ->cols (['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id) ;

        $sth = self::$pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $this->results = $sth->fetchAll(PDO::FETCH_ASSOC);
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

    public function getAllFromTableByCategory($table, $category)
    {
        $select = self::$queryFactory->newSelect();
        $select
            ->cols (['*'])
            ->from($table)
            ->where('category = :category')
            ->bindValue('category', $category) ;

        $sth = self::$pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $this->results = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}