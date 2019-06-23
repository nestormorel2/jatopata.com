<?php get_header(); ?>
<div class="col-md-9">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php edit_post_link('modificar', '', '');?>
        
        
        <?php the_content(); ?>
        
        <?php  
                $latitud=get_post_meta($post->ID,'dereerea_latitud',true);
                $longitud=get_post_meta($post->ID,'dereerea_longitud',true);
            ?>
        
        <div id="mapa"></div>
                    
       

        <style>
            #mapa { width:60%; height:250px; }
        </style>

        <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../css/leaflet.css"/>
        <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../js/leaflet-src.js"></script>
        <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../css/leaflet.draw.css"/>
        <script src="<?php echo plugin_dir_url( __FILE__ ); ?>../js/leaflet.draw.js"></script>

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


             var zoom = 16;

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

                    



                     <?php
                     $datoguardado = get_post_meta( $post->ID, 'dereerea_datoitem', true );
                     if($datoguardado){ ?>

                         //echo "holaa";
                         var v_geojsonFeature = {
                         "type": "FeatureCollection",
                         "features": [
                             <?php echo $datoguardado; ?>,
                         ]
                         };

                     L.geoJson(v_geojsonFeature, {
                     onEachFeature: onEachFeature
                         }).addTo(map);

                             <?php
                     }
                     ?>
                             
                             
                             



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
        
        
    <?php endwhile; else: ?>
        <h3>No hay datos </h3>
    <?php endif; ?>
</div>

<div class="col-md-3">
    <?php include('sidebaritem.php'); ?>
</div>
<?php get_footer(); ?>