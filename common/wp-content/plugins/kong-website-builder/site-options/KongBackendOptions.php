<?php

class KongBackendOptions{
	public function __construct()
	{
		$this->_DIST_DIR = KONG_SO_DIR.'/dist';
		$this->_IMG_DIR = KONG_SO_DIR.'/img';
		$this->_3RD = KONG_CORE_ROOT.'/modules/3rd/';

		$this->backend_hook_scripts();
		$this->register_upload_file_types();
	}

	/**
	 * Prepare all necessary JavaScript and CSS files in registered status
	 * so that they will be ready to be enqueued for latter calling frontend_enqueue_scripts()
	 *
	 * @return mixed
	 */
	public function backend_hook_scripts()
	{
		add_action("admin_enqueue_scripts", array(&$this, ('backend_enqueue_scripts')));
	}

	/**
	 * Enqueue the registered JavaScript and CSS files
	 * which are registered by function register_scripts()
	 * to be hooked into wp_head()
	 * @return mixed
	 */
	public function backend_enqueue_scripts()
	{
		if ($this->is_backend()) {
			// Register and enqueue Javascript
			wp_register_script('angularjs', $this->_3RD.'/angular.min.js', array(), '1.5.8' ,false);
			wp_enqueue_script('angularjs');

			wp_register_script('angular_sanitize', $this->_3RD.'/angular-sanitize.min.js', array("angularjs"), '1.5.8' ,false);
			wp_enqueue_script('angular_sanitize');

			wp_register_script('angular_ui_router', $this->_3RD.'/angular-ui-router.min.js', array("angularjs"), '1.5.8' ,false);
			wp_enqueue_script('angular_ui_router');

			$options = get_option('kongOptions');
			$data = array(
					'options' => !empty($options) && is_array($options) ? $options : new stdClass(),
					'error' => $options === false || !is_array($options),
					'error_message' => 'Error data !!!'
			);

			$redirect_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			if (is_ssl()) {
				$redirect_url = 'https://' . $redirect_url;
			} else {
				$redirect_url = 'http://' . $redirect_url;
			}

			$localize_obj = array(
					'is_front_end' => false,
					'nonce' => wp_create_nonce('wp_rest'),
					'data' => $data,
					'img_url' => $this->_IMG_DIR,
					'save_options_nonce' => wp_create_nonce('kong_save_options'),
					'api' => get_rest_url() . 'kong-site-options/v1',
					'global_api' => get_rest_url() . 'kong-website-builder/v1',
					'rest_url' => get_rest_url(),
					'panel' => isset($_GET['panel']) ? $_GET['panel'] : '',
					'enable_debug' => KONG_DEBUG_MODE,
					'version' => KONG_APP_VERSION,
					'login_url' => wp_login_url($redirect_url),
					'panels' => KongOptionsManager::fetch('backend'),
					'frontend_modules' => KongOptionsManager::getFrontendModules()
			);

			wp_register_script('kong_backend_customizer', $this->_DIST_DIR . '/js/backend.min.js', array('angularjs'), KONG_APP_VERSION, true);
			wp_localize_script('kong_backend_customizer', 'kong_app_data', $localize_obj);
			wp_enqueue_script('kong_backend_customizer');

			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_media();

			wp_register_script('select2', $this->_3RD.'/select2.full.min.js', array(), '4.0.5' ,false);
			wp_enqueue_script('select2');

			wp_register_script('ace', $this->_3RD.'/ace/ace.js', array(), '1.0', false);
			wp_enqueue_script('ace');


			// Register & enqueue CSS
			wp_enqueue_style('jquery-ui');

			wp_register_style('kong_backend_customizer', $this->_DIST_DIR . '/css/backend.min.css', array(), KONG_APP_VERSION ,'all');
			wp_enqueue_style('kong_backend_customizer');

			wp_register_style('fontawesome', $this->_3RD.'/fontawesome/font-awesome.min.css',array(), '4.7.0', 'screen');
			wp_enqueue_style('fontawesome');

			wp_register_style('linearicon_min', $this->_3RD.'/linearicon-min/style.css', array(), KONG_APP_VERSION ,'all');
			wp_enqueue_style('linearicon_min');
		}

	}

	public function is_backend() {
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator', 'author');

		if (array_intersect($allowed_roles, $user->roles ) && isset($_GET['page']) && $_GET['page'] == 'kong-options') {
			return true;
		}

		return false;
	}

	public static function render_options_page()
	{
		?>
		<div class="wrap" ng-app="kong.builder.app" ng-controller="kong_builder_app_controller" ng-strict-di>
			<option-board></option-board>
		</div>
		<?php
	}

	public function register_upload_file_types() {
		add_filter('upload_mimes', array($this, 'upload_file_types'), 1, 1);
	}

	public function upload_file_types($mime_types) {
		$mime_types['ttf'] = 'application/x-font-ttf';
		$mime_types['woff'] = 'font/woff';
		$mime_types['woff2'] = 'font/woff2';
		$mime_types['svg'] = 'font/svg';
		$mime_types['eot'] = 'application/vnd.ms-fontobject';
		$mime_types['ogg']  = 'video/ogg';
		$mime_types['webm'] = 'video/webm';

		return $mime_types;
	}
}

new KongBackendOptions();