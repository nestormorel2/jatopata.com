	<footer id="footer" class=" footer contenedorgeneral" <?php if (is_front_page()) { ?> style="margin-top:0;" <?php } ?> >
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-3 datos" style="text-align: center;">

			<a href="<?php bloginfo('url');?>/"><img src="<?php bloginfo('template_url');?>/m4logomini.png" class="logoprincipal"></a>
			

		</div>
		
		
		<div class=" col-md-4 datos">
			 <div id="sidebar" >
			<h4><a href="#infopoliticas" class="infoextra">Politicas de publicacion de tiendas, anuncios y productos</a></h4>
            
			<div class="cuadroinfoextra">
				<div id="infopoliticas"  class="fondoblanc">
					Politicas de publicacion de tiendas, anuncios y productos
				</div>
			</div>
            <?php //get_sidebar(); ?>
            
            <!-- AGREGAR SIDEBAR DINAMICOOO -->
            
          </div>
		</div>

		<div class=" col-md-3 datos" style="text-align: right;">
			

		 <h4>Contacte con el administrador</h4>
		 <p><a href="#infocontacto" class="infoextra">(Politicas de contacto)</a></p>
				
		 <div class="cuadroinfoextra">
				<div id="infocontacto" class="fondoblanc">
					Politicas de publicacion de tiendas, anuncios y productos
				</div>
			</div>
      
				

	
		</div>

		<div class=" col-md-2 datos">
			
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
	
	
	<div class="contenumeros">
		<i class="fas fa-times-circle cerrarnu" ></i>
		
		
			<?php
			$telefono="0981670410";
			$urlwha="#";
			 if($telefono and $linkwha!=''){ 
			 	$urlwha= $linkwha . $telefono;
			 } else {
			 	
			} 
			if($configuracion['ttelefono3wha']!="" ){ 
			 		echo '<i class="fab fa-whatsapp"></i>';
			 }else{
			 		echo '<i class="fas fa-mobile-alt"></i>';
			 }
			 ?>
			<a href="<?php echo $urlwha; ?>"  target="_blank"><?php echo $telefono; ?></a>
		
	</div>
	<img src="<?php bloginfo('template_url');?>/wha.png" class="imgwha" class="responsive-img" />
</div>
		 
      
				

	
		</div>

		<div class="col-md-12 social">
			
		</div>
	</div>

	


	</div>
	
	
</footer>
</div>



<script src="<?php bloginfo('template_url');?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/parallax.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/jquery.colorbox-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/i18n/jquery.colorbox-es.js"></script>
		
<?php wp_footer(); ?>

<script>
x = 0;

</script>
<script  type="text/javascript">
	new WOW().init();
	jQuery.noConflict()
	
        jQuery(document).ready(function(){


      jQuery('.contenumeros').hide();
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

            //alert(jQuery(window).width());
            if(jQuery(window).width() >= 700 && jQuery(window).width() < 1328){

                jQuery(".infoextra").colorbox({inline:true,transition:'fade', width:"50%",close:'X',previous:'',next:'', current:'', loop:false});
                 jQuery(".gallery-icon a").colorbox({transition:'fade', rel:'group', width:"85%", preloading:true, close:'X',previous:'',next:'', current:'', loop:false});

            }else if(jQuery(window).width() >= 1328){
                 jQuery(".infoextra").colorbox({inline:true,transition:'fade', width:"35%",close:'X',previous:'',next:'', current:'', loop:false});
                 jQuery(".gallery-icon a").colorbox({transition:'fade', rel:'group', width:"60%", preloading:true, close:'X',previous:'',next:'', current:'', loop:false});
            }else{
                jQuery(".infoextra").colorbox({inline:true,transition:'fade', width:"95%",close:'X',previous:'',next:'', current:'', loop:false});
                jQuery(".gallery-icon a").colorbox({transition:'fade', rel:'group', preloading:true, close:'X',previous:'',next:'', current:'', loop:false});
                 jQuery(".pestania").colorbox({inline:true,transition:'fade', width:"100%", height:"100%",close:'X',previous:'',next:'', current:'', loop:false});
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

	     /* 	if(winHt < 900){
	      		
		    	
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
		      }
*/


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
