<?php

//echo "hellow";
//library
require 'config/constant.php';
require 'config/paths.php';
//require 'fpdf/fpdf.php';

// use autoloader
spl_autoload_register(function ($class) {
	require LIBS.$class.'.php';
});

$app = new Bootstrap();




?>
