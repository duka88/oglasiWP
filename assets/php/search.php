<?php 
 add_action('rest_api_init', 'ad_search');
  
function ad_search(){
  
  register_rest_route( 'get', '/ad_search/(?P<s>[a-zA-Z0-9_ ]+)', array( 
      'methods' => 'GET',
      'callback' => 'ad_search_fn'
   ));
}

function ad_search_fn($data){

 
  $args = array(
        'post_type' => 'ads',    
        's' => html_entity_decode($data['s' ]),           
       );

  

      $search = new WP_Query( $args );

      $ads = array();
      $items = array();
    
     
      if($search->have_posts()){
        while($search->have_posts()){
            $search->the_post();
            
            $item = array();
            
            $item['title'] = get_the_title();                       
            $item['url'] = get_the_permalink();      
            $item['price'] = number_format(get_field('price'), 2);  
          
              
            array_push( $items, $item);
        }
      }
    $ads['posts'] = $items;  
  


    return  $ads;

}
?>