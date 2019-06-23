<?php
/*
Plugin Name: NS Frontend Add Product Premium
Plugin URI: https://www.nsthemes.com/
Description: This plugin allow to choose the fields to show in the checkout page
Version: 1.0.0
Author: NsThemes
Author URI: http://www.nsthemes.com
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! defined( 'ADDPROD_NS_PLUGIN_DIR' ) )
    define( 'ADDPROD_NS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'ADDPROD_NS_PLUGIN_DIR_URL' ) )
    define( 'ADDPROD_NS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );



/* *** plugin options *** */
require_once( ADDPROD_NS_PLUGIN_DIR.'/ns-frontend-add-product-options.php');


require_once( plugin_dir_path( __FILE__ ).'/ns-admin-options-pro/ns-admin-options-setup.php');

require_once( plugin_dir_path( __FILE__ ).'ns-frontend-edit-product.php');

		
/*Only logged users can use the plugin*/
function ns_is_user_logged_in() {
    $user = wp_get_current_user();
	$role_name_shop_manager = 'shop_manager';
	$role_name_customer = 'customer';
	/*Administrator can allow from backend two type of roles to login in this plugin: shop_manager and customer*/
	if((get_option('ns-choose-role-'.$role_name_shop_manager, '') == 'on') ){
		if(current_user_can($role_name_shop_manager)){
			return $user->exists();
		}
	}
	if(get_option('ns-choose-role-'.$role_name_customer, '') == 'on'){
		if(current_user_can($role_name_customer)){
			return $user->exists();
		}
	}
	if(current_user_can('administrator')){
			return $user->exists();
	}
	
	return false;
	
}

$is_edit = null;
$edit_id = null;

/*this create a shortcode that allow to insert the add image module linked to a new product*/
add_shortcode("ns-add-product", "ns_add_prod");

