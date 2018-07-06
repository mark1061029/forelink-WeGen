<?php

class KongFooterBuilderAdmin
{
	function __construct()
	{
		$this->_DIST = KONG_FB_DIR.'/dist/';
		$this->_IMAGE = KONG_FB_DIR.'/img/';
		$this->_3RD = KONG_CORE_ROOT.'/modules/3rd/';
		$this->_CSS = $this->_DIST.'/css/';
		$this->_JS = $this->_DIST.'/js/';

		$this->render_live_builder();
		$this->render_dnd_area();
		$this->register_rest_api();
		$this->register_post_type();
		$this->add_meta_boxes();

		if (isset($_GET['page']) && $_GET['page'] == 'kong-footer-setting-page') {
			$this->admin_register_scripts();
		}

		add_action('admin_menu', array($this, 'add_footer_setting_page'));

		if (isset($_GET['preview-footer'])) {
			show_admin_bar(false);
		}
	}

	public function add_meta_boxes() {
		add_action('add_meta_boxes', array($this, 'add_meta_boxes_callback'), 12);
		add_action('save_post', array($this, 'page_save_footer_meta_box_data'));
		add_action('admin_print_styles-post.php', array($this, 'page_footer_metabox_enqueue_script'));
		add_action('admin_print_styles-post-new.php', array($this, 'page_footer_metabox_enqueue_script'));
	}

	public function add_meta_boxes_callback() {
		add_meta_box('kong-page-footer-meta-box', 'Footer Setting', array($this, 'page_footer_meta_box_render'), 'page', 'side', 'low');
	}

	public function page_footer_meta_box_render() {
		wp_nonce_field(basename(__FILE__), 'kong_page_footer_nonce');
		echo "<div id='kong-page-footer'><page-footer-metabox post-id='" . get_the_ID() . "'></page-footer-metabox></div>";
	}

	function page_save_footer_meta_box_data($post_id){
		if (isset($_POST['post_type']) && 'page' != $_POST['post_type']){
			return;
		}

		// verify taxonomies meta box nonce
		if (!isset($_POST['kong_page_footer_nonce']) || !wp_verify_nonce($_POST['kong_page_footer_nonce'], basename(__FILE__))) {
			return;
		}

		// return if autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		// Check the user's permissions.
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		$setting = json_decode(str_replace('\\', '', $_POST['kong-page-footer-setting']), true);

		if (!empty($setting) && is_array($setting)) {
			update_post_meta($post_id, 'kong-page-footer-setting', $setting);
		}
	}

	function page_footer_metabox_enqueue_script(){
		$ID = get_the_ID();

		if ('page' == get_post_type($ID)) {
			wp_register_script('angularjs', '//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js', array(), '1.5.8', false);
			wp_enqueue_script('angularjs');

			$setting = kong_get_footer_setting($ID);

			if (empty($setting['footer'])) {
				$setting['footer'] = 'primary';
			}

			$posts = get_posts(array(
				'post_type' => 'kong_footer',
				'numberposts' => -1,
				'orderby' => 'ID',
				'order' => 'ASC',
				'post_status' => 'publish'
			));

			$footers = array();
			$footer_exist = false;

			if ($setting['footer'] == 'primary' || $setting['footer'] == 'none') {
				$footer_exist = true;
			}

			if (!empty($posts)) {
				foreach ($posts as $post) {
					$footer = new stdClass();
					$footer->id = $post->ID;
					$footer->name = $post->post_title;
					$footers[] = $footer;

					if ($post->ID == $setting['footer']) {
						$footer_exist = true;
					}
				}
			}

			if (!$footer_exist) {
				$setting['footer'] = 'primary';
			}

			$redirect_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			if (is_ssl()) {
				$redirect_url = 'https://' . $redirect_url;
			} else {
				$redirect_url = 'http://' . $redirect_url;
			}

			$translation = array(
				"post_id" => $ID,
				"setting" => $setting,
				"items" => $footers,
				"label" => "footer",
				"api" => get_rest_url() . "kong-footer-builder/v1",
				"edit_url" => add_query_arg(array('kong-fb-enable' => 1), get_admin_url()),
				"nonce" => wp_create_nonce('wp_rest'),
				"enable_debug" => KONG_DEBUG_MODE,
				"list_url" => add_query_arg(array('page' => 'kong-footer-setting-page'), get_admin_url(null, 'admin.php')),
				"login_url" => wp_login_url($redirect_url)
			);

			wp_register_script('select2', $this->_3RD.'/select2.full.min.js', array(), '4.0.3' ,false);
			wp_enqueue_script('select2');

			wp_register_script('kong_fb_page_selection_js', $this->_JS . '/page.selection.min.js', array(), KONG_APP_VERSION, false);
			wp_localize_script('kong_fb_page_selection_js', 'kong_app_footer_data', $translation);
			wp_enqueue_script('kong_fb_page_selection_js');

			wp_register_style('fontawesome', $this->_3RD.'/fontawesome/font-awesome.min.css',array(), '4.7.0', 'screen');
			wp_enqueue_style('fontawesome');

			wp_register_style('kong_fb_page_selection_css', KONG_FB_DIR . '/dist/css/page.selection.min.css');
			wp_enqueue_style('kong_fb_page_selection_css');
		}
	}

