jQuery( document ).ready(function() {
	//jQuery('#ns-wp-editor-div').append(jQuery('#wp-ns-editor-add-prod-short-desc-wrap'));
	
	/*PRODUCT DATA*/
	jQuery("li").on('click', function () {
		jQuery(".ns-prod-data-tab").addClass("ns-hidden");
		jQuery("li").removeClass("ns-active");
		jQuery("." + jQuery(this).attr("id")).removeClass("ns-hidden");
		jQuery(this).addClass("ns-active");	
	});
	
	jQuery("#ns-manage-stock").on('click', function () {
		if(jQuery("#ns-manage-stock").val() == "no"){
			jQuery('#ns-manage-stock-div').css('display','block');
			jQuery("#ns-manage-stock").val("yes");
		}
		else{
			jQuery('#ns-manage-stock-div').css('display','none');
			jQuery("#ns-manage-stock").val("no");
		}
	});
	
	//attributes
	var i = 0;
	jQuery('#ns-add-attribute-btn').on('click', function(event) {     
		if(jQuery('#ns-attribute-taxonomy').val() == 'ns-color-att'){
			jQuery('#ns-inner-attributes').after('<div class="ns-color-attr-class"><h3><label>Color</label></h3><div><label>Add new color:</label><input id="ns-color-attr" name="ns-color-attr" class="ns-input-width" type="text"></div><div><label id="ns-existing-colors">Select a color: </label></div><div><label>Visible on product page </label><input class="checkbox" name="ns-attr-visibility-status" id="ns-attr-visibility-status" checked="checked" type="checkbox"></div><button id="ns-attribute-btn-remove-col" type="button" class="button" style="float:left">Remove</button></div>');
			jQuery('#ns-color-id').prop('disabled', true);
			jQuery('#ns-attribute-taxonomy').val(jQuery('#ns-attribute-taxonomy option:first').val());
			//get the color attributes already saved to create the checkboxes and permits the user to choosing them
			var col_attr = jQuery('#ns-color-att-list').val();
			col_attr = col_attr.split(',');
			
			//create checkboxes for each color already inserted
			jQuery('#ns-existing-colors').after('<table id="color-table">');
			jQuery.each(col_attr, function(index, value){
				if(value != "")
					jQuery('#color-table').append('<tr><th>'+value+'</th><th><input class="checkbox checkbox-attr-selectable-color ns-margin-right" name="'+value+'" type="checkbox"><label>Is Variation</label><input class="checkbox check-is-variation-color-name" name="'+value+'" id="ns-attr-is-variable-color'+value+'" type="checkbox" style="margin-left: 15px;"></th></tr>');
				
			});
			jQuery('#ns-existing-colors').append('</table>');
		}
		else{
			jQuery('#ns-inner-attributes').after('<div><h3><label>Custom product attribute</label></h3><div class="ns-input-name-and-variation"><label>Name:</label><br><input class="ns-input-width attr-names-class" name="ns-attr-names'+i+'" id="ns-attr-names'+i+'" type="text"/><br><br><label>Is Variation</label><input class="checkbox check-is-variation-custom-name" name="'+i+'" id="ns-attr-is-variable-custom'+i+'" type="checkbox" style="margin-left: 15px;"></div><div><label>Value(s)</label><textarea name="ns-attribute-values'+i+'"placeholder="Enter some text, or some attributes by &quot;|&quot; separating values."></textarea></div><div><label>Visible on product page </label><input class="checkbox" name="ns-attr-visibility-status'+i+'" id="ns-attr-visibility-status'+i+'" checked="checked" type="checkbox" style="margin-left: 15px;"/></div><button id="ns-attribute-btn-remove" type="button" class="button" style="float:left">Remove</button></div>');
			i++;
		}
		jQuery('#ns-attribute-list').val(i);
		
	});
	
	//removing attribute
	jQuery(document).on('click', '#ns-attribute-btn-remove, #ns-attribute-btn-remove-col', function(event){
		if(jQuery(this).parent().hasClass('ns-color-attr-class')){
			jQuery('#ns-color-id').prop('disabled', false);
		}
		
		if(jQuery(this).attr('id') == 'ns-attribute-btn-remove'){	// check if theres a need to decrement the counter -- only in case im removing a custom attributes --
			i--;
			//removing from attribute custom variations hidden input the attribute
			var new_string = "";
		    new_string = jQuery('#ns-attr-custom-names').val();
			new_string = new_string.replace(jQuery('.ns-input-name-and-variation :nth-child(2)').val()+',', "");
			jQuery('#ns-attr-custom-names').val(new_string);
			console.log(jQuery('.ns-input-name-and-variation :nth-child(2)').val());
		}
		jQuery(this).parent().remove();
		jQuery('#ns-attribute-list').val(i);
	});
	
	//saving into hidden input selectable color
	jQuery(document).on('click', '.checkbox-attr-selectable-color', function(event){
		if(jQuery(this).is(':checked')){
			jQuery('#ns-attr-from-list').val(jQuery('#ns-attr-from-list').val()+jQuery(this).attr('name')+',');
		}
		else{
			var new_string = "";
		    new_string = jQuery('#ns-attr-from-list').val();
			new_string = new_string.replace(jQuery(this).attr('name')+',', "");
			jQuery('#ns-attr-from-list').val(new_string);
		}		
		
	});
	
	
	//saving into hidden input selected color for variation
	jQuery(document).on('click', '.check-is-variation-color-name', function(event){
		if(jQuery(this).is(':checked')){
			jQuery('#ns-attr-from-list-variation').val(jQuery('#ns-attr-from-list-variation').val()+jQuery(this).attr('name')+',');
		}
		else{
			var new_string = "";
		    new_string = jQuery('#ns-attr-from-list-variation').val();
			new_string = new_string.replace(jQuery(this).attr('name')+',', "");
			jQuery('#ns-attr-from-list-variation').val(new_string);
		}		
		
	});
	
	var x = 0;
	//saving into hidden input selected custom attribute for variation and adding the field to variations custom attr list
	jQuery(document).on('click', '.check-is-variation-custom-name', function(event){
		if(jQuery(this).is(':checked')){
			jQuery('#ns-attr-from-list-variation-custom').val(++x);
			
			//save the name of the custom attribute to hidden input to use it in variations 
			jQuery('#ns-attr-custom-names').val(jQuery('#ns-attr-custom-names').val()+jQuery('.ns-input-name-and-variation :nth-child(2)').val()+',');
		}
		else{
			jQuery('#ns-attr-from-list-variation-custom').val(--x);
			var new_string = "";
		    new_string = jQuery('#ns-attr-custom-names').val();
			new_string = new_string.replace(jQuery('.ns-input-name-and-variation :nth-child(2)').val()+',', "");
			jQuery('#ns-attr-custom-names').val(new_string);
		}		
		
	});
	
	//saving into hidden input the choosen linked product
	/*LINKED PRODUCT*/
	jQuery(document).on('click','.ns-check-linked',function(event) {
		if(jQuery(this).is(':checked')){
			jQuery('#ns-linked-list').val(jQuery('#ns-linked-list').val()+jQuery(this).attr('id')+',');
		}
		else{
			var new_string = "";
		    new_string = jQuery('#ns-linked-list').val();
			new_string = new_string.replace(jQuery(this).attr('id')+',', "");
			jQuery('#ns-linked-list').val(new_string);
		}
	});
	
		
	/*PRODUCT IMAGE*/
	/*This is used to create a temporary url (objectURL) to update the thumbnail image after user insert one*/
	jQuery('#ns-thumbnail').change( function(event) {
		jQuery("#ns-img-thumbnail").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
	});
	
	/*GALLERY AND MODAL*/
	/* When the user clicks on the button, open the gallery modal*/
	jQuery("#ns-myBtn").on('click', function() {
		jQuery('#ns-myModal').css("display","block");
	});

	/* When the user clicks on (x), close the gallery modal*/
	jQuery(".ns-close").on('click', function() {
		jQuery('#ns-myModal').css("display","none");
	});

	/*Categories modal*/
	jQuery("#ns-myBtn-cat").on('click', function() {
		jQuery('#ns-myModal-cat').css("display","block");
	});
	
	jQuery(".ns-close").on('click', function() {
		jQuery('#ns-myModal-cat').css("display","none");
	});
	
	
	
	/*Used to get the selected image from gallery list*/
	var img_array = [];		//this array will contains all the SELECTED images 
	
	jQuery('.ns-image-container img').on('click', function(){
		//Image clicked for the first time
		if(img_array.indexOf(jQuery(this).attr("id")) < 0){
			img_array.push(jQuery(this).attr("id"));
			//setting the value of the input with the urls of images separated by comma
			jQuery('#ns-image-from-list').val(img_array.toString());
			//jQuery('#ns-image-from-list').val( jQuery(this).attr("src") );
			jQuery(this).css('border','5px solid #bdcfed');
		}
		else{
			//Image already being clicked. Removing border and delete element from img_array
			jQuery(this).css('border', '1px solid gray');
			var elementToRemove = jQuery(this).attr("id");
			img_array = jQuery.grep(img_array, function(value) {
			  return value != elementToRemove;
			});
			jQuery('#ns-image-from-list').val(img_array.toString());
		}
			
	});
	
	/*This one is used to upload into the gallery the image from local path
	jQuery('#ns-image-from-file').change( function(event) {
		jQuery('#ns-image-from-file').attr('src',URL.createObjectURL(event.target.files[0]));
	});*/
	
	
	/*HIDE SHOW DIVS*/
	//product data
	jQuery('#ns-post-prod-data-hide-show').on('click', function(event) {            
			 if(jQuery( '#ns-product-data-inner-container' ).is( ':hidden' )){
				jQuery('#ns-post-prod-data-hide-show').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
			 }
			 else
				jQuery('#ns-post-prod-data-hide-show').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
			 jQuery('#ns-product-data-inner-container').toggle('show');
	});
	
	//short description
	jQuery('#ns-short-desc-hide-show').on('click', function(event) {            
			 if(jQuery( '#ns-wp-editor-div' ).is( ':hidden' )){
				jQuery('#ns-short-desc-hide-show').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
			 }
			 else
				jQuery('#ns-short-desc-hide-show').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
			 jQuery('#ns-wp-editor-div').toggle('show');
	});
	
	//post content
	jQuery('#ns-post-content-hide-show').on('click', function(event) {        
             if(jQuery( '#ns-wp-post-content-div' ).is( ':hidden' )){
				jQuery('#ns-post-content-hide-show').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
			 }
			 else
				jQuery('#ns-post-content-hide-show').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
			jQuery('#ns-wp-post-content-div').toggle('show');
    });
	
	//tags
	jQuery('#ns-prod-tags-hide-show').on('click', function(event) {        
			 if(jQuery( '#ns-prod-tags-div' ).is( ':visible' )){
				 jQuery('#ns-product-tags').css('height', '100%');
				 jQuery('#ns-prod-tags-hide-show').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
			 }
			 if(jQuery( '#ns-prod-tags-div' ).is( ':hidden' )){
				jQuery('#ns-product-tags').css('height', 'auto');
				jQuery('#ns-prod-tags-hide-show').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');		
			 }
			 jQuery('#ns-prod-tags-div').toggle('show');
    });
	
	//add image
	jQuery('#ns-prod-image-hide-show').on('click', function(event) {        
			 if(jQuery( '#ns-image-container-0' ).is( ':visible' )){
				 jQuery('#ns-image-container').css('height', '100%');
				 jQuery('#ns-prod-image-hide-show').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
			 }
			 if(jQuery( '#ns-image-container-0' ).is( ':hidden' )){
				jQuery('#ns-image-container').css('height', 'auto');	
				jQuery('#ns-prod-image-hide-show').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
			 }
			 jQuery('#ns-image-container-0').toggle('show');
    });
	
	//categories
	jQuery('#ns-prod-categories-hide-show').on('click', function(event) {        
			 if(jQuery( '#ns-prod-cat-inner' ).is( ':visible' )){
				 jQuery('#ns-product-categories').css('height', '100%');
				 jQuery('#ns-prod-categories-hide-show').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
				 
			 }
			 if(jQuery( '#ns-prod-cat-inner' ).is( ':hidden' )){
				jQuery('#ns-product-categories').css('height', 'auto');
				jQuery('#ns-prod-categories-hide-show').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
			 }
			 jQuery('#ns-prod-cat-inner').toggle('show');
    });
	
	//gallery
	jQuery('#ns-prod-gallery-hide-show').on('click', function(event) {        
			 if(jQuery( '#ns-prod-gallery-inner' ).is( ':visible' )){
				 jQuery('#ns-product-gallery').css('height', '100%');
				jQuery('#ns-prod-gallery-hide-show').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
				 
			 }
			 if(jQuery( '#ns-prod-gallery-inner' ).is( ':hidden' )){
				jQuery('#ns-product-gallery').css('height', 'auto');
				jQuery('#ns-prod-gallery-hide-show').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
			 }
			 jQuery('#ns-prod-gallery-inner').toggle('show');
    });
	
	
	/*EDIT PAGE*/
	jQuery(".ns-button-table-section").hover(function() {
		jQuery(".ns-to-hide").css('display', 'block');
	}, function() {
		jQuery(".ns-to-hide").css('display', 'none');
	});
	
	//ajax used to delete a post
	jQuery('.ns-button-table-del').click(function($) {
	var aux_arr = jQuery(this).data('id').split("#"); 	//getting the id of the product to delete
	var ns_cus_delete_product = aux_arr[1];
	
	jQuery.ajax({
		url : nsremoveprod.ajax_url,
		type : 'post',
		data : {
			action : 'ns_delete_product',
			ns_cus_del_prod :  ns_cus_delete_product,
			'id' : ns_cus_delete_product
		},
		success : function( response ) {
			alert(response);
			jQuery( "#ns-delete-post-"+ns_cus_delete_product ).closest( "tr" ).remove();
				
		},
	    error: function(errorThrown){
		    alert(errorThrown);
	    } 
		

	});
});

	//ajax used to update gallery with user selected image from input type file in gallery
	jQuery("#ns-add-prod-frontend-add-img-gallery").change(function() {
        jQuery('#ns-add-prod-frontend-save-img-gallery').show();
		
    });

	
	//ajax used to add cus category
	jQuery('#ns-cus-cat-btn').click(function($) {
		var custom_cat_val = jQuery('#ns-cus-cat-product').val();
		var custom_cat_parent = jQuery('#ns-cus-cat-parent-select').val();
			if(custom_cat_val != ''){
				var escaped_val = escape(custom_cat_val);
				if(custom_cat_val != escaped_val){									//prevent user to insert special characters. 
					window.alert('Special characters detected. Change your input');
					return;
				}
				
			}
			else{
				window.alert('Invalid input');
			}

	
		jQuery.ajax({
			url : nscuscatprod.ajax_url,
			type : 'post',
			data : {
				action : 'ns_add_cat_product',
				'name' : custom_cat_val,
				'parent': custom_cat_parent
			},
			success : function( response ) {
				if(custom_cat_parent != '')
					custom_cat_parent = '(Parent category: '+custom_cat_parent+')';
				jQuery("#ns-cat-din-table").append('<tr><td><input type="checkbox" name="'+response+'" value="'+response+'"/> '+response+custom_cat_parent+' </td></tr>');
				jQuery('#ns-myModal-cat').css("display","none");
				
					
			},
			error: function(errorThrown){
				alert(errorThrown.responseText);
			} 
			

		});
});

	//this function provides the post id to php after the user clicks on edit button
	jQuery(document).on('click', '.ns-button-table-edit', function(event){
			var id = jQuery(this).attr('data-id').split('#');
			id = id[1];
			jQuery('#ns-page-params').val(id);
			jQuery('#ns-is-edit-input').val('yes');	
	});

	
	/*VARIABLE PRODUCT*/
	
	//hide the variable notification message if an attribute with variation exists
	//a deeper control is used to disable users to click only 'is variation' checkbox, if without corresponding attribute
	jQuery('#ns-variation').on('click', function(event) {
		var hide_message = false;
		jQuery('#ns-message').removeClass('ns-hidden');
		jQuery('#ns-var-button').addClass('ns-hidden');	
		
		var aux = '';
		if(jQuery('#ns-attr-from-list-variation').val() != ''){
			 aux = jQuery('#ns-attr-from-list-variation').val().split(',');
		}
		
		var list_variation_num = aux.length;
		if(list_variation_num > 0){
			hide_message = true;
		}

		var list_variation_custom_num = jQuery('#ns-attr-from-list-variation-custom').val();
		if(list_variation_custom_num > 0){
			hide_message = true;	
		}
		
		if(hide_message){
			jQuery('#ns-message').addClass('ns-hidden');
			jQuery('#ns-var-button').removeClass('ns-hidden');		
		}
	});
	
		
	//initial switch for variable product
	jQuery('#ns-product-type').change(function(){ 
    var value = jQuery(this).val();
	if(value == 'variable'){
		jQuery('#ns-variation').removeClass('ns-hidden');
		
		jQuery('#ns-regular-price').parent().addClass('ns-hidden');	//if is a variable product i need to hide simple product prices
		jQuery('#ns-sale-price').parent().addClass('ns-hidden');
	}
	if(value == 'simple'){
		jQuery('#ns-variation').addClass('ns-hidden');
		
		jQuery('#ns-regular-price').parent().removeClass('ns-hidden'); //if is a simple product i can show the prices
		jQuery('#ns-sale-price').parent().removeClass('ns-hidden');
	}
});


	//add variations (n)
	var j = 0;
	jQuery('#ns-var-button').on('click', function(event) {     
				j++;

				var html_to_append = '<div>'+
							'<div>'+
							'<label>Color Attributes</label><br>'+
								'<select  name="ns-variation-attributes'+j+'" class="ns-input-width ns-variation-attributes">'+
									//here need to dinamycally add all the colors to this option set
									
								'</select>' +
							'</div>'+
							'<div>'+
							'<label>Custom Attributes</label><br>'+
								'<select  name="ns-variation-custom-attributes'+j+'" class="ns-input-width ns-variation-custom-attributes">'+
									//here need to dinamycally add all the custom attributes to this option set
									
								'</select>' +
							'</div>'+
							'<div>'+	
								'<label>Product Variation Image</label><br>'+							
								'<p><input type="file" name="ns-thumbnail-var'+j+'" id="ns-thumbnail-var'+j+'" /></p>'+
							'</div>'+
							'<div><label>Sku</label><br><input class="ns-input-width" size="6" id="ns-variation-sku'+j+'" name="ns-variation-sku'+j+'"  type="text"></div>'+
							'<div>'+
								'<table>'+
									'<tr>'+
										'<th>Downloadable</th><th><input name="ns-variation-downloadable'+j+'" id="ns-variation-downloadable'+j+'" type="checkbox"></th>'+
										'<th>Virtual</th><th><input name="ns-variation-virtual'+j+'" id="ns-variation-virtual'+j+'" type="checkbox"></th>'+
									'</tr>'+
								'</table>'+
							'</div>'+
							'<div>'+
								'<p><label class="ns-input-width">Regular Price</label><br><input id="ns-variation-regular-price'+j+'" name="ns-variation-regular-price'+j+'" class="ns-input-width" placeholder="Variation price (required)" type="text"></p>'+
								'<p><label class="ns-input-width">Sale Price</label><br><input id="ns-variation-sale-price'+j+'" name="ns-variation-sale-price'+j+'" class="ns-input-width" type="text"></p>'+				
								'<p>'+
									'<label class="ns-input-width">Stock Status</label><br>'+
									'<select id="ns-variation-stock-status'+j+'" name="ns-variation-stock-status'+j+'" class="ns-input-width" >'+
										'<option value="instock">In stock</option>'+
										'<option value="outofstock">Out of stock</option>'+
									'</select>'+
								'</p>'+
								'<p>'+
									'<label class="ns-input-width">Weight(kg)</label><br><input id="ns-variation-weight'+j+'" name="ns-variation-weight'+j+'" class="ns-input-width" type="text">'+
									'<br><label class="ns-input-width">Length</label><br>'+
									'<input id="ns-variation-length'+j+'" name="ns-variation-length'+j+'" class="ns-input-width" type="text"><br>'+
									'<label class="ns-input-width">Width</label><br>'+
									'<input id="ns-variation-width'+j+'" name="ns-variation-width'+j+'" class="ns-input-width" type="text"><br>'+
									'<label class="ns-input-width">Height</label><br>'+
									'<input id="ns-variation-height'+j+'" name="ns-variation-height'+j+'" class="ns-input-width" type="text"><br>'+
								'</p>'+
								'<p>'+
									'<label class="ns-input-width">Variation description</label>'+
									'<textarea id="ns-variation-descritpion'+j+'" name="ns-variation-descritpion'+j+'"></textarea>'+
								'</p>'+
							'</div>'+
							'<button type="button" class="button ns-variation-remove" style="float:left">Remove</button>'+
						'</div>';
						
		jQuery('#ns-inner-variation').after(html_to_append);
		jQuery('#ns-variation-list').val(j);
		add_options_attribute_variation();
		
	});
	
	
	//removing variation
	jQuery(document).on('click', '.ns-variation-remove', function(event){
		jQuery(this).parent().remove();
		j--;
		jQuery('#ns-variation-list').val(j);
	});
		
		
	//used to populate options attribute variation	
	function add_options_attribute_variation(){
		var to_split = jQuery('#ns-attr-from-list-variation').val();
		var arr_of_attr_var = to_split.split(',');
		
		jQuery.each(arr_of_attr_var, function(index, item){
			jQuery('.ns-variation-attributes').append('<option id="opt-'+item+'" value="'+item+'">'+item+'</option>');
		});			
	}	
	
		
	//used to populate custom options attribute variation	
	jQuery('#ns-var-button').on('click', function(event) {  
		
		jQuery('.ns-variation-custom-attributes').empty();	//clean input
		
		var to_split = jQuery('#ns-attr-custom-names').val();
		var arr_of_attr_var = to_split.split(',');

		jQuery.each(arr_of_attr_var, function(index, item){
			jQuery('.ns-variation-custom-attributes').append('<option id="opt-'+item+'" value="'+item+'">'+item+'</option>');
		});			
	});	
		
		
});