<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php confirm_logged_in();?>
<?php $layout_context = "admin" ; ?>
<?php include("header.php");?>
<div class="container">
	<div class="row">
                     <div class="main-bar panel panel-primary"> 
                         <div class="panel-heading"><h3 class="panel-title">Admin Portal</h3></div>
                              <div class="panel-body">
                              
                              <div class="panel panel-default panel-warning">
                                                     <div class="panel-body">
                              
                              <h3>Welcome to admin area: <?php echo ucwords(htmlentities($_SESSION["username"])); ?>.</h3>
                              
                                <ul class="list-group admn" >
                                       <a href="main.php" class="list-group-item list-group-item-default">Manage Website Content</a>
                                       <a href="manage_admins.php" class="list-group-item list-group-item-default">Manage Admin Users</a>
                                       <a href="logout.php" class="list-group-item list-group-item-default">Logout</a>
                                </ul>

                           </div></div></div>
                    </div>
    </div>
</div>
<?php include("footer.php");?>