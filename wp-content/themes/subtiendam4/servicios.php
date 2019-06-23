<div class="row">

<?php
 $ent['post_type']='page';
 //$ent['posts_per_page']=3;
 $ent['post_parent']=2;
 query_posts($ent); 

   
                           
              if (have_posts()) :
               
 while (have_posts()) : the_post(); ?>
    
    <div class="col-md-6" id="<?php echo $post->post_name; ?>">
      <h1 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>


     <div style="text-align:center; margin-bottom:18px;">
        <?php the_post_thumbnail( 'thumbnail', array('class' => 'img-responsive alignleft')  ); ?>
      </div>

      
     

      <?php the_excerpt(); ?>

     <a class="btn btn-default" href="<?php the_permalink(); ?>" >Ver m&aacute;s &rarr;</a>
<br style="clear: both;">

      <?php edit_post_link('Editar este post', '<p>', '</p>'); ?>
    </div>
<?php endwhile; ?>
    

    <!-- End Info Blcoks -->
<?php else: ?>      
 <?php endif; 
 //$args = null;
 wp_reset_query();
?>
</div>