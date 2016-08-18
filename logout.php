<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php 
$_SESSION["admin_id"] = null;
$_SESSION["username"] = null;
$_SESSION["password"] = null;
redirect_to("login.php");
?>  