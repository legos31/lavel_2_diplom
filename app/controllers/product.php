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
         echo $this->templates->render('product_view', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
      }
   }

   public function editProduct($id)
   {
      if (!empty($_POST)) {
         if(!$id == null) {
            $this->db->updateTableById('products', $id, $_POST);
            d($_POST);
         }
      }   
      if ($id == null) {
         $this->index();
      }else {
         $this->db->getById('products', $id);
         $result = $this->db->getResults();
         // Render a template
         echo $this->templates->render('product_edit', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
      }
   }

   public function deleteProductbyId($id)
   {
      if ($id == null) {
         $this->index();
      } else {
         $this->db->deleteById('products', $id);

      }
   }

   public function insertProduct()
   {
      echo $this->templates->render('product_insert', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
   }

}
