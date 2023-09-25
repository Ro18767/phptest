<?php
$db = new PDO(
    "mysql:host=localhost;dbname=pv111;charset=UTF8", 
    "pv111_user", 
    "pv111_pass"
);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC) ;
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
$db->setAttribute(PDO::ATTR_PERSISTENT, true) ;

// виконання запиту
try {
$res = $db->query( "SELECT CURRENT_TIMESTAMP" ) ;
$row = $res->fetch() ;
print_r( $row ) ;
}
catch( PDOException $ex ) {
echo $ex->getMessage() ;
}
?>