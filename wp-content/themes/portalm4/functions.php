<?php
require_once('wp_bootstrap_navwalker.php');





	add_action( 'after_setup_theme', 'portalm4_setup' );
	
	function portalm4_setup() {
		
		//add_image_size('red_thumb',157,110, true);	
		//add_image_size('proyecto_thumb',256,137, true);		
		//add_image_size('noticia_thumb',54,54, true);
		add_image_size('index_thumb',500,300, true);
		//add_image_size('carouselc',900,400, true);
		//add_image_size('banner_thumb',1010,367, true);		
		//add_image_size('izquierda_thumb',252,380, true);	

		add_theme_support('post-thumbnails' );
		
		
		register_nav_menu( 'principal_header', 'Menu que va en la cabecera');
		register_nav_menu( 'principal_pie', 'Menu que va en el pie');
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video','audio','image' ) );

		

	}

	if ( function_exists('register_sidebar') ) {
		register_sidebar(array('name'=>"portada", ));
		register_sidebar(array('name'=>"sidebar1"));
	
	}

	add_action( 'after_setup_theme', 'woocommerce_support' );
			function woocommerce_support() {
				define('WOOCOMMERCE_USE_CSS', false);
			add_theme_support( 'woocommerce' );

			add_theme_support( 'wc-product-gallery-zoom' );
/*add_theme_support( 'wc-product-gallery-lightbox' );*/
add_theme_support( 'wc-product-gallery-slider' );
		}

// Remove each style one by one
/*add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}*/

// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );


function mis_posts(){

 


   

$labels = array(
		'name' => _x('Bloque', ''),
		'singular_name' => _x('Bloque', ''),
		'add_new' => _x('Agregar', ''),
		'add_new_item' => __('Agregar Bloque'),
		'edit_item' => __('Editar Bloque'),
		'new_item' => __('Nuevo Bloque'),
		'view_item' => __('Ver Bloque'),
		'search_items' => __('Buscar Bloquees'),
		'not_found' =>  __('Seccion en construcci&oacute;n'),
		'not_found_in_trash' => __('No hay Dato en papelera'),
		'parent_item_colon' => '',
		'menu_name' => 'Bloques del Sitio'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'bloque'),
	
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','thumbnail','editor','excerpt','comments')
	);
	register_post_type('bloque',$args);
        flush_rewrite_rules(); 


   



}

add_action('init','mis_posts',0); 


function mis_taxonomias(){
	



	
}
add_action('init','mis_taxonomias',0);


function theme_excerpt_length($length){
   return 22; //el número aquí es nueva cantidad de palabras en el excerpt
}
add_filter('excerpt_length','theme_excerpt_length');

function theme_excerpt_more($more){
   return "";
}
add_filter('excerpt_more','theme_excerpt_more');




/*  --------------------------------------------------- Customizable logo  ------------------------------------------------------ */

function custom_login_logo() {
    echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/images/logovrinforw.png) 50% 50% no-repeat !important; }</style>';
}
add_action('login_head', 'custom_login_logo');


	

function tax2links($postid,$tax=false){
	if($tax==false) {return false; }
	$taxo=wp_get_post_terms($postid,$tax);
	foreach ($taxo as $kt => $vt) {
		$htmlcode.='<a href="'.get_term_link($vt).'">'.($vt->name).'</a> / ';
	}
	if(strlen($htmlcode)>2){
		return substr($htmlcode,0,-2);
	}
	return false;
}


function tax2checkbox($taxonomy){
	global $wp_query;
	$args=array('hide_empty'=>false);
	$myterms = get_terms($taxonomy, $args);
	$misvars=array_merge($wp_query->query,$_GET,$_POST);
	foreach($myterms as $term){
		?>
		<div class="checkbox">
			<label>
				<input <?php if($misvars[$taxonomy]==$term->slug){ echo 'checked'; }?> name="<?php echo $taxonomy;?>" value="<?php echo $term->slug;?>" type="checkbox"> <?php echo $term->name;?>
			</label>
		</div>
		<?php
	}
}


function tax2select($taxonomy){
	global $wp_query;
	//$args=array('hide_empty'=>true,'orderby'=>'name','parent'=>0);
	$args=array('hide_empty'=>false,'orderby'=>'name','order'=>'ASC','parent'=>0);
	$myterms = get_terms($taxonomy, $args);
	$misvars=array_merge($wp_query->query,$_GET,$_POST);
	?>
	<select name="<?php echo $taxonomy;?>" id="" class="form-control selectpub">
		<option value="">Todos</option>
		<?php
		foreach($myterms as $term){
			?>
				<option <?php if($misvars[$taxonomy]==$term->slug){ echo 'selected'; }?> value="<?php echo $term->slug;?>"> <?php echo $term->name;?></option>
				
				<?php 
				$subargs=array('hide_empty'=>false,'orderby'=>'name','child_of'=>$term->term_id); 
				$subterms=get_terms($taxonomy, $subargs); 
				if(is_array($subterms)){
					foreach ($subterms as $subterm) { ?>
						<option <?php if($misvars[$taxonomy]==$subterm->slug){ echo 'selected'; }?> value="<?php echo $subterm->slug;?>">--- <?php echo $subterm->name;?></option>
					<?php }
				}
				?>

			<?php
		} ?>
	</select>
	<?php
}


