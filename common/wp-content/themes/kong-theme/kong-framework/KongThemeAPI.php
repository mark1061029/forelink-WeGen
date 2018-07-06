<?php

class KongThemeAPI {

	private $_base_api;

	public function __construct() {
		$this->_base_api = 'kong-theme/v1';
	}

	public function register_rest_api() {
		add_action('rest_api_init', array($this, 'register_rest_routes'));
	}

	public function register_rest_routes() {
		register_rest_route($this->_base_api, '/load-more', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fw_theme_load_more_callback'),
			'args' => array(
				'limit' => array(
					'type' => 'integer',
					'default' => 4,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'offset' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'orderby' => array(
					'type' => 'string',
					'default' => 'ID',
					'sanitize_callback' => 'sanitize_text_field'
				),
				'order' => array(
					'type' => 'string',
					'default' => 'DESC',
					'sanitize_callback' => 'sanitize_text_field'
				),
				'data' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'type' => array(
					'type' => 'string',
					'default' => 'classic'
				),
				'custom_settings' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/get-search-results', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fw_theme_get_search_results_callback'),
			'args' => array(
				'offset' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint'
				),
				'limit' => array(
					'type' => 'integer',
					'default' => get_option('posts_per_page'),
					'sanitize_callback' => 'absint'
				)
			)
		));

