<?php

class KongPageBuilderAdmin extends KongPageBuilder
{
	function __construct()
	{
		parent::__construct();

		$this->_DIST = KONG_PB_DIR.'/dist';
		$this->_IMAGE = KONG_CORE_ROOT.'/img/';
		$this->_3RD = KONG_CORE_ROOT.'/modules/3rd/';
		$this->_DIR_PATH = KONG_DIR_PATH.'/page-builder/';

		$this->render_live_builder();
		$this->render_dnd_area();
		$this->register_rest_api();
		$this->render_interface();
		$this->register_post_type();
		$this->add_edit_quick_link();
		$this->block_edit_columns();

		register_activation_hook(KONG_PLUGIN_PATH, array($this, 'activate_plugin_callback'));
		register_deactivation_hook(KONG_PLUGIN_PATH, array($this, 'deactivate_plugin_callback'));

		add_action('save_post', array($this, 'page_save_meta_box_data'));
	}

	public function add_edit_quick_link() {
		add_action('admin_head-edit.php', array($this, 'kong_add_pb_quick_link'));
	}

	public function kong_add_pb_quick_link() {
		global $current_screen;
		if (!self::post_type_is_accepted($current_screen->post_type)) {
			return;
		}

		if (current_user_can('edit_posts'))
		{
			$pb_link = add_query_arg(array(
				'kong-pb-enable' => 1,
				'post_id' => '@post_id'
			), get_admin_url(null, 'post.php'));
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#the-list > tr').each(function() {
						var id = $(this).find('.check-column input[type="checkbox"]').attr('value');
						var pb_link = '<span class="kong-pb-link"><a href="<?php echo $pb_link; ?>">Edit with Page Builder</a> | </span>';
						pb_link = pb_link.replace('@post_id', id);

						$(this).find('.row-actions .trash').before(pb_link);
					});
				});
			</script>
			<?php
		}
	}

	public function deactivate_plugin_callback(){
		$posts = get_posts(array(
				'post_type' => 'kong_pb_card',
				'numberposts' => -1,
				'post_status' => 'any'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				wp_delete_post($post->ID);
			}
		}
	}

	public function activate_plugin_callback() {
		$files = scandir($this->_DIR_PATH . '/cards');
		$cards = array();

		foreach ($files as $file) {
			if (preg_match("/\.json$/i", $file)) {
				$content = file_get_contents($this->_DIR_PATH . '/cards/' . $file);
				$content = str_replace('VNyFbKKOovtiFFyHYybt', KONG_CORE_ROOT . '/photos/', $content);
				$content = !empty($content) ? json_decode($content, true) : array();

				if (is_array($content)) {
					$cards = array_merge($cards, $content);
				}
			}
		}


		if (!empty($cards)) {
			foreach ($cards as $card) {
				$ID = wp_insert_post(array(
						'post_title' => $card['name'],
						'post_type' => 'kong_pb_card'
				));

				if ($ID) {
					update_post_meta($ID, '_kong_pb_card_model', $card['model']);
					update_post_meta($ID, '_kong_pb_card_img', $card['img']);
					update_post_meta($ID, '_kong_pb_card_filter', $card['filter']);

					$path = $this->_DIR_PATH . '/img/cards/' . $card['img'] . '.png';
					$size = getimagesize($path);

					if (!empty($size)) {
						$padding = $size[1] / $size[0] * 100;
					} else {
						$padding = 0;
					}

					update_post_meta($ID, '_kong_pb_card_padding', $padding);
				}
			}
		}
	}

	private function register_post_type() {
		add_action('init', array($this, 'register_post_types'));
	}

	public function register_post_types() {
		register_post_type('kong_pb_tpl_item', array(
			'label' => 'Kong Template Items',
			'has_archive' => true
		));

		register_post_type('kong_pb_tpl', array(
			'label' => 'Kong Templates',
			'has_archive' => true
		));

		register_post_type('kong_pb_card', array(
			'label' => 'Kong Card',
			'has_archive' => true
		));

		register_post_type('kong_block' , array(
			'labels' => array(
				'name' => 'KONG Block',
				'singular_name' => 'KONG Block',
				'add_new_item' => 'Add New Block',
				'edit_item' => 'Edit Block',
				'new_item' => 'New Block',
				'view_item' => 'View Block',
				'search_items' => 'Search Blocks',
				'not_found' => 'No blocks found.',
				'not_found_in_trash' => 'No blocks found in Trash.',
				'all_items' => 'Block',
				'archives' => 'Block',
				'insert_into_item' => 'Insert into block',
				'uploaded_to_this_item' => 'Uploaded to this block',
				'filter_items_list' => 'Filter blocks list',
				'items_list_navigation' => 'Blocks list navigation',
				'labels->items_list' => 'Blocks list'
			),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_in_nav_menus' => false,
			'has_archive' => false,
			'menu_icon' => 'dashicons-layout',
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array('title', 'editor'),
			'rewrite' => false,
			'kong_has_setting' => false
		));

		add_filter('single_template', array($this, 'block_single_template'));
		add_action('template_redirect', array($this, 'prevent_access_block_page'));
	}

	public function prevent_access_block_page() {
		if (get_post_type() == 'kong_block' && !isset($_GET['kong-dnd-enable']) && !current_user_can('edit_posts')) {
			wp_redirect(home_url());
			exit();
		}
	}

	public function block_single_template($template) {
		global $post;

		if ($post->post_type == 'kong_block'){
			if(file_exists(KONG_DIR_PATH . '/page-builder/block.php')) {
				return KONG_DIR_PATH . '/page-builder/block.php';
			}
		}

		return $template;
	}

	/**
	 * Enqueue javascript and css files to serve
	 */
	public function enqueue_scripts()
	{
		global $wp, $lb_pb_model;

		$post = get_post($_GET['post_id']);

		if ($post->post_status == 'auto-draft') {
			$post->post_status = 'draft';
			wp_update_post($post);
		}

		$redirect_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if (is_ssl()) {
			$redirect_url = 'https://' . $redirect_url;
		} else {
			$redirect_url = 'http://' . $redirect_url;
		}

		$redirect_links = array(
			array('text' => 'Preview This Page', 'link' => get_permalink($post), 'newTab'=>true),
			array('text' => 'Backend Editor', 'link' => get_edit_post_link($post->ID, ''), 'newTab'=>false)
		);

		$post_type = get_post_type($_GET['post_id']);

		if ($post_type == 'page') {
			$data = array(
				'type' => 'page',
				'value' => $_GET['post_id']
			);
		} else {
			$data = array(
				'type' => 'single',
				'value' => $post_type
			);
		}

		$header_id = kong_get_header_id($data);
		if ($header_id && $header_id != 'none') {
			$redirect_links[] = array(
					'text' => 'Header Builder',
					'link' => add_query_arg(array(
							'kong-hb-enable' => true,
							'header_id' => $header_id,
							'post_id' => $_GET['post_id']
					), get_admin_url()),
					'newTab' => false
			);
		}
		$footer_id = kong_get_footer_id($data);
		if ($footer_id && $footer_id != 'none') {
			$redirect_links[] = array(
					'text' => 'Footer Builder',
					'link' => add_query_arg(array(
							'kong-fb-enable' => true,
							'footer_id' => $footer_id,
							'post_id' => $_GET['post_id']
					), get_admin_url()),
					'newTab' => false
			);
		}

		$redirect_links = array_merge($redirect_links, array(
			array('text' => 'Live Customizer', 'link' => add_query_arg(array(
					'page' => 'kong-live-customizer',
					'post_id' => $_GET['post_id']
			), get_admin_url(null, 'admin.php')), 'newTab' => false),
			array('text' => 'Site Options', 'link' => add_query_arg(array(
					'page' => 'kong-options'
			), get_admin_url(null, 'admin.php')), 'newTab' => false)
		));

		$redirect_links[] = array('text' => 'Dashboard', 'link' => get_dashboard_url(), 'newTab' => false);

		$category_obj = new stdClass();
		$categories = get_categories(array(
			'hide_empty' => false
		));

		if (!empty($categories)) {
			foreach ($categories as $category) {
				$category_obj->{$category->term_id} = new stdClass();
				$category_obj->{$category->term_id}->name = $category->name;
			}
		}

		$model = get_post_meta($_GET['post_id'], '_kong_pb_model', true);
		$is_block = get_post_type($_GET['post_id']) == 'kong_block';

		$page_data = array(
			'model' => !empty($model) && is_array($model) ? $model : array(),
			'custom_css' => get_post_meta($_GET['post_id'], '_kong_pb_custom_css', true),
			'custom_js' => get_post_meta($_GET['post_id'], '_kong_pb_custom_js', true),
			'error' => $model === false || (!empty($model) && !is_array($model))
		);

		if ($is_block) {
			$block_frame = get_post_meta($_GET['post_id'], '_kong_block_frame', true);
			$page_data['block_frame'] = !empty($block_frame) && is_object($block_frame) ? $block_frame : array(
				'max_width' => '1000px',
				'padding' => '40px 40px 40px 40px',
				'body_bg' => '#9499a1',
				'frame_bg' => '#ffffff'
			);
		}

		$component = array(
			'shortcode_prefix' => 'kong',
			'class_prefix' => 'p'.$_GET['post_id'],
			'root' => KONG_CORE_ROOT,
			'is_block' => $is_block,
			'dist' => $this->_DIST,
			'img' => KONG_PB_DIR.'/img/',
			'client_img' => KONG_CORE_ROOT.'/client/img/',
			'api' => get_rest_url() . 'kong-page-builder/v1',
			'rest_url' => get_rest_url(),
			'nonce' => wp_create_nonce('wp_rest'),
			'redirect_links' => $redirect_links,
			'frame_url' => add_query_arg(array('kong-dnd-enable' => true), get_permalink($post)),
			'post_id' => $_GET['post_id'],
			'uploaded_fonts' => new stdClass(),
			'login_url' => wp_login_url($redirect_url),
			'categories' => $category_obj,
			'page_data' => $page_data,
			'post_type' => get_post_type($_GET['post_id']),
			'page_title' => 'Page Builder: '.get_the_title($_GET['post_id']),
			'enable_debug' => KONG_DEBUG_MODE,
			'version' => KONG_APP_VERSION,
			'block_url' => add_query_arg(array('post_type' => 'kong_block'), admin_url('edit.php')),
			'loader' => false,
			'site_option_url' => admin_url('admin.php?page=kong-options'),
			'typekit_fonts' => new stdClass(),
			'global_api' => get_rest_url() . 'kong-website-builder/v1',
			'widgets' => KongPageBuilderWidgetManager::fetch(),
			'card_filters' => json_encode(["hero","feature","content","service","number","grid","media", "testimonials", "team","call to action", "pricing", "faq", "contact"])
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

		wp_register_script('kong_pb_js', $this->_DIST.'/js/bs.min.js',array('angularjs'),KONG_APP_VERSION,true);
		wp_localize_script('kong_pb_js', 'kong_pb', $component );
		wp_enqueue_script('kong_pb_js');

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


		// Register & enqueue CSS
		wp_register_style('kong_bs', $this->_DIST.'/css/bs.min.css', array(), KONG_APP_VERSION ,'all');
		wp_enqueue_style('kong_bs');

		wp_register_style('fontawesome', $this->_3RD.'/fontawesome/font-awesome.min.css',array(), '4.7.0', 'screen');
		wp_enqueue_style('fontawesome');

		wp_register_style('linearicons_free', $this->_3RD.'/linearicon-free/style.css',array(), '1.0.0', 'screen');
		wp_enqueue_style('linearicons_free');

		wp_register_style('linear_icons', $this->_3RD.'/linearicon-min/style.css', array(), KONG_APP_VERSION ,'all');
		wp_enqueue_style('linear_icons');
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

		if (isset($_GET['kong-pb-enable']) && array_intersect($allowed_roles, $user->roles )
				&& isset($_GET['post_id']) && self::post_type_is_accepted(get_post_type($_GET['post_id']))) {
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
					<div class="kong-app">
						<div class="kong-page-builder" ng-controller="kong.builder.app.controller">
							<kong-page-builder></kong-page-builder>
						</div><!-- Page Builder -->

						<div class="kong-bs__preloader">
							<div class="kong-bs__preloader__loader"></div>
						</div>
					</div>
				</body>
			';
			wp_footer();
			die;
		}
	}

	public function add_title() {
		add_filter('pre_get_document_title', array($this, 'add_title_callback'));
	}

	public function add_title_callback() {
		return 'Page Builder: Loading...';
	}

	function dnd_area( $content ) {
		if (self::post_type_is_accepted(get_post_type(get_the_ID()))) {
			add_filter( 'edit_post_link', '__return_false' );

			$class = get_post_type(get_the_ID()) == 'kong_block' ? ' class="kong-dnd__blockBuilder__frame"' : '';

			return '<div id="kong-pb-dnd-area"' . $class . '></div>';
		}
		else {
			return $content;
		}
	}

	public function dnd_regsiter_script(){
		if (self::post_type_is_accepted(get_post_type(get_the_ID()))) {
			wp_register_script('kong_dnd_js', $this->_DIST.'/js/dnd.min.js', array(), KONG_APP_VERSION ,false);
			wp_enqueue_script('kong_dnd_js');

			wp_register_style('kong_dnd_css', $this->_DIST.'/css/dnd.min.css', array(), KONG_APP_VERSION, 'screen');
			wp_enqueue_style('kong_dnd_css');

			wp_register_style('linearicon_min', $this->_3RD.'/linearicon-min/style.css',array(), '1.0.0', 'screen');
			wp_enqueue_style('linearicon_min');

			wp_register_style('opensans_fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i', false);
			wp_enqueue_style('opensans_fonts');

			if (defined('KONG_FW_VERSION')) {
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

					wp_add_inline_style('kong.dnd', $style);
				}

				if (!empty($options['typekit_fonts'])) {
					$script = '(function(d) {var config = {kitId: "@kitid",scriptTimeout: 3000,async: true},h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src=\'https://use.typekit.net/\'+config.kitId+\'.js\';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)})(document);';

					foreach ($options['typekit_fonts'] as $kit_id => $kit) {
						wp_add_inline_script('kong.dnd', str_replace('@kitid', $kit_id, $script));
					}
				}
			}
		}
	}

	private function render_dnd_area() {
		if (isset($_GET['kong-dnd-enable'])) {
			show_admin_bar(false);
			add_action("wp_head", array(&$this, ('dnd_regsiter_script')));
			add_filter('the_content', array(&$this, ('dnd_area')));
		}
	}

	private function register_rest_api() {
		add_action('rest_api_init', array($this, 'register_rest_routes'));
	}

	public function register_rest_routes() {
		$rest_api = new KongPageBuilderAPI();
		$rest_api->register_routes();
	}

	public function render_interface() {
		add_action('init', array($this, 'interface_init'));
	}

	public function interface_init() {
		add_action('add_meta_boxes_page', array($this, 'pb_meta_box'));
		add_action('add_meta_boxes_kong_block', array($this, 'block_meta_box'));
		add_action('add_meta_boxes_post', array($this, 'post_meta_box'));

		if (defined('KONG_PORTFOLIO_ROOT')) {
			add_action('add_meta_boxes_portfolio', array($this, 'portfolio_meta_box'));
		}
	}

	public function pb_meta_box() {
		$id = get_the_ID();

		if ($id != get_option('page_for_posts')) {
			add_meta_box('kong_pb', 'Kong Page Builder', array(
				$this,
				'pb_meta_box_render'
			), 'page', 'normal', 'high');
		}
	}

	public function block_meta_box() {
		add_meta_box('kong_pb', 'Kong Page Builder', array(
			$this,
			'pb_meta_box_render'
		), 'kong_block', 'normal', 'high');

		add_meta_box('kong_block_shortcode', 'Shortcode', array(
			$this,
			'block_shortcode_meta_box_render'
		), 'kong_block', 'side', 'low');
	}

	public function post_meta_box() {
		add_meta_box('kong_pb', 'Kong Page Builder', array(
			$this,
			'pb_meta_box_render'
		), 'post', 'normal', 'high');
	}

	public function portfolio_meta_box() {
		add_meta_box('kong_pb', 'Kong Page Builder', array(
			$this,
			'pb_meta_box_render'
		), 'portfolio', 'normal', 'high');
	}

	function page_save_meta_box_data( $post_id ){
		if (isset($_POST['post_type']) && !self::post_type_is_accepted(get_post_type($post_id))) {
			return;
		}

		// verify taxonomies meta box nonce
		if ( !isset( $_POST['pb_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['pb_meta_box_nonce'], basename( __FILE__ ) ) ){
			return;
		}
		// return if autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
			return;
		}
		// Check the user's permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ){
			return;
		}

		if (!empty($_POST['kong_page_builder_enable'])) {
			update_post_meta($post_id, '_kong_pb_enable', 1);
		} else {
			update_post_meta($post_id, '_kong_pb_enable', 0);
		}
	}

	public function pb_meta_box_render() {
		$pb_url = get_admin_url() . 'post.php?kong-pb-enable=1&post_id=' . get_the_ID();
		$pb_enable = get_post_meta(get_the_ID(), '_kong_pb_enable', true);
		$class = $pb_enable ? ' class="kong-pb-enabled"' : ' class="kong-pb-disabled"';
		$checked = $pb_enable ? ' checked="checked"' : '';

		wp_register_script('kong_page_admin_script', $this->_DIST . '/js/admin.min.js', array(), KONG_APP_VERSION,true);
		wp_localize_script('kong_page_admin_script', 'kong_page_admin_data', array(
			'pb_url' => $pb_url,
			'is_block' => get_post_type(get_the_ID()) == 'kong_block',
			'class' => $class,
			'version' => KONG_APP_VERSION,
			'checked' => $checked
		));
		wp_enqueue_script('kong_page_admin_script');

		wp_register_style('kong_page_admin_style', $this->_DIST . '/css/admin.min.css', array(), KONG_APP_VERSION);
		wp_enqueue_style('kong_page_admin_style');

		wp_nonce_field(basename(__FILE__), 'pb_meta_box_nonce');
	}

	public function block_shortcode_meta_box_render() {
		echo '<code>[kong_block id="' . get_the_ID() . '"]</code>';
	}

	public function block_edit_columns() {
		add_filter('manage_edit-kong_block_columns', array($this, 'kong_block_edit_columns'));
		add_action('manage_posts_custom_column',  array($this, 'kong_block_custom_columns'));
	}

	public function kong_block_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"block_shortcode" => "Shortcode",
			"date" => "Date",
		);

		return $columns;
	}

	public function kong_block_custom_columns($column) {
		switch ($column)
		{
			case 'block_shortcode':
				echo '[kong_block id="' . get_the_ID() . '"]';
				break;
		}
	}
}

new KongPageBuilderAdmin();