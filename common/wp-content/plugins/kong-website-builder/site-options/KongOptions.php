<?php

class KongOptions {

	protected $_DIST_DIR, $_VIEW_DIR;
	private $_options;

	public function __construct()
	{
		$this->_DIST_DIR = KONG_SO_DIR.'/dist';
		$this->_IMG_DIR = KONG_SO_DIR.'/img';
		$this->_options = kong_get_option();

		$this->register_post_type();
		$this->register_rest_api();

		if(!is_admin()){
			if(empty($_GET['kong-preview-enable'])){
				add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_styles'), 13);
			}
			add_action('wp_enqueue_scripts', array($this, 'enqueue_script_style_files'), 20);
			add_action('wp_footer', array($this, 'enqueue_google_analysis_script'), 9999);
		}

		add_action('admin_menu', array($this, 'add_admin_menu'), 999);
		add_action('admin_bar_menu', array($this, 'add_toolbar_menu'), 999);

		register_activation_hook(KONG_PLUGIN_PATH, array($this, 'activate_plugin_callback'));
	}

	private function register_rest_api() {
		$api = new KongOptionsAPI();
		$api->register_rest_api();
	}

	private function register_post_type() {
		add_action('init', array($this, 'register_post_types'));
	}

	public function register_post_types() {
		register_post_type('kong_op_tpl', array(
				'label' => 'Kong Option Templates',
				'has_archive' => true
		));
	}

	public function activate_plugin_callback() {
		if (get_option('kongOptions') === false) {
			$data = json_decode(file_get_contents(KONG_SO_DIR . '/initial_data.json'), true);
			if (json_last_error() === JSON_ERROR_NONE) {
				if (!empty($data['options'])) {
					update_option('kongOptions', $data['options']);
				}

				if (!empty($data['styles'])) {
					update_option('kongDynamicStyles', $data['styles']);
				}
			}
		}

	}

	public function add_admin_menu() {
		add_menu_page(
			'Site Options',
			'Site Options',
			'administrator',
			'kong-options',
			array($this, 'render_backend_page'),
			'dashicons-editor-kitchensink',
			100
		);

		add_submenu_page(
				'kong-options',
				'Live Customizer',
				'Live Customizer',
				'edit_theme_options',
				'kong-live-customizer',
				array($this, 'render_front_page'));
	}

	public function render_backend_page(){
		return KongBackendOptions::render_options_page();
	}

	public function render_front_page(){
	}