function ns_add_prod( $atts ) { 
$args = array(
    'textarea_rows' => 15,
    'teeny' => true,
    'quicktags' => false
);

if(!ns_is_user_logged_in())
		{
			echo "Para visualizar el contenido tiene que ingresar <br>";
			return;
		}
	
	
	
				
						/*EDIT VARIABLES SECTION*/
			
$is_edit= null;
if(isset($_POST["ns-is-edit-input"])){
	$is_edit = sanitize_text_field($_POST["ns-is-edit-input"]);	//this field lets know if we are viewing this page as add product or edit product;
}
	
$edit_id = null;
if($is_edit == 'yes'){											//if we are viewing this page in edit product mode we need
	$edit_id = sanitize_text_field($_POST['ns-page-params']);	//to know the id of the post to modify, and display it in the hidden input below (ns-is-edit-prod).
																//in this way we can pass the id throgh $_POST;
																//gonna get and store all the metas already existing for that product,
																//in this way I can repopulate all the inputs with their previous values;
	$edit_name = get_post($edit_id)->post_name;
	$edit_regular_price = get_post_meta($edit_id, '_regular_price',true);
	$edit_sale_price = get_post_meta($edit_id, '_sale_price', true);
	$edit_sku = get_post_meta($edit_id, 'sku', true);
	//$edit_manage_stock = get_post_meta($edit_id, '_manage_stock');
	$edit_stock_status = get_post_meta($edit_id, '_stock_status', true);
	$edit_sold_individually = '';
	$edit_weight = get_post_meta($edit_id, '_weight', true);
	$edit_length = get_post_meta($edit_id, '_length', true);
	$edit_width = get_post_meta($edit_id, '_width', true);
	$edit_height = get_post_meta($edit_id, '_height', true);
	$edit_purchase_note = get_post_meta($edit_id, '_purchase_note', true);
	$edit_menu_order = '';
	$edit_bubble_title = '';
	$edit_cus_tab_title = '';
	$edit_cus_tab_content = '';
	$edit_prod_video = '';
	$edit_prod_video_size = '';
	$edit_top_content = '';
	$edit_bottom_content = '';
	$edit_post_content = get_post($edit_id)->post_content;
	$edit_prod_short_desc = get_post($edit_id)->post_excerpt;
	$edit_image_from_list = get_post_meta($edit_id, '_product_image_gallery', true);
	
	$edit_tags_term_arr = wp_get_post_terms( $edit_id, 'product_tag' );		//getting all the posts tags as array of WP_Term Object
	if(empty($edit_tags_term_arr)){
		$edit_tags_term_arr = null;
	}
	
	$edit_cat_term_arr_obj = wp_get_post_terms( $edit_id, 'product_cat' );		//getting all the posts categories as array of WP_Term Object
	
	$edit_cat_term_arr = Array();
	foreach($edit_cat_term_arr_obj as $term_obj){								//create a simplier array to check in faster way only the names of categories
		array_push($edit_cat_term_arr, $term_obj->name);
	}
	/*if(empty($edit_cat_term_arr_obj)){
		$edit_cat_term_arr = null;
	}*/

	
							/***********************/
	
}	if(isset($_POST['ns-add-prod-frontend-save-img-gallery'])){
		ns_add_images_to_gallery();
	}															
ob_start(); ?>
<div id="ns-container-add-product-frontend">
	<form name="form1" action="" method="post" class="" enctype="multipart/form-data">

		<input id="ns-is-edit" name="ns-is-edit-prod" type="hidden" value="<?php echo $edit_id; ?>"/>


	<div id="ns-product-data-container" class="ns-big-box">
						
                    <div class="ns-center">
				
                      <h2 class="ns-center"><span>DATOS DEL PRODUCTO</span></h2> 

                     </div>	
		
			<!---div id="ns-product-data-inner-container" class="ns-border-margin"--->
				<!-- simple or variable product -->
				<!---div>
					<!---select id="ns-product-type" name="ns-product-type"--->
						<!---option value="simple">Simple product</option--->
						<!---option value="variable" style="display:none" >Variable product</option--->
					</select>
				</div--->

<!---span type='button' id='ns-post-prod-data-hide-show' class="dashicons dashicons-arrow-down ns-pointer"></span--->	
				
  

		<!---div class="ns-prod-data-tab ns-general"--->

                        

		     <div class="ns-big-box">

				<div>
						<div><label>NOMBRE DEL PRODUCTO</label> </br></br><input class="ns-big-box" name="ns-product-name" id="ns-product-name" value="<?php if($is_edit == 'yes'){echo($edit_name);}else{echo'';} ?>" placeholder="" type="text" required="true"></div></br></br></br>
						<?php
							if(get_option('ns-code-add-prod-regular-price') != 'on'):
						?>
							<div ><label>PRECIO DE VENTA NORMAL(<?php echo  get_woocommerce_currency_symbol();?>)</label> <br><input class="ns-input-width" name="ns-regular-price" id="ns-regular-price" value="<?php if($is_edit == 'yes'){echo($edit_regular_price);}else{echo'';} ?>" placeholder="" type="text" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places."></div></br></br>
						<?php endif; ?>
						
						<?php
							if(get_option('ns-code-add-prod-sale-price') != 'on'):
						?>
							<div><label>PRECIO DE OFERTA(<?php echo  get_woocommerce_currency_symbol();?>)</label> <br><input class="ns-input-width" name="ns-sale-price" id="ns-sale-price" value="<?php if($is_edit == 'yes'){echo($edit_sale_price);}else{echo'';} ?>" placeholder="" type="text" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places."></div>
						<?php endif; ?>
		              </div>

                       <!---/div--->

                      
		 </div>	
				<div class="ns-prod-data-tab ns-inventory ns-hidden">
					<div>
					
						<?php
							if(get_option('ns-code-add-prod-sku') != 'on'):
						?>
							<div>
								<label>SKU</label> <br><input class="ns-input-width" name="ns-sku" id="ns-sku" value="<?php if($is_edit == 'yes'){if(isset($edit_sku)){echo($edit_sku);}}else{echo'';} ?>" placeholder="" type="text">
							</div>
						<?php endif; ?>
						
						<?php
							if(get_option('ns-code-add-prod-manage-stock') != 'on'):
						?>
							<div>
								<label>Manage Stock?</label><input name="ns-manage-stock" id="ns-manage-stock" class="ns-check-linked" value="no" type="checkbox"> <br><span class="ns-add-product-frontend-span-text">Enable stock management at product level</span>
							</div>
							
							<div id="ns-manage-stock-div" style="display: none;">
								<div>
									<label>Stock quantity</label><br><input class="" name="ns-stock" id="ns-stock" step="any" type="number"> 
								</div>
								<div class="">
								<label>Allow backorders?</label>
									<select id="ns-backorders" name="ns-backorders" class="">
										<option value="no">Do not allow</option>
										<option value="notify">Allow, but notify customer</option>
										<option value="yes" selected="selected">Allow</option>
									</select> 
								</div>
							</div>
						<?php endif; ?>	
						
						<?php
							if(get_option('ns-code-add-prod-stock-status') != 'on'):
						?>
							<div>
								<label>Stock Status</label> <br>
								<select id="ns-stock-status" name="ns-stock-status" class="ns-input-width" >
									<option value="instock">In stock</option>
									<option value="outofstock">Out of stock</option>
								</select>
							</div>
						<?php endif; ?>	
						
						<?php
							if(get_option('ns-code-add-prod-sold-ind') != 'on'):
						?>
							<div>
								<div style="margin-left: 0px;"><label>Sold individually </label><input class="checkbox ns-check-linked" name="ns-sold-individually" id="ns-sold-individually" value="yes" type="checkbox"> <br><span class="ns-add-product-frontend-span-text">Enable this to only allow one of this item to be bought in a single order</span></div>
							</div>
						<?php endif; ?>	
					</div>				
				</div>
				<div class="ns-prod-data-tab ns-shipping ns-hidden">
					
					<div class="">
						<?php
							if(get_option('ns-code-add-prod-weight') != 'on'):
						?>
							<div>
								<label>Weight (kg)</label><br>
								<input class="ns-input-width" name="ns-weight" id="ns-weight" placeholder="0" type="text" value="<?php if($is_edit == 'yes'){echo($edit_weight);}else{echo'';} ?>" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places.">
							</div>
						<?php endif; ?>	
						
						<div>
							<label>Dimensions (cm)</label>
							<div style="margin-left: 0px;">
								<?php
								if(get_option('ns-code-add-prod-length') != 'on'):
								?>
									<input class="ns-input-width" id="ns-product-length" placeholder="Length" size="6" name="ns-product-length"  type="text" value="<?php if($is_edit == 'yes'){echo($edit_length);}else{echo'';} ?>" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places.">
								<?php endif; ?>	
								
								<?php
								if(get_option('ns-code-add-prod-width') != 'on'):
								?>
									<br><input class="ns-input-width" placeholder="Width" size="6" id="ns-width" name="ns-width"  type="text" value="<?php if($is_edit == 'yes'){echo($edit_width);}else{echo'';} ?>" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places.">
								<?php endif; ?>	
								
								<?php
								if(get_option('ns-code-add-prod-height') != 'on'):
								?>
									<br><input class="ns-input-width" placeholder="Height" size="6" id="ns-height" name="ns-height"  type="text" value="<?php if($is_edit == 'yes'){echo($edit_height);}else{echo'';} ?>" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places.">
								<?php endif; ?>	
							</div>
							
                                       </div>	
                            				
				
                                  </div>
					

				<!---/div--->



				
				
				<div class="ns-prod-data-tab ns-attributes ns-hidden">
					<?php
					if(get_option('ns-code-add-prod-attributes') != 'on'):
					?>
						<div id="ns-inner-attributes">
							<select id="ns-attribute-taxonomy" name="ns-attribute-taxonomy" class="ns-attribute-taxonomy ns-input-width">
								<option value="ns-cus-prod-att">Custom product attribute</option>
								<option id="ns-color-id" value="ns-color-att">color</option>
							</select> 
							<br>
							<button id="ns-add-attribute-btn" type="button" class="button">Add</button>
							<input id="ns-attribute-list" name="ns-attribute-list" type="hidden" />
						</div>
					<?php endif; ?>	
					
				</div>
				<div class="ns-prod-data-tab ns-advanced ns-hidden">
					<?php
					if(get_option('ns-code-add-prod-pur-note') != 'on'):
					?>
						<div style="display:none">
							<label>Purchase note</label><textarea name="ns-purchase-note" id="ns-purchase-note" ></textarea>			
						</div>
					<?php endif; ?>	
					<?php
					if(get_option('ns-code-add-prod-menu-ord') != 'on'):
					?>
						<div style="display:none">
							<label>Menu order</label><br><input class="ns-input-width" name="ns-menu-order" id="ns-menu-order" placeholder="" step="1" type="number">
						</div>
					<?php endif; ?>	
					<?php
					if(get_option('ns-code-add-prod-reviews') != 'on'):
					?>
						<div>
							<label>Enable reviews</label><input class="checkbox ns-check-linked" name="ns-comment-status" id="ns-comment-status" checked="checked" type="checkbox">				
						</div>
					<?php endif; ?>	
				</div>
				<div class="ns-prod-data-tab ns-extra ns-hidden">
					<div id="ns-wc-productdata-options-tab">
						<!--<div>
							<label>Custom Bubble</label>
							<select id="ns-bubble" name="ns-bubble" class="ns-input-width">
								<option value="" selected="selected">Disabled</option>
								<option value="&quot;yes&quot;">Enabled</option>
							</select>
						</div> -->
						<?php
						if(get_option('ns-code-add-prod-bubble-title') != 'on'):
						?>
							<div><label>Custom Bubble Title</label><br><input class="ns-input-width" name="ns-bubble-text" id="ns-bubble-text" value="" placeholder="NEW" type="text"></div>
						<?php endif; ?>	
						
						<?php
						if(get_option('ns-code-add-prod-cus-tab') != 'on'):
						?>
							<div><label>Custom Tab Title</label><br><input class="ns-input-width" value="" name="ns-custom-tab" id="ns-custom-tab" placeholder="" type="text"></div>
						<?php endif; ?>	
						
						<?php
						if(get_option('ns-code-add-prod-cus-tab-cont') != 'on'):
						?>
							<div><label>Custom Tab Content</label><textarea  id="ns-cus-tab-content" name="ns-cus-tab-content" class="" placeholder="Enter content for custom product tab here. Shortcodes are allowed"></textarea></div>
						<?php endif; ?>	
						
						<?php
						if(get_option('ns-code-add-prod-video') != 'on'):
						?>
							<div><div style="margin-left: 0px;"><label>Product Video</label><br><input id="ns-video" name="ns-video" class="" placeholder="https://www.youtube.com/watch?v=Ra_iiSIn4OI" type="text"><br><span class="ns-add-product-frontend-span-text">Enter a Youtube or Vimeo Url of the product video here. We recommend uploading your video to Youtube.</span></div></div>				
							<div><label>Product Video Size</label><br><input id="ns-video-size" name="ns-video-size" class="ns-input-width" placeholder="900x900" type="text"></div>
						<?php endif; ?>	
						
						<?php
						if(get_option('ns-code-add-prod-top-content') != 'on'):
						?>
							<div><label>Top Content</label><textarea id="ns-top-content" name="ns-top-content" placeholder="Enter content that will show after the header and before the product. Shortcodes are allowed"></textarea></div>
						<?php endif; ?>	
						
						<?php
						if(get_option('ns-code-add-prod-bottom-content') != 'on'):
						?>
							<div><label>Bottom Content</label><textarea id="ns-bottom-content" name="ns-bottom-content" placeholder=""></textarea></div>
						<?php endif; ?>	
					</div>
				</div>
				
				<div class="ns-prod-data-tab ns-variation ns-hidden">
					<?php
					if(get_option('ns-code-add-prod-variations') != 'on'):
					?>
					<div id="ns-inner-variation">
						<div>
							<div id="ns-message">
								<p>Before you can add a variation you need to add some variation attributes on the <strong>Attributes</strong> tab.</p>
								<p>
									<a class="button ns-left" href="https://docs.woocommerce.com/document/variable-product/" target="_blank">Learn more</a>
								</p>
							</div>
							<button id="ns-var-button" type="button" class="button ns-left ns-hidden" name="ns-var-button">Add Variation</button>	
						</div>
					</div>
					<?php endif; ?>	
				</div>
				<input id="ns-variation-list" name="ns-variation-list" type="hidden" value=""/>
			</div>
		</div>
		
		<?php
		if(get_option('ns-code-add-prod-post-content') != 'on'):
		?>
			
		<textarea style="display:none" id="ns-post-content-text" name="ns-post-content-text" class="ns-display-block" ><?php if($is_edit == 'yes'){echo($edit_post_content);}else{echo '';} ?></textarea>
				
		<?php endif; ?>	
		
		<?php
		if(get_option('ns-code-add-prod-short-desc') != 'on'):
		?>
			<div id="ns-short-desc-container" class="ns-big-box">
				<div>
					<h2 class="ns-center">DESCRIPCION DEL PRODUCTO</h2>
<p class="ns-add-product-frontend-span-text"> </p>
					<textarea id="ns-short-desc-text" name="ns-short-desc-text" class="ns-display-block" ><?php if($is_edit == 'yes'){echo($edit_prod_short_desc);}else{echo'';} ?></textarea>
				</div>

</div>	


<?php endif; ?>	

		
		


			
			<?php
			if(get_option('ns-code-add-prod-image') != 'on'):
			?>
				<div id="ns-image-container" class="ns-big-box">
					<h2 class="ns-center">IMAGEN DEL PRODUCTO</h2>
                                       
						<div id="ns-image-container1">
							<img id="ns-img-thumbnail" src="<?php echo(wc_placeholder_img_src()); ?>" />
						</div>
						<div class="ns-margin-top"><p><input type="file" name="ns-thumbnail" id="ns-thumbnail" /></p></div>
					
				</div>
			<?php endif; ?>	
		   
	





	
  <div id="ns-product-categories" class="ns-big-box">
			
                  <h2 class="ns-center">CREAR O ELEGIR CATEGORIA PARA EL PRODUCTO</h2>
<p class="ns-add-product-frontend-span-text"><strong>Por ej: Si el producto cargado es un zapato de taco </br></br></br> alto, la categoria debe ser ZAPATOS o ZAPATOS</br></br></br> PARA DAMAS </strong> </p>
		<div class="ns-left ns-little-container">
		
			<?php
			if(get_option('ns-code-add-prod-categories') != 'on'):
				//getting here all the categories already inserted by user or default ones
				$cat_args = array(
									'hierarchical' => 1,
									'hide_empty' => false,
									'taxonomy' => 'product_cat',
									'parent' => 0
									);
				$all_main_cat = get_categories($cat_args);/*get_terms( array(
										'taxonomy' => 'product_cat',
										'hierarchical' => 1,
										'hide_empty' => false,
										'parent' => 0
									));	*/			
			?>
				
                  </div>


					
						<div>
							<table id="ns-cat-din-table">
							<?php		
						
								foreach($all_main_cat as $cat_obj){		
									echo '<tr>';
									echo '<td><input type="checkbox" name="'.$cat_obj->name.'" class="ns-add-product-frontend-ca-checkbox" value="'. $cat_obj->name.'"/>'.$cat_obj->name;
									$parentargs = array(
									'hierarchical' => 1,
									'hide_empty' => false,
									'parent' => $cat_obj->term_id,
									'taxonomy' => 'product_cat'
									);
									$parentcats = get_categories($parentargs);
									/*echo'<pre>';print_r($parentcats); echo '</pre>';*/
									foreach ($parentcats as $cat_child){											
										$checked = '';
										if($is_edit == 'yes'){
											if(in_array($cat_child->name, $edit_cat_term_arr)){
												$checked = 'checked';
											}
										}											
										echo '<div class="ns-subcategory-list-div"><input type="checkbox" name="'.$cat_child->name.'" class="ns-add-product-frontend-ca-checkbox" value="'. $cat_child->name .'"'.$checked.'/>'.$cat_child->name.'</div>';			
										$parentargs2 = array(
										'hierarchical' => 1,
										'hide_empty' => false,
										'parent' => $cat_child->term_id,
										'taxonomy' => 'product_cat'
										);
										$parentcats2 = get_categories($parentargs2);
										/*echo'<pre>';print_r($parentcats); echo '</pre>';*/
										foreach ($parentcats2 as $cat_child2){											
											$checked = '';
											if($is_edit == 'yes'){
												if(in_array($cat_child2->name, $edit_cat_term_arr)){
													$checked = 'checked';
												}
											}											
											echo '<div class="ns-subcategory-list-2lv-div"><input type="checkbox" name="'.$cat_child2->name.'" class="ns-add-product-frontend-ca-checkbox" value="'. $cat_child2->name .'"'.$checked.'/>'.$cat_child2->name.'</div>';			
											$parentargs3 = array(
											'hierarchical' => 1,
											'hide_empty' => false,
											'parent' => $cat_child2->term_id,
											'taxonomy' => 'product_cat'
											);
											$parentcats3 = get_categories($parentargs3);
											/*echo'<pre>';print_r($parentcats); echo '</pre>';*/
											foreach ($parentcats3 as $cat_child3){											
												$checked = '';
												if($is_edit == 'yes'){
													if(in_array($cat_child2->name, $edit_cat_term_arr)){
														$checked = 'checked';
													}
												}											
												echo '<div class="ns-subcategory-list-3lv-div"><input type="checkbox" name="'.$cat_child3->name.'" class="ns-add-product-frontend-ca-checkbox" value="'. $cat_child3->name .'"'.$checked.'/>'.$cat_child3->name.'</div>';			
											}
										
										}
									
									}
									echo '</td>';
									echo '</tr>';
									
								}
							?>
								
							</table>						
						</div>
						<button id="ns-myBtn-cat" class="button" type="button">Add new product category</button>
					
				</div> <br> <br>
			<?php endif; ?>	
			
			<?php
			if(get_option('ns-code-add-prod-gallery') != 'on'):
			?>
				<div id="ns-product-gallery" class="ns-big-box">
					
						<h2 class="ns-center">Product Gallery</h2>

						<div>
							<p class="ns-add-product-frontend-span-text">Add product gallery images</p>
							 <!-- Trigger/Open The Gallery Modal -->
							<button id="ns-myBtn" class="button ns-left" type="button">Open Gallery</button>
						</div>
					
				</div>
			<?php endif; ?>	

<div class="ns-big-box">
		
			<h2 class="ns-center">PRODUCTOS RECOMENDADOS O COMPLEMENTARIOS AL PRODUCTO CARGADO </h2>
<p class="ns-add-product-frontend-span-text"><strong>Por ej: Recomendamos estas botas color rojo con la cartera color rojo </strong> </p>

                      <div class="ns-prod-data-tab ns-linked-products ">
					<?php
					//getting all the posts to loop over and display a list of product to link to
					if(get_option('ns-code-add-prod-linked') != 'on'){
						$ns_args = array(
						    'author'        =>  wp_get_current_user()->ID, 
							'post_status' => 'publish',
							'post_parent' => 0,
							'post_type'   => 'product',
							'posts_per_page' => - 1,
						);
						$related_posts = get_posts($ns_args);
						echo '<div id="ns-inner-linked"> <div style="display:none"><h3> </h3><p class="ns-add-product-frontend-span-text"> </p></div>';
						foreach($related_posts as $rel_post){
							echo('<div>'.$rel_post->post_name.'<input class="checkbox ns-check-linked" name="linked#'.$rel_post->post_name.'" id="'.$rel_post->ID.'" type="checkbox"></div>');
						}				
						echo '</div>';
				    }; ?>	
					<input id="ns-linked-list" class="ns-link-class" name="ns-linked-list" style="display:none"/>
	               </div>


</div>


		</div>
		<button type="submit" class="button ns-left" name="submit">Save</button>			
</div>

<?php
if(get_option('ns-code-add-prod-gallery') != 'on'):
?>
	<input id="ns-image-from-list" name="ns-image-from-list" type="hidden" value="<?php if($is_edit == 'yes'){if(isset($edit_image_from_list)){echo($edit_image_from_list);}}else{echo'';} ?>" />
<?php endif; ?>	

<?php
if(get_option('ns-code-add-prod-attributes') != 'on'):
?>
	<input id="ns-attr-from-list" name="ns-attr-from-list" type="hidden" value="" />
	<input id="ns-attr-from-list-variation" name="ns-attr-from-list-variation" type="hidden" value="" />
	<input id="ns-attr-from-list-variation-custom" name="ns-attr-from-list-variation-custom" type="hidden" value="" />
	<input id="ns-attr-custom-names" name="ns-attr-custom-names" type="hidden" value="" />
<?php endif; ?>	

</form>	
				<?php //get all the images from wordpress
				if(get_option('ns-code-add-prod-attributes') != 'on'){
					
				
					$query_images_args = array(
						'post_type'      => 'attachment',
						'post_mime_type' => 'image',
						'post_status'    => 'inherit',
						'posts_per_page' => - 1,
					);

					$query_images = new WP_Query( $query_images_args );

					/*All the images are stored in $images, so then i can foreach on them and echo in <img> source*/
					$images = array();
				?>
				<!-- The Gallery Modal -->
				<div id="ns-myModal" class="ns-modal">
				  <!-- Gallery Modal content -->
				  <div class="ns-modal-content">
						<span class="ns-close">x</span>
						<form id="ns-add-img-from-gallery-form" name="ns-add-img-from-gallery-form"  method="post" enctype="multipart/form-data">
							<div class="ns-margin-top"><p><h4>Add images to your gallery (use CTRL + left click to select more images)</h4><input type="file" multiple name="ns-add-prod-frontend-add-img-gallery[]" id="ns-add-prod-frontend-add-img-gallery" /></p></div>
							<button type="submit" class="button ns-add-product-frontend-hidden" id="ns-add-prod-frontend-save-img-gallery" name="ns-add-prod-frontend-save-img-gallery"> Save </button>
						</form>
						<div class="ns-image-container">
						<h4>Select saved images</h4>
						<?php foreach($query_images->posts as $image){ ?>
							<div class="ns-inline-flex"><img src="<?php echo(wp_get_attachment_url( $image->ID ));?>" id="<?php echo($image->ID);?>" /></div>
						<?php } ?>
						</div>
				  </div>
				</div>
				<?php } ?>	
				
				 <!-- The Category Modal -->
				
				<div id="ns-myModal-cat" class="ns-modal">
				 
					<div class="ns-modal-content">				
						<div class="ns-border-margin ns-padding-container">
							<span class="ns-close">x</span>
							<label>Enter a new category name</label>
							<br>
							<input id="ns-cus-cat-product" name="ns-cus-cat-product" class="ns-input-width" type="text" placeholder="Category Name">
							<br>
							<label>Parent category</label>
							<br>
							<?php
								$all_existent_cat = get_terms( array(
									'taxonomy' => 'product_cat',
									'hide_empty' => false,
								));	
							?>
							<select id="ns-cus-cat-parent-select" class="ns-input-width">
								<option value=''>-Parent Category-</option>
								<?php			
									foreach($all_existent_cat as $cat_obj){		
										echo '<option value="'.$cat_obj->name.'">'.$cat_obj->name.'</option>';
									}
								?>
							</select>
							<button type="button" class="button" id="ns-cus-cat-btn" >Save</button>	
						</div>
					</div>
				</div>
				
<?php
if(get_option('ns-code-add-prod-attributes') != 'on'):
?>
	<input id="ns-color-att-list"  type="hidden" value="<?php foreach(ns_get_all_color_terms() as $val){echo ($val.',');} ?>" />
<?php endif; ?>
<?php 
$ns_html_to_return = ob_get_clean();

	if(isset($_POST['submit']))
	{
		if(!ns_save_product()){			//error found, return empty html;
			echo ("Error: cannot add product.");
			return  $ns_html_to_return;
		}
		else{
			if($_POST['ns-is-edit-prod']!=''){
				echo 'Your product has been updated.';
			}
			else{
				echo 'Your product has been added.';
			}
			
		}
	}
	
	return  $ns_html_to_return;
}  