	private function register_post_type() {
		add_action('init', array($this, 'register_post_types'));
	}

	public function register_post_types() {
		register_post_type('kong_footer', array(
			'label' => 'Kong Footer',
			'has_archive' => true
		));

		register_post_type('kong_footer_tpl', array(
			'label' => 'Kong Footer Template',
			'has_archive' => true
		));
	}

	/**
	 * Enqueue javascript and css files to serve
	 */
	public function enqueue_scripts()
	{
		$post_id = 0;
		$current_menu_type = '';
		$current_menu_object = 0;
		$link_args = array();
		$is_singular = false;
		$data = array();

		if (isset($_GET['post_id']) && $post = get_post($_GET['post_id'])) {
			$post_id = $_GET['post_id'];

			if ($post->post_status == 'auto-draft') {
				$post->post_status = 'draft';
				wp_update_post($post);
			}

			$current_menu_type = 'post';
			$current_menu_object = $post_id;
			$frame_url = get_permalink($post_id);
			$is_singular = true;
			$post_type = get_post_type($post_id);
			$link_args['post_id'] = $post_id;

			if ($post_type == 'page') {
				$data = array(
					'type' => 'page',
					'value' => $post_id
				);
			} else {
				$data = array(
					'type' => 'single',
					'value' => $post_type
				);
			}
		} else if (isset($_GET['term_id']) && $_GET['term_id']) {
			$term_id = $_GET['term_id'];
			$frame_url = get_term_link((int)$term_id);
			$link_args['term_id'] = $term_id;
			$current_menu_type = 'term';
			$current_menu_object = $term_id;
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
		} else if (isset($_GET['author_id']) && $_GET['author_id']) {
			$author_id = $_GET['author_id'];
			$frame_url = get_author_posts_url($author_id);
			$link_args['author_id'] = $author_id;
			$data = array(
				'type' => 'archive',
				'value' => 'post'
			);
		} else if (isset($_GET['year']) && $_GET['year']) {
			$year = $_GET['year'];
			$month = isset($_GET['month']) && $_GET['month'] ? $_GET['month'] : 0;
			$day = isset($_GET['day']) && $_GET['day'] ? $_GET['day'] : 0;

			if ($year && $month && $day) {
				$frame_url = get_day_link($year, $month, $day);
				$link_args['year'] = $year;
				$link_args['month'] = $month;
				$link_args['day'] = $day;
			} else if ($year && $month) {
				$frame_url = get_month_link($year, $month);
				$link_args['year'] = $year;
				$link_args['month'] = $month;
			} else {
				$frame_url = get_year_link($year);
				$link_args['year'] = $year;
			}

			$data = array(
				'type' => 'archive',
				'value' => 'post'
			);
		} else if (isset($_GET['post_type']) && $_GET['post_type']) {
			$post_type = $_GET['post_type'];
			$frame_url = get_post_type_archive_link($post_type);
			$link_args['post_type'] = $post_type;
			$data = array(
				'type' => 'archive',
				'value' => $post_type
			);
		} else if (isset($_GET['search'])) {
			$frame_url = add_query_arg(array('s' => $_GET['search']), get_home_url());
			$link_args['search'] = $_GET['search'];
			$data['type'] = 'search';
		} else {
			if (get_option('show_on_front') == 'posts') {
				$frame_url = get_home_url();
				$data = array(
					'type' => 'home'
				);
			} else {
				$post_id = get_option('page_on_front');
				$is_singular = true;
				$data = array(
					'type' => 'page',
					'value' => $post_id
				);

				if (!$post_id) {
					$post_id = get_option('page_for_posts');
					$is_singular = false;
					$data = array(
						'type' => 'home'
					);
				}

				$frame_url = get_permalink($post_id);
			}

			$current_menu_type = 'post';
			$current_menu_object = $post_id;
		}

		$set_footer = false;
		$message = '';
		$footer_id = $_GET['footer_id'];
		$footer_setting_id = kong_get_footer_id($data);

		if ($footer_id == 'primary') {
			$options = kong_get_footer_options();
			$footer_id = $options['primary']['value'];
		}

		if ($footer_setting_id != $footer_id) {
			$set_footer = true;

			if (!$footer_setting_id || $footer_setting_id == 'none' || !get_post($footer_setting_id)) {
				$message = 'Currently, There is no Footer set for this page. Click on this button to apply the Footer for this page.';
			} else {
				$footer = get_post($footer_setting_id);
				$old_footer_name = $footer->post_title;
				$args = array(
					'kong-hb-enable' => true,
					'footer_id' => $footer_setting_id
				);

				$old_footer_url = add_query_arg(array_merge($args, $link_args), get_admin_url());

				$message = 'This page currently uses  <a href="' . $old_footer_url . '">' . $old_footer_name . '</a> Footer. If you want to apply the Footer for this page, please click on this button.';
			}
		}

		$custom_css = get_post_meta($footer_id, '_kong_fb_custom_css', true);
		$model = get_post_meta($footer_id, '_kong_fb_model', true);

		$footer_data = array(
			'model' => !empty($model) && is_array($model) ? $model : array(),
			'custom_css' => $custom_css,
			'error' => $model === false || (!empty($model) && !is_array($model))
		);

		$redirect_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if (is_ssl()) {
			$redirect_url = 'https://' . $redirect_url;
		} else {
			$redirect_url = 'http://' . $redirect_url;
		}

		$redirect_links = array(
			array('text' => 'Preview This Page', 'link' => $frame_url, 'newTab'=>true),
			array('text' => 'Backend Editor', 'link' => get_edit_post_link($post->ID, ''), 'newTab'=>false),
			array('text' => 'Footer Manager', 'link' => add_query_arg(array(
				'page' => 'kong-footer-setting-page'
			), get_admin_url(null, 'admin.php')), 'newTab' => false)
		);

		$header_id = kong_get_header_id($data);
		if ($header_id && $header_id != 'none') {
			$redirect_links[] = array(
					'text' => 'Header Builder',
					'link' => add_query_arg(array_merge(array(
							'kong-hb-enable' => true,
							'header_id' => $header_id
					), $link_args), get_admin_url()),
					'newTab' => false
			);
		}

		if ($is_singular && class_exists('KongPageBuilder') && KongPageBuilder::post_type_is_accepted(get_post_type($post_id))) {
			$redirect_links[] = array(
				'text' => 'Page Builder',
				'link' => add_query_arg(array(
					'kong-pb-enable' => true,
					'post_id' => $post_id
				), get_admin_url(null, 'post.php')),
				'newTab' => false
			);
		}

		$redirect_links[] = array('text' => 'Live Customizer', 'link' => add_query_arg(array_merge(array(
				'page' => 'kong-live-customizer'
		), $link_args), get_admin_url(null, 'admin.php')), 'newTab' => false);

		$redirect_links[] = array('text' => 'Site Options', 'link' => add_query_arg(array(
				'page' => 'kong-options'
		), get_admin_url(null, 'admin.php')), 'newTab' => false);

		$redirect_links[] = array('text' => 'Dashboard', 'link' => get_dashboard_url(), 'newTab' => false);

		$component = array(
			'shortcode_prefix' => 'lfb',
			'class_prefix' => 'f'.$_GET['footer_id'],
			'root' => KONG_CORE_ROOT,
			'img' => $this->_IMAGE,
			'client_img' => KONG_CORE_ROOT.'/client/img/',
			'api' => get_rest_url() . 'kong-footer-builder/v1',
			'rest_url' => get_rest_url(),
			'nonce' => wp_create_nonce('wp_rest'),
			'frame_url' => add_query_arg(array('kong-fb-dnd-enable' => true), $frame_url),
			'footer_id' => $_GET['footer_id'],
			'current_menu_type' => $current_menu_type,
			'current_menu_object' => $current_menu_object,
			'edit_url' => add_query_arg(array('kong-fb-enable' => true), get_admin_url()),
			'uploaded_fonts' => new stdClass(),
			'global_api' => get_rest_url() . 'kong-website-builder/v1',
			'footer_data' => $footer_data,
			'login_url' => wp_login_url($redirect_url),
			'redirect_links' => $redirect_links,
			'set_footer' => $set_footer,
			'set_footer_data' => $data,
			'message' => $message,
			'enable_debug' => KONG_DEBUG_MODE,
			'template_identify_code' => kong_get_identify_code('kong-fb-template'),
			'kong_pb' => true,
			'page_title' => 'Footer Builder: '.get_the_title($_GET['footer_id']),
			'version' => KONG_APP_VERSION,
			'block_url' => add_query_arg(array('post_type' => 'kong_block'), admin_url('edit.php')),
			'site_option_url' => admin_url('admin.php?page=kong-options'),
			'typekit_fonts' => new stdClass(),
			'widgets' => KongFooterBuilderWidgetManager::fetch()
		);

		$options = kong_get_option();
		if (!empty($options['uploaded_fonts'])) {
			$component['uploaded_fonts'] = $options['uploaded_fonts'];
		}
		if (!empty($options['typekit_fonts'])) {
			$component['typekit_fonts'] = $options['typekit_fonts'];
		}
		if (!empty($options['google_map_api_key'])) {
			$component['map_api_key'] = $options['google_map_api_key'];
		}

		// Register & enqueue Javascript
		wp_register_script('ace', $this->_3RD.'/ace/ace.js', array(), '1.0' ,false);
		wp_enqueue_script('ace');

		wp_register_script('select2', $this->_3RD.'/select2.full.min.js', array(), '4.0.3' ,false);
		wp_enqueue_script('select2');

		wp_register_script('listjs', $this->_3RD.'/list.min.js', array(), '1.2.0' ,false);
		wp_enqueue_script('listjs');

		wp_register_script('angularjs', $this->_3RD.'/angular.min.js', array(), '1.5.8' ,false);
		wp_enqueue_script('angularjs');

		wp_register_script('angular_sanitize', $this->_3RD.'/angular-sanitize.min.js', array("angularjs"), '1.5.8' ,false);
		wp_enqueue_script('angular_sanitize');

		wp_register_script('kong_fb_js', $this->_JS . '/bs.min.js', array('angularjs'), KONG_APP_VERSION, true);
		wp_localize_script('kong_fb_js', 'kong_fb', $component);
		wp_enqueue_script('kong_fb_js');

		wp_register_script( 'tinymce', '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.12/tinymce.min.js');
		wp_enqueue_script( 'tinymce');

		wp_register_script( 'tinymce-colorpicker', '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.12/plugins/colorpicker/plugin.min.js');
		wp_enqueue_script( 'tinymce-colorpicker');

		wp_register_script( 'tinymce-link', '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.12/plugins/link/plugin.min.js');
		wp_enqueue_script( 'tinymce-link');

		wp_register_script( 'tinymce-fullscreen', '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.12/plugins/fullscreen/plugin.min.js');
		wp_enqueue_script( 'tinymce-fullscreen');

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_media();
		wp_enqueue_media();

		// Register & enqueue CSS
		wp_register_style('kong_fb_css', $this->_CSS.'/bs.min.css', array(), KONG_APP_VERSION ,'all');
		wp_enqueue_style('kong_fb_css');

		wp_register_style('fontawesome', $this->_3RD.'/fontawesome/font-awesome.min.css',array(), '4.7.0', 'screen');
		wp_enqueue_style('fontawesome');

		wp_register_style('linearicons_free', $this->_3RD.'/linearicon-free/style.css',array(), '1.0.0', 'screen');
		wp_enqueue_style('linearicons_free');

		wp_register_style('linear_icons', $this->_3RD.'/linearicon-min/style.css', array(), KONG_APP_VERSION ,'all');
		wp_enqueue_style('linear_icons');
	}

