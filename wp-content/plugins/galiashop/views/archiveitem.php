<?php get_header(); ?>




    
  </div>
<div class="contenedormapa">
    <h1 class="titulomapa">Mapa del Centro Histórico de Asunción</h1>
    <div class="col-md-3 sidebarflotante">
    <?php include('sidebaritem.php'); ?>
</div>
    <div id="mapa"></div>
</div>
       
       <!--<p style="margin-right:10em">
Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta
       </p>-->
        
 <div class="container-fluid" id="sugerir" style="padding-top:120px; padding-bottom:80px;">        
        
<div class="col-md-8 col-md-offset-2">

   

                    <div class="titulosec"  ><h1>Sugerir ubicación para el mapa</h1></div>



                    <?php if(isset($_POST['titulo']) AND isset($_POST['descripcion'])) {
                        $titulo = $_POST['titulo'];
                        $descripcion = $_POST['descripcion'];
                        $nombre = $_POST['nombre'];
                        $email = $_POST['suemail'];
                        $categoria = $_POST['categoria'];
                        $datoitem = $_POST['datoitem'];
                        $latitud = $_POST['latitud'];
                        $longitud = $_POST['longitud'];
                      

                       /* $destacado = null;
                        if(isset($_POST['destacado'])){
                          $destacado = $_POST['destacado'];
                          //echo $destacado;
                        }

                        $captcha_instance = new ReallySimpleCaptcha();
                        $captcha_instance->tmp_dir = '/home/bolbush/public_html/marketpar/wp-content/uploads/wpcf7_captcha/';
                        $correct = $captcha_instance->check( $cosa, $captcha );
                        if ($correct == true)  {
                          $captcha_instance->remove( $news_cosa );
                        */
                          // ADD THE FORM INPUT TO $new_post ARRAY
                          $new_post = array(
                            'post_title'  =>  $titulo,
                            'post_content' => $descripcion,
                            'post_status' =>  'draft',           // Choose: publish, preview, future, draft, etc.
                            'post_type' =>  'ereerea_itemmapa',  //'post',page' or use a custom post type if you want to
                            'dereerea_nombre'  =>  $nombre,
                            'dereerea_email'  =>  $email,
                            'dereerea_datoitem'  =>  $datoitem,
                            'dereerea_latitud'  =>  $latitud,
                            'dereerea_longitud'  =>  $longitud
                          );

                          //SAVE THE POST
                          $pid = wp_insert_post($new_post);

                          //ADD OUR CUSTOM FIELDS
                          add_post_meta($pid, 'dereerea_nombre', $nombre, true);
                          add_post_meta($pid, 'dereerea_email', $email, true);
                          add_post_meta($pid, 'dereerea_datoitem', $datoitem, true);
                          add_post_meta($pid, 'dereerea_latitud', $latitud, true);
                          add_post_meta($pid, 'dereerea_longitud', $longitud, true);

                          wp_set_object_terms( $pid, $categoria, 'ereerea_categoriaitem');
                        
                         

                          do_action('wp_insert_post', 'wp_insert_post');


                          if(!($_FILES['foto1']['name'] == '')) {
                            eremap_cargarimagen($_FILES['foto1'], $pid, 1);
                          }
                        


                          eremap_enviarmail($email, $pid);

                          echo '<h2 style="font-size:24px; margin-left:auto; margin-right:auto; margin-bottom:25px;">Su publicacion ha sido agregada, en breve sera aprobada. Gracias!</h2>';


                     /*   } else {

                          echo '<h2 style="font-size:24px;  margin-left:auto; margin-right:auto; margin-bottom:25px;">Complete correctamente los campos</h2>';

                        }*/

                     } else  {

                        // si no se envio nada se muestra el form
                      ?>




                                            <form class="form-horizontal" action="/itemsmapa/#sugerir"  method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="titulo" class="col-sm-2 control-label">Titulo o Nombre del lugar</label>
                                                <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="titulo" name="titulo" placeholder="ej: Bar Pepe, Organizacion Vecinal Jasy">
                                                </div>
                                              </div>
                                               <div class="form-group">
                                                <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>
                                                <div class="col-sm-10">
                                                  <textarea class="form-control" name="descripcion" rows="3"></textarea>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label for="titulo" class="col-sm-2 control-label">Nombre</label>
                                                <div class="col-sm-4">
                                                  <input type="text" class="form-control" name="nombre" placeholder="tu nombre">
                                                </div>
                                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-4">
                                                  <input type="email" class="form-control" id="inputEmail3" name="suemail" placeholder="Email">
                                                </div>

                                              </div>
                                              <div class="form-group">
                                             
                                                <div class="col-sm-6">
                                                 
                                                  <div id="mapamarcar"></div>

                                                  <input type="hidden" name="datoitem" id="datoitem" >
                                                  <input type="hidden" name="latitud"  id="latitud"  >
                                                  <input type="hidden" name="longitud" id="longitud" >
                                                </div>



                                                <label for="exampleInputFile"  class="col-sm-2 control-label">Categoría</label>
                                                <div class="col-sm-4">

                                                    
                                                    <select class="form-control" name="categoria">
                                                      <?php
                                                          $subcats=get_categories(array('taxonomy' => 'ereerea_categoriaitem','orderby'=>'slug', 'parent' => 0 , 'hide_empty' => 0));
                                                          foreach($subcats as $k=>$subcategoria){ ?>
                                                              <option value="<?php echo $subcategoria->slug; ?>">----<?php echo $subcategoria->name; ?></option>
                                                          <?php  } // end foreach ?>
                                                    </select>
                                                    
                                                </div>




                                                <label for="exampleInputFile" style="margin-top:10px;"   class="col-sm-2 control-label">Seleccionar foto</label>
                                                <div class="col-sm-4">

                                                    
                                                    <input type="file"  name="foto1" style="margin-top:20px;" id="exampleInputFile">
                                                    
                                                </div>

                                                <div style="text-align:center; padding-top:20px;" class="col-sm-6" >
                                                      <button type="submit" class="btn btn-warning btn-lg">Enviar</button>
                                                  </div>


                                              </div>
                                             
                                              
                                              
                                            </form>
                        <?php } ?>





                    

      
        
        <?php $datos = array(); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         
                
        
        
                <?php
                    $thumb = wp_get_attachment_thumb_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
                    $meta = get_post_meta( $post->ID, 'dereerea_datoitem', true );
                    $taxo=wp_get_post_terms($post->ID,'ereerea_categoriaitem');
                    $enlace=  get_the_permalink($post->ID);
                    
                    //$iconoslug = $taxo[0]->slug;
                    $iconoslug = get_term_meta( $taxo[0]->term_id, 'ereereataximg', true );

                    if($iconoslug == ""){
                        $iconoslug = plugin_dir_url( __FILE__ ) . '../images/marcadorcito.png';
                    }

                    //echo 'ueeee' . $iconoslug;
                    

                    //$estilo =  ', "style": {"fill":"red","stroke-width": "3", "fill-opacity": 0.1 }';
                    $estilo = "";
                    
                    $geojson = str_replace('"properties":{}', '"properties":{ "imagen": "'.$thumb.'", "nombre": "'.get_the_title().'", "descripcion": "'.get_the_excerpt($post->ID).'", "iconcat": "'.$iconoslug.'" , "enlace": "'.$enlace.'"  } ' . $estilo , $meta);
                    array_push($datos,$geojson);
                ?>
        <?php endwhile; else: ?>
            
        <?php endif; ?>
      
                    
       

        <style>
        .contenedormapa{position: relative;}
        .titulomapa{position: absolute;  padding-left: 80px; top:0; z-index:1024;width: 100%; color: #494747;text-shadow: #FFF 1px 1px 0;
             font-family: "Roboto Condensed",sans-serif ; font-weight:bold;}
        .sidebarflotante{position: absolute; top:140; right: 48px; z-index:1024; }
        .sidebarflotante h2{color:#831f82; text-align: right; text-shadow: #fff 1px 1px 0;}
            #mapa { width:100%; height:600px; margin-bottom: 20px; }
            #mapamarcar { width:100%; height:270px;  }
            .minimini{width: 60px; height: 60px;}
        </style>

        <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../css/leaflet.css"/>
        <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../js/leaflet-src.js"></script>
        <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../css/leaflet.draw.css"/>
        <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../js/leaflet.draw.js"></script>
        <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../datos/estaciones_servicio.geojson"></script>
        
        
        

	<script>
            jQuery( document ).ready(function( $ ) {
            
             var latitud = -25.283603;
             var longitud = -57.619823;
             
            
                     
             //var icons = {
                 <?php

                    //$taxopicon=get_terms('ereerea_categoriaitem');
                    //foreach ($taxo as $kt => $vt) {
                    //    echo $vt->slug.' :  L.icon({iconUrl: "'.get_term_meta( $vt->term_id, 'ereereataximg', true ).'",iconSize: [20,20]}),'; 
                    //}
                 ?>
               //          }


             var zoom = 15;

             var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                             osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                             osm = L.tileLayer(osmUrl, {maxZoom: 18, attribution: osmAttrib});
                             map = new L.Map('mapa', {center: new L.LatLng(latitud, longitud), zoom: zoom}),
                             drawnItems = L.featureGroup().addTo(map);
                     L.control.layers({
                      'osm':osm.addTo(map),
                      "google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', { attribution: 'google'})
                     }).addTo(map);

                     map.scrollWheelZoom.disable();

                    
                    var myStyle = {
    "color": "#831F82",
    "stroke-width": "1",
    "weight": 5,
    "opacity": 0.2
};

                     

                         //echo "holaa";
                         var v_geojsonFeature = {
                         "type": "FeatureCollection",
                         "features": [
                                <?php foreach ($datos as $dato): ?>
                                <?php echo $dato; ?>,
                                <?php endforeach; ?>
                            ]
                         };

                    L.geoJson(v_geojsonFeature, {
                        onEachFeature: onEachFeature,
                        style: myStyle,
                        pointToLayer: function (feature, latlng) {
                            return L.marker(latlng, {
                                icon: L.icon({iconUrl: feature.properties.iconcat ,iconSize: [40,40]})
 
                            });
                        }
                    }).addTo(map);
                         
                         
                     /* L.geoJson(v_estaciones, {
                     onEachFeature: onEachFeature
                         }).addTo(map); */

                   


                     function onEachFeature(p_feature, p_layer) {
                         if (p_feature.properties) {
                             var v_popupString = '<div class="popup" style="text-align:center">';

                             for (var k in p_feature.properties) {
                                 var v = p_feature.properties[k];
                                 
                                 if(k=='nombre'){
                                     v_popupString +=   '<h3 style="margin: 10px 0 10px 0; padding:0;">' + v + '</h3>';
                                 }
                                 else if(k=='name'){
                                     v_popupString +=   '<h3 style="margin: 10px 0 10px 0; padding:0;">' + v + '</h3>';
                                 }
                                 else if(k=='brand'){
                                     v_popupString +=   '<h3 style="margin: 10px 0 10px 0; padding:0;">' + v + '</h3>';
                                 }
                                 else if(k=='descripcion'){
                                     v_popupString +=   '<p>' + v + '</p>';
                                 }
                                 else if(k=='imagen'){
                                     v_popupString +=   '<img style="width:60px; height:60px;" src="' + v + '" >';
                                 }
                                 else if(k=='enlace'){
                                     v_popupString +=   '<a href="' + v + '" >Ver detalle</a>';
                                 }
                                 else{
                                     //v_popupString +=   v + '<br />';
                                 }
                             }
                             v_popupString += '</div>';
                             p_layer.bindPopup(v_popupString);
                         }
                     }



           });
        </script>


         <script>
       jQuery( document ).ready(function( $ ) {
        // Villarrica Paraguay.
        <?php if ($latitud){ ?>
            var latitud = <?php echo $latitud ?>;
            var longitud = <?php echo $longitud ?>;
        <?php } else { ?>
            var latitud = -25.286954;
            var longitud =  -57.638987;
        <?php } ?>
         
       
        var zoom = 18;

        var osmUrl2 = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmAttrib2 = '&copy; <a href="http://openstreetmap2.org/copyright">OpenStreetMap</a> contributors',
            osm2 = L.tileLayer(osmUrl2, {maxZoom: 18, attribution: osmAttrib2});
            map2 = new L.Map('mapamarcar', {center: new L.LatLng(latitud, longitud), zoom: zoom}),
            drawnItems = L.featureGroup().addTo(map2);
        L.control.layers({
         'osm':osm2.addTo(map2),
         "google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
                attribution: 'google'
            })
        }, {'drawlayer':drawnItems}, { position: 'topleft', collapsed: false }).addTo(map2);
                
                map2.scrollWheelZoom.disable();
                
        map2.addControl(new L.Control.Draw({
            draw : {
                polygon : false,
                polyline : false,
                rectangle : false,
                circle : false
            }
            }
         ));

        map2.on('draw:created', function(event) {
            var layer = event.layer;
                        
            drawnItems.addLayer(layer);
                        
                        var shape = layer.toGeoJSON()
                        var shape_for_db = JSON.stringify(shape);
                        jQuery("#datoitem").val(shape_for_db);
                        
                        var coordenadas = layer.getLatLng()
                        
                        jQuery("#latitud").val(coordenadas.lat);
                        jQuery("#longitud").val(coordenadas.lng);
                        //jQuery("#datoslado").show();
                        
                      
                        
        });
                
                
               
                
                        
                        
                      

                

                function onEachFeature(p_feature, p_layer) {
                    if (p_feature.properties) {
                        var v_popupString = '<div class="popup">';

                        for (var k in p_feature.properties) {
                            var v = p_feature.properties[k];
                            v_popupString +=   v + '<br />';
                        }
                        v_popupString += '</div>';
                        p_layer.bindPopup(v_popupString);
                    }
                }
        
      
        
      });
   </script>
        

       
</div>



<?php get_footer(); ?>