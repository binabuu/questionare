<?php

class Bootstrap {
	
	public function __construct(){
		$url = isset($_GET['url']) ? $_GET['url'] : null ;

// to cut back slash infront of url
$url = rtrim($url, '/');


$url = explode('/' ,ucfirst($url));
//print_r($url);


if(empty($url[0]))
{
	require 'controller/Index.php';
	$controller = new Index();
	$controller->index();
	return false;
}

$file = 'controller/'.$url[0].'.php';
if (file_exists($file)){
	require $file;
	
}else{
	require 'controller/Errors.php';
	$controller = new Errors();
	$controller->index();
	return false;
}

$controller = new $url[0]();
$controller->loadModel($url[0]);

if(isset($url[2]))
{
	if(method_exists($controller,$url[1])){
		$controller->{$url[1]}($url[2]);
		//echo $url[2];
	}else {
		$this->error();
	}
	
}else{
	if(isset($url[1])){
		if(method_exists($controller,$url[1])){
			$controller->{$url[1]}();
		}else{
			$this->error();
		}
		
	}else{
		if(empty($url[1]))
		{
			$controller->index();
			return false;
		}
		//echo 'haimoooo';
		//$controller->index();
	}
}
	}
	
	function error(){
	require 'controller/Error.php';
	$controller = new Errors();
	$controller->index();
	return false;
}
	
	
	
}