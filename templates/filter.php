<?php $categories = get_terms('add-category', array('hide_empty' => true, 'parent' => 0));

$cities  = $wpdb->get_results( "SELECT DISTINCT meta_value FROM wp_usermeta WHERE meta_key = 'city'
");
?>
<div class="filter">
    <h3>Filter</h3>
    <div class="devider"></div>
    <h4>Kategorije</h4>
    <?php foreach ($categories as $category) { ?>
    <div class="filter__category-single ">
        <div class="filter__category-head">
            <div class="filter__category-container">
                <p class="filter__name">
                    <?php echo $category->name; ?>
                </p>
            </div>
        </div>
        <div class="filter__category-body">
            <?php  $sub_categories = get_terms('add-category', array('hide_empty' => true, 'parent' => $category->term_id));
           
            foreach ( $sub_categories as $sub_category) { ?>
            <div class="filter__single-child ">
                <div class="filter__category-container">
                    <div class="filter__check jsCheck" data-id="<?php echo  $sub_category->term_id; ?>">
                        <i class="fas fa-check d-none "></i>
                    </div>
                    <p class="filter__name">
                        <?php echo  $sub_category->name; ?>
                    </p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <h4>Gradovi</h4>
    <div class="filter__category-body">
        <div id="jsSelect"  class="select ">
            <div id="citySelect" class="mein-option">
               <span class="text">Izaberi grad</span>
               <div class="icon"><i class="fas fa-chevron-down"></i></div>
            </div>
            <div id="optionsWrap" class="option-wrap d-none">
                <?php foreach ($cities as $city) { ?>
                    <div  class="option"><?php echo $city->meta_value; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <h4>Sortiraj</h4>
    <div class="filter__category-single ">
        <div class="filter__category-head">
            <div class="filter__category-container">
                <div id="nameSort" class="filter__category-container cursor_pointer">
                    <span>Po Nazivu</span>
                    <div class="filter__icon-wrap">
                        <i class="fas fa-long-arrow-alt-up"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter__category-single ">
        <div class="filter__category-head">
            <div class="filter__category-container">
                <div id="priceSort" class="filter__category-container cursor_pointer">
                    <span>Po Ceni</span>
                    <div class="filter__icon-wrap">
                        <i class="fas fa-long-arrow-alt-up"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>