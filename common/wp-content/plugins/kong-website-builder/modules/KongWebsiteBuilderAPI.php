<?php

require_once 'codebird/codebird.php';

class KongWebsiteBuilderAPI
{
	private $_base_api, $_save_properties;

	public function __construct() {
		$this->_base_api = 'kong-website-builder/v1';
		$this->_save_properties = array('name', 'tag', 'content', 'attrs', 'nested');

		add_action('rest_api_init', array($this, 'register_routes'));
	}

	public function register_routes() {
		register_rest_route($this->_base_api, '/pages', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_pages_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/linear-icons', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_linear_icons_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/font-awesome', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_font_awesome_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/font-awesome-social-icons', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_font_awesome_social_icons_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/image-sizes', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_image_sizes_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/image-sizes-group', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_image_sizes_group_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/shortcodes', array(
				'methods' => WP_REST_Server::CREATABLE,
				'callback' => array($this, 'do_shortcodes_callback'),
				'permission_callback' => array($this, 'get_permission_callback'),
				'args' => array(
						'shortcodes' => array(
								'type' => 'string',
								'default' => ''
						)
				)
		));

		register_rest_route($this->_base_api, '/uploaded-fonts', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_uploaded_fonts_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/typekit-fonts', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_typekit_fonts_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/menus', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_menus_callback'),
				'permission_callback' => array($this, 'get_permission_callback')
		));

