<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("validation_function.php");?>
<?php confirm_logged_in();?>
<?php find_selected_categories(true); ?>

<?php 
	if(!$current_field){
	redirect_to("main.php");
	}
?> 

<?php 
	if(isset($_POST['submit'])){
	
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	 
	if(empty($errors)){
	$id = $current_field["id"];
	$menu_name=mysql_prep($_POST["menu_name"]);
	$position=(int)$_POST["position"];
	$visible=(int)$_POST["visible"];
	
	$query ="UPDATE fields SET menu_name = '{$menu_name}',position={$position},visible={$visible} WHERE id ={$id} ";
	$result =mysql_query($query);
	
	if($result && mysql_affected_rows($query) >=0){
	$_SESSION["message"]="field updated.";
	redirect_to("main.php");
	}
	else{
	$message = "field update failed.";
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
                            <form action="edit_field.php?fields=<?php echo urlencode($current_field["id"]); ?>" method="post" class="col-lg-6">
                                <div class="form-group ">
                                    <label>Menu Name</label>
                     <input type="text" class="form-control" name="menu_name" value="<?php echo htmlentities($current_field["menu_name"]); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                        <select name="position" class="form-control">
                                        	<?php 
												$field_set = find_all_fields(false);
												$field_count=mysql_num_rows($field_set);
												for($count=1;$count<=($field_count); $count++){
												echo "<option value=\"{$count}\"";
												if($current_field["position"] == $count){
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
                              <input type="radio" name="visible" value="0" <?php if($current_field["visible"] == 0){ echo "checked";} ?>  />  No
                              &nbsp;
                              <input type="radio" name="visible" value="1" <?php if($current_field["visible"] == 1){ echo "checked";} ?>  />  Yes
                            </p>
                               </div><hr />
                                <button type="submit" name="submit" value="edit subject" class="btn btn-success ">Edit Subject</button>&nbsp;
                                <a href="main.php"><button type="button" class="btn btn-warning ">Cancel</button></a>&nbsp;
                                <a href="delete_field.php?fields=<?php echo urlencode($current_field["id"]); ?>" onclick="return                            confirm('are you sure you want to delete');"><button type="button" class="btn btn-danger ">Delete Field</button></a>
                             </form> 
                           
                      </div>  
             </div>    
        </div>
    </div> 
</div>
<?php include("footer.php");?>  