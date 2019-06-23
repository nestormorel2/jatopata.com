<?php get_header(); ?>







<section class="articulo" >
  <div class="container">
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
                      
                      <div class="">
                        <h2 class="posttitle"><?php the_title(); ?></h2>

                       


                        <div style="text-align:center; margin-bottom:18px;">
                          <?php the_post_thumbnail( 'index_thumb', array('class' => 'img-responsive')  ); ?>
                        </div>

                        <?php //the_content(); ?>


                        <?php edit_post_link('Editar este post', '<p>', '</p>'); ?>
                      </div>
                  <?php endwhile; ?>
                      
           
                      <!-- End Info Blcoks -->
                  <?php else: ?>      
                   <?php endif; 
                   //$args = null;
                   //wp_reset_query();
                  ?>











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
                        
                       
                    </div>
                    <div class="col-md-6">
                       

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
                      <button type="submit" class="btn btn-primary">Modificar</button>
                    </div>
                </div>
            </form>


        </div>
        
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>