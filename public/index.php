<?php 
require '../vendor/autoload.php';
use League\Plates\Engine;

$templates = new Engine('../app/views');

// Render a template
echo $templates->render('products', ['name' => 'Oleg']);