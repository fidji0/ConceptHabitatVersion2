<?php
session_start();
require "../vendor/autoload.php";

$router = new AltoRouter();

require "./param/route.php";

$match = $router->match();


if (is_array($match)) {
    
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    }else{
        $params = $match['params'];
        require "./template/{$match['target']}.php";
    }
    
}else{
    require "./template/404.php";
}

 // memo
 // $router->generate('contact');

?>


