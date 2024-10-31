<?php

/**
 * Runs only when the marketPalce exist.
 * @since 4.7.15
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action( 'admin_init', 'scd_dashboard_setup' );

function scd_dashboard_setup(){

	$pathscdwcfm = ABSPATH . 'wp-content/plugins/scd-smart-currency-detector-variant-for-wcfm/index.php';
	
	if((is_plugin_active('wc-multivendor-marketplace/wc-multivendor-marketplace.php')) && ( ! file_exists( $pathscdwcfm ))){
		
		if ( isset($_POST['scd_wcfm_install']) ) {
			install_scd_wcfm();
		}
	   if ( isset($_POST['scd_wcfm_retry']) ) {
			install_scd_wcfm_view();
			exit();
		}
		
		if ( isset($_POST['scd_wcfm_cancel']) ) {
			
			if(!get_option("scd_free_cancel")){
				add_option("scd_free_cancel",true);
			}
						
			cancel_scd_wcfm();
			
		}
			install_scd_wcfm_view();
			exit();
	}
	
	$pathscddokan = ABSPATH . 'wp-content/plugins/scd-smart-currency-detector-variant-for-dokan/index.php';
	if((is_plugin_active('dokan-lite/dokan.php')) && ( ! file_exists( $pathscddokan ))){
		
		if ( isset($_POST['scd_dokan_install']) ) {
			install_scd_dokan();
		}
	   if ( isset($_POST['scd_dokan_retry']) ) {
			install_scd_dokan_view();
			exit();
		}
		
		if ( isset($_POST['scd_dokan_cancel']) ) {
			
			if(!get_option("scd_free_cancel")){
				add_option("scd_free_cancel",true);
			}
						
			cancel_scd_dokan();
			
		}
			install_scd_dokan_view();
			exit();
	}
	
    $pathscdwcmp = ABSPATH . 'wp-content/plugins/scd-smart-currency-detector-variant-for-wcmp/index.php';
	if((is_plugin_active('dc-woocommerce-multi-vendor/dc_product_vendor.php')) && ( ! file_exists( $pathscdwcmp ))){
		
		if ( isset($_POST['scd_wcmp_install']) ) {
			install_scd_wcmp();
		}
	   if ( isset($_POST['scd_wcmp_retry']) ) {
			install_scd_wcmp_view();
			exit();
		}
		
		if ( isset($_POST['scd_wcmp_cancel']) ) {
			
			if(!get_option("scd_free_cancel")){
				add_option("scd_free_cancel",true);
			}
						
			cancel_scd_wcmp();
			
		}
			install_scd_wcmp_view();
			exit();
	}
	
	$pathscdwcv = ABSPATH . 'wp-content/plugins/scd-smart-currency-detector-variant-for-wcv/index.php';
	if((is_plugin_active('wc-vendors/class-wc-vendors.php')) && ( ! file_exists( $pathscdwcv ))){
		
		if ( isset($_POST['scd_wcv_install']) ) {
			install_scd_wcv();
		}
	   if ( isset($_POST['scd_wcv_retry']) ) {
			install_scd_wcv_view();
			exit();
		}
		
		if ( isset($_POST['scd_wcv_cancel']) ) {
			
			if(!get_option("scd_free_cancel")){
				add_option("scd_free_cancel",true);
			}
						
			cancel_scd_wcv();
			
		}
			install_scd_wcv_view();
			exit();
	}
}

	/**
	 * Content for install scd_wcfm view
	 */
	function install_scd_wcfm_view() {
		global $SCD;
		$scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
		set_current_screen();
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
					<head>
							<meta name="viewport" content="width=device-width" />
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
							<?php do_action('admin_print_styles'); ?>
							<?php do_action('admin_head'); ?>
							<style type="text/css">
									body {
											margin: 100px auto 24px;
											box-shadow: none;
											background: #f1f1f1;
											padding: 0;
											max-width: 700px;
									}
									#wc-logo {
											border: 0;
											margin: 0 0 24px;
											padding: 0;
											text-align: center;
									}
									#wc-logo a {
										color: #00897b;
										text-decoration: none;
									}
									
									#wc-logo a span {
										padding-left: 10px;
										padding-top: 23px;
										display: inline-block;
										vertical-align: top;
										font-weight: 700;
									}
									.scd-install-scdWcfm {
											box-shadow: 0 1px 3px rgba(0,0,0,.13);
											padding: 24px 24px 0;
											margin: 0 0 20px;
											background: #fff;
											overflow: hidden;
											zoom: 1;
									}
									.scd-install-scdWcfm .button-primary{
											font-size: 1.25em;
											padding: .5em 1em;
											line-height: 1em;
											margin-right: .5em;
											margin-bottom: 2px;
											height: auto;
									}
									.scd-install-scdWcfm{
											font-family: sans-serif;
											text-align: center;    
									}
									.scd-install-scdWcfm form .button-primary{
											color: #fff;
											background-color: #00798b;
											font-size: 16px;
											border: 1px solid #00798b;
											width: 280px;
											padding: 10px;
											margin: 25px 0 20px;
											cursor: pointer;
									}
									.scd-install-scdWcfm form .button-primary:hover{
											background-color: #000000;
									}
									.scd-install-scdWcfm p{
											line-height: 1.6;
									}

							</style>
					</head>
					<body class="scd-setup wp-core-ui">
							<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
							<div class="scd-install-scdWcfm">
							<p><?php _e(' This variant has limited features  when you use', 'ch_scd_woo') . ' <strong style="color:red; font-weight: bold;"> ' . _e('WCFM marketplace', 'ch_scd_woo') . ' </strong>' . _e('in your store. You can install SCM variant for WCFM.', 'ch_scd_woo'); ?></p>
									<form method="post" action="" name="scd_install_scdWcfm">
											<?php submit_button(__('Install SCM for WCFM', 'ch_scd_woo'), 'primary', 'scd_wcfm_install'); ?>
											<?php wp_nonce_field('scdwcfmmp-install'); ?>
									</form>
							</div>
					</body>
			</html>
			<?php
	}

	/**
	 * Install scd for wcfm if not exist
	 * @throws Exception
	 */
	function install_scd_wcfm() {
		check_admin_referer('scdwcfmmp-install');
		include_once( ABSPATH . 'wp-admin/includes/file.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		WP_Filesystem();
		$skin = new Automatic_Upgrader_Skin;
		$upgrader = new WP_Upgrader($skin);
		$installed_plugins = array_map('scd_format_plugin_slug', array_keys(get_plugins()));
		$plugin_slug = 'scd-smart-currency-detector-variant-for-wcfm';
		$plugin = 'scd-smart-currency-detector-variant-for-wcfm/index.php';
		$installed = false;
		$activate = false;
		// See if the plugin is installed already
		if (in_array($plugin_slug, $installed_plugins)) {
				$installed = true;
				$activate = !is_plugin_active($plugin);
		}
		// Install this thing!
		if (!$installed) {
			// Suppress feedback
			ob_start();
	
			try {
				$plugin_information = plugins_api('plugin_information', array(
						'slug' => $plugin_slug,
						'fields' => array(
								'short_description' => false,
								'sections' => false,
								'requires' => false,
								'rating' => false,
								'ratings' => false,
								'downloaded' => false,
								'last_updated' => false,
								'added' => false,
								'tags' => false,
								'homepage' => false,
								'donate_link' => false,
								'author_profile' => false,
								'author' => false,
						),
				));

				if (is_wp_error($plugin_information)) {
					throw new Exception($plugin_information->get_error_message());
				}

				$package = $plugin_information->download_link;
				$download = $upgrader->download_package($package);

				if (is_wp_error($download)) {
					throw new Exception($download->get_error_message());
				}

				$working_dir = $upgrader->unpack_package($download, true);

				if (is_wp_error($working_dir)) {
					throw new Exception($working_dir->get_error_message());
				}

				$result = $upgrader->install_package(array(
						'source' => $working_dir,
						'destination' => WP_PLUGIN_DIR,
						'clear_destination' => false,
						'abort_if_destination_exists' => false,
						'clear_working' => true,
						'hook_extra' => array(
								'type' => 'plugin',
								'action' => 'install',
						),
				));

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

				$activate = true;
				if(!get_option("scd_free_cancel"))
				add_option("scd_free_cancel",true);
				
				
			} catch (Exception $e) {
                	global $SCM;
					$scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
					set_current_screen();
						?>
						<!DOCTYPE html>
						<html <?php language_attributes(); ?>>
								<head>
										<meta name="viewport" content="width=device-width" />
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
										<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
										<?php do_action('admin_print_styles'); ?>
										<?php do_action('admin_head'); ?>
										<style type="text/css">
												body {
														margin: 100px auto 24px;
														box-shadow: none;
														background: #f1f1f1;
														padding: 0;
														max-width: 700px;
												}
												#wc-logo {
														border: 0;
														margin: 0 0 24px;
														padding: 0;
														text-align: center;
												}
												#wc-logo a {
													color: #00897b;
													text-decoration: none;
												}
												
												#wc-logo a span {
													padding-left: 10px;
													padding-top: 23px;
													display: inline-block;
													vertical-align: top;
													font-weight: 700;
												}
												.scd-install-scdWcfm {
														box-shadow: 0 1px 3px rgba(0,0,0,.13);
														padding: 24px 24px 0;
														margin: 0 0 20px;
														background: #fff;
														overflow: hidden;
														zoom: 1;
												}
												.scd-install-scdWcfm .button-primary{
														font-size: 1.25em;
														padding: .5em 1em;
														line-height: 1em;
														margin-right: .5em;
														margin-bottom: 2px;
														height: auto;
												}
												.scd-install-scdWcfm{
														font-family: sans-serif;
														text-align: center;    
												}
												.scd-install-scdWcfm form .button-primary{
														color: #fff;
														background-color: #00798b;
														font-size: 16px;
														border: 1px solid #00798b;
														width: 280px;
														padding: 10px;
														margin: 25px 0 20px;
														cursor: pointer;
												}
												.scd-install-scdWcfm form .button-primary:hover{
														background-color: #000000;
												}
												.scd-install-scdWcfm p{
														line-height: 1.6;
												}

										</style>
								</head>
								<body class="scd-setup wp-core-ui">
										<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
										<div class="scd-install-scdWcfm">
												<p><?php _e('Your installation was not successful, please check that you have a good internet connection. You can retry the installation or cancel. Before canceling the installation you can download the plugin', 'ch_scd_woo') . '<a href="https://downloads.wordpress.org/plugin/scd-smart-currency-detector-variant-for-wcfm.zip">' . __('  by clicking here', 'ch_scd_woo') . ' </a>' . __('  and install it manually.', 'ch_scd_woo'); ?></p>
												<form method="post" action="" name="scd_install_scdWcfm">
														<?php submit_button(__('retry to install scm wcfm', 'ch_scd_woo'), 'primary', 'scd_wcfm_retry'); ?>
														<?php submit_button(__('Cancel and return to the dashboard', 'ch_scd_woo'), 'primary', 'scd_wcfm_cancel'); ?>
														<?php wp_nonce_field('scdwcfmmp-install'); ?>
												</form>
										</div>
								</body>
						</html>
						<?php
				exit();
			}

			// Discard feedback
			ob_end_clean();
		}

		wp_clean_plugins_cache();
		// Activate this thing
		if ($activate) {
			try {
				$result = activate_plugin($plugin);

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

			} catch (Exception $e) {

			}
			

		}
		wp_safe_redirect(admin_url('plugins.php'));
	}
	
	
	function cancel_scd_wcfm(){
		check_admin_referer('scdwcfmmp-install');
		wp_safe_redirect(admin_url('plugins.php'));
	}


	/**
	 * Content for install scd_dokan view
	 */
	function install_scd_dokan_view() {
		global $SCD;
		$scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
		set_current_screen();
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
					<head>
							<meta name="viewport" content="width=device-width" />
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
							<?php do_action('admin_print_styles'); ?>
							<?php do_action('admin_head'); ?>
							<style type="text/css">
									body {
											margin: 100px auto 24px;
											box-shadow: none;
											background: #f1f1f1;
											padding: 0;
											max-width: 700px;
									}
									#wc-logo {
											border: 0;
											margin: 0 0 24px;
											padding: 0;
											text-align: center;
									}
									#wc-logo a {
										color: #00897b;
										text-decoration: none;
									}
									
									#wc-logo a span {
										padding-left: 10px;
										padding-top: 23px;
										display: inline-block;
										vertical-align: top;
										font-weight: 700;
									}
									.scd-install-scdDokan {
											box-shadow: 0 1px 3px rgba(0,0,0,.13);
											padding: 24px 24px 0;
											margin: 0 0 20px;
											background: #fff;
											overflow: hidden;
											zoom: 1;
									}
									.scd-install-scdDokan .button-primary{
											font-size: 1.25em;
											padding: .5em 1em;
											line-height: 1em;
											margin-right: .5em;
											margin-bottom: 2px;
											height: auto;
									}
									.scd-install-scdDokan{
											font-family: sans-serif;
											text-align: center;    
									}
									.scd-install-scdDokan form .button-primary{
											color: #fff;
											background-color: #00798b;
											font-size: 16px;
											border: 1px solid #00798b;
											width: 280px;
											padding: 10px;
											margin: 25px 0 20px;
											cursor: pointer;
									}
									.scd-install-scdDokan form .button-primary:hover{
											background-color: #000000;
									}
									.scd-install-scdDokan p{
											line-height: 1.6;
									}

							</style>
					</head>
					<body class="scd-setup wp-core-ui">
							<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
							<div class="scd-install-scdDokan">
									<p><?php _e(' This variant has limited features  when you use', 'ch_scd_woo') . ' <strong style="color:red; font-weight: bold;"> ' . _e('DOKAN marketplace', 'ch_scd_woo') . ' </strong>' . _e('in your store. You can install SCM variant for Dokan.', 'ch_scd_woo'); ?></p>
									<form method="post" action="" name="scd_install_scdDokan">
											<?php submit_button(__('Install SCM for Dokan', 'ch_scd_woo'), 'primary', 'scd_dokan_install'); ?>
											<?php wp_nonce_field('scddokanmp-install'); ?>
									</form>
							</div>
					</body>
			</html>
			<?php
	}

	/**
	 * Install scd for dokan if not exist
	 * @throws Exception
	 */
	function install_scd_dokan() {
		check_admin_referer('scddokanmp-install');
		include_once( ABSPATH . 'wp-admin/includes/file.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		WP_Filesystem();
		$skin = new Automatic_Upgrader_Skin;
		$upgrader = new WP_Upgrader($skin);
		$installed_plugins = array_map('scd_format_plugin_slug', array_keys(get_plugins()));
		$plugin_slug = 'scd-smart-currency-detector-variant-for-dokan';
		$plugin = 'scd-smart-currency-detector-variant-for-dokan/index.php';
		$installed = false;
		$activate = false;
		// See if the plugin is installed already
		if (in_array($plugin_slug, $installed_plugins)) {
				$installed = true;
				$activate = !is_plugin_active($plugin);
		}
		// Install this thing!
		if (!$installed) {
			// Suppress feedback
			ob_start();
	
			try {
				$plugin_information = plugins_api('plugin_information', array(
						'slug' => $plugin_slug,
						'fields' => array(
								'short_description' => false,
								'sections' => false,
								'requires' => false,
								'rating' => false,
								'ratings' => false,
								'downloaded' => false,
								'last_updated' => false,
								'added' => false,
								'tags' => false,
								'homepage' => false,
								'donate_link' => false,
								'author_profile' => false,
								'author' => false,
						),
				));

				if (is_wp_error($plugin_information)) {
					throw new Exception($plugin_information->get_error_message());
				}

				$package = $plugin_information->download_link;
				$download = $upgrader->download_package($package);

				if (is_wp_error($download)) {
					throw new Exception($download->get_error_message());
				}

				$working_dir = $upgrader->unpack_package($download, true);

				if (is_wp_error($working_dir)) {
					throw new Exception($working_dir->get_error_message());
				}

				$result = $upgrader->install_package(array(
						'source' => $working_dir,
						'destination' => WP_PLUGIN_DIR,
						'clear_destination' => false,
						'abort_if_destination_exists' => false,
						'clear_working' => true,
						'hook_extra' => array(
								'type' => 'plugin',
								'action' => 'install',
						),
				));

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

				$activate = true;
				if(!get_option("scd_free_cancel"))
				add_option("scd_free_cancel",true);
				
				
			} catch (Exception $e) {

				global $SCD;
		    $scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
			set_current_screen();
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
					<head>
							<meta name="viewport" content="width=device-width" />
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
							<?php do_action('admin_print_styles'); ?>
							<?php do_action('admin_head'); ?>
							<style type="text/css">
									body {
											margin: 100px auto 24px;
											box-shadow: none;
											background: #f1f1f1;
											padding: 0;
											max-width: 700px;
									}
									#wc-logo {
											border: 0;
											margin: 0 0 24px;
											padding: 0;
											text-align: center;
									}
									#wc-logo a {
										color: #00897b;
										text-decoration: none;
									}
									
									#wc-logo a span {
										padding-left: 10px;
										padding-top: 23px;
										display: inline-block;
										vertical-align: top;
										font-weight: 700;
									}
									.scd-install-scdDokan {
											box-shadow: 0 1px 3px rgba(0,0,0,.13);
											padding: 24px 24px 0;
											margin: 0 0 20px;
											background: #fff;
											overflow: hidden;
											zoom: 1;
									}
									.scd-install-scdDokan .button-primary{
											font-size: 1.25em;
											padding: .5em 1em;
											line-height: 1em;
											margin-right: .5em;
											margin-bottom: 2px;
											height: auto;
									}
									.scd-install-scdDokan{
											font-family: sans-serif;
											text-align: center;    
									}
									.scd-install-scdDokan form .button-primary{
											color: #fff;
											background-color: #00798b;
											font-size: 16px;
											border: 1px solid #00798b;
											width: 280px;
											padding: 10px;
											margin: 25px 0 20px;
											cursor: pointer;
									}
									.scd-install-scdDokan form .button-primary:hover{
											background-color: #000000;
									}
									.scd-install-scdDokan p{
											line-height: 1.6;
									}

							</style>
					</head>
					<body class="scd-setup wp-core-ui">
							<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
							<div class="scd-install-scdDokan">
									<p><?php _e('Your installation was not successful, please check that you have a good internet connection. You can retry the installation or cancel. Before canceling the installation you can download the plugin', 'ch_scd_woo') . '<a href="https://downloads.wordpress.org/plugin/scd-smart-currency-detector-variant-for-dokan.zip">' . __('  by clicking here', 'ch_scd_woo') . ' </a>' . __('  and install it manually.', 'ch_scd_woo'); ?></p>
									<form method="post" action="" name="scd_install_scdDokan">
											<?php submit_button(__('retry to install scm dokan', 'ch_scd_woo'), 'primary', 'scd_dokan_retry'); ?>
											<?php submit_button(__('Cancel and return to the dashboard', 'ch_scd_woo'), 'primary', 'scd_dokan_cancel'); ?>
											<?php wp_nonce_field('scddokanmp-install'); ?>
									</form>
							</div>
					</body>
			</html>
			<?php
				exit();
			}

			// Discard feedback
			ob_end_clean();
		}

		wp_clean_plugins_cache();
		// Activate this thing
		if ($activate) {
			try {
				$result = activate_plugin($plugin);

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

			} catch (Exception $e) {

			}
					
		}
		wp_safe_redirect(admin_url('plugins.php'));
	}
	
	function cancel_scd_dokan(){
		check_admin_referer('scddokanmp-install');
		wp_safe_redirect(admin_url('plugins.php'));
	}



	/**
	 * Content for install scd_wcmp view
	 */
	function install_scd_wcmp_view() {
		global $SCD;
		$scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
		set_current_screen();
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
					<head>
							<meta name="viewport" content="width=device-width" />
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
							<?php do_action('admin_print_styles'); ?>
							<?php do_action('admin_head'); ?>
							<style type="text/css">
									body {
											margin: 100px auto 24px;
											box-shadow: none;
											background: #f1f1f1;
											padding: 0;
											max-width: 700px;
									}
									#wc-logo {
											border: 0;
											margin: 0 0 24px;
											padding: 0;
											text-align: center;
									}
									#wc-logo a {
										color: #00897b;
										text-decoration: none;
									}
									
									#wc-logo a span {
										padding-left: 10px;
										padding-top: 23px;
										display: inline-block;
										vertical-align: top;
										font-weight: 700;
									}
									.scd-install-scdWcmp {
											box-shadow: 0 1px 3px rgba(0,0,0,.13);
											padding: 24px 24px 0;
											margin: 0 0 20px;
											background: #fff;
											overflow: hidden;
											zoom: 1;
									}
									.scd-install-scdWcmp .button-primary{
											font-size: 1.25em;
											padding: .5em 1em;
											line-height: 1em;
											margin-right: .5em;
											margin-bottom: 2px;
											height: auto;
									}
									.scd-install-scdWcmp{
											font-family: sans-serif;
											text-align: center;    
									}
									.scd-install-scdWcmp form .button-primary{
											color: #fff;
											background-color: #00798b;
											font-size: 16px;
											border: 1px solid #00798b;
											width: 280px;
											padding: 10px;
											margin: 25px 0 20px;
											cursor: pointer;
									}
									.scd-install-scdWcmp form .button-primary:hover{
											background-color: #000000;
									}
									.scd-install-scdWcmp p{
											line-height: 1.6;
									}

							</style>
					</head>
					<body class="scd-setup wp-core-ui">
							<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
							<div class="scd-install-scdWcmp">
									<p><?php _e(' This variant has limited features  when you use', 'ch_scd_woo') . ' <strong style="color:red; font-weight: bold;"> ' . _e('WCMP marketplace', 'ch_scd_woo') . ' </strong>' . _e('in your store. You can install SCM variant for WCMP.', 'ch_scd_woo'); ?></p>
									<form method="post" action="" name="scd_install_scdWcmp">
											<?php submit_button(__('Install SCM for WCMP', 'ch_scd_woo'), 'primary', 'scd_wcmp_install'); ?>
											<?php wp_nonce_field('scdwcmp-install'); ?>
									</form>
							</div>
					</body>
			</html>
			<?php
	}

	/**
	 * Install scd for wcmp if not exist
	 * @throws Exception
	 */
	function install_scd_wcmp() {
		check_admin_referer('scdwcmp-install');
		include_once( ABSPATH . 'wp-admin/includes/file.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		WP_Filesystem();
		$skin = new Automatic_Upgrader_Skin;
		$upgrader = new WP_Upgrader($skin);
		$installed_plugins = array_map('scd_format_plugin_slug', array_keys(get_plugins()));
		$plugin_slug = 'scd-smart-currency-detector-variant-for-wcmp';
		$plugin = 'scd-smart-currency-detector-variant-for-wcmp/index.php';
		$installed = false;
		$activate = false;
		// See if the plugin is installed already
		if (in_array($plugin_slug, $installed_plugins)) {
				$installed = true;
				$activate = !is_plugin_active($plugin);
		}
		// Install this thing!
		if (!$installed) {
			// Suppress feedback
			ob_start();
	
			try {
				$plugin_information = plugins_api('plugin_information', array(
						'slug' => $plugin_slug,
						'fields' => array(
								'short_description' => false,
								'sections' => false,
								'requires' => false,
								'rating' => false,
								'ratings' => false,
								'downloaded' => false,
								'last_updated' => false,
								'added' => false,
								'tags' => false,
								'homepage' => false,
								'donate_link' => false,
								'author_profile' => false,
								'author' => false,
						),
				));

				if (is_wp_error($plugin_information)) {
					throw new Exception($plugin_information->get_error_message());
				}

				
				$package = $plugin_information->download_link;
				
				$download = $upgrader->download_package($package);

				if (is_wp_error($download)) {
					throw new Exception($download->get_error_message());
				}

				$working_dir = $upgrader->unpack_package($download, true);

				if (is_wp_error($working_dir)) {
					throw new Exception($working_dir->get_error_message());
				}

				$result = $upgrader->install_package(array(
						'source' => $working_dir,
						'destination' => WP_PLUGIN_DIR,
						'clear_destination' => false,
						'abort_if_destination_exists' => false,
						'clear_working' => true,
						'hook_extra' => array(
								'type' => 'plugin',
								'action' => 'install',
						),
				));

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

				$activate = true;
				if(!get_option("scd_free_cancel"))
				add_option("scd_free_cancel",true);
				
				
			} catch (Exception $e) {

				global $SCD;
		    $scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
			set_current_screen();
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
					<head>
							<meta name="viewport" content="width=device-width" />
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
							<?php do_action('admin_print_styles'); ?>
							<?php do_action('admin_head'); ?>
							<style type="text/css">
									body {
											margin: 100px auto 24px;
											box-shadow: none;
											background: #f1f1f1;
											padding: 0;
											max-width: 700px;
									}
									#wc-logo {
											border: 0;
											margin: 0 0 24px;
											padding: 0;
											text-align: center;
									}
									#wc-logo a {
										color: #00897b;
										text-decoration: none;
									}
									
									#wc-logo a span {
										padding-left: 10px;
										padding-top: 23px;
										display: inline-block;
										vertical-align: top;
										font-weight: 700;
									}
									.scd-install-scdWcmp {
											box-shadow: 0 1px 3px rgba(0,0,0,.13);
											padding: 24px 24px 0;
											margin: 0 0 20px;
											background: #fff;
											overflow: hidden;
											zoom: 1;
									}
									.scd-install-scdWcmp .button-primary{
											font-size: 1.25em;
											padding: .5em 1em;
											line-height: 1em;
											margin-right: .5em;
											margin-bottom: 2px;
											height: auto;
									}
									.scd-install-scdWcmp{
											font-family: sans-serif;
											text-align: center;    
									}
									.scd-install-scdWcmp form .button-primary{
											color: #fff;
											background-color: #00798b;
											font-size: 16px;
											border: 1px solid #00798b;
											width: 280px;
											padding: 10px;
											margin: 25px 0 20px;
											cursor: pointer;
									}
									.scd-install-scdWcmp form .button-primary:hover{
											background-color: #000000;
									}
									.scd-install-scdWcmp p{
											line-height: 1.6;
									}

							</style>
					</head>
					<body class="scd-setup wp-core-ui">
							<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
							<div class="scd-install-scdWcmp">
									<p><?php _e('Your installation was not successful, please check that you have a good internet connection. You can retry the installation or cancel. Before canceling the installation you can download the plugin', 'ch_scd_woo') . '<a href="https://downloads.wordpress.org/plugin/scd-smart-currency-detector-variant-for-wcmp.4.8.0.zip">' . __('  by clicking here', 'ch_scd_woo') . ' </a>' . __('  and install it manually.', 'ch_scd_woo'); ?></p>
									<form method="post" action="" name="scd_install_scdWcmp">
											<?php submit_button(__('retry to install scm wcmp', 'ch_scd_woo'), 'primary', 'scd_wcmp_retry'); ?>
											<?php submit_button(__('Cancel and return to the dashboard', 'ch_scd_woo'), 'primary', 'scd_wcmp_cancel'); ?>
											<?php wp_nonce_field('scdwcmp-install'); ?>
									</form>
							</div>
					</body>
			</html>
			<?php
				exit();
			}

			// Discard feedback
			ob_end_clean();
		}

		wp_clean_plugins_cache();
		// Activate this thing
		if ($activate) {
			try {
				$result = activate_plugin($plugin);

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

			} catch (Exception $e) {

			}
					
		}
		wp_safe_redirect(admin_url('plugins.php'));
	}
	
	function cancel_scd_wcmp(){
		check_admin_referer('scdwcmp-install');
		wp_safe_redirect(admin_url('plugins.php'));
	}



	/**
	 * Content for install scd_wcv view
	 */
	function install_scd_wcv_view() {
		global $SCD;
		$scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
		set_current_screen();
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
					<head>
							<meta name="viewport" content="width=device-width" />
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
							<?php do_action('admin_print_styles'); ?>
							<?php do_action('admin_head'); ?>
							<style type="text/css">
									body {
											margin: 100px auto 24px;
											box-shadow: none;
											background: #f1f1f1;
											padding: 0;
											max-width: 700px;
									}
									#wc-logo {
											border: 0;
											margin: 0 0 24px;
											padding: 0;
											text-align: center;
									}
									#wc-logo a {
										color: #00897b;
										text-decoration: none;
									}
									
									#wc-logo a span {
										padding-left: 10px;
										padding-top: 23px;
										display: inline-block;
										vertical-align: top;
										font-weight: 700;
									}
									.scd-install-scdWCV {
											box-shadow: 0 1px 3px rgba(0,0,0,.13);
											padding: 24px 24px 0;
											margin: 0 0 20px;
											background: #fff;
											overflow: hidden;
											zoom: 1;
									}
									.scd-install-scdWCV .button-primary{
											font-size: 1.25em;
											padding: .5em 1em;
											line-height: 1em;
											margin-right: .5em;
											margin-bottom: 2px;
											height: auto;
									}
									.scd-install-scdWCV{
											font-family: sans-serif;
											text-align: center;    
									}
									.scd-install-scdWCV form .button-primary{
											color: #fff;
											background-color: #00798b;
											font-size: 16px;
											border: 1px solid #00798b;
											width: 280px;
											padding: 10px;
											margin: 25px 0 20px;
											cursor: pointer;
									}
									.scd-install-scdWCV form .button-primary:hover{
											background-color: #000000;
									}
									.scd-install-scdWCV p{
											line-height: 1.6;
									}

							</style>
					</head>
					<body class="scd-setup wp-core-ui">
							<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
							<div class="scd-install-scdWCV">
									<p><?php _e(' This variant has limited features  when you use', 'ch_scd_woo') . ' <strong style="color:red; font-weight: bold;"> ' . _e('WC-Vendor marketplace', 'ch_scd_woo') . ' </strong>' . _e('in your store. You can install SCM variant for WC-Vendor.', 'ch_scd_woo'); ?></p>
									<form method="post" action="" name="scd_install_scdWCV">
											<?php submit_button(__('Install SCM for WC-Vendor', 'ch_scd_woo'), 'primary', 'scd_wcv_install'); ?>
											<?php wp_nonce_field('scdwcvmp-install'); ?>
									</form>
							</div>
					</body>
			</html>
			<?php
	}

	/**
	 * Install scd for dokan if not exist
	 * @throws Exception
	 */
	function install_scd_wcv() {
		check_admin_referer('scdwcvmp-install');
		include_once( ABSPATH . 'wp-admin/includes/file.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		WP_Filesystem();
		$skin = new Automatic_Upgrader_Skin;
		$upgrader = new WP_Upgrader($skin);
		$installed_plugins = array_map('scd_format_plugin_slug', array_keys(get_plugins()));
		$plugin_slug = 'scd-smart-currency-detector-variant-for-wcv';
		$plugin = 'scd-smart-currency-detector-variant-for-wcv/index.php';
		$installed = false;
		$activate = false;
		// See if the plugin is installed already
		if (in_array($plugin_slug, $installed_plugins)) {
				$installed = true;
				$activate = !is_plugin_active($plugin);
		}
		// Install this thing!
		if (!$installed) {
			// Suppress feedback
			ob_start();
	
			try {
				$plugin_information = plugins_api('plugin_information', array(
						'slug' => $plugin_slug,
						'fields' => array(
								'short_description' => false,
								'sections' => false,
								'requires' => false,
								'rating' => false,
								'ratings' => false,
								'downloaded' => false,
								'last_updated' => false,
								'added' => false,
								'tags' => false,
								'homepage' => false,
								'donate_link' => false,
								'author_profile' => false,
								'author' => false,
						),
				));

				if (is_wp_error($plugin_information)) {
					throw new Exception($plugin_information->get_error_message());
				}

				
				$package = $plugin_information->download_link;
				
				$download = $upgrader->download_package($package);

				if (is_wp_error($download)) {
					throw new Exception($download->get_error_message());
				}

				$working_dir = $upgrader->unpack_package($download, true);

				if (is_wp_error($working_dir)) {
					throw new Exception($working_dir->get_error_message());
				}

				$result = $upgrader->install_package(array(
						'source' => $working_dir,
						'destination' => WP_PLUGIN_DIR,
						'clear_destination' => false,
						'abort_if_destination_exists' => false,
						'clear_working' => true,
						'hook_extra' => array(
								'type' => 'plugin',
								'action' => 'install',
						),
				));

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

				$activate = true;
				if(!get_option("scd_free_cancel"))
				add_option("scd_free_cancel",true);
				
				
			} catch (Exception $e) {

				global $SCD;
		    $scd_free_icon= plugins_url('images/scd_free_icon.jpg', __FILE__ );
			set_current_screen();
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
					<head>
							<meta name="viewport" content="width=device-width" />
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title><?php esc_html_e('SCM &rsaquo; Setup Wizard', 'ch_scd_woo'); ?></title>
							<?php do_action('admin_print_styles'); ?>
							<?php do_action('admin_head'); ?>
							<style type="text/css">
									body {
											margin: 100px auto 24px;
											box-shadow: none;
											background: #f1f1f1;
											padding: 0;
											max-width: 700px;
									}
									#wc-logo {
											border: 0;
											margin: 0 0 24px;
											padding: 0;
											text-align: center;
									}
									#wc-logo a {
										color: #00897b;
										text-decoration: none;
									}
									
									#wc-logo a span {
										padding-left: 10px;
										padding-top: 23px;
										display: inline-block;
										vertical-align: top;
										font-weight: 700;
									}
									.scd-install-scdWCV {
											box-shadow: 0 1px 3px rgba(0,0,0,.13);
											padding: 24px 24px 0;
											margin: 0 0 20px;
											background: #fff;
											overflow: hidden;
											zoom: 1;
									}
									.scd-install-scdWCV .button-primary{
											font-size: 1.25em;
											padding: .5em 1em;
											line-height: 1em;
											margin-right: .5em;
											margin-bottom: 2px;
											height: auto;
									}
									.scd-install-scdWCV{
											font-family: sans-serif;
											text-align: center;    
									}
									.scd-install-scdWCV form .button-primary{
											color: #fff;
											background-color: #00798b;
											font-size: 16px;
											border: 1px solid #00798b;
											width: 280px;
											padding: 10px;
											margin: 25px 0 20px;
											cursor: pointer;
									}
									.scd-install-scdWCV form .button-primary:hover{
											background-color: #000000;
									}
									.scd-install-scdWCV p{
											line-height: 1.6;
									}

							</style>
					</head>
					<body class="scd-setup wp-core-ui">
							<h1 id="wc-logo"><a href="http://gajelabs.com/"><img src="<?php echo $scd_free_icon; ?>" alt="SCM" /><span>SMART CURRENCY MANAGER</span></a></h1>
							<div class="scd-install-scdWCV">
									<p><?php _e('Your installation was not successful, please check that you have a good internet connection. You can retry the installation or cancel. Before canceling the installation you can download the plugin', 'ch_scd_woo') . '<a href="https://downloads.wordpress.org/plugin/scd-smart-currency-detector-premium-variant-for-wcvendor.zip">' . __('  by clicking here', 'ch_scd_woo') . ' </a>' . __('  and install it manually.', 'ch_scd_woo'); ?></p>
									<form method="post" action="" name="scd_install_scdWCV">
											<?php submit_button(__('retry to install scm WC-Vendor', 'ch_scd_woo'), 'primary', 'scd_wcv_retry'); ?>
											<?php submit_button(__('Cancel and return to the dashboard', 'ch_scd_woo'), 'primary', 'scd_wcv_cancel'); ?>
											<?php wp_nonce_field('scdwcvmp-install'); ?>
									</form>
							</div>
					</body>
			</html>
			<?php
				exit();
			}

			// Discard feedback
			ob_end_clean();
		}

		wp_clean_plugins_cache();
		// Activate this thing
		if ($activate) {
			try {
				$result = activate_plugin($plugin);

				if (is_wp_error($result)) {
					throw new Exception($result->get_error_message());
				}

			} catch (Exception $e) {

			}
					
		}
		wp_safe_redirect(admin_url('plugins.php'));
	}
	
	function cancel_scd_wcv(){
		check_admin_referer('scdwcvmp-install');
		wp_safe_redirect(admin_url('plugins.php'));
	}






	function scd_format_plugin_slug($key) {
		$slug = explode('/', $key);
		$slug = explode('.', end($slug));
		return $slug[0];
	}

?>