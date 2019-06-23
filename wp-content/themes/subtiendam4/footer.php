	<footer id="footer" class=" footer contenedorgeneral" <?php if (is_front_page()) { ?> style="margin-top:0;" <?php } ?> >
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-3 datos" style="text-align: center;">

			<a href="<?php bloginfo('url');?>/"><img src="<?php bloginfo('template_url');?>/m4logomini.png" class="logoprincipal"></a>
			

		</div>
		<div class=" col-md-2 datos">

			
			
	
		</div>
		
		<div class=" col-md-4 datos">
			 <div id="sidebar" >
		
            <?php //get_sidebar(); ?>
            
            <!-- AGREGAR SIDEBAR DINAMICOOO -->
            
          </div>
		</div>

		<div class=" col-md-3 datos">
			

					 <h4>Información del Sitio</h4>
				<?php
            wp_nav_menu( array(
                'menu'              => 'principal_pie',
                'theme_location'    => 'principal_pie',
                'depth'             => 2
            ));
        ?> 
		 
      
				

	
		</div>

		<div class="col-md-12 social">
			
		</div>
	</div>

	


	</div>
	
	
</footer>
</div>

		
<?php

// Fix Api Whatsapp on Desktops
// Dev: Jean Livino

$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$linkwha ="";
// check if is a mobile
if ($iphone || $android || $palmpre || $ipod || $berry == true)
{
 //header('Location: https://api.whatsapp.com/send?phone=YOURNUMBER&text=YOURTEXT');
 //OR
 //echo "<script>window.location='https://api.whatsapp.com/send?phone=YOURNUMBER&text=YOURTEXT'</script>";
	$linkwha='https://api.whatsapp.com/send?phone=';
}

// all others
else {
// header('Location: https://web.whatsapp.com/send?phone=YOURNUMBER&text=YOURTEXT');
 //OR
 //echo "<script>window.location='https://web.whatsapp.com/send?phone=YOURNUMBER&text=YOURTEXT'</script>";
 //$linkwha='https://web.whatsapp.com/send?phone=595981670410';
 $linkwha='';
}
?>

<div class="linkwhacont"><!-- class="linkwha"-->
	
	<?php 
  $configuracion = get_option( 'blog_globalid' ); 
  //var_dump( $configuracion); 
  ?>
	<div class="contenumeros">
		<small style="color:white">Contacte con la tienda</small><br>
		<i class="fas fa-times-circle cerrarnu" ></i>
		<?php if($configuracion['ttelefono']!=""){ ?>
			<?php
			$urlwha="#";
			if($linkwha!=''){ 
			 	$urlwha= 'tel://' . $configuracion['ttelefono'];
			 }else{
			 	
			} ?>
			<i class="fas fa-phone"></i> 
			<a href="<?php echo $urlwha; ?>"  target="_blank"><?php echo $configuracion['ttelefono']; ?></a>
			<br>
		<?php } ?>
		<?php if($configuracion['ttelefono2']!=""){ ?>
			<?php
			$urlwha="#";
			 if($configuracion['ttelefono2wha']!="" and $linkwha!=''){ 
			 	$urlwha= $linkwha . $configuracion['ttelefono2'];
			 }else{
			 	if($linkwha!=''){
			 		$urlwha= 'tel://' . $configuracion['ttelefono2'];
			 	}
			}
			if($configuracion['ttelefono2wha']!="" ){ 
			 		echo '<i class="fab fa-whatsapp"></i>';
			 }
			 else{
			 		echo '<i class="fas fa-mobile-alt"></i>';
			 }
			 ?>
			<a href="<?php echo $urlwha; ?>"  target="_blank"><?php echo $configuracion['ttelefono2']; ?></a>
			<br>
		<?php } ?>
		<?php if($configuracion['ttelefono3']!=""){ ?>
			<?php
			$urlwha="#";
			 if($configuracion['ttelefono3wha']!="" and $linkwha!=''){ 
			 	$urlwha= $linkwha . $configuracion['ttelefono3'];
			 } else {
			 	if($linkwha!=''){
			 		$urlwha= 'tel://' . $configuracion['ttelefono3'];
			 	} 
			} 
			if($configuracion['ttelefono3wha']!="" ){ 
			 		echo '<i class="fab fa-whatsapp"></i>';
			 }else{
			 		echo '<i class="fas fa-mobile-alt"></i>';
			 }
			 ?>
			<a href="<?php echo $urlwha; ?>"  target="_blank"><?php echo $configuracion['ttelefono3']; ?></a>
		<?php } ?>
	</div>
	<img src="<?php bloginfo('template_url');?>/wha.png" class="imgwha" class="responsive-img" />
