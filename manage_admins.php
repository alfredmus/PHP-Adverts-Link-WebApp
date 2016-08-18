<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>
<?php confirm_logged_in();?>
<?php $admin_set = find_all_admins(); ?>
<?php $layout_context = "admin" ; ?>
<?php include("header.php");?>

<div class="container">
	<div class="row">
                 <div class="col-md-3">
                     <div class="main-bar panel panel-primary"> 
                         <div class="panel-heading"><h3 class="panel-title">Admin manager</h3></div>
                              <div class="panel-body">
                              <div class="panel panel-primary">
                                 <div class="panel-body">
                                 <h3><a href="admin.php">&laquo; Main Menu</a></h3>
                                 </div>
                                </div>
                            </div>
                    </div>
                 </div> 
                 
                 <div class="col-md-9">
                     <div class="main-bar panel panel-primary"> 
                         <div class="panel-heading"><h3 class="panel-title">Manage Admins</h3></div>
                              <div class="panel-body">
                              	<?php  echo message(); ?>
                                <h3>Admins Table</h3><hr />
                                
                                <div class="panel panel-primary">
                                 <div class="panel-body">
                                            
                                  <table class="well table table-bordered">
                                		<thead>
                                            <tr>
                                                <th style="text-align:left; width: 200px;">Username</th>
                                                <th colspan="2" style="text-align: left;">Actions</th>
                                            </tr>
                                        </thead>
                                          <?php while ($admin = mysql_fetch_assoc ($admin_set)) { ?>
                                   <tbody>       
                                    <tr>
                                            <td>
                                                  <?php echo htmlentities($admin["username"]); ?><br />
                                                  <?php //echo htmlentities($admin["hashed_password"]); ?>
                                            </td>
                                            <td> 
                                                  <a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">
                                                   <button class="btn btn-default"> Edit </button>
                                                  </a>
                                            </td>
                                             <td>
                                                 <a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" 
                                                 onclick="return confirm('Are you sure ?');"><button class="btn btn-default"> Delete  </button>
                                                 </a>
                                             </td>
                                    </tr>
                                    <?php } ?>
                                    <tbody>
                                    </table>
                                    <br/><hr />
                                   <a href="new_admin.php"><button class="btn btn-default">Add new Admin</button> </a>

                                            </div>
                                     </div>
                                </div>
                             </div>  
                        </div>
                 </div>  
         </div>
</div>
<?php include("footer.php");?>