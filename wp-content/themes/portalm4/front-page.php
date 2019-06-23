<?php get_header(); ?>

<?php

if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])) {
      // if IE 7 or 8
      // Write HTML to render tab
    echo '<a href="#contemapa"><div id="rum_sst_tab" class="rum_sst_contents less-ie-9 rum_sst_left pestania">Ver Mapa </div></a>';
  } else {
     // if IE>8
     // Write HTML to render tab
     echo '<a href="#contemapa" id="rum_sst_tab" class="rum_sst_contents rum_sst_left pestania">Ver Mapa </a>';
  }

?>
<section class="articulo" >

  <div class="container-fluid">

    <div class="row">

        <div class="col-md-12">

              <ul id="sidebarportada">
                  <?php dynamic_sidebar( 'portada' ); ?>
              </ul>
        
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

    


   

  </div>
  

</section>



<?php get_footer(); ?>
