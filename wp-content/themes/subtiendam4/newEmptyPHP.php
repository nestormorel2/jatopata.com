<?php
/**
 * Plugin Name: Addon de mapa y listado de favoritos
 * Plugin URI: http://ereerea.com
 * Description: Este plugin agrega caracteristicas de mapa al plugin favoritos, desarrollado para Daniel Coronel
 * Version: 1.0.0
 * Author: Jorge Veron, Daniel Coronel
 * Author URI: http://jveron.com
 * License: GPL2
 */



//use ..\Favorites\Entities\User\UserFavorites;

include('includes/funciones.php');
//('latest-posts.php');
//include('consultagral.php');


add_action( 'woocommerce_shop_loop_item_title', 'botonfunc', 10 );

function botonfunc(){
	echo '';
	the_favorites_button();
}

/**
 * Adds ListAdofav_widget widget.
 */
class ListAdofav_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'listadofav_widget', // Base ID
			esc_html__( 'Listado Favoritos Intersit.', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Listado de Favoritos', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
//		echo esc_html__( 'Hello, World!', 'text_domain' );
//		echo '<br><br>';






		// su doc es HERMOSA https://favoriteposts.com/

		/**
		* Get an array of User Favorites
		* @param $user_id int, defaults to current user
		* @param $site_id int, defaults to current blog/site
		* @param $filters array of post types/taxonomies
		* @return array
		*/

		echo '<div class="posicarrou">';

		if ( function_exists( 'get_sites' ) && class_exists( 'WP_Site_Query' ) ) {
		    $sites = get_sites(array('orderby'=>'id','order'=>'DESC'));
		    foreach ( $sites as $site ) {
		    	$listafavoritos = get_user_favorites(null, $site->blog_id, array('product'));

				//var_dump($listafavoritos);

		        switch_to_blog( $site->blog_id );
		        //echo $site->blog_id;

		        foreach($listafavoritos as $favo){
		        	//var_dump($favo);
		        	//$post = get_post($favo); 
					//$title = $post->post_title;
					$configuracion = get_option( 'blog_globalid' ); 


					$title = get_the_title($favo);
					echo '<div class="favoproduc my-inline-block-class">';
					echo '<a href="'.get_the_permalink($favo).'">';
					echo  '<div>'.get_the_post_thumbnail($favo, 'thumbnail').'</div>';

					echo do_shortcode('[favorite_button post_id="'.$favo.'" site_id="'.$site->blog_id.'" ]');

					echo '<div class="conte"><strong>'.$title.'</strong><br>';
					echo '<small>Tienda: <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></small>';

					//echo $configuracion["tlatitud"];
					//echo $configuracion["tlongitud"];

					echo '</a></div>';

					
					echo '</div>';
					
		        }

		        restore_current_blog();

		        
		    }
		 }  


		 echo '</div>';



		 ?>
		 
		 <?php

		 echo '<br><br><br>';

		

		/**
		* HTML List of User Favorites
		* @param $user_id int, defaults to current user
		* @param $site_id int, defaults to current blog/site
		* @param $include_links bool, whether to wrap the post title with the permalink
		* @param $filters array of post types/taxonomies
		* @param $include_button boolean, whether to include the favorite button for each item
		* @param $include_thumbnails boolean, whether to include the thumbnail for each item
		* @param $thumbnail_size string, the thumbnail size to display
		* @param $include_excerpt boolean, whether to include the excerpt for each item
		* @return html
		*/
		//get_user_favorites_list($user_id = null, $site_id = null, $include_links = false, $filters = null, $include_button = false, $include_thumbnails=false, $thumbnail_size='thumbnail', $include_excerpt=false);

		/**
		* Echo HTML List of User Favorites
		* @param $user_id int, defaults to current user
		* @param $site_id int, defaults to current blog/site
		* @param $include_links bool, whether to wrap the post title with the permalink
		* @param $filters array of post types/taxonomies
		* @param $include_button boolean, whether to include the favorite button for each item
		* @param $include_thumbnails boolean, whether to include the thumbnail for each item
		* @param $thumbnail_size string, the thumbnail size to display
		* @param $include_excerpt boolean, whether to include the excerpt for each item
		* @return html
		*/
		//the_user_favorites_list($user_id = null, 2, true, array('post_type' => 'product'),true, true, 'thumbnail', false);

		//echo do_shortcode('[user_favorites separator=. site_id= 2  include_thumbnails=true include_buttons=true ]');


		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class ListAdofav_widget


// register ListAdofav_widget widget
function register_listadofav_widget() {
    register_widget( 'ListAdofav_widget' );
}
add_action( 'widgets_init', 'register_listadofav_widget' );
































/**
 * Adds ListAdotiendas_widget widget.
 */
class ListAdotiendas_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'listadotiendas_widget', // Base ID
			esc_html__( 'Listado Tiendas', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Listado de Favoritos', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
//		echo esc_html__( 'Hello, World!', 'text_domain' );
//		echo '<br><br>';






		// su doc es HERMOSA https://favoriteposts.com/

		/**
		* Get an array of User Favorites
		* @param $user_id int, defaults to current user
		* @param $site_id int, defaults to current blog/site
		* @param $filters array of post types/taxonomies
		* @return array
		*/

		echo '<div class="posicarrou">';
		if ( function_exists( 'get_sites' ) && class_exists( 'WP_Site_Query' ) ) {
		    $sites = get_sites(array('orderby'=>'id','order'=>'DESC'));
		    foreach ( $sites as $site ) {

		    	//var_dump($site);
		    	

		        switch_to_blog( $site->blog_id );

		        $configuracion = get_option( 'blog_globalid' ); 
		        echo '<div class="favoproduc my-inline-block-class">';
					echo '<a href="'.get_bloginfo('url').'">';
					 echo '<h4>'.get_bloginfo('name').'</h4>';
					echo '<img class="imgap" src="'.$configuracion['tfoto'].'" style="height:100px; width:auto;">';

					if($configuracion['tdesc'] != ""){
							//$test = json_encode($configuracion['tdesc']);
							$test = esc_js($configuracion['tdesc']);
							$test = str_replace('\n\n', '<br>', $test);
							echo '<div class="desctienda">'.$test.'</div>';
						}

					
					//echo '<small>Tienda: <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></small>';


					echo '</a>';

					
					echo '</div>';
		       

		        

		        restore_current_blog();

		        
		    }
		 }  
		 echo '</div>';



		 ?>
		 
		 <?php

		 echo '<br><br><br>';

		

		/**
		* HTML List of User Favorites
		* @param $user_id int, defaults to current user
		* @param $site_id int, defaults to current blog/site
		* @param $include_links bool, whether to wrap the post title with the permalink
		* @param $filters array of post types/taxonomies
		* @param $include_button boolean, whether to include the favorite button for each item
		* @param $include_thumbnails boolean, whether to include the thumbnail for each item
		* @param $thumbnail_size string, the thumbnail size to display
		* @param $include_excerpt boolean, whether to include the excerpt for each item
		* @return html
		*/
		//get_user_favorites_list($user_id = null, $site_id = null, $include_links = false, $filters = null, $include_button = false, $include_thumbnails=false, $thumbnail_size='thumbnail', $include_excerpt=false);

		/**
		* Echo HTML List of User Favorites
		* @param $user_id int, defaults to current user
		* @param $site_id int, defaults to current blog/site
		* @param $include_links bool, whether to wrap the post title with the permalink
		* @param $filters array of post types/taxonomies
		* @param $include_button boolean, whether to include the favorite button for each item
		* @param $include_thumbnails boolean, whether to include the thumbnail for each item
		* @param $thumbnail_size string, the thumbnail size to display
		* @param $include_excerpt boolean, whether to include the excerpt for each item
		* @return html
		*/
		//the_user_favorites_list($user_id = null, 2, true, array('post_type' => 'product'),true, true, 'thumbnail', false);

		//echo do_shortcode('[user_favorites separator=. site_id= 2  include_thumbnails=true include_buttons=true ]');


		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class ListAdotiendas_widget


// register ListAdotiendas_widget widget
function register_listadotiendas_widget() {
    register_widget( 'ListAdotiendas_widget' );
}
add_action( 'widgets_init', 'register_listadotiendas_widget' );















/**
 * Adds ListAdofav_widget widget.
 */
class ListAdogral_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'listadogral_widget', // Base ID
			esc_html__( 'Listado Productos Intersit.', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Listado de Favoritos', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
//		echo esc_html__( 'Hello, World!', 'text_domain' );
//		echo '<br><br>';

		?>
		<?php

		$args = array(
				'posts_per_page' => 14,
				'post_type' => 'product',
				'order' => 'desc'
				// all WP_Query arguments are supported including meta_query, tax_query etc.
			);


		global $wp_query;
 
		// get the current page number from $wp_query, I mean the URL parameter, i.e. /page/2
		//$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1; // you can use $wp_query->query['paged'] as well
		 
		// similiar to query_posts()
		//$network_q_posts = network_query_posts( array('posts_per_page' => 3, 'paged' => $current_page) ); 

		$network_q_posts = network_query_posts($args);
		 
		echo '<div class="posicarrou">';
		// run the loop
		foreach( $network_q_posts as $network_q_post ) :
		 
			// we need it to work with get_the_post_thumbnail() and get_permalink()
			switch_to_blog( $network_q_post->BLOG_ID );
		 
			//echo '<li>' . get_the_post_thumbnail( $network_q_post->ID ) . '<a href="' . get_permalink( $network_q_post->ID ) . '">' . $network_q_post->post_title . '</a></li>';


			echo '<div class="favoproduc my-inline-block-class">';
						echo '<a href="'.get_permalink( $network_q_post->ID ) .'">';
						echo  '<div>'. get_the_post_thumbnail( $network_q_post->ID ).'</div>';

						echo do_shortcode('[favorite_button post_id="'.$network_q_post->ID.'" site_id="'.$network_q_post->BLOG_ID .'" ]');

						echo '<div class="conte"><strong>'.$network_q_post->post_title .'</strong><br>';
						echo '<small>Tienda: <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></small>';

						

						echo '</a></div>';

						
						echo '</div>';
		 
			// switch back
			restore_current_blog();
		endforeach;

		echo '</div>';
		 
		// we should change the global $wp_query value to work correctly with pagination
		$wp_query = $GLOBALS['network_query'];
		 
		// I use the popular WP PageNavi plugin
		//wp_pagenavi();
		 
		// reset the $wp_query
		wp_reset_query();
			 
		


        ?>
             <?php 


		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class ListAdofav_widget


// register ListAdofav_widget widget
function register_listadogral_widget() {
    register_widget( 'ListAdogral_widget' );
}
add_action( 'widgets_init', 'register_listadogral_widget' );
















/**
 * Adds MapaFav_widget widget.
 */
class MapaFav_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		

		parent::__construct(
			'mapafav_widget', // Base ID
			esc_html__( 'Favoritos Map Inters.', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Mapa de Favoritos', 'text_domain' ), ) // Args
		);

		
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			//echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		//echo esc_html__( 'Hello, World!', 'text_domain' );

		$configuracion = get_option( 'blog_globalid' ); 

		?>
		<form class="container-fluid" action="<?php bloginfo('url') ?>" method="GET">
			
			<div class="row">
				<div class="col-md-6" style="width: 31%;  display: inline-block; vertical-align: top; margin-right: 20px;">
			<input type="text" style="width: 100%; " id="interbusca" name="s" />
	
				</div>
				<div class="col-md-6"  style="width: 31%; display: inline-block;  vertical-align: top;margin-right: 20px;">
			<div id="slider"></div>
			<input type="number" name="pdesde" id="pdesde" placeholder="Desde Gs" />
	<input type="number" name="phasta" id="phasta" placeholder="Hasta Gs" />
				</div>
				<div class="col-md-6"  style="width: 31%; display: inline-block;  vertical-align: top">
					<button>Buscar entre todos los productos</button>
					<button type="button" id="buscarajx">Buscar2</button>
				</div>
			</div>
			

	

	<script>
		var html5Slider = document.getElementById('slider');

		noUiSlider.create(html5Slider, {
		    start: [0, 60000],
		    connect: true,
		    step: 5000,
		    range: {
		        'min': 0,
		        'max': 150000
		    }
		});



		var inputNumber = document.getElementById('pdesde');
		var inputNumber2 = document.getElementById('phasta');

		html5Slider.noUiSlider.on('update', function (values, handle) {

		    var value = values[handle];

		    if (handle) {
		        inputNumber2.value = value;
		    } else {
		        inputNumber.value = value;
		    }
		});

		inputNumber.addEventListener('change', function () {
		    html5Slider.noUiSlider.set([this.value, null]);
		});

		inputNumber2.addEventListener('change', function () {
		    html5Slider.noUiSlider.set([null, this.value]);
		});



	</script>
	
</form>

		<?php


		echo '<button class="collapsible active">Mostrar Mapa de Favoritos Elegidos</button>
				<div class="content" style="display:block">';
		echo '<div id="mapapers" style="width:100%; height:400px;"></div>';
		echo '</div>';

		echo '<div id="resultadobus"></div>';


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
		
			    
		//echo '//initMap2()';

		$contador=0;
		if ( function_exists( 'get_sites' ) && class_exists( 'WP_Site_Query' ) ) {
		    $sites = get_sites();
		    foreach ( $sites as $site ) {
		    	$listafavoritos = get_user_favorites(null, $site->blog_id, array('post_type' => 'product'));

			

		        switch_to_blog( $site->blog_id );
		   

		        


		        if(sizeof($listafavoritos) > 0){

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
					foreach($listafavoritos as $favo){
						$title = get_the_title($favo);

						echo '<a href="'.get_the_permalink($favo).'">'.$title.'</a>, ';
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


		
		?>

		mapapers.fitBounds(bounds);

		var coll = document.getElementsByClassName("collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
		  coll[i].addEventListener("click", function() {
		    this.classList.toggle("active");
		    var content = this.nextElementSibling;
		    if (content.style.display === "block") {
		      content.style.display = "none";
		    } else {
		      content.style.display = "block";
		    }
		  });
		}
		<?php

		echo '</script>';
		//echo '<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>';



		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

	



} // class MapaFav_widget

// register MapaFav_widget widget
function register_mapafav_widget() {
    register_widget( 'MapaFav_widget' );
}
add_action( 'widgets_init', 'register_mapafav_widget' );


function my_styles_method() {
			wp_enqueue_style(
				'custom-style',
				get_template_directory_uri() . '/css/custom_script.css'
			);
		        //$color = get_theme_mod( 'my-custom-color' ); //E.g. #FF0000
		        $custom_css = "
		                .collapsible {
						    background-color: #777;
						    color: white;
						    cursor: pointer;
						    padding: 18px;
						    width: 100%;
						    border: none;
						    text-align: center;
						    outline: none;
						    font-size: 15px;
						    text-transform:uppercase;
						    font-weight:bold;
						}

						.active, .collapsible:hover {
						    background-color: #555;
						}

						.content {
						    padding: 0;
						    display: block;
						    overflow: hidden;
						    background-color: #f1f1f1;
						}

						.imgap{
							float:left;
							margin-right:10px;
							margin-bottom:10px;
						}
						.conteglobo{
							min-width:450px;
						}
						.desctienda{
							
						}

						.favoproduc{
							display:inline-block; 
							max-width:150px;
							border:solid 1px #CCC;
							 margin-left:8px;
							vertical-align:top;
							 text-align:center;
							 position:relative;
							 margin-bottom:20px;
						}

						.widget_listadofav_widget .widgettitle{
							margin-top:45px;
						}

						@media screen and (max-width: 600px) {
						  .favoproduc{
						  	width:100%;
						  	max-width:100%;
						  }

						  .conteglobo{
							min-width:100px;
						}
						}

						.favoproduc .conte{
							 /*min-height:135px;*/
							 padding:14px;
						}

						.favoproduc .simplefavorite-button{
							margin-top:12px;
						}

						.imgbus{
							height:auto;
							width:78px;
							display:inline-block;
							vertical-align:top;
							margin-right:8px;
						}
						.datosbus{
							display:inline-block;
							vertical-align:top;
						}
						";
		        wp_add_inline_style( 'custom-style', $custom_css );
		}

add_action( 'wp_enqueue_scripts', 'my_styles_method' );

add_action('wp_enqueue_scripts','google_maps_script_loader');



function google_maps_script_loader() {
    global $wp_scripts; $gmapsenqueued = false;
    foreach ($wp_scripts->registered as $key => $script) {
        if (preg_match('#maps\.google(?:\w+)?\.com/maps/api/js#', $script->src)) {
            $gmapsenqueued = true;
        }
    }

    if ($gmapsenqueued) {
        //wp_enqueue_script('custom-gmap', plugin_dir_url( __FILE__ ).'inc/js/gmap.js', array('jquery'), false, true);
    } else {
    	$configuracion = get_option( 'blog_globalid' ); 
		
        wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key='.$configuracion["tgapi"].'', array('jquery'), false, false);
    }
}


add_action('wp_enqueue_scripts','sliderloader');

function sliderloader(){
	 wp_enqueue_script('nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/12.1.0/nouislider.min.js', array(), false, false);
	 wp_enqueue_style(
				'nouislidercss',
				'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/12.1.0/nouislider.min.css'
			);

}


//add_action('wp_enqueue_scripts','favocarousel');

add_action( 'wp_enqueue_scripts', 'favocarousel' );

function favocarousel(){

	
	$codigo = '
	    jQuery(document).ready(function () {
	  
	  var checkWidth = jQuery(document).width();
	  
	  if(checkWidth <=600){
	    jQuery(".posicarrou").owlCarousel({
	        autoplay: true,
	        pagination: true,
	        navigation: true,
	        navigationText: ["Anterior", "Siguiente"]
	    });
	  } else {
	  	(function($, window) {
			    var $ls;
			    function autoheight() {
			        var max = 0;
			        $ls.each(function() {
			            $t = $(this);
			            $t.css("height","");
			            max = Math.max(max, $t.height());
			        });
			        $ls.height(max);
			    }
			    $(function() {
			        $ls = $(".my-inline-block-class"); // the inline-block selector
			        autoheight(); // first time
			        $ls.on("load", autoheight); // when images in content finish loading
			        $(window).load(autoheight); // when all content finishes loading
			        $(window).resize(autoheight); // when the window size changes
			    });
			})(jQuery, window);
	  }
	  
	});';

	wp_enqueue_style(
				'owl',
				'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'
			);
	wp_enqueue_style(
				'owlstyle',
				'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.css'
			);

	wp_enqueue_script('owlcarousel', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array(), false, false);
	wp_add_inline_script( 'owlcarousel', $codigo );




	


	wp_enqueue_style(
				'jqueryuistyle2',
				'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
			);



	$codigo2 = '
 jQuery(document).ready(function () {

 	/*var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL"
    ];

    jQuery( "#interbusca" ).autocomplete({
      source: availableTags
    });*/

		jQuery( "#interbusca" ).autocomplete({
	      source: function( request, response ) {
	        jQuery.ajax( {
	          url: "'.get_bloginfo('url').'/wp-admin/admin-ajax.php?action=my_search",
	          dataType: "json",
	          data: {
	            term: request.term
	          },
	          success: function( data ) {
	            response( data );

	          }
	        } );
	      },
	      minLength: 2,
	      select: function( event, ui ) {
	        log( "Selected: " + ui.item.value + " aka " + ui.item.id );
	      }
	    } ).autocomplete( "instance" )._renderItem = function( ul, item ) {
	      return jQuery( "<li>" )
	        .append( "<div><img src=\""+ item.img  + "\" class=\"imgbus\" ><div class=\"datosbus\"><h3>"+ item.label + "</h3><p> " + item.precio1 +" </p></div>"  + "</div>" )
	        .appendTo( ul );
	    };

    });
    ';




    /*jQuery( "#interbusca" ).autocomplete({
	      source: function( request, response ) {
	        jQuery.ajax( {
	          url: "'.get_bloginfo('url').'/wp-admin/admin-ajax.php?action=my_search",
	          dataType: "json",
	          data: {
	            term: request.term
	          },
	          success: function( data ) {
	            response( data );

	          }
	        } );
	      },
	      minLength: 2,
	      select: function( event, ui ) {
	        log( "Selected: " + ui.item.value + " aka " + ui.item.id );
	      }

	    } );*/

	    $codigo3 = '
	     jQuery(document).ready(function () {

	     	var markersArray = [];

	     	function clearOverlays() {
			  if (markersArray) {
			    for (i in markersArray) {
			      markersArray[i].setMap(null);
			    }
			  }
			}
	     	
	    	jQuery( "#buscarajx" ).click(function() {
	    		buscarajax();
	    	});


	    	jQuery( "#interbusca" ).change(function() {
	    		buscarajax();
	    	});


	    	function buscarajax(){
			 	jQuery.ajax({
				      type: "POST",

				      url: "'.get_bloginfo("url").'/wp-admin/admin-ajax.php?action=busquedajax2",
				      data: { 
				          "term": jQuery("#interbusca").val(),
				          "pdesde": jQuery("#pdesde").val(),
				          "phasta": jQuery("#phasta").val()
				      },
				      success: function(msg){
				          jQuery("#resultadobus").html(msg.html);     

				          var bounds2 = new google.maps.LatLngBounds();

				          clearOverlays();


				           for (var i = 0; i < msg.data.length; i++) {

				           		//var infowindow = new google.maps.InfoWindow({
								//  content: msg.data[i].productos
								//});
				          		
				          		var datai = "<h3>" + msg.data[i].nombretienda + "</h3>" + msg.data[i].productos;

						        var pos = {lat: parseFloat(msg.data[i].latitud), lng: parseFloat(msg.data[i].longitud)};
						        var marker = new google.maps.Marker({
						          position: pos,
						          icon: "'.plugin_dir_url( __FILE__ ).'/placeholder.png",
						          animation: google.maps.Animation.DROP,
						          map: mapapers,
						          title: msg.data[i].nombretienda
						        });

						        markersArray.push(marker);

						        console.log(msg.data[i].nombretienda);

						        var infoWindow = new google.maps.InfoWindow();

						        //marker.addListener("click", function() {
						        //	infowindow.setContent(datai);
								 //   infowindow.open(mapapers, marker);
								 // });

								 google.maps.event.addListener(marker, "click", function(e) {
									infoWindow.setContent(datai);
									infoWindow.open(mapapers, marker);
								});


								(function(marker, datai) {

										// Attaching a click event to the current marker
										google.maps.event.addListener(marker, "click", function(e) {
										infoWindow.setContent(datai);
										infoWindow.open(mapapers, marker);
										});	

								})(marker, datai);



				          }

				      },
				       error: function (data) {       
				          
				          console.log("error al realizar el canje");    

				       },
				       beforeSend: function(){
				            //nada
				        }
				});
	    	}

	    }
			

		});';

	
	wp_enqueue_script('jquery-ui','https://code.jquery.com/ui/1.12.0/jquery-ui.min.js');
	wp_add_inline_script( 'jquery-ui', $codigo2 );
	wp_add_inline_script( 'jquery-ui', $codigo3 );
	
}








/**
 ____                          _                                    __ 
 |  _ \    __ _    __ _      __| |   ___      ___    ___    _ __    / _|
 | |_) |  / _` |  / _` |    / _` |  / _ \    / __|  / _ \  | '_ \  | |_ 
 |  __/  | (_| | | (_| |   | (_| | |  __/   | (__  | (_) | | | | | |  _|
 |_|      \__,_|  \__, |    \__,_|  \___|    \___|  \___/  |_| |_| |_|  
                  |___/                                                 
*/

/*------------------------------ configuracion de ubicacion de las tiendas -------------------------------- */


class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
      
		
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Ajustes de MultiTienda', 
            'publish_posts', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
/*
        add_options_page(
            'Settings Admin', 
            'Slider de Secciones', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );*/

    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {

    	add_action('admin_enqueue_scripts', 'media_uploader_enqueue');

        // Set class property
        $this->options = get_option( 'blog_globalid' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Configuraciones</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );   
                do_settings_sections( 'my-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'blog_globalid', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Configuraciones de Tienda', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

       /* add_settings_field(
            'globalselec', // ID
            'ID Number', // Title 
            array( $this, 'globalselec_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );    */

        add_settings_field(
            'tlatitud', 
            'Latitud', 
            array( $this, 'tlatitud_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        ); 

         add_settings_field(
            'tlongitud', 
            'Longitud', 
            array( $this, 'tlongitud_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );

         add_settings_field(
            'tfoto', 
            'Foto de la Tienda', 
            array( $this, 'tfoto_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        ); 


        add_settings_field(
            'tdesc', 
            'Descripcion de la Tienda', 
            array( $this, 'tdesc_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );   


         add_settings_field(
            'tgapi', 
            'Api Google Maps', 
            array( $this, 'tgapi_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );    
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        /*$new_input = array();
        if( isset( $input['globalselec'] ) )
            $new_input['globalselec'] = absint( $input['globalselec'] );

        if( isset( $input['sliderinfo'] ) )
            $new_input['sliderinfo'] = sanitize_text_field( $input['sliderinfo'] );

        return $new_input;*/
        return $input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'En esta area se definen las configuraciones personalizadas para las tiendas';
    }

    

    /** 
     * Get the settings option array and print one of its values
     */
    public function tlatitud_callback()
    {
    	$resultado = $this->options['tlatitud'];
    	echo '<input type="text" id="tlatitud" name="blog_globalid[tlatitud]" value="'. $resultado  .'"  >';
    }

    public function tlongitud_callback()
    {
    	$resultado = $this->options['tlongitud'];
    	echo '<input type="text" id="tlongitud" name="blog_globalid[tlongitud]" value="'. $resultado  .'"  >';
    }

    public function tfoto_callback()
    {
    	
    	 

    	$resultado = $this->options['tfoto'];
    	//echo '<input type="text" id="tfoto" name="blog_globalid[tfoto]" value="'. $resultado  .'"  >';
		wp_enqueue_media();

		if($resultado==""){
			$resultado="https://via.placeholder.com/150";
		}
    	?>
    	<input id="tfoto" type="text" name="blog_globalid[tfoto]" value="<?php echo $resultado ?>" />
		<input id="upload_image_button" type="button" class="button-primary" value="Elegir foto de tienda" /><br>
    	<img id="fotoselec" style="width:auto; height: 300px; margin-top: 15px;" src="<?php echo $resultado ?>">
    	 
    	<script>
    	jQuery(document).ready(function($){
		    	 var mediaUploader;
					  $('#upload_image_button').click(function(e) {
					    e.preventDefault();
					      if (mediaUploader) {
					      mediaUploader.open();
					      return;
					    }
					    mediaUploader = wp.media.frames.file_frame = wp.media({
					      title: 'Choose Image',
					      button: {
					      text: 'Choose Image'
					    }, multiple: false });
					    mediaUploader.on('select', function() {
					      var attachment = mediaUploader.state().get('selection').first().toJSON();
					      $('#tfoto').val(attachment.url);
					      $('#fotoselec').attr("src",attachment.url);
					    });
					    mediaUploader.open();
					});


				
			});
			</script>
			<?php
    }


    public function tdesc_callback()
    {
    	
    	 

    	$resultado = $this->options['tdesc'];
    	//echo '<input type="text" id="tfoto" name="blog_globalid[tfoto]" value="'. $resultado  .'"  >';
		wp_enqueue_media();

    	?>
    	<!--<input id="tdesc" type="text" name="blog_globalid[tdesc]" value="<?php echo $resultado ?>" />-->
    	<?php wp_editor( $resultado, 'tdesc', array('textarea_name' => 'blog_globalid[tdesc]') ); ?> 
		
    	<script>
    	jQuery(document).ready(function($){
		    	

				
			});
			</script>
			<?php
    }

     public function tgapi_callback()
    {
    	$resultado = $this->options['tgapi'];
    	echo '<input type="text" id="tgapi" name="blog_globalid[tgapi]" value="'. $resultado  .'"  >';
    }

    function media_uploader_enqueue() {
    	
    }
}

$my_settings_page = new MySettingsPage();

/*
global $enqueued_scripts;
global $enqueued_styles;

add_action( 'wp_print_scripts', 'cyb_list_scripts' );
function cyb_list_scripts() {
    global $wp_scripts;
    global $enqueued_scripts;
    $enqueued_scripts = array();
    foreach( $wp_scripts->queue as $handle ) {
        $enqueued_scripts[] = $wp_scripts->registered[$handle]->src;
    }
}
add_action( 'wp_print_styles', 'cyb_list_styles' );
function cyb_list_styles() {
    global $wp_styles;
    global $enqueued_styles;
    $enqueued_styles = array();
    foreach( $wp_styles->queue as $handle ) {
        $enqueued_styles[] = $wp_styles->registered[$handle]->src;
    }
}

add_action( 'wp_head', function() {
    global $enqueued_scripts;
    var_dump( $enqueued_scripts );
    global $enqueued_styles;
    var_dump( $enqueued_styles );
} );

*/



function my_search() {
	$args = array(
		'post_type' => 'product',
		's' => $_GET['term'],
		'orderby' => 'meta_value_num',
		'meta_key'       => '_price',
	    'order'          => 'asc'
	);

	$suggestions = array();
	
	$network_q_posts = network_query_posts($args);

	foreach( $network_q_posts as $network_q_post ) {
		switch_to_blog( $network_q_post->BLOG_ID );
		$suggestion = array();
			$suggestion['id'] = $network_q_post->ID;
			$suggestion['link'] = get_permalink( $network_q_post->ID );
			$suggestion['value'] = $network_q_post->ID;
			$suggestion['label'] = $network_q_post->post_title;
			$suggestion['img'] = get_the_post_thumbnail_url( $network_q_post->ID , 'thumbnail');

			global $woocommerce;
			$currency = get_woocommerce_currency_symbol();
			$price = get_post_meta($network_q_post->ID, '_price', true);
			//$sale = get_post_meta( $network_q_post->ID, '_sale_price', true);

			$suggestion['precio1'] = $currency + $price;
			//$suggestion['precio2'] = $currency + $sale; 



			$suggestions[] = $suggestion;
		restore_current_blog();

	}
		
	wp_reset_query();	
    	
	$response = json_encode( $suggestions );
	echo $response;
	exit();

}

add_action( 'wp_ajax_my_search', 'my_search' );
add_action( 'wp_ajax_nopriv_my_search', 'my_search' );




function busquedajax() {

	$tiendas = [];

    $meta_query = array(
    	'relation' => 'OR',
    	'queryone' => array(
	        'key'     => '_regular_price',
	        'value'   => array(
	            $_POST['pdesde'] ,
	            $_POST['phasta']
	        ),
	        'compare' => 'BETWEEN',
	        'type'=> 'NUMERIC'
	    ),
	    'querytwo' => array(
	        'key'     => '_sale_price',
	        'value'   => array(
	            $_POST['pdesde'] ,
	            $_POST['phasta']
	        ),
	        'compare' => 'BETWEEN',
	        'type'=> 'NUMERIC'
	    )
    );

    

    $args = array(
		'post_type' => 'product',
		's' => $_POST['term'],
		'meta_query' => $meta_query,
		'posts_per_page' => get_option('paged'),
		'paged'	=> $current_page,
		'orderby' => 'meta_value_num',
		'meta_key'       => '_price',
	    'order'          => 'asc'
	);

	$return_str = "";

	$network_q_posts = network_query_posts($args);

 
	// run the loop
	foreach( $network_q_posts as $network_q_post ) :
	 
		// we need it to work with get_the_post_thumbnail() and get_permalink()
		switch_to_blog( $network_q_post->BLOG_ID );
		
		array_push($tiendas, $network_q_post->BLOG_ID);
	 
		//$return_str .=  '<li>' . get_the_post_thumbnail( $network_q_post->ID ) . '<a href="' . get_permalink( $network_q_post->ID ) . '">' . $network_q_post->post_title . '</a></li>';


		$return_str .=  '<div class="favoproduc my-inline-block-class">';
		$return_str .=  '<a href="'.get_permalink( $network_q_post->ID ) .'">';
		$return_str .=   '<div>'. get_the_post_thumbnail( $network_q_post->ID ).'</div>';

		$return_str .=  do_shortcode('[favorite_button post_id="'.$network_q_post->ID.'" site_id="'.$network_q_post->BLOG_ID .'" ]');


		global $woocommerce;
		$currency = get_woocommerce_currency_symbol();
		$price = get_post_meta($network_q_post->ID, '_regular_price', true);
		$sale = get_post_meta( $network_q_post->ID, '_sale_price', true);
		
		if($sale) : 
			$return_str .= '<p class="product-price-tickr"><del>' .  $currency .  $price . '</del>'. $currency .  $sale;  
		elseif($price) : 
			$return_str .= '<p class="product-price-tickr">' . $currency . $price . '</p> ';   
		endif; 
		
		
		$return_str .=  '<div class="conte"><strong>'.$network_q_post->post_title .'</strong><br>';
		$return_str .=  '<small>Tienda: <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></small>';

		

		$return_str .=  '</a></div>';

		
		$return_str .=  '</div>';
	 
		// switch back
		restore_current_blog();
	endforeach;
	 
	// we should change the global $wp_query value to work correctly with pagination
	$wp_query = $GLOBALS['network_query'];
	 
	// I use the popular WP PageNavi plugin
	//wp_pagenavi();
	 
	// reset the $wp_query
	wp_reset_query();



	/*mapa */
	$configuracion = get_option( 'blog_globalid' ); 

		$return_str2 .= '<button class="collapsible active">Tiendas donde se encuentra el producto</button>
				<div class="content" style="display:block">';
		$return_str2 .= '<div id="mapapers" style="width:100%; height:400px;"></div>';
		$return_str2 .= '</div>';
		$return_str2 .= '	    <script>
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


	 echo $return_str . $return_str2;


	













	 echo '</script>';


	$html = $return_str;
	$data = json_encode(array('page_title'=>'My Page'));
	$response = array('html'=>$html, 'data'=>$data);

	//header('Content-Type: application/json');
	//echo json_encode($response);

    //echo $return_str . $return_str2;
    die;
}

add_action('wp_ajax_busquedajax', 'busquedajax');
add_action('wp_ajax_nopriv_busquedajax', 'busquedajax');


















function busquedajax2() {

	$tiendas = [];

    $meta_query = array(
    	'relation' => 'OR',
    	'queryone' => array(
	        'key'     => '_regular_price',
	        'value'   => array(
	            $_POST['pdesde'] ,
	            $_POST['phasta']
	        ),
	        'compare' => 'BETWEEN',
	        'type'=> 'NUMERIC'
	    ),
	    'querytwo' => array(
	        'key'     => '_sale_price',
	        'value'   => array(
	            $_POST['pdesde'] ,
	            $_POST['phasta']
	        ),
	        'compare' => 'BETWEEN',
	        'type'=> 'NUMERIC'
	    )
    );

    

    $args = array(
		'post_type' => 'product',
		's' => $_POST['term'],
		'meta_query' => $meta_query,
		'posts_per_page' => get_option('paged'),
		'paged'	=> $current_page,
		'orderby' => 'meta_value_num',
		'meta_key'       => '_price',
	    'order'          => 'asc'
	);

	$return_str = "";

	$network_q_posts = network_query_posts($args);

 
	// run the loop
	foreach( $network_q_posts as $network_q_post ) :
	 
		// we need it to work with get_the_post_thumbnail() and get_permalink()
		switch_to_blog( $network_q_post->BLOG_ID );
		
		array_push($tiendas, $network_q_post->BLOG_ID);
	 
		//$return_str .=  '<li>' . get_the_post_thumbnail( $network_q_post->ID ) . '<a href="' . get_permalink( $network_q_post->ID ) . '">' . $network_q_post->post_title . '</a></li>';


		$return_str .=  '<div class="favoproduc my-inline-block-class">';
		$return_str .=  '<a href="'.get_permalink( $network_q_post->ID ) .'">';
		$return_str .=   '<div>'. get_the_post_thumbnail( $network_q_post->ID ).'</div>';

		$return_str .=  do_shortcode('[favorite_button post_id="'.$network_q_post->ID.'" site_id="'.$network_q_post->BLOG_ID .'" ]');


		global $woocommerce;
		$currency = get_woocommerce_currency_symbol();
		$price = get_post_meta($network_q_post->ID, '_regular_price', true);
		$sale = get_post_meta( $network_q_post->ID, '_sale_price', true);
		
		if($sale) : 
			$return_str .= '<p class="product-price-tickr"><del>' .  $currency .  $price . '</del>'. $currency .  $sale;  
		elseif($price) : 
			$return_str .= '<p class="product-price-tickr">' . $currency . $price . '</p> ';   
		endif; 
		
		
		$return_str .=  '<div class="conte"><strong>'.$network_q_post->post_title .'</strong><br>';
		$return_str .=  '<small>Tienda: <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></small>';

		

		$return_str .=  '</a></div>';

		
		$return_str .=  '</div>';
	 
		// switch back
		restore_current_blog();
	endforeach;
	 
	// we should change the global $wp_query value to work correctly with pagination
	$wp_query = $GLOBALS['network_query'];
	 
	// I use the popular WP PageNavi plugin
	//wp_pagenavi();
	 
	// reset the $wp_query
	wp_reset_query();





	$marcadores = null;




	$contador=0;
	if ( function_exists( 'get_sites' ) && class_exists( 'WP_Site_Query' ) ) {
	    $sites = get_sites();
	  
	    foreach ( $sites as $site ) {

	    	if(in_array($site->blog_id, $tiendas)){
		        switch_to_blog( $site->blog_id );
		        if(sizeof($network_q_posts) > 0){
		        	
		        	$configuracion = get_option( 'blog_globalid' ); 
		        	//echo  get_bloginfo('name');
		        	$arraycillo = array();
		        	$arraycillo['contador'] = $contador;
		        	$arraycillo['nombretienda'] = get_bloginfo('name');
		        	$arraycillo['latitud'] = $configuracion["tlatitud"];
		        	$arraycillo['longitud'] = $configuracion["tlongitud"];
		        	if($configuracion['tfoto'] != ""){
		        		$arraycillo['tfoto'] = $configuracion['tfoto'];
		        	}
		        	if($configuracion['tdesc'] != ""){
							//$test = json_encode($configuracion['tdesc']);
							$test = esc_js($configuracion['tdesc']);
							$test = str_replace('\n\n', '<br>', $test);
							$arraycillo['tdesc'] = $test;
					}

					$productos = ""; 
					foreach( $network_q_posts as $network_q_post ) {
							if($network_q_post->BLOG_ID == $site->blog_id) {
								$productos .= '<a href="'.get_the_permalink($network_q_post->ID).'">'.$network_q_post->post_title.'</a>, ';
							}
						}
					$arraycillo['productos'] = $productos;


		        	$marcadores[] = $arraycillo;
		        	//array_push($marcadores,$arraycillo);
		        }
		        $contador++;
		        restore_current_blog();
		    }
		}
	}





	 
	 











	$html = $return_str;
	$data = json_encode($marcadores);
	$response = array('html'=>$html, 'data'=>$marcadores);

	header('Content-Type: application/json');
	echo json_encode($response);

    //echo $return_str . $return_str2;
    die;
}

add_action('wp_ajax_busquedajax2', 'busquedajax2');
add_action('wp_ajax_nopriv_busquedajax2', 'busquedajax2');