	public function register_scripts(){
		add_action("wp_enqueue_scripts",array(&$this, ('enqueue_scripts')));
	}

	/**
	 * Hooking all registered JavaScript & CSS into wp_head
	 */
	public function hook_scripts()
	{
		add_action("wp_head", array(&$this, ('enqueue_scripts')));
	}

	private function render_live_builder()
	{
		add_action('init', array(&$this,('builder_area')), 11);
	}

	function builder_area()
	{
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator', 'author');

		if (isset($_GET['kong-fb-enable']) && array_intersect($allowed_roles, $user->roles) && isset($_GET['footer_id'])) {
			if ($_GET['footer_id'] == 'primary') {
				$options = kong_get_footer_options();
				$footer_id = !empty($options['primary']['value']) ? $options['primary']['value'] : 0;
			} else {
				$footer_id = $_GET['footer_id'];
			}

			if (get_post_type($footer_id) == 'kong_footer') {
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

				$this->add_title();
				$this->hook_scripts();

				wp_head();
				echo '
					<body ng-app="kong.builder.app" ng-strict-di>
						<div class="kong-app" ng-controller="kong_builder_app_controller">
							<kong-footer-builder></kong-footer-builder>
							<div class="kong-bs__preloader">
								<div class="kong-bs__preloader__loader"></div>
							</div>
						</div>
					</body><!-- Footer Builder -->
				';
				wp_footer();
				die;
			}
		}
	}

