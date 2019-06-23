<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_shortcode("ns-edit-product", "ns_edit_prod");

function ns_edit_prod( $atts ) { 
	$args = array(
		'textarea_rows' => 15,
		'teeny' => true,
		'quicktags' => false
	);

	if(!ns_is_user_logged_in())
			{
				echo(' <a href="'.wp_login_url().'" title="Login"> Login</a>');
				return;
			}
		
	//checking $_POST to know if load a view of products (table) or the edit page 
	if(isset($_POST['ns-page-params'])){
		ns_edit_product_from_id($_POST['ns-page-params']);	//edit
	}
	else{	
		return ns_show_prod_table();						//table products
	}
}

function ns_edit_product_from_id($post_id){
	return '';
}


function ns_show_prod_table(){
	$args = Array(									//filter for the get_posts() function
		'post_autor' => wp_get_current_user()->ID,
		'orderby'       =>  'post_date',
		'order'         =>  'DSC',
		'posts_per_page' => -1,
		'post_type'=> 'product',
		'post_status'=>array('draft','publish')
	);	
	
	$user_posts = get_posts($args);					//getting all the logged users product(posts)		
	ob_start(); 
?>

<div id="ns-vendor-products">
	<div id="ns-inner-vendor-products">
		<table id="ns-all-user-products-table">
			<thead>
				<tr>
					<th>Imagen</th>
					<th>Nombre del Producto</th>
					<th>Borrar O Editar</th>
					<th>Precio</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				foreach($user_posts as $post):
					$post_meta = get_post_meta($post->ID);		//getting all the post meta
					

					$sale_price = '-';

	
					if(isset($post_meta['_sale_price'][0]))
						$sale_price = $post_meta['_sale_price'][0];
					
					/*IMAGES*/
					$image_guid = wc_placeholder_img_src();
					if(isset($post_meta['_thumbnail_id'])){
						if($post_meta['_thumbnail_id'][0] != ''){
							$thumbnail_id = $post_meta['_thumbnail_id'][0];
							if( is_object(get_post($thumbnail_id)))
								$image_guid = get_post($thumbnail_id)->guid;
						}
					}
					
					/*TAGS*/
					$terms_arr = get_the_terms( $post->ID, 'product_tag' );
					$terms = Array();
					if($terms_arr){
						foreach($terms_arr as $term){
							array_push($terms, $term->name);						//Getting the names of the terms and putting into array for display
						}
						$terms = implode(',', $terms);			
					}
					else{
						$terms = '-';
					}
					/*CATEGORIES*/
					$cat_arr = get_the_terms( $post->ID, 'product_cat' );
					$categories = Array();
					if($cat_arr){
						foreach($cat_arr as $cat){
							array_push($categories, $cat->name);						//Getting the names of the terms and putting into array for display
						}
						$categories = implode(',', $categories);			
					}
					else{
						$categories = '-';
					}
					
				?>

				<tr>
					<th><div id="ns-add-product-frontend-edit-table"><img src="<?php echo($image_guid);?>"></div></th>
					<th>
						<div>
							<a href="<?php echo $post->post_name ?>"><?php echo $post->post_title?></a>
						</div>
					</th>
					<th>
						<div class="ns-button-table-section">
							<div  >
								<div><button id="ns-delete-post-<?php echo($post->ID);?>" data-id="ns-delete-post#<?php echo($post->ID);?>" class="ns-button-table-del" type="button">Borrar</button>
									
								<button id="ns-edit-post-<?php echo($post->ID);?>" data-id="ns-edit-post#<?php echo($post->ID);?>" class="ns-button-table-edit" type="submit" form="ns-aux-form">Editar</button></div>
							</div> 
						</div><r><br>
					</th>
					
					<th><div><?php echo('<p>'.$sale_price.$reg_price.get_woocommerce_currency_symbol().'</p>'); ?></div></th>
					
					<th><div><?php echo($post->post_date); ?></div></th>
				</tr>

				<?php 
				endforeach;
				?>
			</tbody>
		</table>
		<form id="ns-aux-form" method="post" action="">
			<input id="ns-page-params" name="ns-page-params" type="hidden" value=""></input>
			<input id="ns-is-edit-input" name="ns-is-edit-input" type="hidden" value=""></input>
		</form>
	</div>
</div>

<?php

	$ns_html_to_return_edit = ob_get_clean();
	return $ns_html_to_return_edit;
}

/*Service for ajax call to delete a custom field*/
add_action( 'wp_ajax_nopriv_ns_delete_product', 'ns_delete_product' );
add_action( 'wp_ajax_ns_delete_product', 'ns_delete_product' );
function ns_delete_product(){
	if(!wp_delete_post($_POST['id'])){
		echo 'Cannot delete the product';		
	}
	else{
		echo 'Post '.$_POST['id'].' deleted'; 
	}
	die();
}



?>