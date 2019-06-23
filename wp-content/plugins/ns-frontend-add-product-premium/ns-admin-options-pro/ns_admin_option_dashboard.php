<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sandbox_theme_display() {
?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
        <h2>Custom Css settings</h2>
        <?php settings_errors(); ?>

		<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_info'; ?>
         
		<h2 class="nav-tab-wrapper">
		    <a href="?page=ns-frontend-add-product-premium%2Fns-admin-options-pro%2Fns_admin_option_dashboard.php&tab=general_info" class="nav-tab <?php echo $active_tab == 'general_info' ? 'nav-tab-active' : ''; ?>">Info</a>
		    <a href="?page=ns-frontend-add-product-premium%2Fns-admin-options-pro%2Fns_admin_option_dashboard.php&tab=general_remove_options" class="nav-tab <?php echo $active_tab == 'general_remove_options' ? 'nav-tab-active' : ''; ?>">Hide Fields</a>
            <a href="?page=ns-frontend-add-product-premium%2Fns-admin-options-pro%2Fns_admin_option_dashboard.php&tab=general_choose_user" class="nav-tab <?php echo $active_tab == 'general_choose_user' ? 'nav-tab-active' : ''; ?>">Users Administration</a>
            <!--<a href="?page=ns-custom-css-pro%2Fns-admin-options-pro%2Fns_admin_option_dashboard.php&tab=category_css_options" class="nav-tab <?php echo $active_tab == 'category_css_options' ? 'nav-tab-active' : ''; ?>">Category Css</a>
			-->
		</h2>
         
        <form method="post" action="options.php">
            <?php
            switch ($active_tab) {
                case 'general_info':
                    settings_fields( 'ns_add_prod_options_group' );
                    require_once( untrailingslashit( dirname( __FILE__ ) ).'/ns_tab_1_field_group.php');
                    break;
                case 'general_remove_options':
                    settings_fields( 'ns_add_prod_options_group' );
                    require_once( untrailingslashit( dirname( __FILE__ ) ).'/ns_tab_2_field_group.php');
                    break;
                case 'general_choose_user':
                    settings_fields( 'ns_add_prod_options_group_choose_user' );
                    require_once( untrailingslashit( dirname( __FILE__ ) ).'/ns_tab_3_field_group.php');
                    break;                
                case 'category_css_options':
                    settings_fields( 'ns_cc_options_category_group' );
                    require_once( untrailingslashit( dirname( __FILE__ ) ).'/ns_tab_4_field_group.php');
                    break; 
                default:
                    settings_fields( 'ns_add_prod_options_group' );
                    require_once( untrailingslashit( dirname( __FILE__ ) ).'/ns_tab_1_field_group.php');
                    break;
            }
            ?>
         
            <?php submit_button(); ?>
             
        </form>
         
    </div><!-- /.wrap -->
<?php
} // end sandbox_theme_display

sandbox_theme_display();