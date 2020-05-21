<?php
namespace App\Controllers;
use League\Plates\Engine;

class Product {

   public function __construct (Engine )
   {
     
   }

   public function index()
   {
       $templates = new Engine('../app/views');

      // Render a template
      echo $templates->render('products', ['name' => 'Product Number One']);
   }

}
