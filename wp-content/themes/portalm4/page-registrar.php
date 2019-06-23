<?php /* Template Name: Ancho total */ ?>
<?php get_header(); ?>





<section class="articulo" >
  <div class="container">
    <div class="row">
      <div class="col-md-12">
             <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
             
                                

            <div class="post">
  
        <?php// if (!(current_user_can('level_0'))){ ?>   
            <h2><?php the_title();?></h2>  


            <form class="form-horizontal"  method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">

                        <fieldset>
                            <legend>Datos Personales</legend>
                            <?php if (!(current_user_can('level_0'))){ ?>  <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Nombre y Apellido</label></div>
                                <div class="col-sm-8"><input class="form-control" placeholder="Juan Perez" name="nombre" type="text"></div>
                            </div>
                        <?php } else { ?>
                        	Bienvenido/a  <?php echo $current_user->user_firstname; ?> <?php echo $current_user->user_lastname; ?><br><br>
                        	<input class="form-control" name="email" value="<?php $current_user->user_email; ?>" type="hidden">
                       	<?php } ?>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Telefono</label></div>
                                <div class="col-sm-8"><input class="form-control" placeholder="0982555666" name="tel" type="text"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Celular 1</label></div>
                                <div class="col-sm-4"><input class="form-control" placeholder="0982555666" name="celu" type="text"></div>
                                <div class="col-sm-4"><label for="celuwha">tiene whatsapp? <br> <input type="checkbox" value="true" name="celuwha" id="celuwha" checked="checked"></label></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Celular 2</label></div>
                                <div class="col-sm-4"><input class="form-control" placeholder="0982555666" name="celu2" type="text"></div>
                                <div class="col-sm-4"><label for="celuwha2">tiene whatsapp?  <br><input type="checkbox" value="true" name="celu2wha" id="celu2wha" checked="checked"></label></div>
                            </div>
                        </fieldset>
                        <?php if (!(current_user_can('level_0'))){ ?>  
                        <fieldset>
                            <legend>Acceso</legend>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Email</label></div>
                                <div class="col-sm-8"><input class="form-control" name="email" placeholder="tu@correo.com" type="text"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Contraseña</label></div>
                                <div class="col-sm-8"><input class="form-control" name="password" type="password"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Repetir Contraseña</label></div>
                                <div class="col-sm-8"><input class="form-control" name="password2" type="password"></div>
                            </div>

                            <?php echo do_shortcode('[TheChamp-Login title="Ingresa con Facebook"]'); ?>
                        </fieldset>
                        <?php } ?>
                       
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Datos de Tienda</legend>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Nombre de Tienda</label></div>
                                <div class="col-sm-8"><input class="form-control" placeholder="nombre de tu tienda" name="blogname" id="blogname" type="text"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">www.mercado4.com.py/</label></div>
                                <div class="col-sm-5"><input class="form-control" name="blog_title" placeholder="url de tu tienda" id="blog_title" type="text" readonly="true"></div>
                                 <div class="col-sm-2"><label for="celuwha2">Editar URL  <input type="checkbox" name="editarurl" id="editarurl" ></label></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                	<div style="text-align:center"><img src="" style="height:auto; width: 90%; " id="acafoto"></div>
                                	<label class="control-label">Seleccionar Foto:</label></div>
                                <div class="col-sm-8"><input type="file" id="subefoto" name="subefoto"></div>
                            </div>
                        </fieldset>

                         <fieldset>
                            <legend>Descripción de la Tienda</legend>
                             <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Descripción:</label></div>
                                <div class="col-sm-8"><textarea class="form-control" placeholder="describe tu negocio en un parrafo" rows="3" name="descripcion" id="comment"></textarea></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Dirección:</label></div>
                                <div class="col-sm-8"><textarea class="form-control" placeholder="Escriba aquí la direccion de su tienda, galeria, piso, numero de local o referencia." rows="3" name="direccion" id="direccion"></textarea></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4"><label class="control-label">Plantilla:</label></div>
                                <div class="col-sm-8"><label><input type="radio" name="optradio" checked><img src="<?php bloginfo('template_url');?>/tema1.jpg" ></label></div>
                            </div>

                        </fieldset>
                        
                       
                    </div>
                    
                </div>
                <div class="row">
                	<div class="col-md-12">
                		 <fieldset>
                            <legend>Ubicación</legend>
                            <p id="instrumapa">Arrastre la casita hasta la ubicación donde está su tienda <button class="btn btn-warning" id="agrandarmapa">Agrandar Mapa</button></p>
                             <input id="pac-input" class="controls" type="text" placeholder="Buscar calle o referencia">
    						 <div id="map"></div>
    						 <input class="form-control" name="latitud" id="latitud" type="hidden">
    						 <input class="form-control" name="longitud" id="longitud" type="hidden">
    						  <script>
							      // This example adds a search box to a map, using the Google Place Autocomplete
							      // feature. People can enter geographical searches. The search box will return a
							      // pick list containing a mix of places and predicted search terms.

							      // This example requires the Places library. Include the libraries=places
							      // parameter when you first load the API. For example:
							      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

							      function initAutocomplete() {
							        var map = new google.maps.Map(document.getElementById('map'), {
							          center: {lat: -25.297167, lng:-57.621805},
							          zoom: 15,
							          mapTypeId: 'roadmap',
							          mapTypeControl: false,
							          mapTypeControlOptions: {
							              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
							              position: google.maps.ControlPosition.BOTTOM_LEFT
							          }
							        });


							        /*var icon = {
							              url: place.icon,
							              size: new google.maps.Size(71, 71),
							              origin: new google.maps.Point(0, 0),
							              anchor: new google.maps.Point(17, 34),
							              scaledSize: new google.maps.Size(25, 25)
							            };*/

						            // Create a marker for each place.

	


						            var latlng = new google.maps.LatLng(-25.297167, -57.621805);
						            document.getElementById("latitud").value = -25.297167;
						            document.getElementById("longitud").value = -57.621805;

						            var vMarker = new google.maps.Marker({
						              map: map,
						              title: "Tu Tienda",
						              position: latlng,
						              draggable: true,
						              icon: "<?php bloginfo('template_url'); ?>/casita.png"
						            })

						            //markers.push(vMarker);

						            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
						                document.getElementById("latitud").value = evt.latLng.lat().toFixed(6);
						                document.getElementById("longitud").value =evt.latLng.lng().toFixed(6);

						                map.panTo(evt.latLng);
						            });

							        // Create the search box and link it to the UI element.
							        var input = document.getElementById('pac-input');
							        var searchBox = new google.maps.places.SearchBox(input);
							        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

							        // Bias the SearchBox results towards current map's viewport.
							        map.addListener('bounds_changed', function() {
							          searchBox.setBounds(map.getBounds());
							        });

							        //var markers = [];
							        // Listen for the event fired when the user selects a prediction and retrieve
							        // more details for that place.
							        searchBox.addListener('places_changed', function() {
							          var places = searchBox.getPlaces();

							          if (places.length == 0) {
							            return;
							          }

							          // Clear out the old markers.
							          /*markers.forEach(function(marker) {
							            marker.setMap(null);
							          });
							          markers = [];
*/
							          // For each place, get the icon, name and location.
							          var bounds = new google.maps.LatLngBounds();
							          places.forEach(function(place) {
							            if (!place.geometry) {
							              console.log("Returned place contains no geometry");
							              return;
							            }
							            

							            
    									vMarker.setPosition( place.geometry.location);

    									document.getElementById("latitud").value = place.geometry.location.lat().toFixed(6);
						                document.getElementById("longitud").value =place.geometry.location.lng().toFixed(6);

							            if (place.geometry.viewport) {
							              // Only geocodes have viewport.
							              bounds.union(place.geometry.viewport);
							            } else {
							              bounds.extend(place.geometry.location);
							            }
							          });
							          map.fitBounds(bounds);
							        });
							      }

							      initAutocomplete();

							      jQuery( document ).ready(function() {

								      jQuery('#subefoto').change( function(event) {
										jQuery("#acafoto").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
									});


								      jQuery("#blogname").keyup(function(){
										    var Text = jQuery(this).val();
										    Text = aslug(Text);
										    jQuery("#blog_title").val(Text);
										});

								      jQuery("#blog_title").keyup(function(){
										    var Text = jQuery(this).val();
										    Text = aslug(Text);
										    jQuery("#blog_title").val(Text);
										});

								      jQuery("#editarurl").change( function(event) {
								      	if(jQuery(this).is(':checked')){

								      		jQuery("#blog_title").attr('readonly', false);
								      	}else{
								      		jQuery("#blog_title").attr('readonly', true);
								      	}
										
									});

								      function aslug(str) {
										  str = str.replace(/^\s+|\s+$/g, ''); // trim
										  str = str.toLowerCase();

										  // remove accents, swap ñ for n, etc
										  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
										  var to   = "aaaaeeeeiiiioooouuuunc------";
										  for (var i=0, l=from.length ; i<l ; i++) {
										    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
										  }

										  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
										    .replace(/\s+/g, '-') // collapse whitespace and replace by -
										    .replace(/-+/g, '-'); // collapse dashes

										  return str;
										}

								   });
							    </script>

                        </fieldset>
                	</div>


                	<div class="col-md-12">
                      <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </form>

                
            <?php

            $user = 0;
            if(isset($_POST['email'])){
             
             $nombre=$_POST['nombre'];
             $tel=$_POST['tel'];
             $celu=$_POST['celu'];
             $celu2=$_POST['celu2'];
             $celuwha=$_POST['celuwha'];
             $celu2wha=$_POST['celu2wha'];
             $email=$_POST['email'];
             $password=$_POST['password'];
             $blogname=$_POST['blogname'];
             $blogtitle=$_POST['blog_title'];
             $latitud=$_POST['latitud'];
             $longitud=$_POST['longitud'];
             $descripcion=$_POST['descripcion'];
             $foto="";


              if (!(current_user_can('level_0'))){ 

	              $userdata = array(
	              'user_login'    =>   $email,
	              'user_email'    =>   $email,
	              'user_pass'     =>   $password,
	              'first_name'    =>   $nombre,
	              );

	              $user = wp_insert_user( $userdata );
	          }else{
	          	$user = get_current_user_id();
	          }

              

               var_dump($user);
              
              if($user>0){

              	/* parte de subir imagen*/
              	if (!function_exists('wp_generate_attachment_metadata')){
			                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
			            }
						
				if ($_FILES['subefoto']['name']) {
					
					if ($_FILES['subefoto']['error'] !== UPLOAD_ERR_OK) {
						echo "upload error : " . $_FILES['subefoto']['error'];
					}

					$attach_id = media_handle_upload( 'subefoto', 0 );

					//return $attach_id;
					$foto= wp_get_attachment_url($attach_id);
				
				}
				


                add_user_meta( $user, 'telefono', $tel );
                add_user_meta( $user, 'telefono2', $celu );
                add_user_meta( $user, 'telefono3', $celu2 );
                add_user_meta( $user, 'telefono2wha', $celuwha );
                add_user_meta( $user, 'telefono3wha', $celu2wha );
                add_user_meta( $user, 'latitud',  $latitud);
                add_user_meta( $user, 'longitud',  $longitud);
                add_user_meta( $user, 'descripcion',  $descripcion);
                add_user_meta( $user, 'foto',  $foto);

               // echo $latitud . 'aa'.$longitud;
                //add_user_meta( $user, 'foto',  $foto);
                $userdatai= get_userdata( $user );
                $varusername=$userdatai->user_login;
                $varusermail=$userdatai->user_email;



                $result = wpmu_validate_blog_signup( $blogname, $blogtitle );
                $domain = $result['domain'];
                $path = $result['path'];
                $blogname = $result['blogname'];
                $blogtitle = $result['blog_title'];
                $errors = $result['errors'];
                echo '<br>';
                echo '<br>';
                var_dump($result);
                wpmu_signup_blog($domain, $path,$blogtitle,$varusername, $varusermail ); 


/*
                //obtener dato de administrador
                $admindato =  get_userdata(1);


                wpmu_signup_blog($domain, $path,$blogtitle,$admindato->user_login, $admindato->user_email ); 

                $nblog_id = get_blog_id_from_url($domain, $path);

             
				$role = 'editor';
				$resul = add_user_to_blog( $nblog_id, $user, $role );

				var_dump($resul);*/

				auto_login( $varusername );
  

              }else{
              	echo 'error al crear el usuario';
              }
             

              
            }

           
              
            ?>
            
              

            
        <?php //} else { ?>

        

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
            


        <?php// }  ?>
 



                        
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
