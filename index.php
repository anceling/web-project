<?php

header('Content-type: text/html; charset=utf-8');

ini_set('display_errors', 1);


require 'vendor/autoload.php';
//require 'handlers.php'



$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'show_index');

    $r->addRoute('GET', '/work', 'show_work_all');
    
    $r->addRoute('POST', '/work', 'show_work');

    $r->addRoute('GET', '/profile', 'show_profile');
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
	$twig = new Twig_Environment($loader, array());

return $twig;
}



function initdb(){
	
	$sql = mysqli_connect("localhost", "admincjiXjF7", "SspyVLYLh4Xb", "nationsjobb");
	
	$sql->set_charset("utf8");
	
	return $sql;
}




function show_index($vars){

	$twig = inittwig();

	echo $twig->render('index.html');

}

function show_work_all($vars){

	$twig = inittwig();
	$sql = initdb();
	
	
	//temp
	
	$natname = "";
	$cat = "";
	$render_array = [];
	$all = True;
	
	
	//Change to POST method already in router??
	
	
	if ($all){
		
		$result = $sql->query("SELECT * FROM shift");
		
		
		$i = 0;
		
		while ($row = $result->fetch_assoc()){
		
		$render_array[$i] = $row;
		
		$i = ++$i;
		
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

	echo $twig->render('work.html', array("jobs" => $render_array));

}



function show_work($vars){
	
	
	echo $_POST["nation"];
	echo $_POST["pos"];
	
	
	
	echo $vars;
	
	
	
	
	
	
}








function show_profile($vars){

	$twig = inittwig();

	echo $twig->render('profile.html');

}

?>
