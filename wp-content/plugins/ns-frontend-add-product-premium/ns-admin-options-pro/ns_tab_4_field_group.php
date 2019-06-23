<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
<h3>Insert your custom category css here</h3>
	<textarea rows="10" cols="100" id="ns_code_to_add_cc_category_option" name="ns_code_to_add_cc_category_option"><?php echo get_option('ns_code_to_add_cc_category_option', ''); ?></textarea>
</div>
<div class="wrap">
<h3>Insert your custom category css mobile here</h3>
	<textarea rows="10" cols="100" id="ns_code_to_add_cc_category_option_mobile" name="ns_code_to_add_cc_category_option_mobile"><?php echo get_option('ns_code_to_add_cc_category_option_mobile', ''); ?></textarea>
</div>