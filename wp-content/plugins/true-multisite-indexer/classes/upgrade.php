<?php
if( !class_exists( 'mishaUpgrade2' ) ) {
	class mishaUpgrade2{

		public $enable_caches = true;
		public $update_host = 'https://rudrastyh.com';

		function __construct( $update_slug, $plugin_slug, $plugin_id, $version, $text_domain ){

			// params from outside
			$this->version = $version;
			$this->update_slug = $update_slug;
			$this->plugin_slug = $plugin_slug;
			$this->plugin_id = $plugin_id;
			$this->text_domain = $text_domain;

			// our update hooks
			add_filter('plugins_api', array($this, 'info'), 20, 3);
			//add_filter( 'plugins_api_result', array( $this, 'debug_api'), 9999 );
			add_filter('site_transient_update_plugins', array( $this, 'update')); //WP 3.0+
			add_action( 'upgrader_process_complete', array( $this, 'after_update' ), 10, 2 );
			// добавляется именно в конце сообщения плагина
			add_action( 'in_plugin_update_message-' . $plugin_slug . '/' . $plugin_slug . '.php', array( $this, 'update_message' ), 10, 2 );
			//add_action( 'after_plugin_row_' . $plugin_slug . '/' . $plugin_slug . '.php', array( $this, 'updmessage' ), 10, 3 );
			// очищаем кэш при обновлении емайл админка
			add_action( 'update_option_admin_email', array( $this, 'clear_update_cache'), 10, 2 );
			add_filter( 'plugin_row_meta', array($this, 'check_for_updates_link'), 10, 4);
			add_action( 'admin_init', array( $this, 'manual_check') );

		}
		/*
		 * Прежде всего функция, которая дает нам наш лицензионный ключ
		 */
		function get_license(){
			if( is_multisite() ) {
				return ( ( $x = get_site_option('_misha_' . $this->plugin_slug . '_license_key') ) ? $x : get_site_option('admin_email') );
			} else {
				return ( ( $x = get_option('_misha_' . $this->plugin_slug . '_license_key') ) ? $x : get_option('admin_email') );
			}
		}
		/*
		 * Make request to json on the server, cache it or not
		 */
		function request(){

			if ( $this->enable_caches === false || ( false == $remote = get_transient( 'misha_upgrade_' . $this->update_slug ) ) ) {
				$remote = wp_remote_get( add_query_arg( array(
					'plg' => $this->plugin_id,
					'e' => urlencode( $this->get_license() )
				), $this->update_host . '/infojson.php' ), array( 'timeout' => 10, 'headers' => array( 'Accept' => 'application/json' ) ) );

				if ( !is_wp_error( $remote ) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && !empty($remote['body']) ) {
						set_transient( 'misha_upgrade_' . $this->update_slug, $remote, 43200 ); // half a day cache
				} else {
					return false;
				}
			}
			return $remote;

		}

		/*
		 * Delete cache just after plugin has been updated
		 */
		function after_update( $upgrader_object, $options ) {
			if ( $options['action'] == 'update' && $options['type'] === 'plugin' )  {
				delete_transient( 'misha_upgrade_' . $this->update_slug );
			}
		}

		/*
		 * Returns the object of plugin information
		 * $res empty at this step
		 * $action 'plugin_information'
		 * $args stdClass Object ( [slug] => woocommerce [is_ssl] => [fields] => Array ( [banners] => 1 [reviews] => 1 [downloaded] => [active_installs] => 1 ) [per_page] => 24 [locale] => en_US )
		 */
		function info( $res, $action, $args ){


			if( $action !== 'plugin_information' )
				return false;

			if( $this->plugin_slug !== $args->slug )
				return $res;



			if( $remote = $this->request() ){
				$remote = json_decode( $remote['body'] );
				$res = new stdClass();
				$res->name = $remote->name;
				$res->slug = $this->plugin_slug;
				$res->version = $remote->version;
				$res->tested = $remote->tested;
				$res->requires = $remote->requires;
				$res->author = '<a href="https://rudrastyh.com">Misha Rudrastyh</a>';
				$res->author_profile = 'https://profiles.wordpress.org/rudrastyh';
				$res->download_link = $remote->download_url;
				$res->trunk = $remote->download_url;
				$res->last_updated = $remote->last_updated;
				$res->sections = array(
					//'description' => $remote->sections->description,
					//'installation' => $remote->sections->installation,
					'changelog' => $remote->sections->changelog
				);
				if( !empty( $remote->sections->screenshots ) ) {
					$res->sections['screenshots'] = $remote->sections->screenshots;
				}

				$res->banners = array(
					'low' => $this->update_host . '/plg_api_upd/' . $this->update_slug . '/banner-772x250.jpg',
	            	'high' => $this->update_host . '/plg_api_upd/' . $this->update_slug . '/banner-1544x500.jpg'
				);
				return $res;
			}

			return false;

		}

			function update( $transient ){
			if ( empty($transient->checked ) ) {
	            return $transient;
	        }
	        //echo '<pre>' . print_r( $transient, true ) . '</pre>';exit;


			if ( $remote = $this->request() ){
				$remote = json_decode( $remote['body'] );
				if( $remote && version_compare( $this->version, $remote->version, '<' )
				&& version_compare($remote->requires, get_bloginfo('version'), '<' ) ) {
					$res = new stdClass();
					$res->slug = $this->plugin_slug;
					$res->plugin = $this->plugin_slug . '/' . $this->plugin_slug . '.php';
					$res->new_version = $remote->version;
					$res->tested = $remote->tested;
					$res->package = $remote->download_url; // return '' to disable updates
					$res->url = $remote->homepage;
					$res->compatibility = new stdClass();
	           		$transient->response[$res->plugin] = $res;
	           		//$transient->checked[$res->plugin] = $remote->version;
	           	}

			}
	        //echo '<pre>' . print_r( $transient, true ) . '</pre>';
	        //exit;
	        return $transient;
				}


			// function debug_api( $r ){
			// 	echo '<pre>';print_r( $r );echo '</pre>';
			// 	exit;
			// }

			function update_message( $plugin_info_array, $plugin_info_object ) {
				if( empty( $plugin_info_array['package'] ) ) {
					printf( __( ' Please&nbsp;<a href="%1$s">renew&nbsp;your&nbsp;license</a>&nbsp;to&nbsp;update. And make sure that you set your license key in plugin settings.', $this->text_domain ), 'https://rudrastyh.com/checkout?id=' . $this->plugin_id );
				}
			}

			// function updmessage( $plugin_file, $plugin_data, $status ){
			//
			// 	if( ! current_user_can( 'update_plugins' ) ) {
			// 		return;
			// 	}
			//
			// 	// print_r( $plugin_data );
			// 	// print_r( $status );
			// 	echo '<tr class="plugin-update-tr active"><td colspan="3" class="plugin-update colspanchange"><div class="update-message notice inline notice-warning notice-alt"><p>';
			// 	printf( __( 'There is a new version of %1$s available. Please <a href="">renew your license</a> to update.' ), $plugin_data['Name'] );
			// 	echo '</p></div></td></tr>';
			// }

			/*
			 * Очистка кэша после изменения admin_email в админке
			 */
			function clear_update_cache( $old_value, $value ){
				delete_transient( 'misha_upgrade_' . $this->update_slug );
			}

			/*
			 * Функция check for update для очистки кэша
			 */
			function check_for_updates_link( $plugin_meta, $plugin_file, $plugin_data = null, $status = null ){

					// faq | support | check for updates links
					if ( $plugin_file == ( $this->plugin_slug . '/' . $this->plugin_slug . '.php' ) && current_user_can('update_plugins') ) {

						$plugin_meta[] = sprintf('<a href="https://rudrastyh.com/faq" target="_blank">%s</a>', __('FAQ', $this->text_domain ) );
						$plugin_meta[] = sprintf('<a href="https://rudrastyh.com/support" target="_blank">%s</a>', __('Support', $this->text_domain ) );
						$plugin_meta[] = sprintf('<a href="%s">%s</a>', esc_attr( wp_nonce_url( add_query_arg(
							'misha_refresh_update_cache',
							$this->plugin_slug,
							( is_multisite() ? network_admin_url('plugins.php') : admin_url('plugins.php') ) ), 'upgrade_link_nonce' ) ), __('Check for updates', $this->text_domain ) );


					}

					return $plugin_meta;

			}
			function manual_check(){
				if( isset($_GET['misha_refresh_update_cache']) && $_GET['misha_refresh_update_cache'] == $this->plugin_slug && current_user_can('update_plugins') && check_admin_referer('upgrade_link_nonce') ) {
					delete_transient( 'misha_upgrade_' . $this->update_slug );
				}

			}

	}
}
