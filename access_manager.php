<?php

$root_dir = getcwd();

$db = new PDO(
    "mysql:host=localhost;dbname=pv111;charset=UTF8",
    "pv111_user",
    "pv111_pass"
);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_PERSISTENT, true);


$uri = $_SERVER[ 'REQUEST_URI' ] ;  // адреса запиту
$uri_parts = explode( '?', $uri );
$uri_path_only = $uri_parts[0];

// перевіряємо, чи запит є файлом (запит на файл)
$path = ".$uri" ;
if( $uri != '/' && is_readable( $path ) ) {
	// такий файл існує 
	// з деякими файлами можуть проблеми, якщо не зазначити Content-Type
	// зокрема, з CSS-файлами (стилями). Визначаємо тип (розширення) файлу
	$extension = pathinfo( $path, PATHINFO_EXTENSION ) ;
	// та з нього - Content-Type
	unset( $content_type ) ;
	switch( $extension ) {
		case 'css' : 
			$content_type = 'text/css' ; 
			break ;
		case 'jpg' : 
		case 'jpeg': 
			$content_type = "image/jpg" ; 
		case 'png' : 
			$content_type = "image/png" ; 
			break ; 
		case 'js'  : 
			$content_type = 'text/javascript' ; 
			break ;
	}
	if( isset( $content_type ) ) {
		header( "Content-Type: $content_type" ) ;
		readfile( $path ) ;  // передаємо файл у відповідь
	}
	else {
		http_response_code( 403 ) ;  // Forbidden - не дозволено
	}
	exit ;
}

$page_router = [  // масив у РНР створюється [] або array()
	'/index' => 'index.php',   // масиви - асоціативні (схожі на об'єкти JS)
	'/'      => 'index.php',
	'/about' => 'about.php',
	'/forms' => 'forms_controler.php',
	'/db' => 'lib/db.php',
];

$api_router = [
	'/forms' => 'forms_controler.php',
	'/auth' => 'auth_controller.php',
];

if( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset( $api_router[$uri_path_only] ) ) {
	include $api_router[$uri_path_only]; 
	// без шаблону - на файл
	exit;
}

if( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' &&   isset( $page_router[$uri_path_only] )) {  // робота з формами
	 // змінні локалізуються тільки у функціях, оголошена поза функцією змінна доступна скрізь, у т.ч. в іншому файлі
	$page = $page_router[$uri_path_only] ;
	include '_layout.php' ;  // перехід до інструкцій в іншому файлі 
	exit;
}

echo 'access manager - 404' ;
