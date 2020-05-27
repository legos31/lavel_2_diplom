<?php
namespace App\Controllers;
use App\Model\Product as ProductData;
use League\Plates\Engine;
use Delight\Auth\Auth;
use \Tamtamchik\SimpleFlash\Flash;

class Product {
   private $templates, $queryBuilder, $auth;

   public function __construct (Engine $engine, ProductData $db, Auth $auth, Flash $flash)
   {
     $this->templates = $engine;
     $this->db = $db;
     $this->auth = $auth;
     $this->flash = $flash;
   }

   public function index()
   {
      if ($this->auth->isLoggedIn()) {
         $this->db->getAllFromTable('products', false);
         $result = $this->db->getResults();
         // Render a template
         echo $this->templates->render('products', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
      } else {
         $this->db->getAllFromTable('products', true);
         $result = $this->db->getResults();
         // Render a template
         echo $this->templates->render('products', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
      }
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
         if (!empty($_POST)) {
            $otzyv = $_POST['otzyv'];
            $autorId = $this->auth->getUserId();
            $this->db->insert('reviews', ['text' => $otzyv, 'user_id' => $autorId, 'product_id' => $id]);
         }
         $this->db->getByIdWithReviews('products', $id);
         $result = $this->db->getResults();
         // Render a template
         echo $this->templates->render('product_view', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth]);
      }
   }

   public function editProduct($id)
   {
      $this->db->getById('products', $id);
      $result = $this->db->getResults();
      $oldImgPath = $result['0']['img'];
      if (!empty($_POST)) {
         if(!$id == null) {
            $pathForDB = 'uploads/'.$_FILES['img']['name'];
            $params = $_POST;
            $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
            if (!move_uploaded_file($_FILES['img']['tmp_name'], $path . $_FILES['img']['name'])) {
               switch ($_FILES['img']['error']) {
                  case 1:
                     $this->flash->error('Размер файла превышает ограничения');    
                  break;
                  case 2:
                     $this->flash->error('Размер файла превышает ограничения');      
                  break;
                  case 3:
                     $this->flash->error('Файл был загружен не полностью');        
                  break;
                  case 4:
                     $this->flash->error('Файл не был загружен');      
                  break;
               }     
            }

            $this->db->findCategoryByName($_POST['category']);
            $category =$this->db->getCategory();
            $params['category'] = $category['id'];
            $params['img'] = $pathForDB;
            if ($_POST['status']) {
               $params['status'] = 0;
            } else {
               $params['status'] = 1;
            }
            $this->db->updateTableById('products', $id, $params);
            $this->flash->success('Success edit');
            
         }
      }   
      if ($id == null) {
         $this->index();
      }else {
         $this->db->getById('products', $id);
         $result = $this->db->getResults();
         $this->db->category();
         // Render a template
         
         echo $this->templates->render('product_edit', ['results'=> $result, 'category'=>$this->db->getCategory(), 'auth'=>$this->auth, 'errors'=>$this->flash]);
      }
   }

   public function deleteProductbyId($id)
   {
      if ($id == null) {
         $this->index();
      } else {
         $this->db->deleteById('products', $id);
         $this->index();
      }
   }

   public function insertProduct()
   {
      if (!empty($_POST)) {
         $pathForDB = 'uploads/'.$_FILES['img']['name'];
         $params = $_POST;
         $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
         if (!move_uploaded_file($_FILES['img']['tmp_name'], $path . $_FILES['img']['name'])) {
            switch ($_FILES['img']['error']) {
               case 1:
                  $this->flash->error('Размер файла превышает ограничения');   
               break;
               case 2:
                  $this->flash->error('Размер файла превышает ограничения');     
               break;
               case 3:
                  $this->flash->error('Файл был загружен не полностью');        
               break;
               case 4:
                  $this->flash->error('Файл не был загружен');      
               break;
            }
         }
         
         $this->db->findCategoryByName($_POST['category']);
         $category =$this->db->getCategory();
         $params['category'] = $category['id'];
         $params['img'] = $pathForDB;
         if ($_POST['status']) {
            $params['status'] = 0;
         } else {
            $params['status'] = 1;
         }
         $params['user_id'] = $this->auth->getUserId();
         $this->db->insert('products', $params);
         header('Location: http://lavel2/');
      } else {
         echo $this->templates->render('product_insert', ['category'=>$this->db->getCategory(), 'auth'=>$this->auth, 'errors'=>$this->flash]);

      }

   }

}
