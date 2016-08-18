<?php
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","contentmanager");

//===============CRAETE CONNECTION==================

$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
mysql_select_db("contentmanager") or die (mysql_error());

//===============TEST IF CONNECTION SUCCEEDED==================

if (mysqli_connect_error()) { 
die("ERROR: Could not connect: " . mysqli_connect_error(). "(". mysqli_connect_error(). ")" ); 
}
?>  