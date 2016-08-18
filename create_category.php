<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>
<?php require_once("validation_function.php");?>
<?php find_selected_categories(); ?>

<?php 
if(!$current_field){
redirect_to("main.php");
}
?>

<?php 
if(isset($_POST['submit'])){
$field_id=$current_field["id"]; 
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int)$_POST["position"];
$visible=(int)$_POST["visible"];
$content=mysql_prep($_POST["content"]);

$required_fields = array("menu_name", "position", "visible", "content");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);

if(!empty($errors)){
$_SESSION["errors"] = $errors;
redirect_to("new_categories.php");
}

$query ="INSERT INTO categories (field_id,menu_name,position,visible,content) VALUES ({$field_id}, '{$menu_name}', {$position}, {$visible},  '{$content}') ";
$result =mysql_query($query);

if($result){
$_SESSION["message"]="categories created.";
redirect_to("main.php");
}
else{
$_SESSION["message"]="categories creation failed.";
redirect_to("main.php");
}
}
else{
//redirect_to("new_categories.php");
}

?>

<?php 
if(isset($connection)){
mysql_close($connection);
}
?>