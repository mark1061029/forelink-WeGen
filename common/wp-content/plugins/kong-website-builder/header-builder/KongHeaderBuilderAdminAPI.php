<?php
require_once('KongHeaderBuilderAdmin.php');

class KongHeaderBuilderAdminAPI
{
	private $_base_api;
	private $_save_properties;

	public function __construct() {
		$this->_base_api = 'kong-header-builder/v1';
		$this->_save_properties = array('name', 'tag', 'content', 'attrs', 'child', 'nested');
		$this->register_post_type();
	}

	private function register_post_type() {
		add_action('init', array($this, 'register_post_types'));
	}

	public function register_post_types() {
		register_post_type('kong_header', array(
			'label' => 'Kong Header',
			'has_archive' => true
		));

		register_post_type('kong_header_tpl', array(
			'label' => 'Kong Header Template',
			'has_archive' => true
		));
	}

	public function register_routes() {
		register_rest_route($this->_base_api, '/headers', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_hb_create_header_callback'),
			'permission_callback' => array($this, 'kong_hb_create_header_permission_callback'),
			'args' => array(
				'name' => array(
					'type' => 'string',
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				)
			)
		));

		register_rest_route($this->_base_api, '/headers', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_headers_callback'),
			'permission_callback' => array($this, 'kong_hb_get_headers_permission_callback')
		));

		register_rest_route($this->_base_api, '/trash-headers', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_headers_in_trash_callback'),
			'permission_callback' => array($this, 'kong_hb_get_headers_in_trash_permission_callback')
		));

		register_rest_route($this->_base_api, '/headers/status', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_hb_change_status_header_callback'),
			'permission_callback' => array($this, 'kong_hb_change_status_header_permission_callback'),
			'args' => array(
				'id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'status' => array(
					'type' => 'string',
					'default' => 'publish',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				)
			)
		));

		register_rest_route($this->_base_api, '/headers/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_header_callback'),
			'permission_callback' => array($this, 'kong_hb_get_header_permission_callback')
		));

		register_rest_route($this->_base_api, '/headers/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_hb_edit_header_callback'),
			'permission_callback' => array($this, 'kong_hb_edit_header_permission_callback'),
			'args' => array(
				'model' => array(
					'type' => 'string',
					'default' => '[]',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'css' => array(
					'type' => 'string',
					'default' => '',
				),
				'body_padding' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'shortcodes' => array(
					'type' => 'string',
					'default' => ''
				),
				'styles' => array(
					'type' => 'string',
					'default' => ''
				)
			)
		));

		register_rest_route($this->_base_api, '/headers/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::DELETABLE,
			'callback' => array($this, 'kong_hb_delete_header_callback'),
			'permission_callback' => array($this, 'kong_hb_delete_header_permission_callback')
		));

		register_rest_route($this->_base_api, '/header-options', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_hb_save_header_options_callback'),
			'permission_callback' => array($this, 'kong_hb_save_header_options_permission_callback'),
			'args' => array(
				'options' => array(
					'default' => array(),
					'validate_callback' => array($this, 'validate_is_array')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_templates_callback'),
			'permission_callback' => array($this, 'kong_hb_get_templates_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_hb_create_template_callback'),
			'permission_callback' => array($this, 'kong_hb_create_template_permission_callback'),
			'args' => array(
				'name' => array(
					'type' => 'string',
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				),
				'content' => array(
					'type' => 'string',
					'default' => '[]',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'css' => array(
					'type' => 'string',
					'default' => '',
				),
				'body_padding' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::DELETABLE,
			'callback' => array($this, 'kong_hb_remove_template_callback'),
			'permission_callback' => array($this, 'kong_hb_remove_template_permission_callback'),
			'args' => array(
				'id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates/export', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_export_templates_callback'),
			'permission_callback' => array($this, 'kong_hb_export_templates_permission_callback'),
			'args' => array(
				'template_ids' => array(
					'default' => '[]',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates/import', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_hb_import_templates_callback'),
			'permission_callback' => array($this, 'kong_hb_import_templates_permission_callback')
		));

		register_rest_route($this->_base_api, '/presets', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_presets_callback'),
			'permission_callback' => array($this, 'kong_hb_get_presets_permission_callback')
		));

		register_rest_route($this->_base_api, '/pages', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_pages_callback'),
			'permission_callback' => array($this, 'kong_hb_get_pages_permission_callback')
		));

		register_rest_route($this->_base_api, '/page-link', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_page_link_callback'),
			'permission_callback' => array($this, 'kong_hb_get_page_link_permission_callback'),
			'args' => array(
				'page_id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				)
			)
		));

		register_rest_route($this->_base_api, '/set-header', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_hb_set_header_callback'),
			'permission_callback' => array($this, 'kong_hb_set_header_permission_callback'),
			'args' => array(
				'data' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'header_id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				)
			)
		));

		register_rest_route($this->_base_api, '/page-header-setting', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_hb_save_page_header_setting_callback'),
			'permission_callback' => array($this, 'kong_hb_save_page_header_setting_permission_callback'),
			'args' => array(
				'id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'settings' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/post-shortcode', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_post_shortcode_callback'),
			'permission_callback' => array($this, 'kong_hb_post_shortcode_permission_callback'),
			'args' => array(
				'id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'shortcode' => array(
					'name' => 'string',
					'default' => ''
				)
			)
		));

		register_rest_route($this->_base_api, '/rename', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_hb_rename_callback'),
			'permission_callback' => array($this, 'kong_hb_rename_permission_callback'),
			'args' => array(
				'id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'name' => array(
					'name' => 'string',
					'default' => '',
					'validate_callback' => array($this, 'validate_not_empty')
				)
			)
		));

		register_rest_route($this->_base_api, '/get-feature-image', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_hb_get_feature_image_callback'),
			'permission_callback' => array($this, 'kong_hb_get_feature_image_permission_callback'),
			'args' => array(
				'post_id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				)
			)
		));
	}

	/* API callbacks */
	public function kong_hb_create_header_callback($request_data) {
		$params = $request_data->get_params();

		$post_ID = wp_insert_post(array(
			'post_title' => trim($params['name']),
			'post_type' => 'kong_header',
			'post_status' => 'publish'
		));

		if ($post_ID)
			return $post_ID;

		return -1;
	}

	public function kong_hb_get_headers_callback($request_data) {
		$headers = array();

		$posts = get_posts(array(
			'post_type' => 'kong_header',
			'numberposts' => -1,
			'orderby' => 'ID',
			'order' => 'DESC',
			'post_status' => 'publish'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$header = new stdClass();
				$header->id = $post->ID;
				$header->name = $post->post_title;
				$headers[] = $header;
			}
		}

		return $headers;
	}

	public function kong_hb_get_headers_in_trash_callback($request_data) {
		$headers = array();

		$posts = get_posts(array(
			'post_type' => 'kong_header',
			'numberposts' => -1,
			'orderby' => 'post_modified',
			'order' => 'DESC',
			'post_status' => 'trash'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$header = new stdClass();
				$header->id = $post->ID;
				$header->name = $post->post_title;
				$headers[] = $header;
			}
		}

		return $headers;
	}

	public function kong_hb_change_status_header_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];
		$status = $params['status'];

		$post = get_post($id);
		$post->post_status = $status;
		$update = wp_update_post($post);

		return $update ? $update : -1;
	}

	public function kong_hb_delete_header_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];

		$delete = wp_delete_post($id);

		if ($delete) {
			return $id;
		}

		return -1;
	}

	public function kong_hb_save_header_options_callback($request_data) {
		$params = $request_data->get_params();
		update_option('kongHeaderOptions', $params['options']);

		return 1;
	}

	public function kong_hb_get_header_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];

		$header = get_post($id);

		if (!empty($header)) {
			$custom_css = get_post_meta($id, '_kong_hb_custom_css', true);
			$body_padding = get_post_meta($id, '_kong_hb_body_padding', true);
			$model = get_post_meta($id, '_kong_hb_model', true);

			$data = array();
			$data['custom_css'] = $custom_css ? $custom_css : '';
			$data['body_padding'] = !empty($body_padding) && is_array($body_padding) ? $body_padding : KongHeaderBuilderAdmin::$default_body_padding;
			$data['model'] = !empty($model) && is_array($model) ? $model : array();

			return $data;
		}

		return -1;
	}

	public function kong_hb_edit_header_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];
		$model = json_decode($params['model'], true);
		$shortcodes = $params['shortcodes'];
		$styles = json_decode($params['styles'], true);
		$custom_css = $params['custom_css'];
		$body_padding = json_decode($params['body_padding'], true);

		$post = get_post($id);

		if ($post) {
			$post->post_content = $shortcodes;

			if (wp_update_post($post)) {
				update_post_meta($id, '_kong_hb_model', $model);
				update_post_meta($id, '_kong_hb_styles', $styles);
				update_post_meta($id, '_kong_hb_custom_css', $custom_css);
				update_post_meta($id, '_kong_hb_body_padding', $body_padding);

				return $id;
			}
		}

		return -1;
	}

	public function kong_hb_get_templates_callback($request_data) {
		$templates = array();

		$posts = get_posts(array(
			'post_type' => 'kong_header_tpl',
			'numberposts' => -1,
			'orderby' => 'ID',
			'order' => 'ASC'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$template = new stdClass();
				$template->id = $post->ID;
				$template->name = $post->post_title;
				$model = get_post_meta($post->ID, '_kong_hb_model', true);
				$template->model = !empty($model) && is_array($model) ? $model : array();
				$template->custom_css = get_post_meta($post->ID, '_kong_hb_custom_css', true);
				$body_padding = get_post_meta($post->ID, '_kong_hb_body_padding', true);
				$template->body_padding = !empty($body_padding) && is_array($body_padding) ? $body_padding : KongHeaderBuilderAdmin::$default_body_padding;
				$templates[] = $template;
			}
		}

		return $templates;
	}

	public function kong_hb_create_template_callback($request_data) {
		$params = $request_data->get_params();
		$model = json_decode($params['model'], true);
		$css = $params['custom_css'];
		$body_padding = json_decode($params['body_padding'], true);

		$post_ID = wp_insert_post(array(
			'post_title' => trim($params['name']),
			'post_type' => 'kong_header_tpl',
			'post_status' => 'publish'
		));

		if ($post_ID) {
			update_post_meta($post_ID, '_kong_hb_model', $model);
			update_post_meta($post_ID, '_kong_hb_custom_css', $css);
			update_post_meta($post_ID, '_kong_hb_body_padding', $body_padding);

			return $post_ID;
		}

		return -1;
	}

	public function kong_hb_remove_template_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];
		$delete = wp_delete_post($id);

		if ($delete) {
			return $id;
		}

		return -1;
	}

	public function kong_hb_export_templates_callback($request_data) {
		$params = $request_data->get_params();
		$template_ids = json_decode($params['template_ids']);
		$data = array();
		$data['identify'] = kong_get_identify_code('kong-hb-template');
		$templates_data = array();

		if (!empty($template_ids)) {
			foreach ($template_ids as $template_id) {
				$post = get_post($template_id);

				if (!empty($post)) {
					$model = get_post_meta($post->ID, '_kong_hb_model', true);
					$custom_css = get_post_meta($post->ID, '_kong_hb_custom_css', true);
					$body_padding = get_post_meta($post->ID, '_kong_hb_body_padding', true);

					$template_data = new stdClass();
					$template_data->name = $post->post_title;
					$template_data->model = !empty($model) && is_array($model) ? $model : array();
					$template_data->custom_css = $custom_css ? $custom_css : '';
					$template_data->body_padding = !empty($body_padding) && is_array($body_padding) ? $body_padding : KongHeaderBuilderAdmin::$default_body_padding;
					$templates_data[] = $template_data;
				}
			}
		}

		$data['templates'] = $templates_data;

		return $data;
	}

	public function kong_hb_import_templates_callback($request_data) {
		$files = $request_data->get_file_params();

		if (empty($files['importedFile'])) {
			return new WP_Error('kong_rest_invalid_param', 'File is empty', array('status' => 400));
		}

		$data = str_replace('_kong_sharp_', '#', file_get_contents($files['importedFile']['tmp_name']));
		$data = json_decode($data, true);

		if (json_last_error() == JSON_ERROR_NONE && !empty($data['identify']) && $data['identify'] == kong_get_identify_code('kong-hb-template')) {
			$templates = array();

			if (!empty($data['templates'])) {
				foreach ($data['templates'] as $templateImport) {
					$model = !empty($templateImport['model']) && is_array($templateImport['model']) ? $templateImport['model'] : array();
					$body_padding = !empty($templateImport['body_padding']) && is_array($templateImport['body_padding']) ? $templateImport['body_padding'] : KongHeaderBuilderAdmin::$default_body_padding;
					$this->filter_properties($model, $this->_save_properties);

					$post_ID = wp_insert_post(array(
						'post_title' => $templateImport['name'],
						'post_type' => 'kong_header_tpl',
						'post_status' => 'publish'
					));

					if ($post_ID) {
						update_post_meta($post_ID, '_kong_hb_model', $model);
						update_post_meta($post_ID, '_kong_hb_custom_css', $templateImport['custom_css']);
						update_post_meta($post_ID, '_kong_hb_body_padding', $body_padding);

						$template = new stdClass();
						$template->id = $post_ID;
						$template->name = $templateImport['name'];
						$template->model = $model;
						$template->custom_css = $templateImport['custom_css'];
						$template->body_padding = $body_padding;
						$templates[] = $template;
					}
				}
			} else if (!empty($data['template'])) {
				$model = !empty($data['template']['model']) && is_array($data['template']['model']) ? $data['template']['model'] : array();
				$body_padding = !empty($data['template']['body_padding']) && is_array($data['template']['body_padding']) ? $data['template']['body_padding'] : KongHeaderBuilderAdmin::$default_body_padding;
				$this->filter_properties($model, $this->_save_properties);

				$post_ID = wp_insert_post(array(
					'post_title' => $data['template']['name'],
					'post_type' => 'kong_header_tpl',
					'post_status' => 'publish'
				));

				if ($post_ID) {
					update_post_meta($post_ID, '_kong_hb_model', $model);
					update_post_meta($post_ID, '_kong_hb_custom_css', $data['template']['custom_css']);
					update_post_meta($post_ID, '_kong_hb_body_padding', $body_padding);

					$template = new stdClass();
					$template->id = $post_ID;
					$template->name = $data['template']['name'];
					$template->model = $model;
					$template->custom_css = $data['template']['custom_css'];
					$template->body_padding = $body_padding;
					$templates[] = $template;
				}
			}

			return $templates;
		}

		return false;
	}

	public function kong_hb_get_presets_callback($request_data) {
		$presets = array();
		$content = str_replace('VNyFbKKOovtiFFyHYybt', KONG_CORE_ROOT . '/photos/', file_get_contents(KONG_DIR_PATH . '/header-builder/presets/presets.json'));
		$content = !empty($content) ? json_decode($content, true) : array();

		if (is_array($content)) {
			$presets = array_merge($presets, $content);
		}

		foreach ($presets as $key => $preset) {
			$path = KONG_DIR_PATH . '/header-builder/img/presets/' . $preset['img'] . '.png';
			$size = getimagesize($path);
			$presets[$key]["padding"] = !empty($size) ? $size[1] / $size[0] * 100 : 0;
		}

		return $presets;
	}

	public function kong_hb_get_pages_callback($request_data) {
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

	public function kong_hb_get_page_link_callback($request_data) {
		$params = $request_data->get_params();
		$page_id = $params['page_id'];

		if ($page = get_post($page_id)) {
			$link = get_permalink($page_id);
		} else {
			$link = get_home_url();
		}

		return $link;
	}

	public function kong_hb_set_header_callback($request_data) {
		$params = $request_data->get_params();
		$data = json_decode($params['data'], true);
		$header_id = $params['header_id'];
		$header_options = kong_get_header_options();

		switch ($data['type']) {
			case 'home':
				$header_options['primary']['value'] = $header_id;
				return update_option('kongHeaderOptions', $header_options);
			case 'page':
				$header_setting = kong_get_header_setting($data['value']);
				$header_setting['header'] = $header_id;
				return update_post_meta($data['value'], 'kong-page-header-setting', $header_setting);
			case 'search':
				$header_options['search']['value'] = $header_id;
				return update_option('kongHeaderOptions', $header_options);
			case 'taxonomy':
				$header_options[$data['value']] = array(
					'enable' => true,
					'value' => $header_id
				);

				return update_option('kongHeaderOptions', $header_options);
			case 'archive':
				$header_options[$data['value']]['enable'] = true;
				$header_options[$data['value']]['value']['archive'] = $header_id;

				return update_option('kongHeaderOptions', $header_options);
			case 'single':
				$header_options[$data['value']]['enable'] = true;
				$header_options[$data['value']]['value']['single'] = $header_id;

				return update_option('kongHeaderOptions', $header_options);
			default:
				break;
		}

		return false;
	}

	public function kong_hb_save_page_header_setting_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];

		if (get_post($id)) {
			update_post_meta($id, 'kong-page-header-setting', json_decode($params['settings'], true));

			return 1;
		}

		return -1;
	}

	public function kong_hb_post_shortcode_callback($request_data) {
		$params = $request_data->get_params();
		$post = get_post($params['id']);

		if (!empty($post) && $post->post_status == 'publish') {
			return do_shortcode($params['shortcode']);
		}

		return -1;
	}

	public function kong_hb_rename_callback($request_data) {
		$params = $request_data->get_params();
		return wp_update_post(array(
			'ID' => $params['id'],
			'post_title' => $params['name']
		));
	}

	public function kong_hb_get_feature_image_callback($request_data) {
		$params = $request_data->get_params();
		$post_type = get_post_type($params['post_id']);
		$settings = kong_get_settings($params['post_id']);
		$image = '';

		if ($post_type == 'page') {
			$image = $settings['hero']['img_url'];
		} else if (in_array($post_type, array('post', 'portfolio'))) {
			$image = $settings['feature']['url'];
		}

		return $image;
	}

	/* Permission callbacks */
	public function kong_hb_create_header_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to create header', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_headers_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get header list', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_change_status_header_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to change status of header', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_delete_header_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to delete header', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_save_header_options_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to save header options', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_header_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get header', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_edit_header_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to edit header', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_templates_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get header templates', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_create_template_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to create header template', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_remove_template_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to remove header template', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_export_templates_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to export header templates', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_import_templates_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to import header templates', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_presets_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get presets', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_headers_in_trash_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get headers in trash', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_pages_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get pages', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_page_link_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get page link', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_set_header_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to set header', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_save_page_header_setting_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to save header setting of page', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_post_shortcode_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get shortcode', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_rename_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to rename header', array('status' => 403));
		}

		return true;
	}

	public function kong_hb_get_feature_image_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get feature image', array('status' => 403));
		}

		return true;
	}

	/* Validate callbacks */
	public function validate_not_empty($value, $request, $param) {
		if (trim($value) === '') {
			return new WP_Error('kong_rest_invalid_param', sprintf('%s is empty', $param));
		}

		return true;
	}

	public function validate_is_numeric($value, $request, $param) {
		if (!is_numeric($value)) {
			return new WP_Error('kong_rest_invalid_param', sprintf('%s not a numeric', $param));
		}

		return true;
	}

	public function validate_is_array($value, $request, $param) {
		if (!is_array($value)) {
			return new WP_Error('kong_rest_invalid_param', sprintf('%s not a array', $param));
		}

		return true;
	}

	public function validate_is_json($value, $request, $param) {
		$value = json_decode($value);

		if (json_last_error() !== JSON_ERROR_NONE) {
			return new WP_Error('kong_rest_invalid_param', sprintf('%s not a json', $param));
		}

		return true;
	}

	/* Functions */
	public function filter_properties(&$content, $properties){

		if (is_array($content)) {
			foreach ($content as $child) {
				$this->filter_properties($child, $properties);
			}
		}

		if (is_object($content)) {
			foreach ($content as $property => $value) {
				if (!in_array($property, $properties)) {
					unset($content->{$property});
				}
			}

			if (!empty($content->content) && is_array($content->content)) {
				foreach ($content->content as $child) {
					$this->filter_properties($child, $properties);
				}
			}
		}
	}
}