		register_rest_route($this->_base_api, '/image-sizes', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fw_theme_get_image_sizes_callback'),
			'permission_callback' => array($this, 'kong_fw_theme_get_image_sizes_permission_callback')
		));

		register_rest_route($this->_base_api, '/image-sizes-group', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fw_theme_get_image_sizes_group_callback'),
			'permission_callback' => array($this, 'kong_fw_theme_get_image_sizes_group_permission_callback')
		));
	}

	public function kong_fw_theme_load_more_callback($request_data) {
		global $post;
		$params = $request_data->get_params();
		$data = json_decode($params['data']);
		$custom_settings = json_decode($params['custom_settings'], true);

		if (!empty($data)) {
			$limit = isset($params['limit']) ? $params['limit'] : 4;
			$offset = isset($params['offset']) ? $params['offset'] : 0;

			$args = array(
				'posts_per_page' => $limit + 1,
				'offset' => $offset,
				'orderby' => isset($params['orderby']) ? $params['orderby'] : 'ID',
				'order' => isset($params['order']) ? $params['order'] : 'DESC',
				'post_status' => 'publish',
				'post__not_in' => get_option('sticky_posts')
			);

			switch ($data->type) {
				case 'category':
					$args['post_type'] = 'post';
					$args['category__in'] = $data->data;

					break;
				case 'tag':
					$args['post_type'] = 'post';
					$args['tag'] = $data->data;

					break;
				case 'author':
					$args['post_type'] = 'post';
					$args['author'] = $data->data;

					break;
				case 'date':
					$args['post_type'] = 'post';
					$date = array();

					if (!empty($data->data->year)) {
						$date['year'] = $data->data->year;
					}

					if (!empty($data->data->month)) {
						$date['month'] = $data->data->month;
					}

					if (!empty($data->data->day)) {
						$date['day'] = $data->data->day;
					}

					$args['date_query'] = array($date);
					break;
				case 'posts':
					$args['post_type'] = 'post';

					break;
				case 'custom_post_type':
					$args['post_type'] = $data->data;

					break;
				case 'custom_taxonomy':
					break;
				case 'search':
					$args['post_type'] = 'any';
					$args['s'] = $data->data;
					break;
				default:
			}

			$posts = get_posts($args);

			if (!empty($posts)) {
				$html = '';
				$loaded_all = count($posts) <= $params['limit'];

				if (count($posts) > $params['limit']) {
					array_pop($posts);
				}

				$func = '';
				$func_params = array();
				switch ($params['type']) {
					case 'metro':
						$sizes = $custom_settings['sizes'];
						$sizes_temp = $custom_settings['sizes_temp'];
						$func = 'kong_fw_metro_post_item_render';
						$scroll_reveal_class = '';
						if(!empty($custom_settings['scroll_effect']) && $custom_settings['scroll_effect'] != 'none'){
							$scroll_reveal_class = ' '.$custom_settings['scroll_effect'];
						}
						break;
					case 'search':
						$func = 'kong_fw_search_item_render';
						break;
					case 'classic-grid':
						$func = 'kong_fw_classic_grid_post_item_render';
						$func_params[] = array(
							'excerpt_enable' => !empty($custom_settings['excerpt_enable'])
						);
						break;
					default:
						break;
				}

				foreach ($posts as $post_data) {
					$post = $post_data;
					setup_postdata($post);

					ob_start();

					if ($func == 'kong_fw_metro_post_item_render') {
						if (!count($sizes_temp)) {
							$sizes_temp = $sizes;
						}

						$metro_class = 'kong-metro--' . array_shift($sizes_temp) . $scroll_reveal_class;
						$args = array();

						if (!empty($scroll_reveal_class)) {
							$args['scroll_effect'] = $custom_settings['scroll_effect'];
						}

						$func_params = array(
							$args,
							array($metro_class)
						);
					}

					call_user_func_array($func, $func_params);

					$html .= ob_get_clean();
				}

				return json_encode(array(
					'html' => $html,
					'loaded_all' => $loaded_all
				));
			}
		}

		return -1;
	}

	public function kong_fw_theme_get_image_sizes_callback($request_data) {
		$params = $request_data->get_params();

		if (!empty($params['id'])) {
			$sizes = get_intermediate_image_sizes();

			if (!empty($sizes)) {
				$urls = array();

				foreach ($sizes as $size) {
					preg_match('/^kong-(\d+)-auto$/', $size, $matches);

					if (!empty($matches)) {
						$url = wp_get_attachment_image_src($params['id'], $size);

						if ($url && $params['url'] != $url[0]) {
							$urls[$matches[1]] = $url[0];
						}
					}
				}

				if (!empty($urls)) {
					return $urls;
				}
			}
		}

		return -1;
	}

	public function kong_fw_theme_get_image_sizes_group_callback($request_data) {
		$params = $request_data->get_params();
		$items = json_decode($params['items'], true);

		if (!empty($items)) {
			foreach ($items as &$item) {
				if (!empty($item['id'])) {
					$sizes = get_intermediate_image_sizes();

					if (!empty($sizes)) {
						$urls = array();

						foreach ($sizes as $size) {
							preg_match('/^kong-(\d+)-auto$/', $size, $matches);

							if (!empty($matches)) {
								$url = wp_get_attachment_image_src($item['id'], $size);

								if ($url && $item['url'] != $url[0]) {
									$urls[$matches[1]] = $url[0];
								}
							}
						}

						if (!empty($urls)) {
							$item['sizes'] = $urls;
						}
					}
				}
			}
		}

		return $items;
	}

	public function kong_fw_theme_get_search_results_callback($request_data) {
		$params = $request_data->get_params();

		$posts = get_posts(array(
			'offset' => $params['offset'],
			'posts_per_page' => $params['limit'],
			's' => $params['search'],
			'post_type' => 'any'
		));

		if (!empty($posts)) {
			global $post;
			$html = '';
			$loaded_all = count($posts) < $params['limit'] ? true : false;
			$count = $params['offset'];

			foreach ($posts as $post_data) {
				$post = $post_data;
				setup_postdata($post);
				$count++;

				ob_start();
				kong_fw_search_item_render($count);
				$html .= ob_get_contents();
				ob_end_clean();
			}

			return array(
				'html' => $html,
				'loaded_all' => $loaded_all
			);
		}

		return -1;
	}

	// Permission callbacks
    public function kong_fw_theme_get_image_sizes_permission_callback($request_data) {
        if (!current_user_can('edit_posts')) {
            return new WP_Error('kong_fw_forbidden_context', 'You are not allowed to get image sizes', array('status' => 403));
        }

        return true;
    }

	public function kong_fw_theme_get_image_sizes_group_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_fw_forbidden_context', 'You are not allowed to get image sizes group', array('status' => 403));
		}

		return true;
	}

	public function validate_is_json($value, $request, $param) {
		$value = json_decode($value);

		if (json_last_error() !== JSON_ERROR_NONE) {
			return new WP_Error('kong_fw_rest_invalid_param', sprintf('%s not a json', $param));
		}

		return true;
	}

	public function validate_is_numeric($value, $request, $param) {
		if (!is_numeric($value)) {
			return new WP_Error('kong_fw_rest_invalid_param', sprintf('%s not a numeric', $param));
		}

		return true;
	}
}