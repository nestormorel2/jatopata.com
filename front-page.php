<?php get_header(); ?>

<section class="articulo" >
  <div class="container-fluid">
    <div class="row">
    	 <div class="col-md-9 lat1">
    	     <?php echo do_shortcode("[image-carousel]"); ?>
    	 </div>
    	 <div class="col-md-3 lat2">
    	     <img src="<?php bloginfo('template_url');?>/prueba.jpg" >
       </div>
    </div>

    
</div>

  <div class="container-fluid">

    <div class="row">

        <div class="col-md-12">
          <?php if ( is_active_sidebar( 'portada' ) ) : ?>
              <ul id="sidebarportada">
                  <?php dynamic_sidebar( 'portada' ); ?>
              </ul>
          <?php endif; ?>
        </div>
    </div>
   

    <div class="row">

        <div class="col-md-12">
          <div class="cuadroproductos">
            <h2 class="posttitle">Nuestros Productos</h2>
            
            <?php echo do_shortcode('[products limit="6" columns="6" best_selling="true" ]'); ?>
          </div>
        </div>

    </div>
     <div class="row categoriaproductos">

      <?php echo do_shortcode('[product_categories parent="0" columns="6"]'); ?>
    </div>
    
    <div class="row">

        <div class="col-md-4">
          <div class="cuadroproductos">
            <h2 class="posttitle">Nuevos Productos</h2>
            <?php echo do_shortcode('[recent_products limit="3" columns="3" orderby="date" order="desc"]'); ?>
            <?php //echo do_shortcode('[products limit="12" columns="6" best_selling="true" ]'); ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cuadroproductos">
            <h2 class="posttitle">En Descuento</h2>
            <?php echo do_shortcode('[sale_products limit="3" columns="3" orderby="date" order="desc"]'); ?>
            </div>
        </div>


        <div class="col-md-4">
          <div class="cuadroproductos">
            <h2 class="posttitle">Novedades</h2>
            <ul class="noticont">
              <?php 

           
                             
                  if (have_posts()) :
                   ?>
                  <?php
                  $ent['post_type']='post';
                  $ent['posts_per_page']=6;
                  query_posts($ent); 
                  while (have_posts()) : the_post(); ?>  

                      <li class="noticiecita">
                            <a href="<?php the_permalink(); ?>" alt="<?php echo  get_the_title(); ?>" title="<?php echo  get_the_title(); ?>" >
                              <?php
                              if(has_post_thumbnail()){
                                the_post_thumbnail( 'thumbnail', array('class' => 'img-responsive')  ); 
                              }else{
                                echo '<img class="img-responsive alignleft" src="https://via.placeholder.com/100x100/CCCCCC/F3F3F3.png?text=N+F" >';

                              }
                              ?>
                             
                              <?php the_title(); ?>
                              <small><?php the_time('F j, Y'); ?></small>
                            </a>
                      </li>

                  <?php endwhile; ?>
                  

                  <!-- End Info Blcoks -->
              <?php else: ?>      
               <?php endif; 
               //$args = null;
               wp_reset_query();
              ?>
            </ul>
          </div>
        </div>

      </div>


    <div class="row">
        <div class="col-md-12">
          <div class="cuadroproductos">
            <h2 class="posttitle">Destacados</h2>
            <?php echo do_shortcode('[featured_products limit="5" columns="5" orderby="date" order="desc"]'); ?>
            </div>
        </div>
        <!--<div class="col-md-12">
          <div class="cuadroproductos">
            <h2 class="posttitle">Más Vendidos</h2>
            <?php echo do_shortcode('[best_selling_products limit="5" columns="5" orderby="date" order="desc"]'); ?>
            </div>
        </div>-->

        
        
    </div>
</div>
</section>
    
    <section  id="contacto" class="seccioncontacto">

     
      <div class="container">
        <div class="row">
           <h2 class="pagetitlesection">Ubicación y Contacto</h2>
          <div class="col-md-6">
         
            
          <p style="color:#ffffff">Import Center S.A.<br>
            Dirección Rca. Argentina casi Eusebio Ayala N° 1851<br><a style="color: #ffffff;" href="tel://021613018">Teléfono: (021)613018</a></p>

            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14427.351018958434!2d-57.5855493!3d-25.3096546!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5fcf124903d4cd5b!2sBike+Spirit!5e0!3m2!1ses-419!2spy!4v1539633957861" style="width: 90%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
          <div class="col-md-6">
            <?php echo do_shortcode('[contact-form-7 id="2364" title="Formulario de contacto 1"]'); ?>
          </div>
        </div>
      </div>
    </section> 

<section>
<div class="container-fluid">

     <!--<div class="row">
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
-->

     <!--<div class="row">
        <div class="col-md-12">
          <img class='img-responsive' src="https://via.placeholder.com/1600x450/CCCCCC/F3F3F3.png?text=ESPACIO+PARA+PROMO" >
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <img class='img-responsive' src="https://via.placeholder.com/800x400/CCCCCC/F3F3F3.png?text=ESPACIO+PARA+PROMO" >
        </div>
        <div class="col-md-6">
          <img class='img-responsive' src="https://via.placeholder.com/800x400/CCCCCC/F3F3F3.png?text=ESPACIO+PARA+PROMO" >
        </div>
    </div>-->


    <div class="row">

        <div class="col-md-12" style="text-align: center;">
             
             
              <div class="slider variable-width">
                    <?php
                      $contador = 0;
                      $args=array('hide_empty'=>false, 'exclude' => 41);
                      $myterms = get_terms('pwb-brand', $args);
                      foreach($myterms as $term){
                            $contador++;

                            $brand_link = get_term_link ( $term->term_id, 'pwb-brand' );
                            $attachment_id = get_term_meta( $term->term_id, 'pwb_brand_image', 1 );
                            $attachment_html = wp_get_attachment_image( $attachment_id, 'thumbnail' );
                            
                            if( !empty($attachment_html)  ){ 
                            ?>
                              <a href="<?php echo $brand_link; ?>" alt="<?php echo $term->name; ?>" class="marcaspirit">
                                <?php echo $attachment_html; ?>
                              </a> 
                            <?php 
                              }else{
                                echo '<a href="'.$brand_link.'">'.$brand->name.'</a>';
                              }
                            ?>
                    <?php } ?>
              </div>
                      
        </div>

    </div>

  </div>
  

</section>



<?php get_footer(); ?>
