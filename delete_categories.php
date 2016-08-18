<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>

<?php 
$current_categories = find_categories_by_id($_GET["categories"]);
if(!$current_categories){
redirect_to("main.php");
}

$id = $current_categories["id"];
$query = "DELETE FROM  categories WHERE id ={$id} LIMIT 1";
$result = mysql_query($query);

if($result && mysql_affected_rows()==1){
$_SESSION["message"]="categories deleted.";
redirect_to("main.php");
}
else{
$_SESSION["message"] = "categories deletion failed.";
redirect_to("main.php?fields={$id}");
}
?>