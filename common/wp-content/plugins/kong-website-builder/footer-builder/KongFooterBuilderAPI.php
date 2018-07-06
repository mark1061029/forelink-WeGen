<?php

class KongFooterBuilderAPI
{
	private $_base_api;
	private $_save_properties;

	public function __construct() {
		$this->_base_api = 'kong-footer-builder/v1';
		$this->_save_properties = array('name', 'tag', 'content', 'attrs', 'nested');
	}

	public function register_routes() {
		register_rest_route($this->_base_api, '/footers', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_fb_create_footer_callback'),
			'permission_callback' => array($this, 'kong_fb_create_footer_permission_callback'),
			'args' => array(
				'name' => array(
					'type' => 'string',
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				)
			)
		));

		register_rest_route($this->_base_api, '/footers', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fb_get_footers_callback'),
			'permission_callback' => array($this, 'kong_fb_get_footers_permission_callback')
		));

		register_rest_route($this->_base_api, '/pages', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fb_get_pages_callback'),
			'permission_callback' => array($this, 'kong_fb_get_pages_permission_callback')
		));

		register_rest_route($this->_base_api, '/trash-footers', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fb_get_footers_in_trash_callback'),
			'permission_callback' => array($this, 'kong_fb_get_footers_in_trash_permission_callback')
		));

		register_rest_route($this->_base_api, '/page-link', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fb_get_page_link_callback'),
			'permission_callback' => array($this, 'kong_fb_get_page_link_permission_callback'),
			'args' => array(
				'page_id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				)
			)
		));

		register_rest_route($this->_base_api, '/footers/status', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_fb_change_status_footer_callback'),
			'permission_callback' => array($this, 'kong_fb_change_status_footer_permission_callback'),
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

		register_rest_route($this->_base_api, '/footer-options', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_fb_save_footer_options_callback'),
			'permission_callback' => array($this, 'kong_fb_save_footer_options_permission_callback'),
			'args' => array(
				'options' => array(
					'default' => array(),
					'validate_callback' => array($this, 'validate_is_array')
				)
			)
		));

		register_rest_route($this->_base_api, '/page-footer-setting', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_fb_save_page_footer_setting_callback'),
			'permission_callback' => array($this, 'kong_fb_save_page_footer_setting_permission_callback'),
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

		register_rest_route($this->_base_api, '/footers/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_fb_edit_footer_callback'),
			'permission_callback' => array($this, 'kong_fb_edit_footer_permission_callback'),
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

		register_rest_route($this->_base_api, '/footers/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::DELETABLE,
			'callback' => array($this, 'kong_fb_delete_footer_callback'),
			'permission_callback' => array($this, 'kong_fb_delete_footer_permission_callback')
		));

		register_rest_route($this->_base_api, '/set-footer', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_fb_set_footer_callback'),
			'permission_callback' => array($this, 'kong_fb_set_footer_permission_callback'),
			'args' => array(
				'data' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'footer_id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fb_get_templates_callback'),
			'permission_callback' => array($this, 'kong_fb_get_templates_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_fb_create_template_callback'),
			'permission_callback' => array($this, 'kong_fb_create_template_permission_callback'),
			'args' => array(
				'name' => array(
					'type' => 'string',
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				),
				'model' => array(
					'type' => 'string',
					'default' => '[]',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'css' => array(
					'type' => 'string',
					'default' => '',
				)
			)
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::DELETABLE,
			'callback' => array($this, 'kong_fb_remove_template_callback'),
			'permission_callback' => array($this, 'kong_fb_remove_template_permission_callback'),
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
			'callback' => array($this, 'kong_fb_export_templates_callback'),
			'permission_callback' => array($this, 'kong_fb_export_templates_permission_callback'),
			'args' => array(
				'template_ids' => array(
					'default' => '[]',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates/import', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_fb_import_templates_callback'),
			'permission_callback' => array($this, 'kong_fb_import_templates_permission_callback')
		));

		register_rest_route($this->_base_api, '/presets', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fb_get_presets_callback'),
			'permission_callback' => array($this, 'kong_fb_get_presets_permission_callback')
		));

		register_rest_route($this->_base_api, '/post-shortcode', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_fb_post_shortcode_callback'),
			'permission_callback' => array($this, 'kong_fb_post_shortcode_permission_callback'),
			'args' => array(
				'id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'shortcode' => array(
					'type' => 'string',
					'default' => ''
				)
			)
		));

		register_rest_route($this->_base_api, '/rename', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_fb_rename_callback'),
			'permission_callback' => array($this, 'kong_fb_rename_permission_callback'),
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
	}

	/* API callbacks */
	public function kong_fb_create_footer_callback($request_data) {
		$params = $request_data->get_params();

		$post_ID = wp_insert_post(array(
			'post_title' => trim($params['name']),
			'post_type' => 'kong_footer',
			'post_status' => 'publish'
		));

		if ($post_ID)
			return $post_ID;

		return -1;
	}

	public function kong_fb_get_footers_callback($request_data) {
		$footers = array();

		$posts = get_posts(array(
			'post_type' => 'kong_footer',
			'numberposts' => -1,
			'orderby' => 'ID',
			'order' => 'DESC',
			'post_status' => 'publish'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$footer = new stdClass();
				$footer->id = $post->ID;
				$footer->name = $post->post_title;
				$footers[] = $footer;
			}
		}

		return $footers;
	}

	public function kong_fb_get_pages_callback($request_data) {
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

	public function kong_fb_get_footers_in_trash_callback($request_data) {
		$footers = array();

		$posts = get_posts(array(
			'post_type' => 'kong_footer',
			'numberposts' => -1,
			'orderby' => 'post_modified',
			'order' => 'DESC',
			'post_status' => 'trash'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$footer = new stdClass();
				$footer->id = $post->ID;
				$footer->name = $post->post_title;
				$footers[] = $footer;
			}
		}

		return $footers;
	}

	public function kong_fb_get_page_link_callback($request_data) {
		$params = $request_data->get_params();
		$page_id = $params['page_id'];

		if ($page = get_post($page_id)) {
			$link = get_permalink($page_id);
		} else {
			$link = get_home_url();
		}

		return $link;
	}

	public function kong_fb_change_status_footer_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];
		$status = $params['status'];

		$post = get_post($id);
		$post->post_status = $status;
		$update = wp_update_post($post);

		return $update ? $update : -1;
	}

	public function kong_fb_save_footer_options_callback($request_data) {
		$params = $request_data->get_params();
		update_option('kongFooterOptions', $params['options']);

		return 1;
	}

	public function kong_fb_save_page_footer_setting_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];

		if (get_post($id)) {
			update_post_meta($id, 'kong-page-footer-setting', json_decode($params['settings'], true));

			return 1;
		}

		return -1;
	}

	public function kong_fb_edit_footer_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];
		$model = json_decode($params['model'], true);
		$shortcodes = $params['shortcodes'];
		$styles = json_decode($params['styles'], true);
		$custom_css = $params['custom_css'];

		$post = get_post($id);

		if ($post) {
			$post->post_content = $shortcodes;

			if (wp_update_post($post)) {
				update_post_meta($id, '_kong_fb_model', $model);
				update_post_meta($id, '_kong_fb_styles', $styles);
				update_post_meta($id, '_kong_fb_custom_css', $custom_css);

				return $id;
			}
		}

		return -1;
	}

	public function kong_fb_delete_footer_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];

		$delete = wp_delete_post($id);

		if ($delete) {
			return $id;
		}

		return -1;
	}

	public function kong_fb_set_footer_callback($request_data) {
		$params = $request_data->get_params();
		$data = json_decode($params['data'], true);
		$footer_id = $params['footer_id'];
		$footer_options = kong_get_footer_options();

		switch ($data['type']) {
			case 'home':
				$footer_options['primary']['value'] = $footer_id;
				return update_option('kongFooterOptions', $footer_options);
			case 'page':
				$footer_setting = kong_get_footer_setting($data['value']);
				$footer_setting['footer'] = $footer_id;
				return update_post_meta($data['value'], 'kong-page-footer-setting', $footer_setting);
			case 'search':
				$footer_options['search']['value'] = $footer_id;
				return update_option('kongFooterOptions', $footer_options);
			case 'taxonomy':
				$footer_options[$data['value']] = array(
						'enable' => true,
						'value' => $footer_id
				);

				return update_option('kongFooterOptions', $footer_options);
			case 'archive':
				$footer_options[$data['value']]['enable'] = true;
				$footer_options[$data['value']]['value']['archive'] = $footer_id;

				return update_option('kongFooterOptions', $footer_options);
			case 'single':
				$footer_options[$data['value']]['enable'] = true;
				$footer_options[$data['value']]['value']['single'] = $footer_id;

				return update_option('kongFooterOptions', $footer_options);
			default:
				break;
		}

		return false;
	}

	public function kong_fb_get_templates_callback($request_data) {
		$templates = array();

		$posts = get_posts(array(
			'post_type' => 'kong_footer_tpl',
			'numberposts' => -1,
			'orderby' => 'ID',
			'order' => 'ASC'
		));

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$template = new stdClass();
				$template->id = $post->ID;
				$template->name = $post->post_title;
				$model = get_post_meta($post->ID, '_kong_fb_model', true);
				$template->model = !empty($model) && is_array($model) ? $model : array();
				$template->custom_css = get_post_meta($post->ID, '_kong_fb_custom_css', true);
				$templates[] = $template;
			}
		}

		return $templates;
	}

	public function kong_fb_create_template_callback($request_data) {
		$params = $request_data->get_params();
		$model = json_decode($params['model'], true);
		$css = $params['custom_css'];

		$post_ID = wp_insert_post(array(
			'post_title' => trim($params['name']),
			'post_type' => 'kong_footer_tpl',
			'post_status' => 'publish'
		));

		if ($post_ID) {
			update_post_meta($post_ID, '_kong_fb_model', $model);
			update_post_meta($post_ID, '_kong_fb_custom_css', $css);

			return $post_ID;
		}

		return -1;
	}

	public function kong_fb_remove_template_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];
		$delete = wp_delete_post($id);

		if ($delete) {
			return $id;
		}

		return -1;
	}

	public function kong_fb_export_templates_callback($request_data) {
		$params = $request_data->get_params();
		$template_ids = json_decode($params['template_ids']);
		$data = array();
		$data['identify'] = kong_get_identify_code('kong-fb-template');
		$templates_data = array();

		if (!empty($template_ids)) {
			foreach ($template_ids as $template_id) {
				$post = get_post($template_id);

				if (!empty($post)) {
					$model = get_post_meta($post->ID, '_kong_fb_model', true);
					$custom_css = get_post_meta($post->ID, '_kong_fb_custom_css', true);

					$template_data = new stdClass();
					$template_data->name = $post->post_title;
					$template_data->model = !empty($model) && is_array($model) ? $model : array();
					$template_data->custom_css = $custom_css ? $custom_css : '';
					$templates_data[] = $template_data;
				}
			}
		}

		$data['templates'] = $templates_data;

		return $data;
	}

	public function kong_fb_import_templates_callback($request_data) {
		$files = $request_data->get_file_params();

		if (empty($files['importedFile'])) {
			return new WP_Error('kong_rest_invalid_param', 'File is empty', array('status' => 400));
		}

		$data = str_replace('_kong_sharp_', '#', file_get_contents($files['importedFile']['tmp_name']));
		$data = json_decode($data, true);

		if (json_last_error() == JSON_ERROR_NONE && !empty($data['identify']) && $data['identify'] == kong_get_identify_code('kong-fb-template')) {
			$templates = array();

			if (!empty($data['templates'])) {
				foreach ($data['templates'] as $templateImport) {
					$model = !empty($templateImport['model']) && is_array($templateImport['model']) ? $templateImport['model'] : array();
					$this->filter_properties($model, $this->_save_properties);

					$post_ID = wp_insert_post(array(
						'post_title' => $templateImport['name'],
						'post_type' => 'kong_footer_tpl',
						'post_status' => 'publish'
					));

					if ($post_ID) {
						update_post_meta($post_ID, '_kong_fb_model', $model);
						update_post_meta($post_ID, '_kong_fb_custom_css', $templateImport['custom_css']);

						$template = new stdClass();
						$template->id = $post_ID;
						$template->name = $templateImport['name'];
						$template->model = $model;
						$template->custom_css = $templateImport['custom_css'];
						$templates[] = $template;
					}
				}
			} else if (!empty($data['template'])) {
				$model = !empty($data['template']['model']) && is_array($data['template']['model']) ? $data['template']['model'] : array();
				$this->filter_properties($model, $this->_save_properties);

				$post_ID = wp_insert_post(array(
					'post_title' => $data['template']['name'],
					'post_type' => 'kong_footer_tpl',
					'post_status' => 'publish'
				));

				if ($post_ID) {
					update_post_meta($post_ID, '_kong_fb_model', $model);
					update_post_meta($post_ID, '_kong_fb_custom_css', $data['template']['custom_css']);

					$template = new stdClass();
					$template->id = $post_ID;
					$template->name = $data['template']['name'];
					$template->model = $model;
					$template->custom_css = $data['template']['custom_css'];
					$templates[] = $template;
				}
			}

			return $templates;
		}

		return false;
	}

	public function kong_fb_get_presets_callback($request_data) {
		$presets = array();
		$content = str_replace('VNyFbKKOovtiFFyHYybt', KONG_CORE_ROOT . '/photos/', file_get_contents(KONG_DIR_PATH . '/footer-builder/presets/presets.json'));
		$content = !empty($content) ? json_decode($content, true) : array();

		if (is_array($content)) {
			$presets = array_merge($presets, $content);
		}

		foreach ($presets as $key => $preset) {
			$path = KONG_DIR_PATH . '/footer-builder/img/presets/' . $preset['img'] . '.png';
			$size = getimagesize($path);
			$presets[$key]["padding"] = !empty($size) ? $size[1] / $size[0] * 100 : 0;
		}

		return $presets;
	}

	public function kong_fb_post_shortcode_callback($request_data) {
		$params = $request_data->get_params();
		$post = get_post($params['id']);

		if (!empty($post) && $post->post_status == 'publish') {
			return do_shortcode($params['shortcode']);
		}

		return -1;
	}

	public function kong_fb_rename_callback($request_data) {
		$params = $request_data->get_params();
		return wp_update_post(array(
			'ID' => $params['id'],
			'post_title' => $params['name']
		));
	}
	
	/* Permission callbacks */
	public function kong_fb_create_footer_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to create footer', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_footers_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get footer list', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_pages_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get pages', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_footers_in_trash_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get footers in trash', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_page_link_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get page link', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_change_status_footer_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to change status of footer', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_save_footer_options_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to save footer options', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_save_page_footer_setting_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to save footer setting of page', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_edit_footer_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to edit footer', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_menu_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get menu', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_menus_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get menus', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_delete_footer_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to delete footer', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_set_footer_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to set footer', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_templates_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get footer templates', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_create_template_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to create footer template', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_remove_template_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to remove footer template', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_export_templates_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to export footer templates', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_import_templates_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to import footer templates', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_get_presets_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get presets', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_do_shortcodes_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to do shortcodes', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_post_shortcode_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get shortcode', array('status' => 403));
		}

		return true;
	}

	public function kong_fb_rename_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to rename footer', array('status' => 403));
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

	public function validate_is_json($value, $request, $param) {
		$value = json_decode($value);

		if (json_last_error() !== JSON_ERROR_NONE) {
			return new WP_Error('kong_rest_invalid_param', sprintf('%s not a json', $param));
		}

		return true;
	}

	public function validate_is_array($value, $request, $param) {
		if (!is_array($value)) {
			return new WP_Error('kong_rest_invalid_param', sprintf('%s not a array', $param));
		}

		return true;
	}

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

