<?php 
if(!is_user_logged_in()) {

         wp_redirect(home_url()); 
       
         }

get_header(); ?>
<div class="profile-wrap">
    <h1>Vaši Oglasi</h1>
    <div id="showFormWrap" class="btn btn--ad-form">Dodaj Oglas</div>
    <div id="addFormWrap" class=" profile__add-wrap">
        <div class="profile__add-wrap-inner form_wrap--register">
            <form id="addAdForm" action="/" class="form">
                <h2>Dodaj oglas</h2>
                <div class="input w-100">
                    <label for="name">Ime Predmeta</label>
                    <input type="text" name="name" class="jsProdInput">
                    <div class="border-black"></div>
                    <div class="border-grey"></div>
                    <div class="form__errors d-none jsAdFormErrors">Ime je obavezano!</div>
                </div>
                <div class="input ">
                    <label for="name">Cena</label>
                    <input type="number" name="price" min="1" class="jsProdInput">
                    <div class="border-black"></div>
                    <div class="border-grey"></div>
                    <div class="form__errors d-none jsAdFormErrors">Cena je obavezna!</div>
                </div>
                <div class="input input--select">
                    <label for="name">Stanje predmeta</label>
                    <input type="radio" name="condition" value="new"><span>Novo</span>
                    <input type="radio" name="condition" value="used"><span>Polovno</span>                   
                </div>
                <div class="input input--select">
                    <label for="category">Kategorija</label>
                    <select id="category" name="category">
                        <?php $categories = get_terms('add-category', array('hide_empty' => false, 'parent' =>0));
          
                 foreach($categories as $category){ ?>
                        <option value="<?php echo $category->term_id; ?>">
                            <?php echo $category->name; ?>
                        </option>
                        <?php } ?>
                    </select>                    
                </div>
                <input id="adId" type="hidden" name="ad_id" value="">
                <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
                <div class="input d-none input--select">
                    <label for="sub_category">Pod Kategorija</label>
                    <select id="subCategory" name="sub_category">
                    </select>
                    
                </div>
                <div class="input input--img">
                    <label for="adPicture">
                        <figure>
                            <p>Dodaj Sliku</p>
                            <img id="imagePrew" src="" alt="" class="d-none">
                            <input id="adPicture" type="file" name="picture" class="d-none jsProdInput">
                            <span></span>
                        </figure>
                    </label>
                    <div class="form__errors d-none jsAdFormErrors">Slika je obavezna!</div>
                </div>
                <div class="input input--textarea ">
                    <label for="name">Opis</label>
                    <textarea name="description" id="" cols="30" rows="10" class="jsProdInput"></textarea>
                    <div class="border-black"></div>
                    <div class="border-grey"></div>
                    <div class="form__errors d-none jsAdFormErrors"></div>
                </div>
                <div id="buttons" class="btn-wrap">
                    <div id="addAd" class="btn">
                        Prosledi
                    </div>
                    <div id="editAd" class="btn d-none">
                        Prosledi
                    </div>
                </div>
                <div id="adFormSpiner" class="spiner-wrap d-none">
                    <div class="loader"></div>
                </div>
            </form>
        </div>
    </div>
    <?php $myAds = new WP_Query( array(
           'post_type' => 'ads',
           'author' => get_current_user_id(),
           'posts_per_page' => -1,
           'orderby' => 'date',
           'order' => 'DESC'     
    ) ); 
       
     
     
  

      ?>
    <div class="product__list-wrap">
        <div id="productList" class="product__list">
            <?php  if($myAds->have_posts()){
  
                 while($myAds->have_posts()){
                  $myAds->the_post();
                  $item = array();


                   ?>
            <div class="product__item jsProductItem">
                <div class="product__icon-wrap">
                    <span class="jsEditOpen" data-id="<?php echo get_the_id(); ?>">
                        <i class="far fa-edit"></i>
                    </span>
                    <span class="jsDeleteOpen" data-id="<?php echo get_the_id(); ?>">
                        <i class="fas fa-trash"></i>
                    </span>
                </div>
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
<?php include('templates/delete_popup.php') ?>
<?php get_footer(); ?>