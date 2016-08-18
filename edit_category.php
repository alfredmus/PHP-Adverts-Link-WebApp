<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>
<?php confirm_logged_in();?>
<?php require_once("validation_function.php");?>  
<?php find_selected_categories(true);?>

<?php 
if(!$current_categories){
redirect_to("main.php");
}
?>

<?php 
if(isset($_POST['submit'])){

$required_fields = array( "menu_name", "position", "visible", "content");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);
 
if(empty($errors)){
$id = $current_categories["id"];
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int)$_POST["position"];
$visible=(int)$_POST["visible"];
$content=mysql_prep($_POST["content"]);

$query ="UPDATE categories SET menu_name ='{$menu_name}', position={$position}, visible={$visible}, content='{$content}' WHERE id = {$id}  LIMIT 1";
$result =mysql_query($query);

if($result && mysql_affected_rows() >= 0){
$_SESSION["message"]="categories updated.";
redirect_to("main.php");
}
else{
$message = "categories update failed.";
}
}
}
else{
}

?>
<?php $layout_context = "admin" ; ?>
<?php include("header.php");?>
<!----===============SIDEBAR=================--------->

<div class="container">
	<div class="row">
    	<div class="col-md-3">
           <div class="side-bar panel panel-default panel-danger">
                         <div class="panel-heading"><h3 class="panel-title">Job Categories</h3></div>
                 <div class="panel-body">
                     
                     <?php echo navigation($current_field, $current_categories); ?> 
                     
                        <a href="new_field.php"><div  class="input-group"><button class="btn btn-primary pull-right">ADD LINKS</button></div></a>
                  </div>
             </div>
         </div>
         
    
<!----===============MAINBAR=================--------->
 
        <div class="col-md-9 ">
             <div class="main-bar panel panel-primary"> 
                 <div class="panel-heading"><h3 class="panel-title">Edit Field</h3></div>
                      <div class="panel-body">
                            <?php  if(!empty($message)){echo "<div class=\"message\">".htmlentities($message)."</div>";} ?>
                             <?php echo form_errors($errors); ?>
                    	<h3>Edit Field</h3>
                <form action="edit_category.php?categories=<?php echo urlencode($current_categories["id"]); ?>" method="post" class="col-lg-6">
                                <div class="form-group ">
                                    <label>Menu Name</label>
                <input type="text" class="form-control" name="menu_name" value="<?php echo htmlentities($current_categories["menu_name"]); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                        <select name="position" class="form-control">
                                        	<?php 
												$categories_set = find_categories_for_field($current_categories["field_id"],false);
												$categories_count=mysql_num_rows($categories_set);
												for($count=1;$count<=($categories_count); $count++){
												echo "<option value=\"{$count}\"";
												if($current_categories["position"] == $count){
												echo " selected";
												}
												echo ">{$count}</option>";
												}
												
											?>
                                        </select>
                                </div>
                <div class="form-group">
                 <label>Visible</label>
                        <p>
                          <input type="radio" name="visible" value="0" <?php if($current_categories["visible"] == 0){ echo "checked";} ?> />  No
                          &nbsp;
                          <input type="radio" name="visible" value="1" <?php if($current_categories["visible"] == 1){ echo "checked";} ?> />  Yes
                        </p>
               </div>
                               <div class="form-group">
                        	     <label>Contents</label>
                         <textarea class="form-control" name="content" ><?php echo htmlentities($current_categories["content"]); ?></textarea>
                               </div><hr />
                                <button type="submit" name="submit" value="edit subject" class="btn btn-success ">Edit categories</button>&nbsp;
                                <a href="main.php?categories=<?php echo urlencode($current_categories["id"]); ?>">
                                <button type="button" class="btn btn-warning ">Cancel</button></a>
                                &nbsp;
                                <a href="delete_categories.php?categories=<?php echo urlencode($current_categories["id"]); ?>" onclick="return                        confirm('are you sure you want to delete');"><button type="button" class="btn btn-danger ">Delete Categories</button></a>
                             </form> 
                           
                      </div>  
             </div>    
        </div>
    </div> 
</div>
<?php include("footer.php");?>  