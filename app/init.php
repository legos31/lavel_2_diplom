<?php
if( !session_id() ) @session_start();

use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;
use Delight\Auth\Auth;
use Tamtamchik\SimpleFlash\Flash;

$builder = new DI\ContainerBuilder();
$builder->addDefinitions ([
   Engine::class => function () {
      return new Engine('../app/views');
  },
    PDO::class => function() {
        return new PDO('mysql:host=localhost;dbname=lavel2', 'root', '');
    },

    QueryFactory::class => function () {
       return new QueryFactory ('mysql');
    },

    Auth::class => function($builder) {
        return new Auth ($builder->get('PDO'));
    }
]);
