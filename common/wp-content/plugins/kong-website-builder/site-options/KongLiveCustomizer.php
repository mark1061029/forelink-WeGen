<?php

class KongLiveCustomizer{
	public function __construct() {
		$this->_DIST_DIR = KONG_SO_DIR.'/dist';
		$this->_IMG_DIR = KONG_SO_DIR.'/img';
		$this->_3RD = KONG_CORE_ROOT.'/modules/3rd/';

		$this->add_title();
		$this->render_frontend_view();

		if (!is_admin()) {
			$this->preview_register_script();
			$this->add_body_classes();
		}
	}

	public function add_title() {
		add_filter('pre_get_document_title', array($this, 'add_filter_callback'));
	}

	public function add_filter_callback($title) {
		if($this->is_frontend()){
			return 'Live Customizer: Loading...';
		}
		return $title;
	}

	/**
	 * Enqueue the registered JavaScript and CSS files
	 * which are registered by function register_scripts()
	 * to be hooked into wp_head()
	 * @return mixed
	 */
	public function frontend_enqueue_scripts()
	{
		if(!$this->is_frontend()){
			return;
		}
		global $wp_styles;

		if (!empty($wp_styles->queue)) {
			foreach ($wp_styles->queue as $handle) {
				wp_dequeue_style($handle);
			}
		}

		if (!empty($_GET['url'])) {
			$frame_url = urldecode($_GET['url']);
		} else if (!empty($_GET['post_id']) && $post = get_post($_GET['post_id'])) {
			if ($post->post_status == 'auto-draft') {
				$post->post_status = 'draft';

				wp_update_post($post);
			}

			$frame_url = get_permalink($post);
		} else if (isset($_GET['term_id']) && $_GET['term_id']) {
			$term_id = $_GET['term_id'];
			$frame_url = get_term_link((int)$term_id);
		} else if (isset($_GET['author_id']) && $_GET['author_id']) {
			$author_id = $_GET['author_id'];
			$frame_url = get_author_posts_url($author_id);
		} else if (isset($_GET['year']) && $_GET['year']) {
			$year = $_GET['year'];
			$month = isset($_GET['month']) && $_GET['month'] ? $_GET['month'] : 0;
			$day = isset($_GET['day']) && $_GET['day'] ? $_GET['day'] : 0;

			if ($year && $month && $day) {
				$frame_url = get_day_link($year, $month, $day);
			} else if ($year && $month) {
				$frame_url = get_month_link($year, $month);
			} else {
				$frame_url = get_year_link($year);
			}
		} else if (isset($_GET['post_type']) && $_GET['post_type']) {
			$post_type = $_GET['post_type'];
			$frame_url = get_post_type_archive_link($post_type);
		} else {
			if (get_option('show_on_front') == 'posts') {
				$frame_url = get_home_url();
			} else {
				$post_id = get_option('page_on_front');

				if (!$post_id) {
					$post_id = get_option('page_for_posts');
				}

				$frame_url = get_permalink($post_id);
			}
		}

		$redirect_links = array(
			array('text' => 'Preview This Page', 'link' => $frame_url, 'newTab'=>true, 'id' => 'kong-preview-link')
		);

		$redirect_links[] = array('text' => 'Backend Editor', 'link' => '#', 'newTab'=> false, 'id' => 'kong-backend-link');
		$redirect_links[] = array('text' => 'Header Builder', 'link' => '#', 'newTab' => false, 'id' => 'kong-hb-link');
		$redirect_links[] = array('text' => 'Page Builder', 'link' => '#', 'newTab' => false, 'id' => 'kong-pb-link');
		$redirect_links[] = array('text' => 'Footer Builder', 'link' => '#', 'newTab' => false, 'id' => 'kong-fb-link');
		$redirect_links[] = array('text' => 'Dashboard', 'link' => get_dashboard_url(), 'newTab' => false);

		$redirect_links[] = array('text' => 'Site Options', 'link' => add_query_arg(array(
			'page' => 'kong-options'
		), get_admin_url(null, 'admin.php')), 'newTab'=>false);

		$redirect_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if (is_ssl()) {
			$redirect_url = 'https://' . $redirect_url;
		} else {
			$redirect_url = 'http://' . $redirect_url;
		}

		$options = get_option('kongOptions');
		$data = array(
			'options' => !empty($options) && is_array($options) ? $options : new stdClass(),
			'error' => $options === false || (!empty($options) && !is_array($options))
		);

		$localize_data = array(
			'frame_url'  => add_query_arg(array('kong-preview-enable' => 1), $frame_url),
			'is_front_end' => true,
			'root' => KONG_CORE_ROOT,
			'img_url' => $this->_IMG_DIR,
			'api' => get_rest_url() . 'kong-site-options/v1',
			'rest_url' => get_rest_url(),
			'nonce' => wp_create_nonce('wp_rest'),
			'data' => $data,
			'panel' => isset($_GET['panel']) ? $_GET['panel'] : '',
			'enable_debug' => KONG_DEBUG_MODE,
			'global_api' => get_rest_url() . 'kong-website-builder/v1',
			'host' => $_SERVER['HTTP_HOST'],
			'redirect_links' => $redirect_links,
			'version' => KONG_APP_VERSION,
			'login_url' => wp_login_url($redirect_url),
			'sidebars' => !empty($options['sidebars']) ? $options['sidebars'] : new stdClass(),
			'site_option_url' => admin_url('admin.php?page=kong-options'),
			'uploaded_fonts' => !empty($options['uploaded_fonts']) ? $options['uploaded_fonts'] : new stdClass(),
			'typekit_fonts' => !empty($options['typekit_fonts']) ? $options['typekit_fonts'] : new stdClass(),
			'panels' => KongOptionsManager::fetch('frontend')
		);

		// Register & enqueue Javascript
		wp_register_script('angularjs', $this->_3RD.'/angular.min.js', array(), '1.5.8' ,false);
		wp_enqueue_script('angularjs');

		wp_register_script('angular_sanitize', $this->_3RD.'/angular-sanitize.min.js', array("angularjs"), '1.5.8' ,false);
		wp_enqueue_script('angular_sanitize');

		wp_register_script('angular_ui_router', $this->_3RD.'/angular-ui-router.min.js', array("angularjs"), array("angularjs"), '1.5.8' ,false);
		wp_enqueue_script('angular_ui_router');

		wp_register_script('kong_lc_frontend', $this->_DIST_DIR . '/js/frontend.min.js', array('angularjs'), KONG_APP_VERSION, true);
		wp_localize_script('kong_lc_frontend', 'kong_app_data', $localize_data);
		wp_enqueue_script('kong_lc_frontend');

		wp_register_script('select2_script', $this->_3RD.'/select2.full.min.js', array(), '4.0.3', false);
		wp_enqueue_script('select2_script');

		wp_register_script('ace', $this->_3RD.'/ace/ace.js', array(), '1.0', false);
		wp_enqueue_script('ace');

		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_media();

		// Register & enqueue CSS
		wp_register_style('kong_theme_option_frontend', $this->_DIST_DIR . '/css/frontend.min.css', array(), KONG_APP_VERSION ,'all');
		wp_enqueue_style('kong_theme_option_frontend');

		wp_register_style('fontawesome', $this->_3RD.'/fontawesome/font-awesome.min.css',array(), '4.7.0', 'screen');
		wp_enqueue_style('fontawesome');

		wp_register_style('linearicons_free', $this->_3RD.'/linearicon-free/style.css',array(), '1.0.0', 'screen');
		wp_enqueue_style('linearicons_free');

		wp_register_style('linear_icons', $this->_3RD.'/linearicon-min/style.css', array(), KONG_APP_VERSION ,'all');
		wp_enqueue_style('linear_icons');

		wp_register_style('opensans_fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i', false);
		wp_enqueue_style('opensans_fonts');
	}

