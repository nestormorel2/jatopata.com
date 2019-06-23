<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
	<h3>Select wich role can use NS Add Product Frontend plugin</h3>
	<table>
		<th>Role</th>
		<th></th>
	<?php
		$checked = '';
		$checked2 = '';
			if(get_option('ns-choose-role-customer', '') == 'on') $checked = 'checked'; else $checked = '';
			echo '<tr><td>Customer</td><td><input type="checkbox" id="ns-choose-role-customer" name="ns-choose-role-customer"'.$checked.' /></td></tr>';
			
			if(get_option('ns-choose-role-shop_manager', '') == 'on') $checked2 = 'checked'; else $checked2 = '';
			echo '<tr><td>Shop Manager</td><td><input type="checkbox" id="ns-choose-role-shop_manager" name="ns-choose-role-shop_manager"'.$checked2.' /></td></tr>';

	?>
	</table>
</div>
