<?php


require 'vendor/autoload.php';


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache' => 'compilation_cache',
));




function showindex(){
	
	echo $twig->render('index.html');
	

	
	
}















?>
