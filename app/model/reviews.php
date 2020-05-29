<?php
namespace App\model;
use Aura\SqlQuery\QueryFactory;
use Exception;
use PDO;
use \Tamtamchik\SimpleFlash\Flash;

class Reviews {

    private static $queryFactory, $pdo;
    private $results;
    private $category;
    private $flash;

    public function __construct(QueryFactory $queryFactory, PDO $pdo, Flash $flash)
    {
        self::$queryFactory = $queryFactory;
        self::$pdo = $pdo;
        $this->flash = $flash;
    }

    public function getResults()    
    {
        return $this->results;
    }

    public function getById($table, $id)
    {
        $select = self::$queryFactory->newSelect();
        $select
            ->cols (['*'])
            ->from( $table.' AS r')
            ->join(
                'INNER',             // the join-type
                'products AS p',        // join to this table ...
                'p.id = r.product_id' // ... ON these conditions
            )
            ->join(
                'INNER',             // the join-type
                'users AS u',        // join to this table ...
                'u.id = r.user_id' // ... ON these conditions
            )
            ->where('id_rev = :id')
            ->bindValue('id', $id);

        $sth = self::$pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $this->results = $sth->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function updateTableById($id, $params)
    {
        $update = self::$queryFactory->newUpdate();

        $update
            ->table('reviews')                  // update this table
            ->cols($params)
            ->where('id_rev = :id')           // AND WHERE these conditions
            ->bindValue('id', $id);   // bind one value to a placeholder

        $sth = self::$pdo->prepare($update->getStatement());

        // execute with bound values
        $sth->execute($update->getBindValues());  
    }

    public function deleteById($id)
    {
        $delete = self::$queryFactory->newDelete();

        $delete
            ->from('reviews')                   // FROM this table
            ->where('id_rev = :id')           // AND WHERE these conditions
            ->bindValue('id', $id);   // bind one value to a placeholder
        // prepare the statement
        $sth = self::$pdo->prepare($delete->getStatement());

        // execute with bound values
        $sth->execute($delete->getBindValues()); 
    }
}