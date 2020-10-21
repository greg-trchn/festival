<?php
session_start();
// session_destroy();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
require(__DIR__.'/src/controller/Home.php');
require(__DIR__.'/src/controller/Connexion.php');
require(__DIR__.'/src/controller/Register.php');
require(__DIR__.'/src/controller/Cart.php');
require(__DIR__.'/src/controller/Ordered.php');
require(__DIR__.'/src/controller/Purchases.php');
require(__DIR__.'/src/model/Model.php');
require(__DIR__.'/src/service/ErrorService.php');

$content = json_decode(file_get_contents(__DIR__ . '/config/env.json'));
define('ENV',           $content->env);
define('DOMAIN_SITE',   $content->domain_site);
define('BASE_URL',      $content->base_url);
define('ROOT_HTTP',     DOMAIN_SITE . BASE_URL);

if (ENV == 'prod') {
    ini_set('display_errors', 0);
    set_error_handler([new ErrorService(), "log"]);
    register_shutdown_function([new ErrorService(), "shutdown"]);
}

//$page = filter_input(INPUT_GET, "page");
$page = $_SERVER['REDIRECT_URL'];

$route = array(
//    "" => Home::class,
//    "test/([0-9]{1,5})" => Cart::class,
    "connexion" => Connexion::class,
    "deconnexion" => Connexion::class,
    "register" => Register::class,
    "cart" => Cart::class,
    "ordered" => Ordered::class,
    "purchases" => Purchases::class
);

//var_dump(preg_match('#^/m2i/festival/test/([0-9]{1,5})$#', $page, $match));
//array_shift($match);
//var_dump($match);
//show(...$match);//splat operator

foreach ($route as $routeValue => $className) {
    if(preg_match('#^' . BASE_URL . $routeValue.'$#', $page, $match)) {
        array_shift($match);
//        var_dump($match);
//        var_dump($page);
        $controller = new $className;
        $controller->manage(...$match);
        break;
    }
}

//foreach ($route as $routeValue => $className) {
//    if ($page === $routeValue) {
//        $controller = new $className;
//        $controller->manage();
//        break;
//    }
//}

if (!isset($controller)) {
    $controller = new Home();
    $controller->manage();
}


