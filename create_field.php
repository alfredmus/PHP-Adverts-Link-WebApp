<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("validation_function.php");?>

<?php 

	if(isset($_POST['submit'])){
	
	$menu_name=mysql_prep($_POST["menu_name"]);
	$position=(int)$_POST["position"];
	$visible=(int)$_POST["visible"];
	
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	
	if(!empty($errors)){
	$_SESSION["errors"] = $errors;
	redirect_to("new_field.php");
	}
	
	$query ="INSERT INTO fields (menu_name,position,visible) VALUES ('{$menu_name}',{$position},{$visible})";
    $result =mysql_query($query);
	
	if($result){
	$_SESSION["message"]="field created.";
	redirect_to("main.php");
	}
	else{
	$_SESSION["message"]="field creation failed.";
	redirect_to("new_field.php");
	}
	}
	else{
	redirect_to("new_field.php");
	}

?>








<?php 
if(isset($connection)){
mysql_close($connection);
}
?>