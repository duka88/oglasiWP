<?php


  add_action('rest_api_init', 'filter_ad');

  function filter_ad(){
	  
	 register_rest_route( 'filter', 'ad', array( 
	      'methods' => 'POST',
	      'callback' => 'filter_adFn'
	   ));
	}

    function filter_adFn($data){
          
         $cat = 0; 
         $usersID = 0;
         $sort = array('title' => $data['name'] );

    	if(!empty( $data['cat'])){
    		$cat =  array(
			            'taxonomy' => 'add-category',			         
			            'terms'    => $data['cat'],
			        );
    	}
      
      if($data['city']){
         global $wpdb;
          $users = $wpdb->get_results( "SELECT DISTINCT user_id FROM wp_usermeta WHERE meta_key = 'city' AND meta_value ='".$data['city']."'", ARRAY_A);

          $usersID =  array_column($users, 'user_id');
      }

      if($data['price']){
         $sort = array( 'meta_value_num' =>  $data['price']);  
      }
    	
			   

    	$query = new WP_Query( array(
	           'post_type' => 'ads',	          
	           'posts_per_page' => 12,	
             'author__in' => $usersID,          
	           'tax_query' => array($cat),			       
	           'orderby'  =>  $sort, 
              'meta_key'  => 'price',
              'order'   => 'ASC',
              'paged' => $data['page']	     
				    ) ); 
    	$ads = array();
    	$posts = array();

    	if($query->have_posts()){  
             while($query->have_posts()){
                $query->the_post();
                $post = getPostinfo(get_the_id());
                 array_push($posts, $post);

            }}
    $ads['posts'] = $posts;   
		$ads['pages'] = $query->max_num_pages;		       
        
        return $ads;
    }

  ?>