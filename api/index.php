<?php
///header('Content-Type: text/html; charset=UTF-8');
session_start();  
$path =  dirname(__FILE__) ;
require $path .'/rb.php';  
R::setup('mysql:host=localhost;dbname=abdulwakeel','root','');
//     R::debug( TRUE );
require $path .'/Slim/Slim.php'; 
require $path .'/classes/Posts.php';
$app = new Slim();  
$objPosts = new Posts($app);
$app->run();

?>