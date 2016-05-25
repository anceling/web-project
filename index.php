<?php

ini_set('display_errors', 1);


require 'vendor/autoload.php';
//require 'handlers.php'



$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'showindex');

    $r->addRoute('GET', '/work', 'showwork');

    $r->addRoute('GET', '/profile', 'showprofile');
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
        // ... 404 Not Found
        echo "404";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo "405";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        call_user_func($handler, $vars);
        break;
}


function inittwig(){
	
	$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
	$twig = new Twig_Environment($loader, array(
		// Uncomment the line below to cache compiled templates
		// 'cache' => __DIR__.'/../cache',
	));

return $twig;
}



function initdb(){
	
	$sql = mysqli_connect("localhost", "admincjiXjF7", "SspyVLYLh4Xb", "nationsjobb");
	
	return $sql;
}




function showindex($vars){

	$twig = inittwig();

	echo $twig->render('index.html');

}

function showwork($vars){

	$twig = inittwig();
	$sql = initdb();
	
	
	//temp
	
	$natname = "";
	$cat = "";
	$all = True;
	
	
	if ($all){
		
		$result = $sql->query("SELECT * FROM shift");
		
		
		while ($row = $result->fetch_assoc()){
		
		
		echo $row["nation_name"];
		
		
	}
		
		
		$sql->close();
		
		
	}
	
	
	else {
	
	
	
	$stmt = $sql->stmt_init();
	
	$stmt->prepare("SELECT * FROM shift WHERE nation_name=? AND category=?");
	
	$stmt->bind_param("ss", $natname, $cat);
	
	$stmt->execute();
	
	$result = $stmt->get_result();
	
	while ($row = $result->fetch_assoc()){
		
		
		echo $row["nation_name"];
		
		
	}
	
	
	}

	echo $twig->render('work.html');

}

function showprofile($vars){

	$twig = inittwig();

	echo $twig->render('profile.html');

}

?>
