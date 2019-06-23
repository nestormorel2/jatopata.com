<?php get_header(); ?>







<section class="articulo" >
  <div class="container-fluid">
    <div class="row">
     

      <div class="col-md-9">
            <main id="main" class="site-main" role="main">
 <?php //if(is_shop()){
if(1==2){
  ?> 
                          <?php //get_product_search_form(); ?>
                        <form class="row formbuscar" method="GET">
                    <div class="form-group col-md-10">
                      <input type="text" name="s" class="form-control" placeholder="Buscar productos">
                      <input type="hidden" name="post_type" value="product" />
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-default">Buscar</button>
                    </div>
                    </form>

                        <?php } ?>

               <?php woocommerce_content(); ?>




           

         </main>
              
             

        </div>
        <div class="col-md-3">
          <div id="sidebar" >

            

     

            

            <?php if(is_product()){ ?>    
            <h2 class="posttitle">Escribenos</h2> 
                  <?php

               $product->get_id();

                 

              ?>

               <a href="https://api.whatsapp.com/send?phone=0986209537&text=WEB%20quiero%20consultar%20sobre%20este%20producto%20<?php echo $product->get_name(); ?>" target="_blank"><img src="<?php bloginfo('template_url');?>/iconwha.png" style="height:25px; width:25px;" alt="Escribenos al whatsapp"> Quiero averiguar sobre este producto "<?php echo $product->get_name(); ?>"</a>
          <?php  } else { ?>

           
            
            <?php get_sidebar(); ?>

            <?php } ?>


            
            <!-- AGREGAR SIDEBAR DINAMICOOO -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>