function ns_save_product(){
	/*Create a new post or update an existing one*/

	$post_id = ns_save_post();

	if(is_wp_error( $post_id )){
		return false;
	}


	/*Product data*/
	$regular_price = null;
	 if(isset($_POST["ns-regular-price"])){
		
		if(is_numeric( $_POST["ns-regular-price"] ) || $_POST["ns-regular-price"] == ''){
			$regular_price = sanitize_text_field($_POST["ns-regular-price"]);
		}
		else{
			wp_delete_post( $post_id, true );
			return false;
		}
	}
	$sale_price = null;
	 if(isset($_POST["ns-sale-price"])){
		
		if(is_numeric( $_POST["ns-sale-price"] ) || $_POST["ns-sale-price"] == ''){
			$sale_price = sanitize_text_field($_POST["ns-sale-price"]);
		}
		else{
			wp_delete_post( $post_id, true );
			return false;
		}
		
	 }
	$sku = null;
	 if(isset($_POST["ns-sku"])){
		 $sku = sanitize_text_field($_POST["ns-sku"]);
	 }
	 
	$manage_stock = null;
	$stock_quantity = null;
	$stock_back_orders = "no";
	 if(isset($_POST["ns-manage-stock"])){
		$manage_stock = sanitize_text_field($_POST["ns-manage-stock"]);
		if(is_numeric( $_POST["ns-stock"] ) || $_POST["ns-stock"] == ''){
			$stock_quantity = sanitize_text_field($_POST["ns-stock"]);
		}
		else{
			wp_delete_post( $post_id, true );
			return false;
		}
		$stock_back_orders = sanitize_text_field($_POST["ns-backorders"]);
	 }

	 $stock_status = null;
	 if(isset($_POST["ns-stock-status"])){
		$stock_status = $_POST["ns-stock-status"];
	 }
		
	$sold_individually = null; 
	if(isset($_POST["ns-sold-individually"])){
		$sold_individually = $_POST["ns-sold-individually"];
	}

	$weight = null;
	 if(isset($_POST["ns-weight"])){
		if(is_numeric( $_POST["ns-weight"] ) || $_POST["ns-weight"] == ''){
			$weight = sanitize_text_field($_POST["ns-weight"]);
		}
		else{
			wp_delete_post( $post_id, true );
			return false;
		}
	 }
	 
	$length = null;
	 if(isset($_POST["ns-product-length"])){
		if(is_numeric( $_POST["ns-product-length"] ) || $_POST["ns-product-length"] == ''){
			 $length = sanitize_text_field($_POST["ns-product-length"]);
		}
		else{
			wp_delete_post( $post_id, true );
			return false;
		}
	 }
	 
	$width = null;
	 if(isset($_POST["ns-width"])){	
		if(is_numeric( $_POST["ns-width"] ) || $_POST["ns-width"] == ''){
			$width = sanitize_text_field($_POST["ns-width"]);
		}
		else{
			wp_delete_post( $post_id, true );
			return false;
		}
	}

	$height = null;
	 if(isset($_POST["ns-height"])){	
		if(is_numeric( $_POST["ns-height"] ) || $_POST["ns-height"] == ''){
			$height = sanitize_text_field($_POST["ns-height"]);
		}
		else{
			wp_delete_post( $post_id, true );
			return false;
		}
	 }
	  
	 /* $shipping_class = null; 
	  if(isset($_POST["ns-product-shipping-class"])){
		$shipping_class = $_POST["ns-product-shipping-class"];
	  }*/
	  
	$purchase_note = null; 
	 if(isset($_POST["ns-purchase-note"])){
		$purchase_note = sanitize_text_field($_POST["ns-purchase-note"]);
	 }

	if($stock_status)
		update_post_meta( $post_id, '_stock_status', $stock_status);
	if($regular_price)
		update_post_meta( $post_id, '_regular_price',  $regular_price);
	if($sale_price)
		update_post_meta( $post_id, '_sale_price', $sale_price );
	if($purchase_note)
		update_post_meta( $post_id, '_purchase_note', $purchase_note  );

	update_post_meta( $post_id, '_featured', "no" );
	if($weight)
		update_post_meta( $post_id, '_weight', $weight );
	if($length)
		update_post_meta( $post_id, '_length', $length );
	if($width)
		update_post_meta( $post_id, '_width', $width );
	if($height)
		update_post_meta( $post_id, '_height', $height );
	if($sku)
		update_post_meta( $post_id, '_sku', $sku);

	update_post_meta( $post_id, '_sale_price_dates_from', "" );
	update_post_meta( $post_id, '_sale_price_dates_to', "" );

	if($sale_price)
		update_post_meta( $post_id, '_price', $sale_price );
	if($sold_individually)
		update_post_meta( $post_id, '_sold_individually', $sold_individually );

	if($manage_stock == "yes"){
		update_post_meta( $post_id, '_manage_stock', $manage_stock );
		update_post_meta( $post_id, '_stock', $stock_quantity );
		update_post_meta( $post_id, '_backorders', $stock_back_orders );
	}

	update_post_meta( $post_id, '_visibility', 'visible' );
	update_post_meta( $post_id, 'total_sales', '0');

	 
	/*
	wp_set_object_terms( $post_id, 'Races', 'product_cat' );
	wp_set_object_terms($post_id, 'simple', 'product_type');
	update_post_meta( $post_id, '_downloadable', 'yes');
	update_post_meta( $post_id, '_virtual', 'yes');
	*/

	/*Bubbles*/
	ns_save_bubble($post_id);

	/*Categories*/
	ns_save_categories($post_id);

	/*Tags*/
	ns_save_tags($post_id);

	/*Images*/
	$ns_attachment_id = ns_add_image($post_id);

	//if($ns_attachment_id)
		update_post_meta( $post_id, '_thumbnail_id', $ns_attachment_id );

	/*Linked products*/
	ns_linked_products($post_id);

	/*Attributes*/
	ns_add_attributes($post_id);

	/*Variations*/
	ns_switch_over_variations_att($post_id);

	/*Gallery*/
	ns_add_gallery_images($post_id);

	return true;
}

