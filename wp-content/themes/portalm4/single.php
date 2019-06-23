<?php get_header(); ?>







<section class="articulo" >
  <div class="container">
    <div class="row">
      <div class="col-md-9">
              <?php 
               
                  if (have_posts()) :
                   ?>
             <?php
                          //$ent['post_type']='post';
                          //$ent['posts_per_page']=3;
                          //query_posts($ent); 
                   while (have_posts()) : the_post(); ?>
                      
                      <div class="row-page">
                        <h2 class="posttitle"><?php the_title(); ?></h2>


                        <!--<div style="text-align:center; margin-bottom:18px;">
                          <?php the_post_thumbnail( 'index_thumb', array('class' => 'img-responsive')  ); ?>
                        </div>-->

                        
                         <?php if(get_post_type() != 'proyecto'){ ?>
                        <?php get_template_part('meta'); ?>
                        <?php } ?>

                        <?php the_content(); ?>

                        <?php if(get_post_type() != 'post'){ ?>
                        <?php echo do_shortcode('[gallery columns="4"  link="file" ]'); ?>
                        <?php } ?>
                        


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
        <div class="col-md-3">
          <div id="sidebar">

             <?php get_sidebar(); ?>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>