		register_rest_route($this->_base_api, '/menus/(?P<id>\d+)', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_menu_callback'),
				'permission_callback' => array($this, 'get_permission_callback'),
				'args' => array(
						'type' => array(
								'type' => 'string',
								'default' => ''
						),
						'depth' => array(
								'type' => 'integer',
								'default' => 0
						),
						'current_menu_type' => array(
								'type' => 'string',
								'default' => ''
						),
						'current_menu_object' => array(
								'type' => 'integer',
								'default' => 0
						)
				)
		));

		register_rest_route($this->_base_api, '/get-tweets', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_tweets_callback'),
				'args' => array(
						'num' => array(
								'type' => 'integer',
								'default' => 5,
								'sanitize_callback' => 'absint',
								'validate_callback' => function($value, $request, $param) {
									if (!is_numeric($value)) {
										return new WP_Error('kong_rest_invalid_param', sprintf('%s not a numeric', $param));
									}

									return true;
								}
						)
				)
		));

		register_rest_route($this->_base_api, '/get-instagram', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_instagram_callback'),
				'args' => array(
						'num' => array(
								'type' => 'integer',
								'default' => 12,
								'sanitize_callback' => 'absint',
								'validate_callback' => function($value, $request, $param) {
									if (!is_numeric($value)) {
										return new WP_Error('kong_rest_invalid_param', sprintf('%s not a numeric', $param));
									}

									return true;
								}
						)
				)
		));

		register_rest_route($this->_base_api, '/get-flickr', array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => array($this, 'get_flickr_callback'),
				'args' => array(
						'num' => array(
								'type' => 'integer',
								'default' => 12,
								'sanitize_callback' => 'absint',
								'validate_callback' => function($value, $request, $param) {
									if (!is_numeric($value)) {
										return new WP_Error('kong_rest_invalid_param', sprintf('%s not a numeric', $param));
									}

									return true;
								}
						)
				)
		));
	}

	public function get_linear_icons_callback() {
		return json_decode(file_get_contents(KONG_CORE_ROOT . '/modules/json/linear-icons.json'));
	}

	public function get_font_awesome_callback($request_data) {
		return json_decode(file_get_contents(KONG_CORE_ROOT . '/modules/json/font-awesome.json'));
	}

	public function get_font_awesome_social_icons_callback($request_data) {
		return json_decode(file_get_contents(KONG_CORE_ROOT . '/modules/json/font-awesome-social-icons.json'));
	}

	public function get_image_sizes_callback($request_data) {
		$params = $request_data->get_params();
		$sizes = array("large" => 1024, "medium_large" => 768, "medium" => 300);

		if (!empty($params['id'])) {
			$urls = array("full" => $params['url']);
			foreach($sizes as $thumb => $size){
				$url = wp_get_attachment_image_src($params['id'], $thumb);
				if($url && $params['url'] != $url[0]){
					$urls[$size] = $url[0];
				}
			}

			return $urls;
		}

		return -1;
	}

	public function get_image_sizes_group_callback($request_data) {
		$params = $request_data->get_params();
		$items = json_decode($params['items'], true);
		$sizes = array("large" => 1024, "medium_large" => 768, "medium" => 300);

		if (!empty($items)) {
			foreach ($items as &$item) {
				if (!empty($item['id'])) {
					$urls = array("full" => $item['url']);
					foreach($sizes as $thumb => $size){
						$url = wp_get_attachment_image_src($item['id'], $thumb);
						if($url && $item['url'] != $url[0]){
							$urls[$size] = $url[0];
						}
					}

					$item['sizes'] = $urls;
				}
			}
		}

		return $items;
	}


	public function get_uploaded_fonts_callback($request_data) {
		$fonts = array();

		$options = kong_get_option();

		if (!empty($options['uploaded_fonts'])) {
			foreach ($options['uploaded_fonts'] as $id => $uploaded_font) {
				if ($uploaded_font['enable']) {
					$font = array();
					$font['id'] = $id;
					$font['name'] = $uploaded_font['name'];
					$fonts[] = $font;
				}
			}
		}

		return $fonts;
	}

	public function get_typekit_fonts_callback($request_data) {
		$fonts = array();

		$options = kong_get_option();

		if (!empty($options['typekit_fonts'])) {
			foreach ($options['typekit_fonts'] as $kit) {
				if ($kit['active'] && !empty($kit['fonts'])) {
					foreach ($kit['fonts'] as $kit_font) {
						$font = array();
						$font['id'] = $kit_font['id'];
						$font['name'] = $kit_font['name'];
						$fonts[] = $font;
					}
				}
			}
		}

		return $fonts;
	}

	public function do_shortcodes_callback($request_data) {
		$params = $request_data->get_params();
		$html = do_shortcode($params['shortcodes']);

		return $html;
	}

	public function get_menus_callback($request_data) {
		global $wpdb;

		$terms = $wpdb->get_results($wpdb->prepare("
			SELECT t.term_id, t.name, t.slug
			FROM $wpdb->terms t
			INNER JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id
			WHERE tt.taxonomy = %s
		", 'nav_menu'), ARRAY_A);

		$menus = array();

		if (!empty($terms)) {
			foreach ($terms as $term) {
				$menu = array();
				$menu['id'] = $term['term_id'];
				$menu['name'] = $term['name'];
				$menus[] = $menu;
			}
		}

		return $menus;
	}

	public function get_menu_callback($request_data) {
		global $wpdb;
		$params = $request_data->get_params();
		$term_id = $params['id'];
		$menu_content = '';
		$menu = $wpdb->get_results("
			SELECT t.term_id
			FROM $wpdb->terms t
			INNER JOIN $wpdb->term_taxonomy tt ON t.term_id = tt.term_id
			WHERE tt.taxonomy = 'nav_menu' AND t.term_id = " . $term_id . "
		");

		if (!empty($menu)) {
			$type = !empty($params['type']) ? $params['type'] : '';
			$depth = !empty($params['depth']) ? $params['depth'] : 0;

			$menu_content = wp_nav_menu(array(
					'menu' => $params['id'],
					'echo' => false,
					'container' => '',
					'type' => $type,
					'depth' => $depth,
					'current_menu_type' => $params['current_menu_type'],
					'current_menu_object' => $params['current_menu_object']
			));
		}

		return $menu_content;
	}

	public function get_pages_callback($request_data) {
		$pages = array();

		$posts = get_posts(array(
				'post_type' => 'page',
				'numberposts' => -1,
				'orderby' => 'ID',
				'order' => 'ASC',
				'post_status' => 'publish'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$page = new stdClass();
				$page->id = $post->ID;
				$page->name = $post->post_title;
				$pages[] = $page;
			}
		}

		return $pages;
	}

	public function get_tweets_callback($request_data) {
		$params = $request_data->get_params();

		$options = kong_get_option();
		$CONSUMER_KEY = !empty($options['twitter_consumer_key']) ? $options['twitter_consumer_key'] : '';
		$CONSUMER_SECRET = !empty($options['twitter_consumer_secret']) ? $options['twitter_consumer_secret'] : '';
		$ACCESS_TOKEN = !empty($options['twitter_access_token']) ? $options['twitter_access_token'] : '';
		$ACCESS_TOKEN_SECRET = !empty($options['twitter_access_token_secret']) ? $options['twitter_access_token_secret'] : '';

		\Codebird\Codebird::setConsumerKey($CONSUMER_KEY, $CONSUMER_SECRET);
		$cb = \Codebird\Codebird::getInstance();
		$cb->setToken($ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);

		$username = !empty($options['twitter_username']) ? $options['twitter_username'] : '';
		$count = !empty($params['num']) ? $params['num'] : 5;
		$api = 'statuses_userTimeline';

		$api_params = array(
				'screen_name' => $username,
				'q' => $username,
				'count' => $count
		);

		$data = (array) $cb->$api($api_params);

		return json_encode($data);
	}

	public function get_instagram_callback($request_data) {
		global $wp_filesystem;

		if (kong_connect_fs('')) {
			$params = $request_data->get_params();

			$options = kong_get_option();
			$access_token = !empty($options['instagram_access_token']) ? $options['instagram_access_token'] : '';
			$username = !empty($options['instagram_username']) ? $options['instagram_username'] : '';

			$user_url = 'https://www.instagram.com/' . $username . '/?__a=1';

			if (kong_exist_url($user_url)) {
				$user_info = json_decode($wp_filesystem->get_contents($user_url));
				$media_url = 'https://api.instagram.com/v1/users/' . $user_info->user->id . '/media/recent/?access_token=' . $access_token . '&count=' . $params['num'];

				if (kong_exist_url($media_url)) {
					return $wp_filesystem->get_contents($media_url);
				}
			}
		}

		return false;
	}

	public function get_flickr_callback($request_data) {
		global $wp_filesystem;

		if (kong_connect_fs('')) {
			$params = $request_data->get_params();

			$options = kong_get_option();
			$api_key = !empty($options['flickr_api_key']) ? $options['flickr_api_key'] : '';
			$user_id = !empty($options['flickr_user_id']) ? $options['flickr_user_id'] : '';
			$url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
			$url .= '&api_key=' . $api_key;
			$url .= '&user_id=' . $user_id;
			$url .= '&per_page=' . $params['num'];
			$url .= '&format=json';
			$url .= '&nojsoncallback=1';

			$data = new stdClass();
			$data->user_id = $user_id;

			if (kong_exist_url($url)) {
				$data->data = $wp_filesystem->get_contents($url);
				return $data;
			}

			return false;
		}
	}

	public function get_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to run this function.', array('status' => 403));
		}

		return true;
	}
}

new KongWebsiteBuilderAPI();
