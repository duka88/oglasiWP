<?php 
  add_action('rest_api_init', 'delete_ad');

  function delete_ad(){
	  
	 register_rest_route( 'delete_ad', 'ad/(?P<ad>\d+)', array( 
	      'methods' => 'POST',
	      'callback' => 'delete_ad_adFn'
	   ));
	}

   function delete_ad_adFn($data){

       wp_delete_post($data['ad']);

   }

 ?>