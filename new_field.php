<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php require_once("db_connection.php");?>
<?php confirm_logged_in();?>
<?php $layout_context = "admin" ; ?>
<?php include("header.php");?>

<?php find_selected_categories(true); ?>


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
                 <div class="panel-heading"><h3 class="panel-title">Create Field</h3></div>
                      <div class="panel-body">
                             <?php  echo message(); ?>
                             <?php $errors = errors(); ?>
                             <?php echo form_errors($errors); ?>
                    	<h3>Create Field</h3>
                            <form action="create_field.php" method="post" class="col-lg-6">
                                <div class="form-group ">
                                    <label>Menu Name</label>
                                        <input type="text" class="form-control" name="menu_name" value="" />
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                        <select name="position" class="form-control">
                                        	<?php 
												$field_set = find_all_fields(false);
												$field_count=mysql_num_rows($field_set);
												for($count=1;$count<=($field_count+1); $count++){
												echo "<option value=\"{$count}\">{$count}</option>";
												}
											?>
                                        </select>
                                </div>
                                <div class="form-group">
                        	     <label>Visible</label>
                                        <p>
                                          <input type="radio" name="visible" value="0" />  No
                                          &nbsp;
                                          <input type="radio" name="visible" value="1" />  Yes
                                        </p>
                               </div><hr />
                                <button type="submit" name="submit" class="btn btn-success ">Create Subject</button>&nbsp;
                                <a href="main.php"><button type="button" class="btn btn-danger ">Cancel</button></a>
                             </form> 
                           
                      </div>  
             </div>    
        </div>
    </div> 
</div>
<?php include("footer.php");?>  