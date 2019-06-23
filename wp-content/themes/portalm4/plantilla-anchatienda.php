<?php /* Template Name: Ancho total tienda */ ?>
<?php get_header(); ?>





<section class="articulo" >
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
              <?php 
               
                  if (have_posts()) :
                   ?>
             <?php
                          //$ent['post_type']='post';
                          //$ent['posts_per_page']=3;
                          //query_posts($ent); 
                   while (have_posts()) : the_post(); ?>
                      
                      <main id="main" class="site-main" role="main">
                        <h2 class="posttitle"><?php the_title(); ?></h2>
                        
                         <?php if(is_shop()){ ?> 
                          <?php //get_product_search_form(); ?>
                        <form class="row" method="GET">
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

                        <?php edit_post_link('Editar este post', '<p>', '</p>'); ?>
                      </main>
                  <?php endwhile; ?>
                      
           
                      <!-- End Info Blcoks -->
                  <?php else: ?>      
                   <?php endif; 
                   //$args = null;
                   //wp_reset_query();
                  ?>
        </div>
        
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>