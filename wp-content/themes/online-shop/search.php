<?php

/**

 * The template for displaying search results pages.

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result

 *

 * @package Acme Themes

 * @subpackage Online Shop

 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">

	

			<header class="page-header">

				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'online-shop' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

			</header><!-- .page-header -->

			<a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&ordenar=precio">Ordenar por precio</a>

			<a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&ordenar=titulo">Ordenar Por nombre</a>

<br>

			<?php
$tiendas = [];
				$current_page = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // or $wp_query->query['paged']



	/*$consultameta = array(
            array(
                'key' => '_price',
                'value' => '5',
                'compare' => '>='
            ),
            array(
                'key' => '_price',
                'value' => '40',
                'compare' => '<='
            )
        );*/

	/*$meta_query[] = array(
        'key'     => '_regular_price',
        'value'   => array(
            5 ,
            40
        ),
        'compare' => 'BETWEEN',
        'type'=> 'NUMERIC'
    );

    $meta_query[] = array(
        'key'     => '_sale_price',
        'value'   => array(
            5 ,
            40
        ),
        'compare' => 'BETWEEN',
        'type'=> 'NUMERIC'
    );*/

    if(isset($_GET['pdesde']) and isset($_GET['phasta'])){

    	 /*$meta_query = array(
	    	'relation' => 'OR',
	    	'queryone' => array(
		        'key'     => '_regular_price',
		        'value'   => array(
		            $_GET['pdesde'] ,
		            $_GET['phasta']
		        ),
		        'compare' => 'BETWEEN',
		        'type'=> 'NUMERIC'
		    ),
		    'querytwo' => array(
		        'key'     => '_sale_price',
		        'value'   => array(
		            $_GET['pdesde'] ,
		            $_GET['phasta']
		        ),
		        'compare' => 'BETWEEN',
		        'type'=> 'NUMERIC'
		    )
	    );*/


	    $meta_query = array(
	    	'relation' => 'OR',
	    	'queryone' => array(
		        'key'     => '_regular_price',
		        'value'   => array(
		            $_GET['pdesde'] ,
		            $_GET['phasta']
		        ),
		        'compare' => 'BETWEEN',
		        'type'=> 'NUMERIC'
		    ),
		    'querytwo' => array(
		        'key'     => '_sale_price',
		        'value'   => array(
		            $_GET['pdesde'] ,
		            $_GET['phasta']
		        ),
		        'compare' => 'BETWEEN',
		        'type'=> 'NUMERIC'
		    )
	    );

    }

   

   
	
$args = array(
	's' => $_GET['s'], 
	'meta_query' => $meta_query,
	'posts_per_page' => get_option('paged'),
	'paged'	=> $current_page,
	'orderby' => 'meta_value_num',
	'meta_key'       => '_price',
    'order'          => 'asc'


);


$args['orderby']='title';

$args['order'] = 'DESC';
/*
'orderby' => 'meta_value_num',

'orderby' => array( 
		'querytwo' => 'DESC',
        'queryone' => 'DESC',
        
    ),

	'meta_key'       => '_price',
    'order'          => 'desc'




*/
			 ?>





			 <?php

			$network_q_posts = network_query_posts($args);

		 
		// run the loop
		foreach( $network_q_posts as $network_q_post ) :
		 
			// we need it to work with get_the_post_thumbnail() and get_permalink()
			switch_to_blog( $network_q_post->BLOG_ID );
			
			array_push($tiendas, $network_q_post->BLOG_ID);
		 
			//echo '<li>' . get_the_post_thumbnail( $network_q_post->ID ) . '<a href="' . get_permalink( $network_q_post->ID ) . '">' . $network_q_post->post_title . '</a></li>';


			echo '<div class="favoproduc my-inline-block-class">';
			echo '<a href="'.get_permalink( $network_q_post->ID ) .'">';
			echo  '<div>'. get_the_post_thumbnail( $network_q_post->ID ).'</div>';

			echo do_shortcode('[favorite_button post_id="'.$network_q_post->ID.'" site_id="'.$network_q_post->BLOG_ID .'" ]');


			global $woocommerce;
			$currency = get_woocommerce_currency_symbol();
			$price = get_post_meta($network_q_post->ID, '_regular_price', true);
			$sale = get_post_meta( $network_q_post->ID, '_sale_price', true);
			?>
			
			<?php if($sale) : ?>
			<p class="product-price-tickr"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></p>    
			<?php elseif($price) : ?>
			<p class="product-price-tickr"><?php echo $currency; echo $price; ?></p>    
			<?php endif; ?>
			
			<?php
			echo '<div class="conte"><strong>'.$network_q_post->post_title .'</strong><br>';
			echo '<small>Tienda: <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></small>';

			

			echo '</a></div>';

			
			echo '</div>';
		 
			// switch back
			restore_current_blog();
		endforeach;
		 
		// we should change the global $wp_query value to work correctly with pagination
		$wp_query = $GLOBALS['network_query'];
		 
		// I use the popular WP PageNavi plugin
		//wp_pagenavi();
		 
		// reset the $wp_query
		wp_reset_query();
			 
		

		 ?>

		 	

		 <?php
