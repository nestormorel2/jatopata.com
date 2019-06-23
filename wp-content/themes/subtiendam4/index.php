<?php /* Template Name: noticias */ ?>
<?php get_header(); ?>




<section class="articulo" >
  <div class="container">
    <div class="row">
      
      

      <div class="col-md-9">

        <h2 class=" TITULO_NOTICIAS posttitle">Noticias y Actividades</h2>


        <h4 style="margin-top:0px;" class="titulopublics">
              <?php if(isset($_GET['s'])){ ?>
              Resultados de búsqueda para "<?php the_search_query(); ?>"
              <?php  }  ?>
                
            </h4>

              <form>
        <div class="input-group">
          <input type="text" name ="s" class="form-control" value="<?php echo $s; ?>" placeholder="noticia a buscar">
            <span class="input-group-btn">
              <button class="btn btn-default" value="Search" type="submit">Buscar</button>
            </span>
            <input type="hidden" name="post_type" value="post" />
          </div><!-- /input-group -->
</form>

              <nav class="navbar navbar-default" role="navigation" style="margin-top:15px">



            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-right:15px">
              <ul class="nav navbar-nav">
                <li><a href=""><strong><?php echo $wp_query->found_posts;?></strong> <?php post_type_archive_title(); ?>  / 

                 <?php global $wp_query;
                 if (get_query_var('paged') == 0) {
                  echo '<strong> Página 1 de '. $wp_query->max_num_pages . '</strong>';
                 } else {
                     echo '<strong>Página ' . get_query_var( 'paged' ). ' de ' . $wp_query->max_num_pages . '</strong>';  
                 }


                 ?>

                

                </a> </li>
              </ul>
              <!-- <form class="navbar-form navbar-left" role="search">
                <select class="form-control">
                  <option>Ordenar por</option>
                  <option>Relevancia</option>

                </select>
              </form> -->
              <!-- <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Ver por página 10 / 30 / 100</a> </li>
              </ul> -->
            </div><!-- /.navbar-collapse -->
          </nav>

<?php 
            if(function_exists('wp_paginate')):
                wp_paginate();  
            endif;
          ?>
<div class="container-fluid">

              <?php 
               
                  if (have_posts()) :
                   ?>
             <?php
                          //$ent['post_type']='post';
                          //$ent['posts_per_page']=3;
                          //query_posts($ent); 
                   while (have_posts()) : the_post(); ?>
                      
                      <div class="row-page row">
                        <h3 ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>


                        <div style="text-align:center; margin-bottom:18px;">
                          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail', array('class' => 'img-responsive alignleft')  ); ?></a>
                        </div>

                        <?php the_excerpt(); ?>

                        <?php if(get_post_type() != 'proyecto'){ ?>
                        <?php get_template_part('meta'); ?>
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
        </div>
        <div class="col-md-3">
          <div id="sidebar">

            <?php get_template_part('menuplanetas'); ?>
            
            <?php get_sidebar(); ?>
            
           

            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>