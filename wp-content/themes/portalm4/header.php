<!DOCTYPE html>
<html lang="es">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="<?php bloginfo('template_url');?>/favicon.ico">
	   <title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      echo " | $site_description";

    ?></title>

    
  <script src="<?php bloginfo('template_url');?>/js/pace.min.js"></script>
  <link href="<?php bloginfo('template_url');?>/css/animacion.css" rel="stylesheet" />

	
   	<link href="<?php bloginfo('template_url');?>/css/bootstrap.min.css" rel="stylesheet">
   	<link href="<?php bloginfo('template_url');?>/css/animate.css" rel="stylesheet">
   	<link href="<?php //bloginfo('stylesheet_url'); ?><?php bloginfo('template_url');?>/style3.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/fonts/ionicons.min.css">
   	<link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700|Montserrat:400,500" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.4.0/balloon.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/jquery.mCustomScrollbar.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/slick/slick-theme.css" />


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

     <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/colorbox.css">


    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/woocommerce.css">
    
    <script src="<?php bloginfo('template_url');?>/js/jquery.min.js"></script>

    <?php wp_head(); ?>

    <style>
    .logochiquito{
    	
    }

    .nav > li.imgtab{
      display: inline-block;
      width: auto;
    }
    .imgtab a img{
      width: auto;
      height: 40px;
    }

    .linkwha{
    height: auto;
    width: 50px;
    position: fixed;
    bottom: 15px;
    right: 10px;
  }


  .linkwhacont{
    height: auto;
    width: auto;
    /*position: fixed;*/
    bottom: 15px;
    right: 10px;
  text-align: right;
  }
  .contenumeros a{
    color: white;
    text-decoration: none;
  }
  .contenumeros{
    text-align: left;
       padding: 15px;
    background: #0393CD;
    font-size: 20px;
    border-radius: 5px;
    position:absolute;
    margin-bottom: 15px;
     box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
     bottom: 100%;
     right: 5%;
  }
.cerrarnu{
  position: absolute;
  top: -5px;
  right:-5px;
  z-index: 9999999;
  cursor: pointer;
}
  .imgwha{
    height: auto;
    width: 80px;
     cursor: pointer;
  }
.contenumeros:after {
    content:'';
    position: absolute;
    top: 100%;
    right: 10%;
    margin-left: -50px;
    width: 0;
    height: 0;
    border-top: solid 12px #0393CD;
    border-left: solid 12px transparent;
    border-right: solid 12px transparent;
}
 

<?php if(is_page('registrar')){ ?>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 425px;
      }
      /* Optional: Makes the sample page fill the window. */
     
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #007EC4;
        font-family: Roboto;
        color:#fff !important;
        font-size: 20px;
        font-weight: 300;
        margin-left: 12px;
        padding: 5px 11px 5px 13px;
        text-overflow: ellipsis;
        width: 80%;
        margin-top: 4px;
      }
#pac-input::placeholder{
color:#f3f3f3 !important;
}
      #pac-input:focus {
        border-color: #4d90fe;
      }
      #instrumapa{
        position: absolute;
        z-index: 9999999;
        bottom: 0px;
        padding: 8px;
        background: #1c3454;
        color: white;
        left: 15px;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }*/



  <?php  } ?>
</style>

</head>
<body <?php body_class() ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.12&appId=455925321152842&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="contenedorgeneral container-fluid">

	<div class="container-fluid" id="header">
		  <!--<a href="<?php bloginfo('url');?>/"><img src="<?php bloginfo('template_url');?>/images/header.jpg" class="logoprincipal"></a>-->
		  <div class="row">
		  <div class="col-md-4" style="text-align: center;">
		  	<a href="<?php bloginfo('url');?>/"><img src="<?php bloginfo('template_url');?>/logo2.png" class="logoprincipal"></a>
		  </div>
      <div class="col-md-5 ">
        <div class="promoarriba">
          <a href="<?php bloginfo('url');?>/"><img src="<?php bloginfo('template_url');?>/promo.png" ></a>
        </div>
      </div>
		  <div class="col-md-3 " style="padding-top:20px;">
		   <?php if (!(current_user_can('level_0'))){ ?> 
              <a href="<?php bloginfo('url');?>/index.php/registro/" class="btn btn-warning">Registre o Acceda a su Tienda</a>   
            <?php } else {?>
              <a href="<?php bloginfo('url');?>/index.php/mi-cuenta/" class="btn btn-default btspiri">mi cuenta</a> 
              <a href="<?php bloginfo('url');?>/wp-login.php?action=logout" class="btn btn-warning">Salir</a>
            <?php }  ?>

      
		  	<!--	<a href="tel://0233" class="llamanos"><i class="ion-android-call" style="color:#60AC28" aria-hidden="true"></i><span class="numerito" style="color:#000000">(021)644 644</span></a>

            <div class="redes">
                  <a href="https://www.facebook.com/Bike-Spirit-117525591594000/" target="_blank"><img src="<?php bloginfo('template_url');?>/facebook.png" class="logsocial" alt="facebook"></a>

                <a href="https://api.whatsapp.com/send?phone=0986209537" target="_blank"><img src="<?php bloginfo('template_url');?>/iconwha.png" class="logsocial" alt="Escribenos al whatsapp"></a>

        </div>

            -->		
                  
                    
                    
		  </div>
		</div>
	</div>
  

<nav class="navbar navbar-default navbar-vr">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php bloginfo('url');?>/">
            	
            	<!--<img src="<?php bloginfo('template_url');?>/logob.png" class="logochiquito">-->
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul id="menu-manu" class="nav navbar-nav">
              <li><a href="<?php bloginfo('url') ?>">Inicio</a></li>
              <?php

              $catprod = get_terms( array(
                  'taxonomy' => 'product_cat',
                  'hide_empty' => false,
              ) );

              //var_dump($catprod);

              if ( ! empty( $catprod ) && ! is_wp_error( $catprod ) ){
                  
                  foreach ( $catprod as $term ) {
                      echo '<li><a href="'. get_term_link($term).'">' . $term->name . '</a></li>';
                  }
                 
              }
               ?>
            </ul>
            <?php
                /*  wp_nav_menu( array(
                      'menu'              => 'principal_header',
                      'theme_location'    => 'principal_header',
                      'depth'             => 2,
                      'container'         => false,
                      'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
                      'menu_class'        => 'nav navbar-nav',
                      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                      'walker'            => new wp_bootstrap_navwalker())
                  );*/
              ?>  
            

		        <div class="navbar-right">

        

            <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
                $count = WC()->cart->cart_contents_count;
                ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php 
                if ( $count > 0 ) {
                    ?>
                    <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
                    <?php
                }
                    ?></a>
             
            <?php } ?>

           
        </div>
		      
             <?php //echo do_shortcode("[woocommerce_cart]"); ?>
            <?php //echo do_shortcode("[woocommerce_checkout]"); ?>
            <?php //echo do_shortcode("[woocommerce_my_account]"); ?>
            <?php //echo do_shortcode("[woocommerce_product_search]"); ?>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>


 