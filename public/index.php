<?php 
require '../vendor/autoload.php';
require '../app/init.php';

$containerDI = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['\App\Controllers\Product', 'index']);
    
    $r->addRoute('GET', '/login', ['\App\Controllers\user','login']);
    $r->addRoute('POST', '/login', ['\App\Controllers\user','login']);
    
    $r->addRoute('GET', '/register', ['\App\Controllers\user','register']);
    $r->addRoute('POST', '/register', ['\App\Controllers\user','register']);

    $r->addRoute('GET', '/logout', ['\App\Controllers\user','logout']);
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/category/{id:\d+}', ['\App\Controllers\Product','byCategory']);
    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
    $r->addRoute('GET', '/product/{id:\d+}', ['\App\Controllers\Product','viewProduct']);
    
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $containerDI->call($handler, $vars);
        break;
    default:
        echo "no routing";
}