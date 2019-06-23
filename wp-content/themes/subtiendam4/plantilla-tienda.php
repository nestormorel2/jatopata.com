<?php /* Template Name: page tienda */ ?>
<?php get_header(); ?>







<section class="articulo" >
  <div class="container-fluid">
    <div class="row">
     

      <div class="col-md-9">
            <main id="main" class="site-main" role="main">
 <?php if(is_shop()){ ?> 
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

               <?php the_content(); ?>




           

         </main>
              
             

        </div>
        <div class="col-md-3">
          <div id="sidebar" >


            <h2 class="posttitle">Escribenos</h2>

            <?php if(is_product()){ ?>     
                  <?php

               $product->get_id();

                 

              ?>

               <a href="https://api.whatsapp.com/send?phone=595994211187&text=WEB%20quiero%20averiguar%20sobre%20este%20producto%20<?php echo $product->get_name(); ?>" target="_blank"><img src="<?php bloginfo('template_url');?>/iconwha.png" style="height: 40px; width: 40px;" alt="Escribenos al whatsapp"> Quiero averiguar sobre este producto "<?php echo $product->get_name(); ?>"</a>
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