<?php require_once("session.php");?>
<?php require_once("db_connection.php");?>
<?php require_once("functions.php");?>
<?php require_once("validation_function.php");?>

<?php 
$username = "";
if(isset($_POST['submit'])){

$required_fields = array("username", "password");
validate_presences($required_fields);

if(empty($errors)){

$username = $_POST["username"];
$password = $_POST["password"];

$found_admin = attempt_login($username, $password);

if($found_admin){
$_SESSION["admin_id"]= $found_admin["id"];
$_SESSION["username"]= $found_admin["username"];
$_SESSION["password"]= $found_admin["hashed_password"];
redirect_to("admin.php");
}
else{
$_SESSION["message"]="username/password not found.";
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
                 <div class="panel-heading"><h3 class="panel-title">Admin Login</h3></div>
                      <div class="panel-body">   
  
         <div class="panel panel-default panel-primary">
              <div class="panel-body"> 
  
                              <?php  echo message(); ?>
                              <?php echo form_errors($errors); ?>                            		
             
                     <form action="login.php" method="post"   >
                         <h3>Login</h3><hr style="margin-top: 2em; border-top: 1px solid #000000 ;" />
                               <label>Username</label>
                                 <div class="has-error has-feedback input-group">
                                 <span class="input-group-addon">
                                 	<span class="glyphicon glyphicon-user"></span>
                                 </span>
                                 <input type="text" class="form-control" name="username" placeholder="username..." 
                                 value="<?php echo htmlentities($username); ?>"  />
                                 
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
                                
                                <button type="submit" name="submit" class="btn btn-primary ">LOGIN</button>&nbsp;
                                
                      </form> 
                            </div>
                        </div>
                </div>
           </div>  
    </div>
</div>                 

<?php include("footer.php");?>

