<?php

require KONG_FW_DIR . '/KongThemeAPI.php';

class KongTheme {
	private $_options;

	function __construct() {
		$this->_options = kong_fw_get_options();
		$this->setup_session();
		$this->edit_user_profile();
		$this->register_rest_api();
		$this->permalink_filter();
		$this->add_notice();
		$this->register_maintenance_page();
	}

	public function register_rest_api() {
		$api = new KongThemeAPI();
		$api->register_rest_api();
	}

	public function setup_session() {
		add_action('init', array($this, 'myStartSession'), 1);
		add_action('wp_logout', array($this, 'myEndSession'));
		add_action('wp_login', array($this, 'myEndSession'));
	}

	public function myStartSession() {
		if(!session_id()) {
			session_start();
		}
	}

	public function myEndSession() {
		session_destroy();
	}

	public function edit_user_profile() {
		add_action('personal_options', array($this, 'start_user_profile'));
	}

	public function start_user_profile() {
		add_action('show_user_profile', array($this, 'stop_user_profile'));
		add_action('edit_user_profile', array($this, 'stop_user_profile'));
		ob_start();
	}

	public function stop_user_profile($user) {
		$html = ob_get_contents();
		ob_end_clean();

		ob_start();
		wp_editor(get_user_meta($user->ID, 'description', true), 'kong_fw_user_biographical', array(
			'media_buttons' => false,
			'textarea_rows' => 5,
			'textarea_name' => 'description'
		));
		$editor = ob_get_contents();
		ob_end_clean();

		$html = preg_replace('/<textarea.*id=\"description\".*<\/textarea>/i', $editor, $html);

		print $html;
	}

	public function permalink_filter() {
		add_filter('post_link', array($this, 'permalink_filter_callback'), 10, 2);
	}

	public function permalink_filter_callback($url, $post) {
		$setting = kong_fw_get_settings($post->ID);

		if (!empty($setting['redirect_link'])) {
			return $setting['redirect_link'];
		}

		return $url;
	}

	public function add_notice() {
		add_action('admin_notices', array($this, 'add_notice_callback'));
	}

	public function add_notice_callback() {
		global $GLOBALS;

		$has_active = is_plugin_active('kong-website-builder/kong-website-builder.php');

		if (!$has_active) {
			ob_start();
			?>
			This Theme requires the installation of <i>Kong Website Builder</i> Plugin to work properly.
			<?php
			$html = ob_get_clean();

			add_settings_error('kong-notice', 'kong-notice', $html, 'error');

			if (!in_array($GLOBALS['current_screen']->parent_base, array('options-general', 'kong-theme-admin'))) {
				$this->display_notice('kong-notice');
			}
		}
	}

	public function display_notice($notice) {
		global $wp_settings_errors;

		settings_errors($notice);

		foreach ((array)$wp_settings_errors as $key => $details) {
			if ($details['setting'] === $notice) {
				unset($wp_settings_errors[$key]);
				break;
			}
		}
	}

	public static function getImageSizes($data){
		$sizes = '';

		if (!empty($data['desktop']) && !empty($data['tablet']) && !empty($data['mobile'])) {
			$desktop = $data['desktop'];
			$tablet = $data['tablet'];
			$mobile = $data['mobile'];

			if ($desktop == $tablet && $tablet == $mobile) {
				$sizes = $desktop;
			} else {
				if ($mobile == $tablet) {
					$sizes .= '(max-width:768px) ' . $mobile . ', ' . $desktop;
				} else {
					$sizes .= '(max-width:512px) ' . $mobile . ', ';
					if ($tablet == $desktop) {
						$sizes .= $desktop;
					} else {
						$sizes .= '(max-width:768px) ' . $tablet . ', ' . $desktop;
					}
				}
			}
		}

		return $sizes;
	}

	private function register_maintenance_page() {
		add_filter('template_include', array($this, 'maintenance_page'));
	}

	public function maintenance_page($template) {
		if (!is_user_logged_in() && !empty($this->_options['maintenance_enable'])
				&& !empty($this->_options['maintenance_page_id'])
				&& get_post_type($this->_options['maintenance_page_id']) == 'page'
				&& get_post_status($this->_options['maintenance_page_id']) == 'publish') {
			return locate_template('maintenance.php');
		}

		return $template;
	}
}

new KongTheme();