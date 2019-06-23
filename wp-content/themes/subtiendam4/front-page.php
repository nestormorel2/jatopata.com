<?php get_header(); ?>

<section class="articulo" >

  <div class="container-fluid">

    <div class="row">
     
      <div class="col-md-4 presentacioncilla">
        <?php

        $configuracion = get_option( 'blog_globalid' ); 
        //var_dump($configuracion); 
         ?>
   
                     
                        <h2 class="posttitle">Descripción</h2>
                        <?php echo $configuracion["tdesc"]; ?>


                    

   </div>
   <div class="col-md-5">
       <img src="<?php echo $configuracion["tfoto"]; ?>">
   </div>
   <div class="col-md-3">
      
        <div id="mapita"  style="width:100%; height:278px;"  ></div>
        <script>
          var mapapers;
             mapapers = new google.maps.Map(document.getElementById("mapita"), {
                center: {lat: <?php echo $configuracion["tlatitud"]; ?>, lng: <?php echo $configuracion["tlongitud"]; ?>},
                zoom: 14,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true
              });
              var pos = {lat: <?php echo $configuracion["tlatitud"]; ?>, lng: <?php echo $configuracion["tlongitud"]; ?>};

              var markertienda = new google.maps.Marker({
              position: pos,
              map: mapapers,
              title: '<?php bloginfo('name'); ?>',
              icon: "<?php bloginfo('template_url'); ?>/casita.png"
            });
        </script>
   </div>
</div>

   
    <!--<div class="row">

        <div class="col-md-4">
          <div class="cuadroproductos">
            <h2 class="posttitle">Nuevos Productos</h2>
            <?php //echo do_shortcode('[recent_products limit="3" columns="3" orderby="date" order="desc"]'); ?>
            <?php //echo do_shortcode('[products limit="12" columns="6" best_selling="true" ]'); ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cuadroproductos">
            <h2 class="posttitle">En Descuento</h2>
            <?php //echo do_shortcode('[sale_products limit="3" columns="3" orderby="date" order="desc"]'); ?>
            </div>
        </div>

        <div class="col-md-4">
          <div class="cuadroproductos">
            <h2 class="posttitle">Destacados</h2>
            <?php //echo do_shortcode('[featured_products limit="3" columns="3" orderby="date" order="desc"]'); ?>
            </div>
        </div>
        

      </div>-->


      <div class="row">

        <div class="col-md-12">
          <div class="cuadroproductos">
            <h2 class="posttitle">Nuevos Productos</h2>
            <?php //echo do_shortcode('[recent_products limit="3" columns="3" orderby="date" order="desc"]'); ?>
            <?php echo do_shortcode('[products limit="24" columns="6" best_selling="true"  ordeby="on sale"]'); ?>
          </div>
        </div>
        

      </div>


<div class="row categoriaproductos">

      <?php //echo do_shortcode('[product_categories parent="0" columns="6"]'); ?>
    </div>

   
   


   
</div>
</section>
    
   
<section>
<div class="container-fluid">

  <div class="row">
        <div class="col-md-12">
          <div style="margin-top: -20px;" class="cuadroproductos">
            
          <?php
          if( function_exists( 'wp_bannerize_pro' ) ) {
  wp_bannerize_pro( array( 'orderby' => 'random', 'categories' => 'espacio2' ) );
}
           ?>
         </div>
        </div>
    </div>


    


   

  </div>
  

</section>



<?php get_footer(); ?>