</div>


				
		 
      
				




<script src="<?php bloginfo('template_url');?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/parallax.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/slick/slick.min.js"></script>
		
<?php wp_footer(); ?>

<script>
x = 0;

</script>
<script  type="text/javascript">
	new WOW().init();
	jQuery.noConflict()
	jQuery(document).ready(function(){

	});

	jQuery(document).ready(function(){

		jQuery('.cerrarnu').click(function (e) {
		    jQuery('.contenumeros').hide();
		})

		jQuery('.imgwha').click(function (e) {
		    jQuery('.contenumeros').show();
		})

		jQuery('.contenumeros a').click(function (e) {
		    //console.log(this);
		    let link = jQuery(this).attr('href');
		    //alert(link);
		    if(link=='#'){
		    	e.preventDefault();
		    }
		})
		/*jQuery('.contenumeros a').click(function(e) {
			alert(jQuery('this').attr('href'));
			if(jQuery('this').attr('href')==undefined){
				//e.preventDefault();
			}else{
				
			}
			e.preventDefault();
		});*/
	   

	   /* jQuery("#target").mCustomScrollbar({
		    theme:"dark"
		}); */

		jQuery('#selectorareas').change(function() {
		 	var str = "";
		    jQuery( "#selectorareas option:selected" ).each(function() {
		      str += jQuery(this ).val();

		    });
		    location.href = str;
		});


		jQuery('#cantcuotas').change(function() {
			calcularcuotas();
		 	/*var str = "";
		    Quejry( "#selectorareas option:selected" ).each(function() {
		      str += jQuery(this ).val();

		    });
		    alert(str);*/
		});
		jQuery('#monto').change(function() {
			calcularcuotas();
		 	/*var str = "";
		    jQuery( "#selectorareas option:selected" ).each(function() {
		      str += jQuery(this ).val();

		    });
		    alert(str);*/
		});

		function calcularcuotas(){
			
			var cantcu = jQuery( "#cantcuotas option:selected" ).val();
			var montou = jQuery( "#monto" ).val();
			//alert(montou + " "+ cantcu);
			var montocu= montou/cantcu;
			jQuery( "#montocuotas" ).text("MONTO CUOTAS: "+ Math.round(montocu) + " Gs")
			
		}

	});

	jQuery(document).ready(function() {
		  /*  jQuery("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
		        e.preventDefault();
		        jQuery(this).siblings('a.active').removeClass("active");
		        jQuery(this).addClass("active");
		        var index = jQuery(this).index();
		        jQuery("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
		        jQuery("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
		    }); */

		   //jQuery('select').select2();


  
    	var winHt = jQuery(window).height();
    	console.log(winHt);

	      	/*if(winHt < 900){
	      		
		    	
		    	jQuery( window ).scroll(function() {
		      
		      	var winWd = jQuery(window).width();
			      //var mht = jQuery('#presentacion').height();
			      var mht = 250;
			      var scrPos = jQuery(window).scrollTop();
			      if( scrPos > mht ){
			      	
					
					jQuery('.navbar-vr').addClass('navbar-fixed-top');
					jQuery('.logochiquito').show();
			      }else{
			      	jQuery('.navbar-vr').removeClass('navbar-fixed-top');
			      	jQuery('.logochiquito').hide();
					
			      }
			     });
		      }*/



		      jQuery('.tab-menu a').hover(function (e) {
				  e.preventDefault()
				  jQuery(this).tab('show')
				})


/*

		      jQuery('.variable-width').slick({
				  dots: true,
				  infinite: true,
				  speed: 300,
				  slidesToShow: 1,
				  centerMode: true,
				  variableWidth: true
				});
		      
		    */

		         jQuery('.variable-width').slick({
             	 	centerMode: true,         
  					dots: true,
					arrows: true,
  					infinite: true,
  					speed: 300,
  					slidesToShow: 7,
  					slidesToScroll: 1,
					autoplay: true,
					autoplaySpeed: 2000,
					initialSlide: 0,
  		responsive: [
    		{
    		  breakpoint: 1024,
    			  settings: {
     		      slidesToShow: 5,
        		  slidesToScroll: 2,
        		  infinite: true,
                  dots: true
                }
    },
    {
      breakpoint: 640,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
		centerMode:false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		centerMode:false
      }
    }
     ]
});

		

});
</script>
</body>
</html>
