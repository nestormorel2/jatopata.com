<?php

class register_form{
		
	public function load_script(){ ?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				jQuery('#register').validate({ errorClass: "rw-error" });
			});
		</script>
	<?php }
	
	public function captcha_image(){
	?>
	<div class="reg-captcha">
    <img src="<?php echo plugins_url( WPRPWS_DIR_NAME . '/captcha/captcha.php' ); ?>" id="captcha">
	<br /><a href="javascript:refreshCaptcha();"><?php _e('Reload Image','wp-register-profile-with-shortcode');?></a>
	</div>
    <script type="application/javascript">
	function refreshCaptcha(){ document.getElementById('captcha').src = '<?php echo plugins_url( WPRPWS_DIR_NAME . '/captcha/captcha.php' );?>?rand='+Math.random(); }
	</script>
    <?php
	}
	
	public function error_message(){
		start_session_if_not_started();
		if(isset($_SESSION['reg_error_msg']) and $_SESSION['reg_error_msg']){
			echo '<div class="'.$_SESSION['reg_msg_class'].'">'.$_SESSION['reg_error_msg'].'</div>';
			unset($_SESSION['reg_error_msg']);
			unset($_SESSION['reg_msg_class']);
		}
	}
	
	public function registration_form(){
		global $post;
		$wprp_p = new wprp_register_process;
		$default_registration_form_hooks = get_option('default_registration_form_hooks'); 
		if(!is_user_logged_in()){
			echo '<div id="reg_forms" class="reg_forms">';
			if(get_option('users_can_register')) { 
				$this->load_script();
				do_action('wprp_before_register_form_start');
				$this->error_message();
				include( WPRPWS_DIR_PATH . '/view/frontend/register.php');
				do_action('wprp_after_register_form_end');
			} else {
				echo '<p>' . apply_filters( 'wprp_registration_disabled_text', __('Sorry. Registration is not allowed in this site.','wp-register-profile-with-shortcode') ) . '</p>';
			}
			echo '</div>';
		}
	}
}