	public function add_toolbar_menu($wp_admin_bar) {
		global $GLOBALS;

		global $wp;

		$wp_admin_bar->add_node(array(
				'id' => 'kong-options',
				'title' => 'Site Options'
		));

		$wp_admin_bar->add_node(array(
				'id' => 'kong-backend-options',
				'title' => 'Site Options',
				'parent' => 'kong-options',
				'href' => add_query_arg(array(
						'page' => 'kong-options'
				), get_admin_url(null, 'admin.php'))
		));

		$args = array('page' => 'kong-live-customizer');

		if (is_singular() || is_home()) {
			if (is_home()) {
				$id = 0;
			} else {
				$id = get_the_ID();
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
		} else if (is_author()) {
			$args['author_id'] = get_query_var('author');
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
		} else if (is_post_type_archive()) {
			$args['post_type'] = get_query_var('post_type');
		} else {
			if (!$wp->did_permalink) {
				$path = '';

				if ($wp->query_string) {
					$path = '?' . $wp->query_string;
				}

				$url = home_url($path);
			} else {
				$url = home_url(add_query_arg(array(), $wp->request));
			}

			$args['url'] = urlencode($url);
		}

		$wp_admin_bar->add_node(array(
				'id' => 'kong-live-customizer',
				'title' => 'Live Customizer',
				'parent' => 'kong-options',
				'href' => add_query_arg($args, get_admin_url(null, 'admin.php'))
		));

		if (!empty($GLOBALS['current_screen']) && $GLOBALS['current_screen']->base == 'post') {
			$wp_admin_bar->add_node(array(
					'id' => 'kong-live-customizer',
					'title' => 'Live Customizer',
					'href' => add_query_arg(array(
							'page' => 'kong-live-customizer',
							'post_id' => get_the_ID()
					), get_admin_url(null, 'admin.php'))
			));
		}
	}

	public function enqueue_scripts_styles() {
		$dynamic_styles = get_option('kongDynamicStyles');
		$dynamic_styles = !empty($dynamic_styles) && is_array($dynamic_styles) ? $dynamic_styles : array();

		if (!empty($dynamic_styles['links'])) {
			$i = 0;

			foreach ($dynamic_styles['links'] as $link) {
				$i++;
				wp_enqueue_style('dynamic-css-link-' . $i, $link);
			}
		}

		$styles = '';

		if(!empty($dynamic_styles['style'])){
			$styles .= $dynamic_styles['style'];
		}

		if (!empty($this->_options['custom_css'])) {
			$styles .= $this->_options['custom_css'];
		}

		$styles = preg_replace('/\r?\n|\r/', '', preg_replace('/\s*\{\s*/', '{', preg_replace('/\s*}\s*/', '}', preg_replace('/\s*;\s*/', ';', preg_replace('/\s*,\s*/', ',', preg_replace('/\s*:\s*/', ':', $styles))))));

		if($styles){
			wp_add_inline_style('kong_builder_css', $styles);
		}

		if(!empty($this->_options['custom_js'])){
			$custom_js = $this->_options['custom_js'];
			preg_match_all('/[\'\"][^\'\"(\r?\n|\r)]*\/\/[^\'\"(\r?\n|\r)]*[\'\"]/', $custom_js, $matches);
			$maps = array();

			if (!empty($matches[0])) {
				$count = 1;

				foreach ($matches[0] as $match) {
					$custom_js = str_replace($match, '@match' . $count, $custom_js);
					$maps['@match' . $count] = $match;
					$count++;
				}
			}

			$custom_js = preg_replace('/\/\/.*/', '', $custom_js);

			if (!empty($maps)) {
				foreach ($maps as $key => $match) {
					$custom_js = str_replace($key, $match, $custom_js);
				}
			}

			$custom_js = preg_replace('/\r?\n|\r/', '', preg_replace('/\s*\{\s*/', '{', preg_replace('/\s*}\s*/', '}', preg_replace('/\s*;\s*/', ';', preg_replace('/\s*,\s*/', ',', preg_replace('/\s*:\s*/', ':', $custom_js))))));
			echo '<script type="text/javascript">try{' . $custom_js . '}catch(error){console.log(error);}</script>';
		}

		if (!empty($this->_options['typekit_fonts'])) {
			$script = '<script>(function(d) {var config = {kitId: "@kitid",scriptTimeout: 3000,async: true},h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src=\'https://use.typekit.net/\'+config.kitId+\'.js\';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)})(document);</script>';

			foreach ($this->_options['typekit_fonts'] as $kit_id => $kit) {
				if ($kit['active']) {
					echo str_replace('@kitid', $kit_id, $script);
				}
			}
		}
	}

	public function enqueue_script_style_files() {
		if (!empty($this->_options['enqueue_scripts'])) {
			foreach ($this->_options['enqueue_scripts'] as $script) {
				if (!empty($script['enable'])) {
					$handle = !empty($script['handle']) ? str_replace(' ', '-', strtolower($script['handle'])) : $script['id'];
					$deps = !empty($script['deps']) ? explode(',', $script['deps']) : array();
					$in_footer = !empty($script['in_footer']);
					wp_enqueue_script($handle, $script['src'], $deps, $script['ver'], $in_footer);
				}
			}

			foreach ($this->_options['enqueue_styles'] as $style) {
				if (!empty($style['enable'])) {
					$handle = !empty($style['handle']) ? str_replace(' ', '-', strtolower($style['handle'])) : $style['id'];
					$deps = !empty($style['deps']) ? explode(',', $style['deps']) : array();
					wp_enqueue_style($handle, $style['src'], $deps, $style['ver'], $style['media']);
				}
			}
		}
	}

	public function enqueue_google_analysis_script() {
		if (!empty($this->_options['google_analytics'])) {
			echo $this->_options['google_analytics'];
		}
	}
}

new KongOptions();