	/**
	 * Hook the Script files from frontend_enqueue_scripts() into
	 * wp_head by calling WordPress API add_action()
	 * @return mixed
	 */
	public function frontend_hook_scripts()
	{
		add_action("wp_enqueue_scripts", array(&$this, ('frontend_enqueue_scripts')));
	}

	public function render_frontend_view() {
		add_action('init', array($this, 'theme_options_area'));
	}

	public function theme_options_area() {
		if($this->is_frontend()){
			remove_all_actions( 'wp_print_styles' );
			remove_all_actions( 'wp_print_head_scripts' );
			remove_all_actions( 'wp_footer' );
			add_action( 'wp_head', 'wp_enqueue_scripts', 1 );
			add_action( 'wp_head', 'wp_print_styles', 2 );
			add_action( 'wp_head', 'wp_print_head_scripts', 2 );
			add_action( 'wp_head', 'wp_site_icon' );
			add_action( 'wp_footer', 'wp_print_footer_scripts', 1 );
			add_action( 'wp_footer', 'wp_auth_check_html', 2 );
			remove_all_actions( 'wp_enqueue_scripts' );

			$this->frontend_hook_scripts();

			wp_head();
			echo '
			<body class="kong-theme-option" ng-app="kong.builder.app" ng-controller="kong_builder_app_controller" ng-strict-di>
				<div class="kong-app">
					<kong-theme-option></kong-theme-option>
					<div class="kong-bs__preloader">
						<div class="kong-bs__preloader__loader"></div>
					</div>
				</div>
			</body>';
			wp_footer();
			die;
		}
	}

