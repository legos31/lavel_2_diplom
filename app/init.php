<?php
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;

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
    }
]);