function ns_save_post(){
	/*Checking if user is logged in*/

	$user_id = wp_get_current_user()->ID;
	
	/*Get the inserted product title*/
	$ns_title = "New Product";
	if(isset($_POST["ns-product-name"])){
		$ns_title = sanitize_text_field($_POST["ns-product-name"]);
	}
	
	/*Get the inserted product short description*/
	$ns_short_desc = null;
	if(isset($_POST["ns-short-desc-text"])){
		$ns_short_desc = sanitize_text_field($_POST["ns-short-desc-text"]);
	}
	
	/*Get the inserted product post content*/	
	$ns_post_content = null;
	if(isset($_POST["ns-post-content-text"])){
		$ns_post_content = sanitize_text_field($_POST["ns-post-content-text"]);
	}  
	
	/*If user wanna activate the reviews*/	
	$ns_is_reviews = "closed";
	if(isset($_POST["ns-comment-status"])){
		$ns_is_reviews = "open";
	}
	
	/*Get the menu order inserted by user*/
	$ns_menu_order = 0;
	if(isset($_POST["ns-menu-order"])){
		$ns_menu_order = $_POST["ns-menu-order"];	
	}
	
	$post = array(
    'post_author' => $user_id,
    'post_content' => $ns_post_content,	
    'post_status' => "draft",
    'post_title' => $ns_title,
    'post_parent' => '',
    'post_type' => "product",
	'post_excerpt' => $ns_short_desc,
	'comment_status' => $ns_is_reviews,
	'menu_order' => $ns_menu_order,
	'post_name' => $ns_title,
);

$post_id = null;
	if(isset($_POST['ns-is-edit-prod'])){	
		/*Update already existing post*/
		$post['ID'] = $_POST['ns-is-edit-prod'];
		$post_id = wp_update_post($post, true);
	}	
	else{
		/*Create a new post*/
		$post_id = wp_insert_post( $post, true );
	}

	return $post_id;
}


