<?php 

get_header();

/* Template Name: home */

?>

<?php global $current_user;
      get_currentuserinfo();
      /*
      echo 'Username: ' . $current_user->user_login . "
";
      echo 'User email: ' . $current_user->user_email . "
";
      echo 'User first name: ' . $current_user->user_firstname . "
";
      echo 'User last name: ' . $current_user->user_lastname . "
";
      echo 'User display name: ' . $current_user->display_name . "
";
      echo 'User ID: ' . $current_user->ID . "
";
*/
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main"> 
    <?php 
    include (TEMPLATEPATH . '/nav.php'); 
    ?>
    <div class="container-fluid float-container">
    	<div class="wrapp">
			<div class="row">
				<div class="float-child">
					<div class="sidebar clearfix">
						<ul class="nav nav-sidebar">
						    <li class="filters">filters</li>
						    <li class="sidebar-border-bottom"></li>
						    <ul class="filter-order">
						     <li>order</li>
						     <li class="filter-asc-desc">
							    <div>
								    <input id="ascCheck" type="checkbox" name="check" value="ASC">
								    <label id="asc_lbl" for="ascCheck">Ascending</label>
								    <br>
								    <input id="descCheck" type="checkbox" name="check" value="DESC">
								    <label id="desc_lbl" for="descCheck">Descending</label>
								</div>
						     </li>
						    </ul>
						    <ul class="filter-dep">
						     <li>department</li>
						     <li class="filter-men-women">
							    <div>
								    <input id="mCheck" type="checkbox" name="check" value="Men">
								    <label id="mCheck_lbl" for="mCheck">Men</label>
								    <br>
								    <input id="wCheck" type="checkbox" name="check" value="Women">
								    <label id="wCheck_lbl" for="wCheck">Women</label>
								</div>
						     </li>
						    </ul>
						    <ul class="filter-price">
						     <li>price</li>
						     <li class="price-type">
							    <div>
								    <input id="lt29Check" type="checkbox" name="check" value="lt29">
								    <label id="lt29Check_lbl" for="lt29Check">Less Than $29</label>
								    <br>
								    <input id="fil2939Check" type="checkbox" name="check" value="29-39">
								    <label id="fil2939Check_lbl" for="fil2939Check">$29 - $39</label><br>
								    <input id="fil3949Check" type="checkbox" name="check" value="39-49">
								    <label id="fil3949Check_lbl" for="fil3949Check">$39 - $49</label>
								    <br>
								    <input id="fil4989Check" type="checkbox" name="check" value="49-89">
								    <label id="fil4989Check_lbl" for="fil4989Check">$49 - $89</label>
								    <br>
								    <input id="gt89Check" type="checkbox" name="check" value="gt89">
								    <label id="gt89Check_lbl" for="gt89Check">Greater Than $89</label>
								    <br>
								    <button type="submit" class="btn clear-all">Clear All</button>
								    <br><br>
								</div>
						     </li>
						    </ul>
						</ul>
					</div>
	            </div>
				<div id="prodContainer" class="float-child">
			        <?php
					  $args = array(
					    'post_type' => 'product',
					    'posts_per_page' => -1,
					    'order' => 'ASC',
					    /*
					    'tax_query' => array(
			                array(
			                    'taxonomy' => 'category',
			                    'field' => 'slug',
			                    'terms' => 'Jeans', //the taxonomy terms I'd like to dynamically query
			                ),
			            ),
			            */
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
								        <span class="color"><?= $color; ?></span><br>
								        <?php

								        global $product;
                                        echo $product->get_attribute( 'size' );
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
				                            

				                            function custom_product_attributes() {
												global $product;
												$attributes = $product->get_attributes();
												if ( ! $attributes ) {
												return;
												}
												if ($product->is_type( 'variable' )) {
												return;
												}
												echo '<div class="wc-prod-attributes"><h2>Custom Attributes</h2>';
												foreach ( $attributes as $attribute ) {
												$attribute_data = $attribute->get_data();
												$attribute_terms = $attribute_data['options'];
												$label = $attribute_data['name'];
												?>
												<div class="wc-prod-single-attribute">
												<h3><?php echo $label; ?></h3>
												<select class="wc-custom-select-attribute" name="attribute[<?php echo $attribute_data['id']; ?>]" id="attribute[<?php echo $attribute_data['id']; ?>]">
												                <option value selected>Choose an option</option>
												                <?php foreach ( $attribute_terms as $pa ): ?>
												                    <option value="<?php echo $pa; ?>"><?php echo $pa; ?></option>
												                <?php endforeach; ?>
												            </select>
												</div>
												<?php
												}
												echo '</div>';
											}
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
				</div>
			</div>
	    </div>
	</div>


    </main>
</div>

	




<?php 
get_footer();