function tax2select2($taxonomy, $placeho){
	global $wp_query;
	//$args=array('hide_empty'=>true,'orderby'=>'name','parent'=>0);
	$args=array('hide_empty'=>false,'orderby'=>'name','order'=>'ASC','parent'=>0);
	$myterms = get_terms($taxonomy, $args);
	$misvars=array_merge($wp_query->query,$_GET,$_POST);
	?>
	<select name="<?php echo $taxonomy;?>" id="<?php echo $taxonomy;?>" class="form-control" data-placeholder="<?php echo $placeho;?>">
		<option></option>
		<?php
		foreach($myterms as $term){
			?>
				<option <?php if($misvars[$taxonomy]==$term->slug){ echo 'selected'; }?> value="<?php echo $term->slug;?>"> <?php echo $term->name;?></option>
				
				<?php 
				$subargs=array('hide_empty'=>false,'orderby'=>'name','child_of'=>$term->term_id); 
				$subterms=get_terms($taxonomy, $subargs); 
				if(is_array($subterms)){
					foreach ($subterms as $subterm) { ?>
						<option <?php if($misvars[$taxonomy]==$subterm->slug){ echo 'selected'; }?> value="<?php echo $subterm->slug;?>">--- <?php echo $subterm->name;?></option>
					<?php }
				}
				?>

			<?php
		} ?>
	</select>
	<?php
}


function tax2radio($taxonomy){
	global $wp_query;

	$args=array('hide_empty'=>false);
	$myterms = get_terms($taxonomy, $args);
	$misvars=array_merge($wp_query->query,$_GET,$_POST);
	
	foreach($myterms as $term){
		?>
		<div class="checkbox">
			<label>
				<input name="<?php echo $taxonomy;?>" <?php if($misvars[$taxonomy]==$term->slug){ echo 'checked'; }?> value="<?php echo $term->slug;?>" type="radio"> <?php echo $term->name;?>
			</label>
		</div>
		<?php
	}
}

function taxastags($postid,$html=false){
	$taxs=get_post_taxonomies($postid);
	foreach ($taxs as $key => $value) {
		$tax[$value]=wp_get_post_terms($postid,$value);
		foreach ($tax[$value] as $kt => $vt) {
			$htmlcode.='<li><a href="'.get_term_link($vt).'">'.($vt->name).'</a> </li>';
		}
	}
	if($html==true){
		return $htmlcode;
	}
	return false; 
}

function tax2tags($postid,$tax=false){
	if($tax==false) {return false; }
	$taxo=wp_get_post_terms($postid,$tax);
	foreach ($taxo as $kt => $vt) {
		$htmlcode.=''.($vt->name).', ';
	}
	if(strlen($htmlcode)>2){
		return substr($htmlcode,0,-2);
	}
	return false;
}




add_filter( 'init', 'vrinfor_init', 9 );



function vrinfor_init()

{

    add_filter( 'show_admin_bar', '__return_false' );

}


function wpb_list_child_pages() { 

global $post; 



if ( $post->post_parent != 0 ) {

	$principal = wp_list_pages( 'include=' . $post->post_parent . '&echo=0&title_li=' );
	$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
}
else{
	
	$principal = wp_list_pages( 'include=' . $post->ID . '&echo=0&title_li=' );
	$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
}
if ( $childpages ) {

	$string = '<ul class="nav nav-pills nav-stacked pagelateral">' ;
	$string .= $principal;
	$string .= $childpages ;
	$string .= '</ul>';
} 

return $string;

}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');

function tienefamilia(){
	global $post; 

	$children = get_pages( array( 'child_of' => $post->ID ) );

	if($post->post_parent != 0 or count( $children ) != 0 ){
		return true;
	} else {
		return false;
	}
}


function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}


function modified( $query )
{
    if ( is_post_type('concurso') )
    {
        $query->set( 'orderby', 'modified' );
        $query->set( 'order', 'desc' );
    }
}
add_action( 'pre_get_posts', 'modified' );