//used to know if the variation is a color or custom attribute
function ns_switch_over_variations_att($post_id){
	$variation_list_num = null;
	if(isset($_POST["ns-attr-from-list-variation"])){
		$explode = explode(',', sanitize_text_field($_POST["ns-attr-from-list-variation"]));	//getting how many colors for variations user has inserted
		$variation_list_num = sizeof($explode)-1;				//-1 cuz of the blank 
	}
	
	$variation_list_num_custom_attr = null;
	if(isset($_POST["ns-attr-custom-names"])){
		$explode = explode(',' , sanitize_text_field($_POST["ns-attr-custom-names"])); 			//getting how many cus attr for variations user has inserted
		$variation_list_num_custom_attr = sizeof($explode)-1;	//-1 cuz of the blank 
	}
	
	
	if($variation_list_num > 0){	//here we have a variations on colors
		ns_save_variations($post_id, true, $variation_list_num);
	}
	
	else if($variation_list_num_custom_attr > 0){	//here we have a variations on custom attributes
		ns_save_variations($post_id, false, $variation_list_num_custom_attr);
	}
}

function ns_save_variations($post_id, $is_color, $num_of_variation){
		$user_id = wp_get_current_user()->ID;
		$i = 0;			//index used to loop over variations

		//the below variables will update the 'main' product metas with variations information
		$ns_max_price_variation_id = null;
		$ns_min_price_variation_id = null;
		$ns_max_variation_price = 0;
		$ns_min_variation_price = 100000;
		$ns_max_variation_regular_price = 0;
		$ns_min_variation_regular_price = 100000;
		$ns_max_variation_sale_price = 0;
		$ns_min_variation_sale_price = 100000;
		$ns_max_regular_price_variation_id = null;
		$ns_min_regular_price_variation_id = null;
		$ns_min_sale_price_variation_id = null;
		$ns_max_sale_price_variation_id = null;
		
		for($i = 1; $i <= $num_of_variation; $i++){
			
			//just creating an incomplete post variation to get the id of the post and use it for next post update
			$variation_post_dummy = array(
				'post_author' => $user_id,
				'post_status' => "publish",
				'post_parent' => $post_id,				//setting the parent
				'post_type' => "product_variation",
			);
			$variation_post_id = wp_insert_post($variation_post_dummy);
			$post_title_complete = 'Variation #'.$variation_post_id.' of '.get_post($post_id)->post_title;
			$post_name_complete =  'product-'.get_post($post_id)->ID.'-variation';
			//Updating variation post to match woocommerce standard
			$variation_post_update = array(
				  'ID'           => $variation_post_id,
				  'post_title'   => $post_title_complete,
				  'post_name' => $post_name_complete,
			 );
			 
			if(wp_update_post($variation_post_update)!= 0){
				//if the variations post has been correctly inserted, then lets get and insert the fields as post meta
				
				//variation image
				$var_image_id = null;
			
				if(isset($_FILES['ns-thumbnail-var'.$i])){
					if ($_FILES['ns-thumbnail-var'.$i]['name']) {
						if ($_FILES['ns-thumbnail-var'.$i]['error'] !== UPLOAD_ERR_OK) {
								
							return "upload error : " . $_FILES['ns-thumbnail-var'.$i]['error'];
						}			
						$var_image_id = media_handle_upload( 'ns-thumbnail-var'.$i, $variation_post_id );
						update_post_meta( $variation_post_id, '_thumbnail_id', $var_image_id);
						
						   
					}
				}
				
				
				$var_sku = null;
				if(isset($_POST['ns-variation-sku'.$i])){
					$var_sku = sanitize_text_field($_POST['ns-variation-sku'.$i]);
					update_post_meta( $variation_post_id, '_sku', $var_sku);
				}
				
				$var_reg_price = null;
				if(isset($_POST['ns-variation-regular-price'.$i])){
					$var_reg_price = sanitize_text_field($_POST['ns-variation-regular-price'.$i]);
					update_post_meta( $variation_post_id, '_regular_price', $var_reg_price);
					if($var_reg_price <= $ns_min_variation_regular_price){
						$ns_min_variation_regular_price = $var_reg_price;
						$ns_min_regular_price_variation_id = $variation_post_id;
					}
					if($var_reg_price >= $ns_max_variation_regular_price){
						$ns_max_variation_regular_price = $var_reg_price;
						$ns_max_regular_price_variation_id = $variation_post_id;
					}
				}
				
				$var_sale_price = null;
				if(isset($_POST['ns-variation-sale-price'.$i])){
					$var_sale_price = sanitize_text_field($_POST['ns-variation-sale-price'.$i]);
					update_post_meta( $variation_post_id, '_sale_price', $var_sale_price);
					if($var_sale_price <= $ns_min_variation_regular_price){
						$ns_min_variation_sale_price = $var_sale_price;
						$ns_min_sale_price_variation_id = $variation_post_id;
						$ns_min_price_variation_id = $variation_post_id;	
						$ns_min_variation_price = $var_sale_price;						
					}
					if($var_sale_price >= $ns_max_variation_regular_price){
						$ns_max_variation_sale_price = $var_sale_price;
						$ns_max_sale_price_variation_id = $variation_post_id;
						$ns_max_price_variation_id = $variation_post_id;
						$ns_max_variation_price = $var_sale_price;
					}
				}
				
				$var_stock_status = null;
				if(isset($_POST['ns-variation-stock-status'.$i])){
					$var_stock_status = sanitize_text_field($_POST['ns-variation-stock-status'.$i]);
					update_post_meta( $variation_post_id, '_stock_status', $var_stock_status);
				}
				
				$var_weight = null;
				if(isset($_POST['ns-variation-weight'.$i])){
					$var_weight = sanitize_text_field($_POST['ns-variation-weight'.$i]);
					update_post_meta( $variation_post_id, '_weight', $var_weight);
				}
				
				$var_len = null;
				if(isset($_POST['ns-variation-length'.$i])){
					$var_len = sanitize_text_field($_POST['ns-variation-length'.$i]);
					update_post_meta( $variation_post_id, '_length', $var_len);
				}
				
				$var_width = null;
				if(isset($_POST['ns-variation-width'.$i])){
					$var_width = sanitize_text_field($_POST['ns-variation-width'.$i]);
					update_post_meta( $variation_post_id, '_width', $var_width);
				}
				
				$var_height = null;
				if(isset($_POST['ns-variation-height'.$i])){
					$var_height = sanitize_text_field($_POST['ns-variation-height'.$i]);
					update_post_meta( $variation_post_id, '_height', $var_height);
				}
				
				$var_desc = null;
				if(isset($_POST['ns-variation-descritpion'.$i])){
					$var_desc = sanitize_text_field($_POST['ns-variation-descritpion'.$i]);
					update_post_meta( $variation_post_id, '_variation_description', $var_desc);
				}
				
				$var_downloadable = 'no';
				if(isset($_POST["ns-variation-downloadable".$i])){
					$var_downloadable = 'yes';
				}
				
				$var_virtual = 'no';
				if(isset($_POST["ns-variation-virtual".$i])){
					$var_virtual = 'yes';
				}
				
				update_post_meta( $variation_post_id, '_downloadable', $var_downloadable);
				update_post_meta( $variation_post_id, '_virtual', $var_virtual);
				
				//linking attribute
				
					$attr_val = null;
					if(isset($_POST['ns-variation-attributes'.$i])){
						$attr_val = sanitize_text_field($_POST['ns-variation-attributes'.$i]);
						update_post_meta($variation_post_id, 'attribute_pa_color', strtolower($attr_val));
						
					}
					else
						echo 'Need to select an attribute for this variation';
				
				
					$attr_val_cus = null;
					$attr_values;

					if(isset($_POST['ns-attribute-values'.($i-1)])){ //$i-1 cuz need to allineate with attribute input-> to change 
						
						$attr_values = sanitize_text_field($_POST['ns-attribute-values'.($i-1)]);

						if(isset($_POST['ns-variation-custom-attributes'.$i])){
							$attr_val_cus = sanitize_text_field($_POST['ns-variation-custom-attributes'.$i]);
							update_post_meta($variation_post_id, 'attribute_'.$attr_val_cus, strtolower($attr_values));
						}	
						else
							echo 'Need to select a custom attribute for this variation';
					}
	
				
				update_post_meta( $variation_post_id, '_price', $var_sale_price);

				

			}
			else 
				echo 'Variation post not inserted. ';
		}
		
		//updating now the calc variables to post
		update_post_meta( $post_id, '_max_price_variation_id', $ns_max_price_variation_id);
		update_post_meta( $post_id, '_min_price_variation_id', $ns_min_price_variation_id);
		update_post_meta( $post_id, '_max_variation_price', $ns_max_variation_price);
		update_post_meta( $post_id, '_min_variation_price', $ns_min_variation_price);
		update_post_meta( $post_id, '_max_variation_regular_price', $ns_max_variation_regular_price);
		update_post_meta( $post_id, '_min_variation_regular_price', $ns_min_variation_regular_price);
		update_post_meta( $post_id, '_max_variation_sale_price', $ns_max_variation_sale_price);
		update_post_meta( $post_id, '_min_variation_sale_price', $ns_min_variation_sale_price);
		update_post_meta( $post_id, '_max_regular_price_variation_id', $ns_max_regular_price_variation_id);
		update_post_meta( $post_id, '_min_regular_price_variation_id', $ns_min_regular_price_variation_id);
		update_post_meta( $post_id, '_min_sale_price_variation_id', $ns_min_sale_price_variation_id);
		update_post_meta( $post_id, '_max_sale_price_variation_id', $ns_max_sale_price_variation_id);
		
		update_post_meta( $post_id, '_price', $var_sale_price);
		//setting the terms to let woocommerce knows is a variation product
		wp_set_post_terms($post_id, 'variable', 'product_type');
		
		
}


