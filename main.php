<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php require_once("db_connection.php");?>
<?php confirm_logged_in();?>
<?php $layout_context = "admin" ; ?>
<?php include("header.php");?>

<?php find_selected_categories(); ?>


<!----===============SIDEBAR=================--------->

<div class="container">
	<div class="row">
    	<div class="col-md-3">
           <div class="side-bar panel panel-default panel-danger">
                         <div class="panel-heading"><h3 class="panel-title">Job Categories</h3></div>
                 <div class="panel-body">
                     <h3><a href="admin.php">&laquo; Main Menu</a></h3>
                        <?php echo navigation($current_field, $current_categories); ?>                     
                	  
                         <a href="new_field.php"><div class="input-group"><button class="btn btn-primary pull-right">ADD LINKS</button></div></a>
                  </div>
             </div>
         </div>
         
    
<!----===============MAINBAR=================--------->
 
        <div class="col-md-9 ">
             <div class="main-bar panel panel-primary"> 
                 <div class="panel-heading"><h3 class="panel-title">Job Description</h3></div>
                      <div class="panel-body">
                            
                            
                                  
                                     <div class="panel panel-success">
                                        <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $current_field ["menu_name"] ; ?></h3>
                                        </div>
                                            <div class="panel-body">
                                                <p>
                                                <?php if($current_field){ ?>
                                                Position: <?php echo $current_field ["position"] ; ?><br />
                                                Visible: <?php echo $current_field ["visible"] == 1 ? 'yes' : 'no'  ; ?>
                                                
                                                <hr />
                                                      <a href="edit_field.php?fields=<?php echo urlencode($current_field["id"]); ?>">
                                                      <div class="input-group"><button class="btn btn-success">EDIT FIELD</button></div>
                                                      </a><hr />
                                                  
                                                  <h3> Pages in this subject: </h3>
                                                  <ul>
														<?php 
                                                        $categories_set = find_categories_for_field($current_field["id"]);
                                                        while($categories = mysql_fetch_assoc($categories_set)){
                                                        echo "<li>";
                                                        $categories_id = $categories["id"];
                                                        echo "<a href=\"main.php?categories = {$categories_id}\">";
                                                        echo htmlentities ($categories["menu_name"]);
                                                        echo "</a>";
                                                        echo "</li>";
                                                        }
                                                         ?>
                                                  </ul><hr />
                                    <a href="new_categories.php?fields=<?php echo urlencode($current_field["id"]); ?>"><div class="input-group">
                                    <button class="btn btn-success pull-right">Add Categories</button></div>
                                    </a>
                                                  
                                                <?php } elseif ($current_categories) {?>
                                                Categories Name:<?php echo $current_categories ["menu_name"] ; ?><br />
                                                Position:<?php echo $current_categories["position"]; ?><br/>
                                                Visible:<?php echo $current_categories["visible"] == 1 ? 'yes' : 'no' ; ?><br/>
                                                <br/>
                                                Content:<br/>
                                                <div class="view-content">
                                                <?php echo nl2br(htmlentities( $current_categories["content"] )); ?>
                                                </div>
                                                
                                                <hr />
                                                      <a href="edit_category.php?categories=<?php echo urlencode($current_categories["id"]); ?>">
                                                      <div class="input-group"><button class="btn btn-success">EDIT CATEGORY</button></div>
                                                      </a>
                                                
                                                <?php } else { ?>
                                                <?php  echo message(); ?>
                                                   Please select a field
                                                   
                                                <?php } ?>
                                                </p>
                                                
                                            </div>
                                     </div>
                                                            
 
                      </div>
             </div>    
              <?php include("pagination.php");?> 
        </div>
    </div> 
</div>
<?php include("footer.php");?>  