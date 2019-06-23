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
   	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/fonts/ionicons.min.css">
   	<link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700|Montserrat:400,500" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.4.0/balloon.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/jquery.mCustomScrollbar.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/slick/slick-theme.css" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/woocommerce.css">
    
    <script src="<?php bloginfo('template_url');?>/js/jquery.min.js"></script>

    <?php

        $configuracion = get_option( 'blog_globalid' ); 
        //var_dump($configuracion); 
         ?>
   
                     
                       
                        

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

    .alogoprincipal{
      display: table-row;
      width: 100%;
    }
    .alogoprincipal h1{
      color:<?php echo $configuracion["tcolor"]; ?> ;
      display: table-cell;
      vertical-align: middle;
      padding-right: 20px;
      text-align:left;
    }
    .alogoprincipal img{
         display: table-cell;
      vertical-align: middle;
    }


    .posttitle, .page-title, .widgettitle, .product_title{
    background:<?php echo $configuracion["tcolor"]; ?>;
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
    position: fixed;
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
    position:relative;
    margin-bottom: 15px;
     box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
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
    width: 50px;
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


		  <div class="col-md-4" style="text-align: left;">
        
             <a href="<?php echo get_site_url(1);?>/"><img src="<?php bloginfo('template_url');?>/logo2.png" class="logoprincipal"></a>
		  </div>
      <div class="col-md-5 ">
       
      <div class="promoarriba">
          <a href="<?php bloginfo('url');?>/"><img src="<?php bloginfo('template_url');?>/promo.png" ></a>
        </div>
      
		  		<!--<a href="tel://0233" class="llamanos" style="display:block; padding-top: 15px;"><i class="ion-android-call" style="color:#60AC28" aria-hidden="true"></i><span class="numerito" style="color:#000000">(021)644 644</span></a>

            <div class="redes" style="margin-top: 0;">
                  <a href="https://www.facebook.com/Bike-Spirit-117525591594000/" target="_blank"><img src="<?php bloginfo('template_url');?>/facebook.png" class="logsocial" alt="facebook"></a>

                <a href="https://api.whatsapp.com/send?phone=0986209537" target="_blank"><img src="<?php bloginfo('template_url');?>/iconwha.png" class="logsocial" alt="Escribenos al whatsapp"></a>

        </div>-->

                    
		  </div>

       <div class="col-md-3">
        
         <a href="<?php bloginfo('url');?>/" class="alogoprincipal">
          <img src="<?php bloginfo('template_url');?>/tienda.png" class="logoprincipal" style="float: left;margin-right: 15px;">
          <h1><?php bloginfo('name'); ?></h1>
          </a> 
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
              <li><a href="<?php bloginfo('url'); ?>">Inicio</a></li>
              <li><a href="/desarrollo">Volver a M4</a></li>
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
                 /* wp_nav_menu( array(
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

              <ul class="nav navbar-nav">
                <?php if(current_user_can( 'publish_posts' )){ ?> 
                    <li><a href="<?php bloginfo('url');?>/agregar">Agregar/Editar Producto</a></li>
                     <li><a href="<?php bloginfo('url');?>/modificar">Modificar Tienda</a></li>
                <?php } ?>
      
     

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



<?php if(!( is_front_page())){  ?>
<section class="container-fluid interna parallax-window"  data-parallax="scroll" data-image-src="<?php bloginfo('template_url');?>/images/fondocird.jpg">
  <div id="presentacionmini">
  <div class="row">
    <div class="col-md-12">
      <h2></h2>
    </div>
  </div>
  </div>
</section>

      <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
        <div class="container">
          <?php if(function_exists('bcn_display'))
          {
              bcn_display();
          }?>
          </div>
      </div>
      <?php } ?>

      <?php

/*$user_id = get_current_user_id();
$latitud = get_user_meta($user_id,'latitud',true);
  $longitud = get_user_meta($user_id,'longitud',true);
  var_dump($latitud);

  var_dump($longitud);*/
   ?>