function ns_save_categories($post_id){
	$ns_cat_array = array();
	
	$all_existent_cat = get_terms( array(
										'taxonomy' => 'product_cat',
										'hide_empty' => false,
									));	
							
	foreach($all_existent_cat as $cat_obj){		
		/*already saved categories*/
		$remove_spaces = str_replace(' ', '_', $cat_obj->name);
		if(isset($_POST[$remove_spaces])){
			$cat = sanitize_text_field($_POST[$remove_spaces]);
			array_push($ns_cat_array, $cat);
		}

		/*set product categories*/
		if($ns_cat_array){
			wp_set_object_terms($post_id, $ns_cat_array, 'product_cat');
		}
	
	}
	
}


function ns_save_tags($post_id){
	/*First need to sanitize the post variables, then explode the string on the comma to have the array*/
	$ns_tags_comma = null;
	if(isset($_POST["ns-new-tag-product"]))
		$ns_tags_comma = sanitize_text_field($_POST["ns-new-tag-product"]);

	$ns_tags = explode("," , $ns_tags_comma);

	/*set the product tags*/
	if($ns_tags){
		wp_set_object_terms($post_id, $ns_tags, 'product_tag');
	}
	
}


function ns_save_bubble($post_id){
	$is_any = false;
	/*
	$custom_bubble = null;
	if(isset($_POST["ns-bubble"])){
		$custom_bubble = sanitize_text_field($_POST["ns-bubble"]);
		$is_any = true;
	}
	 */
	 $bubble_title = null;
	 if(isset($_POST["ns-bubble-text"])){
		$bubble_title = sanitize_text_field($_POST["ns-bubble-text"]);
		$is_any = true;
	 }
	 
	 $cus_tab_title = null;
	 if(isset($_POST["ns-custom-tab"])){
		 $cus_tab_title = sanitize_text_field($_POST["ns-custom-tab"]);
		 $is_any = true;
	 }
     
	 $cus_tab_content = null;
	 if(isset($_POST["ns-cus-tab-content"])){
		 $cus_tab_content = sanitize_text_field($_POST["ns-cus-tab-content"]);
		 $is_any = true;
	 }
	 
     $cus_tab_top = null;
	 if(isset($_POST["ns-top-content"])){
		 $cus_tab_top = sanitize_text_field($_POST["ns-top-content"]);
		 $is_any = true;
	 }
     
	 $cus_tab_bottom = null;
	 if(isset($_POST["ns-bottom-content"])){
		$cus_tab_bottom = sanitize_text_field($_POST["ns-bottom-content"]);
		 $is_any = true;
	 }
    
	$ns_video = null;
	if(isset($_POST["ns-video"])){
		$ns_video = sanitize_text_field($_POST["ns-video"]);
		$is_any = true;
	}
	 
	 $ns_video_size = null;
	 if(isset($_POST["ns-video-size"])){
		 $ns_video_size = sanitize_text_field($_POST["ns-video-size"]);
		 $is_any = true;
	 }
	 
	if($is_any){
		$ns_bubble_arr = Array( Array(
		 '_bubble_new' => "yes",
		 '_bubble_text' => $bubble_title,
		 '_custom_tab_title' => $cus_tab_title,
		 '_custom_tab' => $cus_tab_content,
		 '_product_video' =>  $ns_video,
		 '_product_video_size' => $ns_video_size,
		 '_top_content' =>  $cus_tab_top,
		 '_bottom_content' => $cus_tab_bottom,
		 )
		);

		update_post_meta( $post_id, 'wc_productdata_options', $ns_bubble_arr );
	} 
     
 	
}

