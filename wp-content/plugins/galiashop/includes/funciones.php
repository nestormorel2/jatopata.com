<?php

//FUNCIONES QUE MUESTRAN TAXONOMIAS
 
function eremap_tax2checkbox($taxonomy){
	global $wp_query;
	$args=array('hide_empty'=>false);
	$myterms = get_terms($taxonomy, $args);
	$misvars=array_merge($wp_query->query,$_GET,$_POST);
	foreach($myterms as $term){
		?>
		<div class="checkbox">
			<label>
				<input <?php if($misvars[$taxonomy]==$term->slug){ echo 'checked'; }?> name="<?php echo $taxonomy;?>" value="<?php echo $term->slug;?>" type="checkbox"> <?php echo $term->name;?>
			</label>
		</div>
		<?php
	}
}

//para el single
function eremap_tax2tags($postid,$tax=false){
	if($tax==false) {return false; }
	$taxo=wp_get_post_terms($postid,$tax);
	foreach ($taxo as $kt => $vt) {
		$htmlcode.=''.($vt->name).', ';
	}
	if(strlen($htmlcode)>2){
		return substr($htmlcode,0,-2);
	}
	return false;
}
function eremap_tax2links($postid,$tax=false){
	if($tax==false) {return false; }
	$taxo=wp_get_post_terms($postid,$tax);
	
	foreach ($taxo as $kt => $vt) {
		$htmlcode.='<a href="'.get_term_link($vt->term_id).'?post_type='.get_post_type($postid).'">'.($vt->name).'</a> / ';
		//$htmlcode.='<a href="'.get_term_link($vt->term_id).'?post_type='.get_post_type($postid).'">'.($vt->name).'</a> / ';
	}
	if(strlen($htmlcode)>2){
		return substr($htmlcode,0,-2);
		
	}
	return false;
}

function eremap_tax2linksarchive($taxonomy = false ){
	if($taxonomy==false) {return false; }
        $args=array('hide_empty'=>false);
	$taxo=get_terms($taxonomy, $args);
	$htmlcode.= "<ul class='eremapas'>";
	foreach ($taxo as $kt => $vt) {
		$htmlcode.='<li><a href="'.get_term_link($vt->term_id).'">'.($vt->name).'</a> </li>';
		//$htmlcode.='<a href="'.get_term_link($vt->term_id).'?post_type='.get_post_type($postid).'">'.($vt->name).'</a> / ';
	}
	$htmlcode.= "</ul>";
	//if(strlen($htmlcode)>2){
	//	return substr($htmlcode,0,-2);
	//}
	return $htmlcode;
}

// METADATA
function eremap_isJson($string) {
	$t=@json_decode($string,true);
	if(is_array($t)){
		return true;
	}
	return false;
}
//Limpia Array
function eremap_limpia_array($array){
	
	if(is_array($array)){
		return limpia_array($array);
	} else{
		return htmlentities($array, ENT_QUOTES,'UTF-8',false);
	}

	return $array;
}


function eremap_cargarimagen($imagen, $pid, $portada){
		if ( ! function_exists( 'wp_handle_upload' ) ) {
		    require_once( ABSPATH . 'wp-admin/includes/file.php' );
		    require_once(ABSPATH . 'wp-admin/includes/image.php');
		    require_once(ABSPATH . 'wp-admin/includes/post.php');
		}

	    $uploadedfile = $imagen;
	    $upload_overrides = array( 'test_form' => false );
	    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
	    if ( $movefile ) {
	        //echo "File is successfully uploaded.\n";
	        //var_dump( $movefile);
	        $filename = $imagen['name'];
	        $wp_filetype = wp_check_filetype($filename, null );
	        $mime_type = $wp_filetype[type];
	        $attachment = array(
	          'post_mime_type' => $wp_filetype['type'],
	          'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
	          'post_name' => preg_replace('/\.[^.]+$/', '', basename($filename)),
	          'post_parent' => $pid,
	          'post_status' => 'inherit'
	        );
	        $attachment_id = wp_insert_attachment($attachment, $movefile['url'], $pid);

	        if($attachment_id != 0) {
	          $attachment_data = wp_generate_attachment_metadata($attachment_id, $movefile['file']);
	          //var_dump( $attachment_data);
	          $coso = wp_update_attachment_metadata($attachment_id, $attach_data);
	          //var_dump( $coso);
	          if($portada == 1){
	          	set_post_thumbnail( $pid, $attachment_id );
	          }
	        }

	    } else {
	        echo "Error!\n";
	    }

}


function eremap_enviarmail($correo, $pid){
    //$mailhash = wp_hash($correo);
    //$url = 'http://marketpar.com.py/loginguest?mac=' . $mailhash;
    $permalink = get_permalink( $pid );
    
    
    $mensaje = '------Enviado Automaticamente desde asd.gov.py--------- ' . "\r\n". "\r\n";

    
    $mensaje .= 'Gracias por colaborar con el sitio, en breve podra visualizar su publicación :'. "\r\n";
    
    
    $headers = 'From: Plancha.gov.py <info@asasulabpy.org>' . "\r\n";
    wp_mail($correo, 'Colaboracion en asd.gov.py', $mensaje, $headers); 
}