	public function preview_register_script() {
		if (!empty($_GET['kong-preview-enable'])) {
			show_admin_bar(false);
			add_action('wp_head', array($this, 'preview_enqueue_script'));
		}
	}

	public function preview_enqueue_script() {
		global $wp;

		if (!$wp->did_permalink) {
			$path = '';

			if ($wp->query_string) {
				$path = '?' . $wp->query_string;
			}

			$preview_url = home_url($path);
		} else {
			$preview_url = home_url(add_query_arg(array(), $wp->request));
		}

		$data = array();
		$args = array();

		if (is_singular() || is_home()) {
			if (is_home()) {
				$id = 0;
				$data = array(
					'type' => 'home'
				);
			} else {
				$id = get_the_ID();
				$post_type = get_post_type($id);

				if ($post_type == 'page') {
					$data = array(
						'type' => 'page',
						'value' => $id
					);
				} else {
					$data = array(
						'type' => 'single',
						'value' => $post_type
					);
				}
			}

			$args['post_id'] = $id;
		} else if (is_category() || is_tag() || is_tax()) {
			if (is_category()) {
				$term_id = get_query_var('cat');
			} else if (is_tag()) {
				$tag = get_query_var('tag');
				$term = get_term_by('slug', $tag, 'post_tag');
				$term_id = $term->term_id;
			} else {
				$term_slug = get_query_var('term');
				$tax = get_query_var('taxonomy');
				$term = get_term_by('slug', $term_slug, $tax);
				$term_id = $term->term_id;
			}

			$args['term_id'] = $term_id;
			$term = get_term($term_id);

			if (in_array($term->taxonomy, array('category', 'tag'))) {
				$data = array(
					'type' => 'archive',
					'value' => 'post'
				);
			} else {
				$data = array(
					'type' => 'taxonomy',
					'value' => $term->taxonomy
				);
			}
		} else if (is_author()) {
			$args['author_id'] = get_query_var('author');
			$data = array(
				'type' => 'archive',
				'value' => 'post'
			);
		} else if (is_date()) {
			$year = get_query_var('year');
			$month = get_query_var('monthnum');
			$day = get_query_var('day');

			if ($year) {
				$args['year'] = $year;
			}

			if ($month) {
				$args['month'] = $month;
			}

			if ($day) {
				$args['day'] = $day;
			}

			$data = array(
				'type' => 'archive',
				'value' => 'post'
			);
		} else if (is_post_type_archive()) {
			$post_type = get_query_var('post_type');
			$args['post_type'] = get_query_var('post_type');
			$data = array(
				'type' => 'archive',
				'value' => $post_type
			);
		} else if (is_search()) {
			$args['search'] = get_search_query();
			$data['type'] = 'search';
		}

		$localize = array(
			'host' => $_SERVER['HTTP_HOST'],
			'preview_url' => $preview_url
		);

		if (!empty($data)) {
			$header_id = kong_get_header_id($data);
			if ($header_id) {
				$localize['hb_url'] = add_query_arg(array_merge(array(
					'kong-hb-enable' => true,
					'header_id' => $header_id
				), $args), get_admin_url());
			}

			$footer_id = kong_get_footer_id($data);
			if ($footer_id) {
				$localize['fb_url'] = add_query_arg(array_merge(array(
						'kong-fb-enable' => true,
						'footer_id' => $footer_id
				), $args), get_admin_url());
			}
		}

		if (is_singular()) {
			$id = get_the_ID();
			$localize['backend_url'] = get_edit_post_link($id);

			if (class_exists('KongPageBuilder') && KongPageBuilder::post_type_is_accepted(get_post_type($id))) {
				$localize['pb_url'] = add_query_arg(array(
					'kong-pb-enable' => true,
					'post_id' => $id
				), get_admin_url(null, 'post.php'));
			}
		}

		wp_register_script('site_options_iframe', $this->_DIST_DIR . '/js/iframe.min.js', array(), KONG_APP_VERSION ,false);
		wp_localize_script('site_options_iframe', 'kong_st_data', $localize);
		wp_enqueue_script('site_options_iframe');
		wp_enqueue_style('site_options_iframe', $this->_DIST_DIR . '/css/iframe.css', array(), KONG_APP_VERSION ,'all');

		$options = kong_get_option();

		if (!empty($options['uploaded_fonts'])) {
			$style = '';

			foreach ($options['uploaded_fonts'] as $id => $font) {
				$family = $font['family'];

				if (!$family) {
					$family = 'font_uploaded_' . $id;
				}

				$src_1 = '';
				$src_2 = '';
				$url_arr = [];

				if (!empty($font['eot_link'])) {
					$src_1 = "src: url('" . $font['eot_link'] . "');";
					$url_arr[] = "url('" . $font['eot_link'] . "?#iefix') format('embedded-opentype')";
				}

				if (!empty($font['woff_link'])) {
					$url_arr[] = "url('" . $font['woff_link'] . "') format('woff')";
				}

				if (!empty($font['woff2_link'])) {
					$url_arr[] = "url('" . $font['woff2_link'] . "') format('woff2')";
				}

				if (!empty($font['ttf_link'])) {
					$url_arr[] = "url('" . $font['ttf_link'] . "') format('truetype')";
				}

				if (!empty($font['svg_link'])) {
					$url_arr[] = "url('" . $font['svg_link'] . "#" . $family . "') format('svg')";
				}

				if (!empty($url_arr)) {
					$src_2 = "src: " . implode(',', $url_arr) . ";";
				}

				$style .= "
					@font-face {
						font-family: '" . $family . "';
						" . $src_1 . $src_2 . "
					}
				";
			}

			wp_add_inline_style('kong.theme.option.iframe', $style);
		}

		if (!empty($options['typekit_fonts'])) {
			$script = '(function(d) {var config = {kitId: "@kitid",scriptTimeout: 3000,async: true},h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src=\'https://use.typekit.net/\'+config.kitId+\'.js\';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)})(document);';

			foreach ($options['typekit_fonts'] as $kit_id => $kit) {
				wp_add_inline_script('iframe-script', str_replace('@kitid', $kit_id, $script));
			}
		}
	}

	public function is_frontend() {
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator', 'author');

		if (array_intersect($allowed_roles, $user->roles) && isset($_GET['page']) && $_GET['page'] == 'kong-live-customizer') {
			return true;
		}

		return false;
	}

	public function add_body_classes() {
		if (!empty($_GET['kong-preview-enable'])) {
			add_filter('body_class', array($this, 'filter_body_classes'));
		}
	}

	public function filter_body_classes($classes) {
		$classes[] = 'kong-theme-option-iframe';
		return $classes;
	}
}

new KongLiveCustomizer();