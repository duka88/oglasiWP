<?php 
  add_action('rest_api_init', 'add_ad');

  function add_ad(){
	  
	 register_rest_route( 'add_ad', 'ad', array( 
	      'methods' => 'POST',
	      'callback' => 'add_ad_adFn'
	   ));
	}

   function add_ad_adFn($data){

       if(empty(validator($data, $_FILES["picture"]))){	

		   $post_data = array(
	        'post_author'  => $data['user_id'],     
	        'post_title'   => $data['name'],      
	        'post_type'    => 'ads',
	        'post_status'  => 'publish',
	     
	      );
          $post_id = wp_insert_post($post_data);
          
         
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
	   	  return validator($data, $_FILES["picture"]);
	   }
	}

	function getPostinfo($post_id){

         $post = array();
        

         $post['id'] = $post_id;
         $post['name'] = get_the_title($post_id);
         $post['link'] = get_the_permalink($post_id);
         $post['img'] = get_the_post_thumbnail_url($post_id ,'mm_prod_sm');
         $post['price'] = number_format(get_field('price', $post_id), 2);

         return $post;


	}

	function saveImage($image, $post_id){
		
		
		$wordpress_upload_dir = wp_upload_dir();		
		 
		$profilepicture = $image;
	
		$new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
		$new_file_mime = mime_content_type( $profilepicture['tmp_name'] );		 
	
		if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
		 
		 
			$upload_id = wp_insert_attachment( array(
				'guid'           => $new_file_path, 
				'post_mime_type' => $new_file_mime,
				'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			), $new_file_path );
		 
		
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
		 
			
		    $attach_id = wp_generate_attachment_metadata( $upload_id, $new_file_path );
		    wp_update_attachment_metadata( $upload_id, $attach_id );
		
			set_post_thumbnail( $post_id , $upload_id);
		}
	}
   
   function validator($data, $file , $edit = false){
      
    	$errors = array();
        
        if(!$data['name']){
        	$errors['name'] = 'name is required';
        }
          if(!$data['price']){
        	$errors['price'] = 'price is required';
        }
          if(!$data['condition']){
        	$errors['condition'] = 'condition is required';
        }         
        if(!$file['name'] && !$edit){
        	$errors['image'] = 'image is required';
        } 

        if(empty($errors)){

        	$errors = array();

        }else{
            $errors['error'] = true;  
        }

        return $errors;
            
   }

  add_action('rest_api_init', 'get_cat_ad');

  function get_cat_ad(){
	  
	 register_rest_route( 'get_cat', 'ad/(?P<cat>\d+)', array( 
	      'methods' => 'GET',
	      'callback' => 'get_cat_adFn'
	   ));
	}

    function get_cat_adFn($data){

        return get_terms('add-category', array('hide_empty' => false, 'parent' => $data['cat']));
    }
?>