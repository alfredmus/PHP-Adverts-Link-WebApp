<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>
<?php confirm_logged_in();?>
<?php require_once("validation_function.php");?>

<?php 
		if(isset($_POST['submit'])){
		
		$required_fields = array("username", "password");
		validate_presences($required_fields);
		
		$fields_with_max_lengths = array("username" => 30);
		validate_max_lengths($fields_with_max_lengths);
		
		if(empty($errors)){
		
		$username = mysql_prep($_POST["username"]);
		$hashed_password = $_POST["password"];
		
		$query ="INSERT INTO admins (username, hashed_password) VALUES ('{$username}', '{$hashed_password}') ";
		$result =mysql_query($query);
		
		if($result){
		$_SESSION["message"]="Admin created.";
		redirect_to("manage_admins.php");
		}
		else{
		$_SESSION["message"]="Admin creation failed.";
		}
		}
		}
		else{
		//redirect_to("new_admin.php");
		}

?>

<?php $layout_context = "admin" ; ?>
<?php include("header.php");?>

<div class="container col-lg-6 login">
	<div class="row">
             <div class="main-bar panel panel-primary"> 
                 <div class="panel-heading"><h3 class="panel-title">New Admin</h3></div>
                      <div class="panel-body">  
                      
                      <div class="panel panel-default panel-primary">
                        <div class="panel-body">  
                              
                              <?php  echo message(); ?>
                              <?php echo form_errors($errors); ?>          		
             
                     <form action="new_admin.php" method="post" >
                         <h3>Create Admin</h3><hr style="margin-top: 2em; border-top: 1px solid #000000 ;" />
                               <label>Username</label>
                                 <div class="has-error has-feedback input-group">
                                 <span class="input-group-addon">
                                 	<span class="glyphicon glyphicon-user"></span>
                                 </span>
                                 <input type="text" class="form-control" name="username" placeholder="username..." />
                                 
                                 </div>
                                 
                           <br/><br/>
                              
                           <label>Password</label>
                                <div class="has-success has-feedback input-group">
                                    <span class="input-group-addon">
                                    	<span class="glyphicon glyphicon-star"></span>
                                    </span>
                                    <input type="password" class="form-control" name="password" placeholder="Password..."/>
                                    
                                </div>
                                
                                <br/><br/>
                                
                                <button type="submit" name="submit" class="btn btn-success ">Create Admin</button>&nbsp;
                                <a href="manage_admins.php"><button type="button" class="btn btn-success "> Cancel </button></a>  
                      </form> 
                         </div>
                       </div> 
                </div>
           </div>  
    </div>
</div>                 

<?php include("footer.php");?>