$configuracion = get_option( 'blog_globalid' ); 

		echo '<button class="collapsible active">Tiendas donde se encuentra el producto</button>
				<div class="content" style="display:block">';
		echo '<div id="mapapers" style="width:100%; height:400px;"></div>';
		echo '</div>';
		echo '	    <script>
			      var mapapers;
			       mapapers = new google.maps.Map(document.getElementById("mapapers"), {
			          center: {lat: '.$configuracion["tlatitud"].', lng: '.$configuracion["tlongitud"].'},
			          zoom: 14,
			          zoomControl: true,
			          mapTypeControl: true,
			          scaleControl: true
			        });

			        var bounds = new google.maps.LatLngBounds();
			      ';


			?>


<?php
				$contador=0;
		if ( function_exists( 'get_sites' ) && class_exists( 'WP_Site_Query' ) ) {
		    $sites = get_sites();
		    foreach ( $sites as $site ) {

		    	/*var_dump($site);
		    	echo '<br>hola';
		    	var_dump($tiendas);*/

		    	if(in_array($site->blog_id, $tiendas)){
		    	

			        switch_to_blog( $site->blog_id );
			   

			        


			        if(sizeof($network_q_posts) > 0){

			        	$configuracion = get_option( 'blog_globalid' ); 


						

						?>

						var infowindow<?php echo $contador; ?> = new google.maps.InfoWindow({
						    content: '<?php /*echo get_the_post_thumbnail($favo, 'thumbnail');*/
						    echo '<div class="conteglobo">';
						    echo '<h4>'.get_bloginfo('name').'</h4>';
						     if($configuracion['tfoto'] != ""){
							echo '<img class="imgap" src="'.$configuracion['tfoto'].'" style="height:100px; width:auto;">';
						} else{ echo '<img class="imgap" src="'.plugin_dir_url( __FILE__ ).'/nophoto.jpg" style="height:100px; width:auto;">'; }  
						if($configuracion['tdesc'] != ""){
							//$test = json_encode($configuracion['tdesc']);
							$test = esc_js($configuracion['tdesc']);
							$test = str_replace('\n\n', '<br>', $test);
							echo '<div class="desctienda">'.$test.'</div>';
						}
						
						echo '<p><strong>Favoritos: </strong>';



						foreach( $network_q_posts as $network_q_post ) {
							if($network_q_post->BLOG_ID == $site->blog_id) {
								echo '<a href="'.get_the_permalink($network_q_post->ID).'">'.$network_q_post->post_title.'</a>, ';
							}
						}
						
						echo '<p></div>';
						 ?>'
						  });

						  var pos = {lat: <?php echo $configuracion["tlatitud"]; ?>, lng: <?php echo $configuracion["tlongitud"]; ?>};


						  var marker<?php echo $contador; ?> = new google.maps.Marker({
						    position: pos,
						    map: mapapers,
						    title: '<?php echo $title; ?>'
						  });
						  marker<?php echo $contador; ?>.addListener('click', function() {
						    infowindow<?php echo $contador; ?>.open(mapapers, marker<?php echo $contador; ?>);
						  });		


						  loc = new google.maps.LatLng(<?php echo $configuracion["tlatitud"]; ?>,  <?php echo $configuracion["tlongitud"]; ?>);
						  bounds.extend(loc);


						<?php
			        }




			        $contador++;
			        restore_current_blog();

		        }
		    }
		 }


		
		?>







		<?php


		echo '</script>';

		
		
?>
<?php if(1==2){ ?>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */

            while ( have_posts() ) : the_post();

				/**

				 * Run the loop for the search to output the results.

				 * If you want to overload this in a child theme then include a file

				 * called content-search.php and that will be used instead.

				 */

				get_template_part( 'template-parts/content', get_post_format() );

            endwhile;

            the_posts_navigation();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif; ?>
  <?php } ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php

get_sidebar( 'left' );

get_sidebar();

get_footer();