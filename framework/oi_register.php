<?php	 		 		 		 		 		 	
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$absurll = $_REQUEST['absurl'];
if (!function_exists('__'))  
{require_once ($absurll."/wp-load.php");};

$tempurl = get_template_directory_uri();
$siteurl =  home_url();
$oi_modal_js= '';
$result = array('oi_error' => '');



$result = array('oi_modal_js' => $oi_modal_js ,'oi_modal_title' => 'No Header' ,'oi_modal_body'=>'No Content','oi_error' => '');

if (count($_POST)) {
	
	$username = esc_sql($_REQUEST['username']);
	$email = esc_sql($_REQUEST['email']);
	$pass = esc_sql($_REQUEST['pass']);
	$pass2 = esc_sql($_REQUEST['pass2']);
	



	if(empty($username)) {
		$result['oi_error'] .= "<span class='oi_reigister_error'> ".__( "User name should not be empty", "orangeidea" )."</span>";
	}
	if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email) || empty($email)) {
		$result['oi_error'] .= "<span class='oi_reigister_error'> ".__( "Please enter a valid email", "orangeidea" )."</span>";
	}
	if(empty($pass) || strlen($pass) < 5) {
		$result['oi_error'] .= "<span class='oi_reigister_error'> ".__( "Password should have more than 5 symbols", "orangeidea" )."</span>";
	}
	
	if($pass != $pass2) {
		$result['oi_error'] .=  "<span class='oi_reigister_error'> ".__( "The passwords do not match", "orangeidea" )."</span>";
	}
	
	if ( !empty($username) && username_exists( $username )){
		$result['oi_error'] .= "<span class='oi_reigister_error'> ".__( "This user name is already registered", "orangeidea" )."</span>";
	}
	
	if($result['oi_error'] == "") {
		// Create Use
		$password = $pass;
		$username = $username;
		wp_create_user( $username, $password, $email );
		
		
		//User Login
		$creds = array();  
		$creds['user_login'] = $username;  
		$creds['user_password'] = $password;  
		$creds['remember'] = true;  
		$user = wp_signon( $creds, false );  
		
		// Mail to User
		$from = get_bloginfo('name');
		$site_url =  home_url();
		$from_email = get_bloginfo('admin_email');
		$headers = 'From: '.$from . " <". $from_email .">\r\n";
		$subject = "Registration successful";
		$msg = "<b><span style='font-size:16px'>Hello <span style='color:#f00'>$username</span></span></b><br><br>Thank you for registration, here your login details:<br><br><b>Username:</b> $username<br><b>Password:</b> $password<br>";
		wp_mail( $email, $subject, $msg, $headers );
		
		// Result Message
		$result['oi_modal_title'] = 'Thank you for registration!';
		$result['oi_modal_body'] = "<span class='success'>".__( "Your login details<br><br><strong>Login:</strong> $username <br><strong>Password:</strong> $password <br><br>We also sent it to email <strong>$email</strong>", "orangeidea" )."</span><br><br>
		<a href='$site_url' class='btn oi_submit_success'><span class='glyphicon glyphicon-shopping-cart'></span> ".__( "Start Shopping", "orangeidea" )."</a>";
	};
	
	
	
};
print json_encode($result)  ?>