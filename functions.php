
<?php
    function redirect_to($new_location){
	header("location:".$new_location);
	exit;
	}
	function mysql_prep($string){
	$escaped_string=mysql_real_escape_string($string);
	return $escaped_string;
	}
	function confirm_query($result_set){
	if(!$result_set){
	die("database query failed.");
	}
	}
	function find_all_fields($public=true){
	
		$query = "SELECT * ";
		$query .= "FROM fields "; 
		if ($public){
		$query .= "WHERE visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$field_set = mysql_query($query);
		confirm_query($field_set); 
		return $field_set; 
	}
	function find_categories_for_field($field_id, $public=true){
	
		$query = "SELECT * ";
		$query .= "FROM categories "; 
		$query .= "WHERE field_id = {$field_id} ";
		if($public){
		$query .= "AND visible = 1  ";
		}
		$query .= "ORDER BY position ASC";
		$categories_set = mysql_query($query);
		confirm_query($categories_set); 
		return $categories_set; 
	}
	function find_fields_by_id($fields_id){
	
	    $safe_fields_id = mysql_real_escape_string($fields_id);
		 
		$query = "SELECT * ";
		$query .= "FROM fields "; 
		$query .= "WHERE id = {$safe_fields_id} ";
		$query .= "LIMIT 1";
		$field_set = mysql_query($query);
		confirm_query($field_set);
		if ($field = mysql_fetch_assoc($field_set)){
		return $field; 
		}  
		else{
		return null;
		}
	}
		function find_categories_by_id($categories_id){
	
	    $safe_categories_id = mysql_real_escape_string($categories_id);
		 
		$query = "SELECT * ";
		$query .= "FROM categories "; 
		$query .= "WHERE id = {$safe_categories_id} ";
		$query .= "LIMIT 1";
		$categories_set = mysql_query($query);
		confirm_query($categories_set);
		if ($categories = mysql_fetch_assoc($categories_set)){
		return $categories; 
		}  
		else{
		return null;
		}
	}
	function find_default_categories_for_field($field_id){
		$categories_set = find_categories_for_field($field_id);
		if($first_category = mysql_fetch_assoc($categories_set)){ 
		return $first_category;
		}
		else{
		return null;
		}
		}
	function find_selected_categories($public=false){
	    global $current_field;
		global $current_categories;
	
		if(isset($_GET["fields"])){
		$current_field = find_fields_by_id($_GET["fields"],$public);
		if($current_field && $public){ 
		$current_categories = find_default_categories_for_field($current_field["id"]);
		}
		else{
		$current_categories = null;
		}
		}
		elseif(isset($_GET["categories"])){
		$current_field = null;
		$current_categories = find_categories_by_id($_GET["categories"],$public);
		}
		else{
		$current_field = null;
		$current_categories = null;
		}
		
	}
		function form_errors($errors=array()){
		$output="";
		if(!empty($errors)){
		$output .= "<div class=\"error\">";
		$output .= "please fix the following errors:";
		$output .= "<ul>";
		foreach ($errors as $key => $error){
		$output .= "<li>";
		$output .= htmlentities($error);
		$output .= "</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
		}
		return $output;
		}
		function navigation($field_id, $categories_id){
		$output="<div class=\"list-group\">";
		       $field_set = find_all_fields(false);   
					     while ($fields = mysql_fetch_assoc ($field_set)){ 
                            $output .="<div class=\"list-group-item\">";
                              $output .= "<h4 class=\"list-group-item-heading\">";
                               $output .= "<a href=\"main.php?fields=";
							   $output .=urlencode($fields["id"]);
                               $output .="\">";
							   $output .=$fields ["menu_name"];
                               $output .="</a>";
                               $output .="</h4>";
                                    
                             $categories_set = find_categories_for_field($fields["id"], false);
                             
                               $output .="<ul>";
							   $output .="<p class=\"list-group-item-text\">";
                                while ($categories = mysql_fetch_assoc ($categories_set)){ 
                                $output .="<li>";
								$output .="<a href=\"main.php?categories=";
								$output .=urlencode($categories["id"]);
								$output .="\">";
								   $output .= $categories ["menu_name"];
                                    $output .="</a>";
                                 $output .="</li>";
                                 } 
                                mysql_free_result($categories_set); 
                                $output .="</p>";
								$output .="</ul>";
                            $output .="</div>";
						 }   
                        mysql_free_result($field_set);
						  $output .="</div>";
						  return $output;
		}
				
				function public_navigation($field_id, $categories_id){
					$output="<div class=\"list-group\">";
						   $field_set = find_all_fields();   
					     while ($fields = mysql_fetch_assoc ($field_set)){ 
                            $output .="<div class=\"list-group-item\">";
                              $output .= "<h4 class=\"list-group-item-heading\">";
                               $output .= "<a href=\"public.php?fields=";
							   $output .=urlencode($fields["id"]);
                               $output .="\">";
							   $output .=$fields ["menu_name"]; 
                               $output .="</a>";
                               $output .="</h4>";
                                    
						if($field_id["id"] == $fields["id"] || $categories_id["field_id"] ==$fields["id"]){
                             $categories_set = find_categories_for_field($fields["id"]);
                             
                               $output .="<ul>";
							   $output .="<p class=\"list-group-item-text\">";
                                while ($categories = mysql_fetch_assoc ($categories_set)){ 
                                $output .="<li>";
								$output .="<a href=\"public.php?categories=";
								$output .=urlencode($categories["id"]);
								$output .="\">";
								   $output .= $categories ["menu_name"];
                                    $output .="</a>";
                                 $output .="</li>";
                                 } 
                                mysql_free_result($categories_set); 
								}
							$output .="</p>";
							$output .="</ul>";
                            $output .="</div>";
						 }   
                        mysql_free_result($field_set);
						  $output .="</div>";
						  return $output;
		}
		function find_all_admins(){
		$query = "SELECT * ";
		$query .= "FROM admins "; 
		$query .= "ORDER BY username ASC ";
		$admin_set = mysql_query($query);
		confirm_query($admin_set); 
		return $admin_set;
		}
		
		function find_admin_by_id($admin_id){
		$safe_admin_id = mysql_real_escape_string($admin_id);
		$query = "SELECT * FROM admins WHERE id = {$safe_admin_id} ";
		$admin_set = mysql_query($query);
		confirm_query($admin_set);
		if($admin = mysql_fetch_assoc($admin_set)){ 
		return $admin;
		}
		else{
		return null;
		}
		}
		function password_encrypt($password){
		$hash_format = "$2y$10$";
		$salt_length = 22;
		$salt = generate_salt($salt_length);
		$format_and_salt = $hash_format . $salt;
		$hash = crypt ($password, $format_and_salt);
		echo $hash;
		}
		function generate_salt($length){
		$unique_random_string = md5(uniqid(mt_rand(),true));
		$base64_string = base64_encode($unique_random_string);
		$modified_base64_string = str_replace('+', '.', $base64_string);
		$salt = substr($modified_base64_string , 0, $length);
		return $salt;
		}
		function password_check($password, $existing_hash){
		$hash = crypt($password , $existing_hash);
		if($hash === $existing_hash){
		return true;
		}
		else {
		return false;
		}
		}
		function find_admin_by_credentials($username, $password){
		$safe_username = mysql_real_escape_string($username);
		$safe_password = mysql_real_escape_string($password);
		$query = "SELECT * FROM admins WHERE username = '{$safe_username}' and hashed_password = '{$safe_password}' ";
		$admin_set = mysql_query($query);
		confirm_query($admin_set);
		if($admin = mysql_fetch_assoc($admin_set)){ 
		return $admin;
		}
		else{
		return null;
		}
		}
		function attempt_login($username, $password){
		$admin = find_admin_by_credentials($username, $password);
		if($admin){
		if ($username == $admin["username"] && $password == $admin["hashed_password"]){
		return $admin;
		}
		else {
		return false;
		}
		}
		else {
		return false;
		}
		}
		
		function logged_in(){
		return isset($_SESSION['admin_id']);
		}
		
		function confirm_logged_in(){
		if(!logged_in()){
		redirect_to("login.php");
		}
		}


?>