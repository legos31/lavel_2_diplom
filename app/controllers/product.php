<?php
namespace App\Controllers;
use App\Model\Product as ProductData;
use League\Plates\Engine;

class Product {
   private $templates, $queryBuilder;

   public function __construct (Engine $engine, ProductData $db)
   {
     $this->templates = $engine;
     $this->db = $db;
   }

   public function index()
   {
      $this->db->getAllFromTable('products');
      $result = $this->db->getResults();
      // Render a template
      echo $this->templates->render('products', ['results'=> $result]);
   }

}