function ns_add_image($post_id){

	$user_id = wp_get_current_user()->ID;

	if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }
			
	if ($_FILES['ns-thumbnail']['name']) {
		
		if ($_FILES['ns-thumbnail']['error'] !== UPLOAD_ERR_OK) {
			return "upload error : " . $_FILES['ns-thumbnail']['error'];
		}

		$attach_id = media_handle_upload( 'ns-thumbnail', $post_id );

		return $attach_id;
	
	}
	return false;
			
}

function ns_add_images_to_gallery(){

	if ( $_FILES ) { 
		$files = $_FILES["ns-add-prod-frontend-add-img-gallery"];  
		foreach ($files['name'] as $key => $value) {            
			if ($files['name'][$key]) { 
				$file = array( 
					'name' => $files['name'][$key],
					'type' => $files['type'][$key], 
					'tmp_name' => $files['tmp_name'][$key], 
					'error' => $files['error'][$key],
					'size' => $files['size'][$key]
				); 
				$_FILES = array ("ns-add-prod-frontend-add-img-gallery" => $file); 
				foreach ($_FILES as $file => $array) {              
					$newupload = ns_add_multiple_images_handle_attachment($file, 0); 
				}
			} 
		} 
    }
	return true;

}

function ns_add_multiple_images_handle_attachment($file_handler,$post_id,$set_thu=false) {
  // check to make sure its a successful upload
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');

  $attach_id = media_handle_upload( $file_handler, $post_id );

  return $attach_id;
}

