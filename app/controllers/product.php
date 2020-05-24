<?php
namespace App\Controllers;
use App\Model\Product as ProductData;
use League\Plates\Engine;
use Delight\Auth\Auth;

class Product {
   private $templates, $queryBuilder, $auth;

   public function __construct (Engine $engine, ProductData $db, Auth $auth)
   {
     $this->templates = $engine;
     $this->db = $db;
     $this->auth = $auth;
   }

   public function index()
   {
      $this->db->getAllFromTable('products');
      $result = $this->db->getResults();
      // Render a template
      echo $this->templates->render('products', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
   }

   public function byCategory($id = null)
   {
      if ($id == null) {
         $this->index();
      }else {
         $this->db->getAllFromTableByCategory('products', $id);
         $result = $this->db->getResults();
         // Render a template
         echo $this->templates->render('products', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);         
      }
   }

   public function viewProduct($id)
   {
      if ($id == null) {
         $this->index();
      }else {
         $this->db->getById('products', $id);
         $result = $this->db->getResults();
         // Render a template
         echo $this->templates->render('product', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
      }
   }

}