function menucategorias(){
	$contenido = "";

	$taxonomy="product_cat";
	$args=array('hide_empty'=>true,'orderby'=>'name','order'=>'ASC','parent'=>0);
	$myterms = get_terms($taxonomy, $args);
	//$misvars=array_merge($wp_query->query,$_GET,$_POST);
        
    $contenido .= '<!-- TABS PRESENTATION -->
	<section class="blok panelmenu">
	<div class="blok-body">
	<div class="row">
	<!-- Nav tabs -->';

	$contador = 0;
    $contenido .= '<ul class="nav tab-menu nav-pills col-sm-3 nav-stacked pr15 ">';    	
	foreach($myterms as $term){
		$active = "";
		if($contador == 0){
			$active="active";
		}
		$contenido .= '<li class="'.$active.'" data-toggle="tab"><a href="#tab'.$term->slug.'">'.$term->name.'</a></li>';
		$contador++;
	}
	$contenido .= '</ul>';


	$contador = 0;
	$contenido .='<!-- Tab panes --><div class="tab-content col-sm-9">';
	foreach($myterms as $term){
		$active = "fade";
		if($contador == 0){
			$active =" active in active";
		}
		$contenido .= '<div class="tab-pane  panelmarcasme '.$active.'" id="tab'.$term->slug.'"><ul>';

		$subargs=array('hide_empty'=>false,'orderby'=>'name','child_of'=>$term->term_id); 
		$subterms=get_terms($taxonomy, $subargs); 
		if(is_array($subterms)){
			foreach ($subterms as $subterm){
				$contenido .= '<li><a href="'.get_term_link ( $subterm->term_id, 'product_cat' ).'">'. $subterm->name .'</a> <span class="badge">'. $subterm->count .' <span></li>';
			}
		}
					  
		$contenido .= '</ul></div>';
		$contador++;
	}
	$contenido .= '</div>';

	$contenido .= '</div><!-- //row -->
	</div><!-- blok-body // -->
	</section><!-- // blok -->
	<!-- TABS PRESENTATION // -->';


	

	return $contenido;
}


function menumarcas(){
	$contenido = "";

	$taxonomy="pwb-brand";
	$args=array('hide_empty'=>false,'orderby'=>'name','order'=>'ASC','parent'=>0);
	$myterms = get_terms($taxonomy, $args);
	//$misvars=array_merge($wp_query->query,$_GET,$_POST);
        
    $contenido .= '<!-- TABS PRESENTATION -->
	<section class="blok panelmenu">
	<div class="blok-body">
	<div class="row">
	<!-- Nav tabs -->';

	$contador = 0;
    $contenido .= '<ul class="nav tab-menu nav-pills col-sm-4 nav-stacked pr15 ">'; 

	foreach($myterms as $term){
		$active = "";
		if($contador == 0){
			$active="active";
		}

		$brand_link = get_term_link ( $term->term_id, 'pwb-brand' );
        $attachment_id = get_term_meta( $term->term_id, 'pwb_brand_image', 1 );

		$contenido .= '<li class="'.$active.' imgtab" data-toggle="tab"><a  href="#tab'.$term->slug.'" alt='.$term->name.'>';
		$contenido .= wp_get_attachment_image( $attachment_id, 'thumbnail' );
		$contenido .= '</a></li>';
		$contador++;
	}
	$contenido .= '</ul>';


	$contador = 0;
	$contenido .='<!-- Tab panes --><div class="tab-content col-sm-8">';
	foreach($myterms as $term){
		$active = "fade";
		if($contador == 0){
			$active =" active in active";
		}
		$contenido .= '<div class="tab-pane panelmarcasme '.$active.'" id="tab'.$term->slug.'"><ul>';

		$catenmarks = get_tax_taxs('pwb-brand', 'product_cat',$term->slug);
		//$contenido .= var_export($catenmarks, true);
		//$contenido.=$catenmarks;
		
		if(is_array($catenmarks)){
			if(sizeof($catenmarks)>0){
				$count = 0;
				foreach ($catenmarks as $subterm){
					//$contenido .= $catenmarks[$count]->tag_name;
					//$contenido .= var_export($subterm, true); $contenido .= "<br><br>";
					//$contenido .= '<li><a href="'.get_term_link ( $subterm->tag_id, 'product_cat' ).'">'. $subterm->tag_name .'</a> <span class="badge"> <span></li>';
					$contenido .= '<li><a href="'.$catenmarks[$count]->tag_link.'">'. $catenmarks[$count]->tag_name .'</a></li>';
					
					$count++;
				}
			}
			
		}
					  
		$contenido .= '</ul></div>';
		$contador++;
	}
	$contenido .= '</div>';

	$contenido .= '</div><!-- //row -->
	</div><!-- blok-body // -->
	</section><!-- // blok -->
	<!-- TABS PRESENTATION // -->';


	

	return $contenido;
}






/** CARRITO
 * Add Cart icon and count to header if WC is active
 */