//Saving the upsell products
function ns_linked_products($post_id){
	if(isset($_POST["ns-linked-list"])){
		$to_explode = sanitize_text_field($_POST["ns-linked-list"]);		
		$linked_prod_ids_arr = explode(',', $to_explode);
		update_post_meta($post_id, '_upsell_ids', $linked_prod_ids_arr);
	}
}

function ns_add_attributes($post_id){
	$ns_outer_array = Array();
	if(isset($_POST["ns-color-attr"])){					//There's could be only one color attribute field
														//if is set then create the array(array) 
		$color_attributes = sanitize_text_field($_POST["ns-color-attr"]);
		$is_visible = 0;
		if(isset($_POST["ns-attr-visibility-status"])){
			$is_visible = 1;
		}
		$ns_attr = Array(
				'name' => "pa_color",
				'value' => "",
				'position' => "0",
				'is_visible' => $is_visible,
				'is_variation' =>  1,
				'is_taxonomy' => 1,
				);
		
		$ns_outer_array['pa_color'] = $ns_attr;			//adding the color with key 'pa_color' to let framework knows it is color
	    wp_set_object_terms($post_id, $_POST["ns-color-attr"], 'pa_color', false);
	
  }
  
  if(isset($_POST['ns-attribute-list'])){		//Check if user inserted custom attributes and loop over them
	  $num_custom_attr = intval(sanitize_text_field($_POST['ns-attribute-list']));

	  if($num_custom_attr >= 0){	
		  for($i=0; $i<$num_custom_attr; $i++){ 
				$is_visible = 0;
				$ns_attr_name = sanitize_text_field($_POST['ns-attr-names'.$i.'']);
				$ns_attr_value = sanitize_text_field($_POST['ns-attribute-values'.$i.'']);
				
				
				if(isset($_POST['ns-attr-visibility-status'.$i.''])){
					$is_visible = 1;
				}
				
				
				$ns_attr = Array(
					'name' => $ns_attr_name,
					'value' => $ns_attr_value,
					'position' => "1",
					'is_visible' => $is_visible,
					'is_variation' =>  1,
					'is_taxonomy' => 0,
					);
				$ns_outer_array[$ns_attr_name] = $ns_attr;
				//array_push($ns_outer_array,  $ns_attr);		
		  }
	  }
  }
  if($ns_outer_array)
	update_post_meta( $post_id, '_product_attributes', $ns_outer_array );
  
  $arr_to_terms;
  if(isset($_POST["ns-attr-from-list"])){			//user selected an already saved color
		$arr_to_terms = explode(",",$_POST["ns-attr-from-list"]);
  }
  if(isset($_POST["ns-color-attr"])){				//user has inserted another new color
		array_push($arr_to_terms,$_POST["ns-color-attr"]);
  }
  if($arr_to_terms)									//if the array is not empty we have a new color or a already existing one
		wp_set_object_terms( $post_id, $arr_to_terms, 'pa_color'); 
			
	
}

/*Used to get all the colors already inserted by user*/
function ns_get_all_color_terms(){
	$term_array = Array();
	$term_list = get_terms( 'pa_color');
	foreach($term_list as $classTerm){
		array_push($term_array, $classTerm->name);
	}
	return $term_array;
}


function ns_add_gallery_images($post_id){
	$images_ids = null;
	if(isset($_POST["ns-image-from-list"])){
		$images_ids = sanitize_text_field($_POST["ns-image-from-list"]);
		update_post_meta( $post_id, '_product_image_gallery', $images_ids );
	}
}


/*Service for ajax call to add a custom category*/
add_action( 'wp_ajax_nopriv_ns_add_cat_product', 'ns_add_cat_product' );
add_action( 'wp_ajax_ns_add_cat_product', 'ns_add_cat_product' );
function ns_add_cat_product(){
	if(isset($_POST['name'])){
		$new_cat_name = sanitize_text_field($_POST['name']);
		$parent_cat = false;
		
		if(isset($_POST['parent']) && $_POST['parent'] != ''){
			$parent_cat = $_POST['parent'];
		}
		if(term_exists($new_cat_name, 'product_cat') == null){
			$args = '';
			if($parent_cat != false){
				$t = get_term_by('name', $parent_cat, 'product_cat');
				$args = array('parent' => $t ->term_id);
			}
			$arr_term_tax = wp_insert_term( $new_cat_name, 'product_cat',$args );
			update_term_meta($arr_term_tax['term_id'], 'product_count_product_cat', '0'); 
			echo $new_cat_name;
		}
		else{
			header('HTTP/1.1 500 Internal Server ');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('message' => 'Category Already Exist!')));
		}	
	}
	else{
		header('HTTP/1.1 500 Internal Server ');
        header('Content-Type: application/json; charset=UTF-8');
		die(json_encode(array('message' => 'ERROR')));
	}
	
	die();
}


//Enqueue the Dashicons script
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
	wp_enqueue_style( 'dashicons' );
}

