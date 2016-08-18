<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>

<?php 
	$current_field = find_fields_by_id($_GET["fields"]);
	if(!$current_field){
	redirect_to("main.php");
	}
	$categories_set = find_categories_for_field($current_field["id"]);
	if(mysql_num_rows($categories_set) > 0){
	$_SESSION["message"] = "can't delete a field with categories.";
	redirect_to("main.php?fields={$current_field["id"]}");
	
	}
	
	$id = $current_field["id"];
	$query = "DELETE FROM  fields WHERE id ={$id} LIMIT 1";
	$result = mysql_query($query);
	
	if($result && mysql_affected_rows($connection)==1){
	$_SESSION["message"]="field deleted.";
	redirect_to("main.php");
	}
	else{
	$_SESSION["message"] = "field deletion failed.";
	redirect_to("main.php?fields={$id}");
	}
?>