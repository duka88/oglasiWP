<?php
$id = (int) $_GET['adSeller'] ;
 get_header(); ?>
<div class="front-wrap">
    <h1>Svi proizvodi: <?php echo get_the_author_meta('display_name',$id ); ?></h1>
    <div class="product__list-wrap">
        <div id="productList" class="product__list">
            <?php

                $ads = new WP_Query( array(
               'post_type' => 'ads',              
               'posts_per_page' => 12,
               'author' => $id,
               'orderby'  => array( 'meta_value_num' => 'ASC', 'title' => 'ASC' ), 
                'meta_key'  => 'price',
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
        <?php if($ads->max_num_pages > 1) {?>
        <div id="loadMore" class="btn">
            UČITAJ VISE
            <div id="spiner" class="loader d-none"></div>
        </div>
        <?php } ?>
    </div>
</div>
<?php get_footer(); ?>