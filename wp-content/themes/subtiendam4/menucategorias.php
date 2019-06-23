<div class="panel-group" id="accordion">

            	<?php
	            	$taxonomy="product_cat";
	            	$args=array('hide_empty'=>true,'orderby'=>'name','order'=>'ASC','parent'=>0);
					$myterms = get_terms($taxonomy, $args);
					$misvars=array_merge($wp_query->query,$_GET,$_POST);
            	
				foreach($myterms as $term){
            	?>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $term->slug;?>"><span class="glyphicon glyphicon-plus">
                            </span> <?php echo $term->name;?> </a>
                        </h4>
                    </div>
                          <?php
                                $ptparent= get_queried_object()->parent;
                                $ptid= get_queried_object()->term_id;
                                $open = "";
                                $select = "";
                                if($ptparent==$term->term_id){
                                    $open = "in";   
                                }
                                
                               
                         ?>
                    <div id="collapse<?php echo $term->slug;?>" class="panel-collapse collapse <?php echo $open; ?>">
                        <div class="panel-body">
                            <table class="table">



                            	<?php 

									$subargs=array('hide_empty'=>false,'orderby'=>'name','child_of'=>$term->term_id); 

									$subterms=get_terms($taxonomy, $subargs); 

									if(is_array($subterms)){

										foreach ($subterms as $subterm) { ?>

						
                                            <?php 
                                            if($ptid==$subterm->term_id){
                                                        $select = "background:#dddddd";   
                                                    }
                                                   
                                             ?>
											<tr>
			                                    <td style="<?php echo $select; ?>">
			                                        <span class="glyphicon glyphicon-file text-info"></span><a href="<?php echo get_bloginfo('url') .'/index.php/categoria-producto/'. $subterm->slug;?>"><?php echo $subterm->name;?></a> <span class="badge"><?php echo $subterm->count; ?></span>
			                                    </td>
			                                </tr>
                                            <?php
                                            $select="";
                                             ?>

										<?php }

									}

									?>
                               
                                
                               
                            </table>
                        </div>
                    </div>
                </div>

            <?php  }?>
                
                
                
            </div>