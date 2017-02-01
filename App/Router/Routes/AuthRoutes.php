<?php

$router->map( 'POST', '/user/login', 'AuthController#login' );
$router->map( 'GET',  '/user/logout', 'AuthController#logout' );
