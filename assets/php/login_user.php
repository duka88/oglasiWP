<?php 
  add_action('rest_api_init', 'login_in_ad');

  function login_in_ad(){
	  
	  register_rest_route( 'login_in', 'ad', array( 
	      'methods' => 'POST',
	      'callback' => 'log_in_adFn'
	   ));
	}

   function log_in_adFn($data){

		$creds = array(
			'user_login'    => $data['email'],
            'user_password' => $data['password'],
		);
	   
	   $result = wp_signon($creds);

	   if ( is_wp_error($result) ){
             return ['status' => 'error', 'message' => $result->get_error_message()];
         }else{
         	 return  true;
         }    
		

	}


	add_action('rest_api_init', 'register_ad');

	 function register_ad(){
		  
		  register_rest_route( 'register', 'ad', array( 
		      'methods' => 'POST',
		      'callback' => 'register_adFn'
		   ));
		}

		function register_adFn($data){

		       
				$email    = $data['email'];
	            $password = $data['password'];
	            $username = $data['name'];

	            $creds = array(
					'user_login'    => $data['email'],
		            'user_password' => $data['password'],
				);
		

		   if ( !username_exists( $username ) ) {
				$user_id = wp_create_user( $username, $password, $email );
				$user = new WP_User( $user_id );

				if ( is_wp_error($user) ){
	             return ['status' => 'error', 'message' => $result->get_error_message()];
	            }else{
		         	$user->set_role( 'author');
		         	wp_signon($creds);

		         	return true;
		        }    
			

			}

		   
		 

		   
			

	}