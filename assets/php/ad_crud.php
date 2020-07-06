<?php 
  add_action('rest_api_init', 'add_ad');

  function add_ad(){
	  
	  register_rest_route( 'add_ad', 'ad', array( 
	      'methods' => 'POST',
	      'callback' => 'add_ad_adFn'
	   ));
	}

   function add_ad_adFn($data){

		
	   
	   return  $data['name'];

	  if ( is_wp_error($result) ){
             return ['status' => 'error', 'message' => $result->get_error_message()];
         }else{
         	 return  true;
         }    
		

	}
