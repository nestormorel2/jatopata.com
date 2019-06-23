<?php /* Template Name: Ancho total */ ?>
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
                      
                      <div class="row-page row">
                        <h2 class="posttitle"><?php the_title(); ?></h2>
                        <?php the_content(); ?>

                        <?php edit_post_link('Editar este post', '<p>', '</p>'); ?>
                      </div>
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