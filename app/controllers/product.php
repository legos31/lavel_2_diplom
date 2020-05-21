<?php
namespace App\Controllers;
use App\QueryBuilder;
use League\Plates\Engine;

class Product {
   private $templates, $queryBuilder;

   public function __construct (Engine $engine, QueryBuilder $queryBuilder)
   {
     $this->templates = $engine;
     $this->queryBuilder = $queryBuilder;
   }

   public function index()
   {
      // Render a template
      $this->queryBuilder->getAllFromTable('products');
      $result = $this->queryBuilder->getResults();
      echo $this->templates->render('products', ['name' => 'Product Number One']);
   }

}