	public function add_title() {
		add_filter('pre_get_document_title', array($this, 'add_title_callback'));
	}

	public function add_title_callback() {
		return 'Footer Builder: Loading...';
	}

	public function dnd_register_script(){
		wp_enqueue_script('kong.footer.dnd', $this->_DIST.'/js/dnd.min.js', array(), KONG_APP_VERSION ,false);
		wp_enqueue_style('kong.footer.dnd', $this->_DIST.'/css/dnd.min.css', array(), KONG_APP_VERSION, 'screen');
		wp_enqueue_style('linearicon_min', KONG_CORE_ROOT.'/modules/3rd/linearicon-min/style.css',array(), '1.0.0', 'screen');
		wp_enqueue_style('opensans_fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i', false);

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

			wp_add_inline_style('kong.footer.dnd', $style);
		}

		if (!empty($options['typekit_fonts'])) {
			$script = '(function(d) {var config = {kitId: "@kitid",scriptTimeout: 3000,async: true},h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src=\'https://use.typekit.net/\'+config.kitId+\'.js\';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)})(document);';

			foreach ($options['typekit_fonts'] as $kit_id => $kit) {
				wp_add_inline_script('kong.footer.iframe', str_replace('@kitid', $kit_id, $script));
			}
		}
	}

	private function render_dnd_area() {
		if (isset($_GET['kong-fb-dnd-enable'])) {
			show_admin_bar(false);
			add_action("wp_head", array(&$this, ('dnd_register_script')));
		}
	}

	private function register_rest_api() {
		add_action('rest_api_init', array($this, 'register_rest_routes'));
	}

	public function register_rest_routes() {
		$rest_api = new KongFooterBuilderAPI();
		$rest_api->register_routes();
	}

	public function admin_enqueue_scripts() {
		global $GLOBALS;
		wp_enqueue_script('angularjs', $this->_3RD.'/angular.min.js', array(), '1.5.8' ,false);

		$footer_options = kong_get_footer_options();
		$footer_labels = array(
			'primary' => 'Primary Footer',
			'search' => 'Search Footer'
		);

		$footer_defaults = array(
			'primary' => array(
				'always_enable' => true,
				'value' => ''
			),
			'search' => array(
				'always_enable' => true,
				'value' => ''
			)
		);

		$post_types = kong_fb_get_post_types();

		if (!empty($post_types)) {
			foreach ($post_types as $post_type) {
				if (!in_array($post_type->name, array('page', 'attachment', 'kong_block'))) {
					$footer_labels[$post_type->name] = $post_type->label . ' Footer';
					$footer_defaults[$post_type->name] = array(
						'enable' => false,
						'value' => array(
							'archive' => '',
							'single' => ''
						),
						'post_type' => true
					);
				}
			}
		}

		$taxonomies = get_taxonomies(array('_builtin' => false, 'show_ui' => true), 'objects');

		if (!empty($taxonomies)) {
			foreach ($taxonomies as $taxonomy) {
				$footer_labels[$taxonomy->name] = $taxonomy->label . ' Footer';
				$footer_defaults[$taxonomy->name] = array(
					'enable' => false,
					'value' => ''
				);
			}
		}

		$redirect_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if (is_ssl()) {
			$redirect_url = 'https://' . $redirect_url;
		} else {
			$redirect_url = 'http://' . $redirect_url;
		}

		$data = array(
			'api' => get_rest_url() . 'kong-footer-builder/v1',
			'nonce' => wp_create_nonce('wp_rest'),
			'version' => KONG_APP_VERSION,
			'edit_url' => add_query_arg(array('kong-fb-enable' => true), get_admin_url()),
			'enable_debug' => KONG_DEBUG_MODE,
			'options' => array_merge($footer_defaults, $footer_options),
			'labels' => $footer_labels,
			'label' => 'footer',
			'login_url' => wp_login_url($redirect_url)
		);

		wp_register_script('kong_admin_fb', $this->_JS . 'crud.min.js', array('angularjs'), KONG_APP_VERSION, false);
		wp_localize_script('kong_admin_fb', 'kong_app_data', $data);
		wp_enqueue_script('kong_admin_fb');

		wp_enqueue_script('select2', $this->_3RD.'/select2.full.min.js', array(), '4.0.3' ,false);
		wp_enqueue_script('select2');

		wp_register_style('kong_admin_fb', $this->_CSS.'/crud.min.css', array(), KONG_APP_VERSION, 'screen');
		wp_enqueue_style('kong_admin_fb');

		wp_register_style('linearicon_min', $this->_3RD.'/linearicon-min/style.css',array(), '1.0.0', 'screen');
		wp_enqueue_style('linearicon_min');

		wp_register_style('fontawesome', $this->_3RD.'/fontawesome/font-awesome.min.css',array(), '4.7.0', 'screen');
		wp_enqueue_style('fontawesome');
	}

	public function admin_register_scripts(){
		add_action("admin_enqueue_scripts",array($this, ('admin_enqueue_scripts')));
	}

	public function add_footer_setting_page() {
		add_menu_page(
			'Footer Manager',
			'Footer Manager',
			'administrator',
			'kong-footer-setting-page',
			array($this, 'kong_footer_setting_page'),
			'dashicons-editor-kitchensink',
			82
		);
	}

	public function kong_footer_setting_page() {
		?>
		<div class="wrap" id="kong-footer-builder-admin" ng-app="kong.app.manager" ng-controller="kong_app_manager_controller" ng-strict-di>
			<app-admin></app-admin>
		</div>
		<?php
	}
}

new KongFooterBuilderAdmin();
