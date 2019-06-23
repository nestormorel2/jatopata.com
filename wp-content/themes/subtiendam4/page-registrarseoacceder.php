<?php /* Template Name: Ancho total */ ?>
<?php get_header(); ?>





<section class="articulo" >
  <div class="container">
    <div class="row">
      <div class="col-md-12">
             <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
             
                                

            <div class="post">
  
        <?php if (!(current_user_can('level_0'))){ ?>   
                <h2><?php the_title();?></h2>  

                

              

            <div class="row">
 

                <div class="col-md-6 columnalogin" >

                 <!-- <div class="contenid">
                    <h3>Ingresa con tu Facebook</h3>
                    <?php echo do_shortcode('[TheChamp-Login]'); ?>
                  </div>-->
                  
                  <div class="contenid">
                    <h3>Ingresar</h3>
                    <?php echo do_shortcode('[login_widget]'); ?> 
                  </div>

                </div>

                <div class="col-md-6 columnalogin"  style="text-align:center;">
                  
                  <div class="contenid">
                    <h3>O Registrate</h3>
                  <?php echo do_shortcode('[rp_register_widget]'); ?>
                  </div>
                </div>
                 

            </div>
        <?php } else { ?>

        <h2>Bienvenido/a  <?php echo $current_user->user_firstname; ?> <?php echo $current_user->user_lastname; ?></h2> 

          <?php the_content(); ?>


        <?php 
             
             // echo '<a href="'.get_bloginfo('url').'/editarformulario/" class="btn btn-primary">Ver Cargar datos para postularse </a><br><br>';
             // echo '<a href="'.get_bloginfo('url').'/editarformulario/" class="btn btn-primary">Buscar vacancias disponibles </a><br><br>';
             // echo '<a href="'.get_bloginfo('url').'/editarformulario/" class="btn btn-primary">Cargar Curriculum </a><br><br>';
        ?>

         <?php 
             
             // echo '<a href="'.get_bloginfo('url').'/editarformulario/" class="btn btn-primary">Ver vacancias cargadas </a><br><br>';
             // echo '<a href="'.get_bloginfo('url').'/editarformulario/" class="btn btn-primary">Agregar nueva vacancia </a><br><br>';
            //  echo '<a href="'.get_bloginfo('url').'/editarformulario/" class="btn btn-primary">Buscar Postulantes </a><br><br>';
        ?>
            


        <?php }  ?>
 



                        
                    </div>
                
                
                <?php endwhile; else: ?>
                    <h1>No hay contenido en esta seccion.</h1>
                <?php endif; ?>
        </div>
        
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>
