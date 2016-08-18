<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php require_once("db_connection.php");?>
<?php $layout_context = "public" ; ?>
<?php include("pheader.php");?>

<?php find_selected_categories(); ?>

<!----===============SIDEBAR=================--------->

<div class="container">
	<div class="row">
    	<div class="col-md-3">
           <div class="side-bar panel panel-default panel-danger">
                         <div class="panel-heading"><h3 class="panel-title">Job Categories</h3></div>
                 <div class="panel-body">
                     
                        <?php echo public_navigation($current_field, $current_categories); ?>                     
                  </div>
             </div>
         </div>
         
    
<!----===============MAINBAR=================--------->
 
        <div class="col-md-9 ">
             <div class="main-bar panel panel-primary"> 
                 <div class="panel-heading"><h3 class="panel-title">Job Description</h3></div>
                      <div class="panel-body">
                            
                            
                                  <div >
                                     <div class="panel panel-success">
                                        <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $current_field ["menu_name"] ; ?></h3>
                                        </div>
                                            <div class="panel-body">
                                                <p>
                                                  <div class="list-group-item">
                                                     <div class="list-group-item-text">
                                                     <?php if($current_field){ ?>
                                                        <?php 
                                                        $categories_set = find_categories_for_field($current_field["id"]);
														while($categories = mysql_fetch_assoc($categories_set)){
                                                        $categories_id = $categories["id"];
														echo "<a href=\"public.php?categories = {$categories_id}\">";
                                                        echo "<h5>";
														echo htmlentities ($categories["menu_name"]);
														echo "</h5>";
														echo "<br/>";
														echo nl2br(htmlentities( $categories["content"] ));
                                                        echo "</a>";
                                                       
														echo "<hr/>";
                                                        }
                                                         ?>
                                                        
                                                     </div>
                                                 </div>
                                                                                               
                                                <?php } elseif ($current_categories) {?>
                                                
                                                <div class="view-content">
                                                <?php echo nl2br(htmlentities( $current_categories["content"] )); ?>
                                                </div>
                                                
                                                
                                                                                                      
                                                <?php } else { ?>
                                               
                                                   Please select a field
                                                   
                                                <?php } ?>
                                                </p>
                                                
                                            </div>
                                     </div>
                                  </div>                          
 
                      </div>
             </div>    
              <?php include("pagination.php");?> 
        </div>
    </div> 
</div>
<?php include("footer.php");?>  