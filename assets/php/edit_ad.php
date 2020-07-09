<?php 
  add_action('rest_api_init', 'get_ad');

  function get_ad(){
	  
	 register_rest_route( 'get_ad', 'ad/(?P<id>\d+)', array( 
	      'methods' => 'GET',
	      'callback' => 'get_ad_adFn'
	   ));
	}

   function get_ad_adFn($data){

   	    $post = array();
   	    $post['id'] =  $data['id']; 
   	    $post['img'] =  get_the_post_thumbnail_url( $data['id'],'mm_med'); 
   	    $post['link'] =  get_the_permalink($data['id']); 
   	    $post['name'] =  html_entity_decode (get_the_title($data['id'])); 
   	    $post['price'] =  get_field('price', $data['id']); 
   	    $post['description'] =  get_field('description', $data['id']); 
   	    $post['condition'] =  get_field('condition', $data['id']); 
   	    $categories = get_the_terms($data['id'], 'add-category');

       foreach($categories as $category){
     
        	if(!$category->parent){
        		$post['category'] = $category; 
        	}else{
        		$post['sub_category'] =  $category; 
        	}
        } 
   	  
   	   $post['sub_categories'] = get_terms('add-category', array('hide_empty' => false, 'parent' => $post['category']->term_id));




        return $post;
   }


  add_action('rest_api_init', 'edit_ad');

  function edit_ad(){
	  
	 register_rest_route( 'edit_ad', 'ad', array( 
	      'methods' => 'POST',
	      'callback' => 'edit_ad_adFn'
	   ));
	}

   function edit_ad_adFn($data){

   	  
   	   $image = (isset($_FILES["picture"])) ? $_FILES["picture"] : '';

	    if(empty(validator($data, $_FILES["picture"], true))){	
		         $post_data = array(
				      'ID'           => $data['ad_id'],
				      'post_title'   => $data['name']		     
				  );
				 

		         $post_id = wp_update_post($post_data);

		        if ( is_wp_error($post_id) ){
	             return ['status' => 'error', 'message' => $result->get_error_message()];
	         	}else{
	   
	            update_post_meta( $post_id, 'price', $data['price'] );
	            update_post_meta( $post_id, 'condition', $data['condition'] );
	           
	            if($_FILES["picture"]){
	            
	            	saveImage($_FILES["picture"], $post_id);
	            }
	           	if($data['description']){
	            	update_post_meta( $post_id, 'description', $data['description'] );
	            }
	            if($data['category']){
	            	wp_set_post_terms(  $post_id,  $data['category'] , 'add-category', true );	            
	            } 
	            if($data['sub_category']){
	            	wp_set_post_terms(  $post_id,  $data['sub_category'] , 'add-category', true );	            
	            } 


	        
	             return  getPostinfo($post_id);
	         }  

	      }else{
		   	  return validator($data, $_FILES["picture"], true);
		   }
   }

   ?>