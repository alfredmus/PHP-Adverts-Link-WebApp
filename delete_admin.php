<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>

<?php 
$admin = find_admin_by_id($_GET["id"]);
if(!$admin){
redirect_to("manage_admins.php");
}

$id = $admin["id"];
$query = "DELETE FROM  admins WHERE id ={$id} LIMIT 1";
$result = mysql_query($query);

if($result && mysql_affected_rows()==1){
$_SESSION["message"]="Admin deleted.";
redirect_to("manage_admins.php");
}
else{
$_SESSION["message"] = "Admin deletion failed.";
redirect_to("manage_admins.php");
}
?>