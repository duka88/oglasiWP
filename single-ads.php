<?php 
 get_header();



if(have_posts()){
   while(have_posts()){
   	  the_post(); 

   	  $id = get_the_id();
      $categories = wp_get_post_terms( $id, 'add-category', array( 'orderby' => 'parent' ,'order' => 'ASC'));     
      ?>
<div class="single-add-wrap">
    <div class="single-add__header">
        <div class="single-add__img-wrap">
            <figure>
                <img src="<?php echo  get_the_post_thumbnail_url('','mm_prod_med'); ?>" alt="" class="single-add__img">
            </figure>
        </div>
        <div class="single-add__info">
            <div class="single-add__category">
                <?php foreach($categories as $category){  ?>
                <span class="
				    <?php if($category->parent === 0){
                     
				      echo 'single-add__category-name';

				     }else{
                    $taxID = $category->term_id;
				    echo 'single-add__subcategory-name';} 

				    ?>
				">
                    <a href="<?php echo get_term_link($category->term_id, 'add-category');  ?>">
                        <?php echo $category->name;  ?></a>
                </span>
                <?php } ?>
            </div>
            <div class="single-add__info-wrap">
                <div class="single-add__name">
                    <h1>
                        <?php echo  get_the_title(); ?>
                    </h1>
                </div>
                <div class="single-add__price">
                    <p class="price">
                        <?php echo  number_format(get_field('price'), 2); ?> <span class="curency">din</span></p>
                </div>
                <div class="single-add__state">
                    <p class="state">Novo</p>
                </div>
                <div class="single-add__location">
                    <p class="location">
                        <?php echo get_the_author_meta('city'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="user jsMenuScroll">
        <h2 class="user__name">
            Podaci Prodavca
        </h2>
        <div class="user__info">
            <div class="user_single-info">
                <span><b>name:</b> </span>
                <span>
                    <?php echo get_the_author(); ?></span>
            </div>
            <div class="user_single-info">
                <span><b>mejl:</b> </span>
                <span>
                    <?php echo get_the_author_meta('email'); ?></span>
            </div>
            <div class="user_single-info">
                <span><b>tel:</b> </span>
                <span>
                    <?php echo get_the_author_meta('phone'); ?></span>
            </div>
            <div class="user_single-info">
                <span><b>Mesto:</b> </span>
                <span>
                    <?php echo get_the_author_meta('city'); ?></span>
            </div>
            <div class="user_single-info">
                <a href="/<?php echo add_query_arg('adSeller',  get_the_author_meta('id'), 'user-products')?>">Sve od prodavca</a>
            </div>
        </div>
    </div>
    <div class="single-add__description">
        <p>
            <?php echo  get_field('description'); ?>
        </p>
    </div>
    <div class="single-add__releted-wrap">
        <h2>Slični Proizvodi:</h2>
        <div class="product__list-wrap">
            <div id="productList" class="product__list">
                <?php

                $ads = new WP_Query( array(
               'post_type' => 'ads',              
               'posts_per_page' => 4,               
               'tax_query' => array(
				        array(
				            'taxonomy' => 'add-category',
				            'terms'    => $taxID,
				            'field' => 'term_id',				           
				        ),
				    ) ,
                'orderby'  =>  'title',              
               'order'   => 'ASC' 
                    ) ); 
                       

             if( $ads->have_posts()){  
                 while($ads->have_posts()){
                  $ads->the_post();
                  $item = array();

                   ?>
                <div class="product__item jsProductItem">
                    <div class="product__body">
                        <a href="<?php echo get_the_permalink();   ?>">
                            <figure>
                                <img src="<?php echo get_the_post_thumbnail_url('','mm_prod_sm'); ?>
                                  " alt="">
                            </figure>
                        </a>
                    </div>
                    <div class="product__footer">
                        <a href="<?php echo get_the_permalink();   ?>">
                            <h3>
                                <?php echo get_the_title(); ?>
                            </h3>
                        </a>
                        <div class="price">
                            <?php echo  number_format(get_field('price'), 2); ?> din</div>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
    <?php 
     } }
get_footer();