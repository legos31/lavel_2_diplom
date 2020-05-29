<?php
namespace App\Controllers;
use League\Plates\Engine;
use Delight\Auth\Auth;
use \Tamtamchik\SimpleFlash\Flash;
Use App\Model\User;
Use App\Model\Reviews as ReviewsData;
use App\Controllers\Product;

class Reviews {
   private $templates, $queryBuilder, $auth, $user, $result, $product;

   public function __construct (Engine $engine, ReviewsData $db, Auth $auth, Flash $flash, User $user, Product $product)
   {
     $this->templates = $engine;
     $this->db = $db;
     $this->auth = $auth;
     $this->flash = $flash;
     $this->user = $user;
     $this->product = $product;
   }

   public function EditReviews($id)
   {
    if (!empty($_POST)) {

        $this->db->updateTableById($id, $_POST);
        $this->flash->success('Success edit');
    }   
    $this->db->getById('reviews', $id);
    $this->result = $this->db->getResults();
    d($this->result);
    echo $this->templates->render('reviews', ['results'=> $this->result, 'category'=>$this->product->getCategory(), 'auth'=>$this->auth,'errors' => $this->flash]);
   }

   public function delete($id)
   {
        if ($id <> null) {   
            $this->db->deleteById($id);
            header('Location: http://lavel2/');
        }
   echo $this->templates->render('reviews', ['results'=> $this->result, 'category'=>$this->product->getCategory(), 'auth'=>$this->auth,'errors' => $this->flash]);
    }
}