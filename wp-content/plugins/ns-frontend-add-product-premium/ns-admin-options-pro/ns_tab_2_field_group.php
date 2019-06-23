<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="">
	<h3>Check to hide an element</h3> 
	<table cellspacing="18" class="ns-table">
		<tr>
			<th>Field Name :</th>
			<th>Hide</th>
		</tr>
		<tr>
			<th>Regular Price : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-regular-price', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-regular-price" name="ns-code-add-prod-regular-price"></th>
		</tr>
		<tr>
			<th>Sale Price : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-sale-price', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-sale-price" name="ns-code-add-prod-sale-price"></th>
		</tr>
		<tr>
			<th>SKU : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-sku', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-sku" name="ns-code-add-prod-sku"></th>
		</tr>
		<tr>
			<th>Manage Stock : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-manage-stock', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-manage-stock" name="ns-code-add-prod-manage-stock"></th>
		</tr>
		<tr>
			<th>Stock Status : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-stock-status', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-stock-status" name="ns-code-add-prod-stock-status"></th>
		</tr>
		<tr>
			<th>Sold Individually : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-sold-ind', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-sold-ind" name="ns-code-add-prod-sold-ind"></th>
		</tr>
		<tr>
			<th>Weight : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-weight', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-weight" name="ns-code-add-prod-weight"></th>
		</tr>
		<tr>
			<th>Length : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-length', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-length" name="ns-code-add-prod-length"><br></th>
		</tr>
		<tr>
			<th>Width : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-width', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-width" name="ns-code-add-prod-width"></th>
		</tr>
		<tr>
			<th>Height : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-height', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-height" name="ns-code-add-prod-height"></th>
		</tr>
		<tr>
			<th>Linked Products : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-linked', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-linked" name="ns-code-add-prod-linked"></th>
		</tr>		
		<tr>
			<th>Attributes : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-attributes', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-attributes" name="ns-code-add-prod-attributes"></th>
		</tr>		
		<tr>
			<th>Purchase Note : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-pur-note', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-pur-note" name="ns-code-add-prod-pur-note"></th>
		</tr>	
		<tr>
			<th>Menu order : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-menu-ord', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-menu-ord" name="ns-code-add-prod-menu-ord"></th>
		</tr>	
		<tr>
			<th>Enable Reviews : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-reviews', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-reviews" name="ns-code-add-prod-reviews"></th>
		</tr>	
		<tr>
			<th>Custom Bubble Title : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-bubble-title', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-bubble-title" name="ns-code-add-prod-bubble-title"></th>
		</tr>		
		<tr>
			<th>Custom Tab Title : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-cus-tab', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-cus-tab" name="ns-code-add-prod-cus-tab"></th>
		</tr>
		<tr>
			<th>Custom Tab Content : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-cus-tab-cont', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-cus-tab-cont" name="ns-code-add-prod-cus-tab-cont"></th>
		</tr>
		<tr>
			<th>Product Video : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-video', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-video" name="ns-code-add-prod-video"></th>
		</tr>
		<tr>
			<th>Top Content : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-top-content', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-top-content" name="ns-code-add-prod-top-content"></th>
		</tr>
		<tr>
			<th>Bottom Content : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-bottom-content', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-bottom-content" name="ns-code-add-prod-bottom-content"></th>
		</tr>
		<tr>
			<th>Variations : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-variations', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-variations" name="ns-code-add-prod-variations"></th>
		</tr>
		<tr>
			<th>Post Content : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-post-content', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-post-content" name="ns-code-add-prod-post-content"></th>
		</tr>
		<tr>
			<th>Short Description : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-short-desc', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-short-desc" name="ns-code-add-prod-short-desc"></th>
		</tr>
		<tr>
			<th>Product Tags : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-tags', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-tags" name="ns-code-add-prod-tags"></th>
		</tr>
		<tr>
			<th>Product Image : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-image', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-image" name="ns-code-add-prod-image"></th>
		</tr>
		<tr>
			<th>Product Categories : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-categories', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-categories" name="ns-code-add-prod-categories"></th>
		</tr>
		<tr>
			<th>Product Gallery : </th>
			<th><input  <?php if(get_option('ns-code-add-prod-gallery', '') == 'on') echo'checked'; ?> type="checkbox" id="ns-code-add-prod-gallery" name="ns-code-add-prod-gallery"></th>
		</tr>
		
	</table>

</div>
