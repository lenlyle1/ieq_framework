<?php

//use App\Lib\Utils\Template;
use Lib\Debug\Debugger;
Debugger::debug('loading routes!');
$router = new AltoRouter();

$routeFiles = scandir(SITE_ROOT . '/App/Router/Routes');

foreach($routeFiles as $file) {
    if(strstr($file, '.php')){
        require_once(SITE_ROOT . '/App/Router/Routes/' . $file);
    }
}


$match = $router->match();

if ($match === false) {
    // output 404
    $smarty->display('404/404.tpl');
} else {
    list( $controller, $action ) = explode( '#', $match['target'] );
    if ( is_callable(array('Controllers\\' . $controller, $action)) ) {
        $template = call_user_func_array(array('Controllers\\' . $controller,$action), array($match['params']));
        if($template){
            $smarty->display($template . '.tpl');
        }
    } else {
        echo 'Controller Error: ' . $controller.'#' . $action;
        // here your routes are wrong.
        // Throw an exception in debug, send a  500 error in production
    }
}
