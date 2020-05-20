<?php
namespace App\Controllers;

use League\Plates\Engine;

class Product {

   public function __construct ()
   {
      $templates = new Engine('../app/views/template');

      // Render a template
      echo $templates->render('product', ['name' => 'Product Number One']);
   }

}
