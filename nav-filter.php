<?php 

/* Template Name: nav-filter */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

    // Post values
    $cats = $_POST['cats'];
    $cat = $_POST['cat'];
    
    $tax_query = array();
    if(preg_match("/\b(all product)\b/ui", $cat )) {
        $tax_query[] = '';
    } else if(preg_match("/\b(women|men)\b/ui", $cat )) {
        $tax_query[] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $cat, //the taxonomy terms I'd like to dynamically query
            ),
            array(
                'taxonomy' => 'cats',
                'field' => 'slug',
                'terms' => $cats, //the taxonomy terms I'd like to dynamically query
            ),
        );
    }
    
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'tax_query' => $tax_query,
    );
       
    $query = new WP_Query($args);

        if($query->have_posts()) : 
            
            while($query->have_posts()) : $query->the_post();

            $product_id = get_the_ID();
          
            $url = get_the_permalink();
            $title = get_the_title();
            $thumb = get_the_post_thumbnail_url();
            $excerpt = get_the_excerpt();
            $product = wc_get_product($product_id);
            $price_html = $product->get_price_html();
            $color = get_post_meta($product_id, '_color', true);
            $url = get_permalink( $product_id );

        ?>
        <div class="float-content">
            <div class="float-child-content">
                <a style="display:block;text-decoration:none;" href="<?= $url ?>">
                    <div class="product-content">
                        <div>
                          <img src="<?= $thumb; ?>" alt="product_img" />
                        </div>
                        <div class="product-caption">
                            <h2 class="title"><?= $title; ?></h2>
                          <div>
                
                            <span class="product-price"><?= $price_html; ?> CAD</span><br>
                            <span class="color"><?= $color; ?></span>
                             <?php
                           
                                /*
                                echo apply_filters(
                                    'woocommerce_loop_add_to_cart_link',
                                    sprintf(
                                        '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
                                        esc_url( $product->add_to_cart_url() ),
                                        esc_attr( $product->get_id() ),
                                        esc_attr( $product->get_sku() ),
                                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                                        esc_attr( $product->product_type ),
                                        esc_html( $product->add_to_cart_text() )
                                    ),
                                    $product
                                
                                );
                                */
                                ?>
                          </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endwhile;
        endif; wp_reset_postdata();
        ?> 
