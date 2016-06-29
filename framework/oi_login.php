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
	
	$username = esc_sql($_REQUEST['log']);
	$pass = esc_sql($_REQUEST['pwd']);
	
	if(empty($username)) {
		$result['oi_error'] .= "<span class='oi_reigister_error'>".__( "User name should not be empty", "orangeidea" )."</span>";
	};
	if(empty($pass)) {
		$result['oi_error'] .= "<span class='oi_reigister_error'>".__( "Password should not be empty", "orangeidea" )."</span>";
	};
	
	
	
	
	if (empty($result['oi_error'])){
		//User Login
		$creds = array();  
		$creds['user_login'] = $username;  
		$creds['user_password'] = $pass;  
		$creds['remember'] = true; 
		$site_url =  home_url(); 
		$user = wp_signon( $creds, false ); 
		if ( is_wp_error($user) ){  
			$result['oi_error'] .= "<span class='oi_reigister_error'>".__( "Wrong User/Password combination", "orangeidea" )."</span>";
			$status_role = 'error';
		}else{
			$result['oi_modal_title'] = __( "Welcome Back", "orangeidea" )." <span class=colored>$username</span>";
			$result['oi_modal_body'] = "<a href='$site_url' class='btn oi_submit_success'".__( "Start Shopping", "orangeidea" )."</a>
			";
		}
	}
	
};
print json_encode($result)  ?>