function my_wc_cart_count() {
 
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
        $count = WC()->cart->cart_contents_count;
        ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
        if ( $count > 0 ) {
            ?>
            <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
            <?php
        }
                ?></a><?php
    }
 
}
add_action( 'your_theme_header_top', 'my_wc_cart_count' );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function my_header_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
    if ( $count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
        <?php            
    }
        ?></a><?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );


//$args = array('categories' => '12,13,14');
//$tags = get_category_tags($args);
function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results
	("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
		FROM
			wp_posts as p1
			LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

			wp_posts as p2
			LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name
	");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}

function get_tax_taxs($tax1, $tax2,$slug) {
	global $wpdb;
	$prefijo =  $wpdb->prefix;
	$consultat = "
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
		FROM
			".$prefijo."posts p1
			LEFT JOIN ".$prefijo."term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN ".$prefijo."term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN ".$prefijo."terms as terms1 ON t1.term_id = terms1.term_id,

			".$prefijo."posts p2
			LEFT JOIN ".$prefijo."term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN ".$prefijo."term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN ".$prefijo."terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = '$tax1' AND p1.post_status = 'publish' AND terms1.slug = '$slug' AND
			t2.taxonomy = '$tax2' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name
	";
	//var_dump($prefijo);
	//var_dump($consultat);
	$tags = $wpdb->get_results($consultat);
	$count = 0;
	if (count($tags)> 0){
			foreach ($tags as $tag) {
				$tags[$count]->tag_link = get_tag_link($tag->tag_id);
				$count++;
			}
		}
	
	
	return $tags;
}







function cuandosecrea_unblog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
	
	$latitud = get_user_meta($user_id,'latitud',true);
	$longitud = get_user_meta($user_id,'longitud',true);
	$descripcion = get_user_meta($user_id,'descripcion',true);
	$foto = get_user_meta($user_id,'foto',true);


	$telefono = get_user_meta($user_id,'telefono',true);
	$telefono2=get_user_meta($user_id,'telefono2',true);
	$telefono3=get_user_meta($user_id,'telefono3',true);

	$telefono2wha=get_user_meta($user_id,'telefono2wha',true);
	$telefono3wha =get_user_meta($user_id,'telefono3wha',true);




	$configuracion["tlatitud"]=$latitud;
	$configuracion["tlongitud"]=$longitud;
	$configuracion["ttelefono"]=$telefono;
	$configuracion["tdesc"]=$descripcion;
	$configuracion["tfoto"]=$foto;
	$configuracion["ttelefono2"]=$telefono2;
	$configuracion["ttelefono3"]=$telefono3;
	$configuracion["ttelefono2wha"]=$telefono2wha;
	$configuracion["ttelefono3wha"]=$telefono3wha;
	update_blog_option($blog_id,'blog_globalid', $configuracion);

	update_blog_option($blog_id,'ns-code-add-prod-sale-price', 'on');
	update_blog_option($blog_id,'ns-code-add-prod-gallery', 'on');

	

	switch_to_blog( $blog_id );
    switch_theme('subtiendam4'); 

    // Create post object
	 $editpage_post = array(
	   'post_title'    => 'Agregar/Editar Producto',
	   'post_name'     => 'agregar',
	   'post_content'  => '[ns-add-product][ns-edit-product]',
	   'post_status'   => 'publish',
	   'post_type' => 'page'
	 );

	 // Insert the post into the database
	wp_insert_post( $editpage_post );

	// Create post object
	 $editpage_post2 = array(
	   'post_title'    => 'Modificar Tienda',
	   'post_name'     => 'modificar',
	   'post_content'  => '[ns-add-product][ns-edit-product]',
	   'post_status'   => 'publish',
	   'post_type' => 'page'
	 );

	 // Insert the post into the database
	wp_insert_post( $editpage_post2 );
	
    restore_current_blog();
}
add_action( 'wpmu_new_blog', 'cuandosecrea_unblog', 10, 6 );


function activate_user_and_blog( $domain, $path, $title, $user, $user_email, $key, $meta ) {
  // Activate website right blog registration
  $blogID = wpmu_activate_signup($key);

  // Get the URL of the new blog
  $blogURL = get_blogaddress_by_id($blogID['blog_id']);


  

  // Redirect the user to their blog Dashboard
  //wp_redirect(trailingslashit($blogURL));

  // wp_redirect( home_url() );  // Redirect to home page
  exit;
}
add_filter('wpmu_signup_blog_notification', 'activate_user_and_blog', 10, 7 );


function auto_login( $user ) {
    $username = $user;
    if ( !is_user_logged_in() ) {
        $user = get_userdatabylogin( $username );
        $user_id = $user->ID;
        wp_set_current_user( $user_id, $user_login );
        wp_set_auth_cookie( $user_id );
        do_action( 'wp_login', $user_login );
    }
}