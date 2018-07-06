<?php

class KongOptionsAPI {

	private $_base_api;

	public function __construct() {
		$this->_base_api = 'kong-site-options/v1';
	}

	public function register_rest_api() {
		add_action('rest_api_init', array($this, 'register_rest_routes'));
	}

	public function register_rest_routes() {
		register_rest_route($this->_base_api, '/frontend-options', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_frontend_option_save_callback'),
			'permission_callback' => array($this, 'kong_frontend_option_save_permission_callback'),
			'args' => array(
				'options' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'styles' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/backend-options', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_backend_option_save_callback'),
			'permission_callback' => array($this, 'kong_backend_option_save_permission_callback'),
			'args' => array(
				'options' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_option_get_templates_callback'),
			'permission_callback' => array($this, 'kong_option_get_templates_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_option_create_template_callback'),
			'permission_callback' => array($this, 'kong_option_create_template_permission_callback'),
			'args' => array(
				'title' => array(
					'type' => 'string',
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				),
				'content' => array(
					'type' => 'string',
					'default' => '{}',
					'validate_callback' => array($this, 'validate_is_json')
				)
			)
		));

		register_rest_route($this->_base_api, '/templates/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_option_get_template_callback'),
			'permission_callback' => array($this, 'kong_option_get_template_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates/(?P<ids>(\d+,)*\d+)', array(
			'methods' => WP_REST_Server::DELETABLE,
			'callback' => array($this, 'kong_option_remove_templates_callback'),
			'permission_callback' => array($this, 'kong_option_remove_templates_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates/export/(?P<ids>(\d+,)*\d+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_option_export_templates_callback'),
			'permission_callback' => array($this, 'kong_option_export_templates_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates/import', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_option_import_templates_callback'),
			'permission_callback' => array($this, 'kong_option_import_templates_permission_callback')
		));
	}

	public function kong_frontend_option_save_callback($request_data) {
		$params = $request_data->get_params();
		$options = json_decode($params['options'], true);
		$styles = json_decode($params['styles'], true);

		if (is_array($options) && is_array($styles)) {
			$old_options = get_option('kongOptions');
			$old_options = !empty($old_options) && is_array($old_options) ? $old_options : array();
			$options = array_merge($old_options, $options);
			update_option('kongOptions', $options);
			update_option('kongDynamicStyles', $styles);

			return true;
		}

		return false;
	}

	public function kong_backend_option_save_callback($request_data) {
		$params = $request_data->get_params();
		$options = json_decode($params['options'], true);

		if (is_array($options)) {
			$old_options = get_option('kongOptions');
			$old_options = !empty($old_options) && is_array($old_options) ? $old_options : array();
			$options = array_merge($old_options, $options);
			update_option('kongOptions', $options);
		}

		return true;
	}

	public function kong_option_get_templates_callback($request_data) {
		$templates = array();

		$posts = get_posts(array(
			'post_type' => 'kong_op_tpl',
			'numberposts' => -1,
			'orderby' => 'ID'
		));

		foreach ($posts as $post) {
			$template = new stdClass();
			$template->id = $post->ID;
			$template->name = $post->post_title;
			$model = get_post_meta($post->ID, '_kong_option_tpl_model', true);
			$template->content = !empty($model) && is_array($model) ? $model : new stdClass();

			$templates[] = $template;
		}

		return $templates;
	}

	public function kong_option_create_template_callback($request_data) {
		$params = $request_data->get_params();
		$content = json_decode($params['content'], true);
		$this->remove_properties($content, array('$$hashKey'));

		$post_ID = wp_insert_post(array(
			'post_title' => $params['title'],
			'post_type' => 'kong_op_tpl',
			'post_status' => 'publish'
		));

		if ($post_ID) {
			update_post_meta($post_ID, '_kong_option_tpl_model', $content);

			$template = new stdClass();
			$template->id = $post_ID;
			$template->name = $params['title'];
			$template->content = $content;

			return $template;
		}

		return -1;
	}

	public function kong_option_get_template_callback($request_data) {
		$params = $request_data->get_params();

		if ($post = get_post($params['id'])) {
			$template = new stdClass();
			$template->id = $post->ID;
			$template->name = $post->post_title;
			$model = get_post_meta($post->ID, '_kong_option_tpl_model', true);
			$template->content = !empty($model) && is_array($model) ? $model : new stdClass();

			return $template;
		}

		return -1;
	}

	public function kong_option_remove_templates_callback($request_data) {
		$params = $request_data->get_params();
		$ids = explode(',', $params['ids']);
		$deleted = 0;

		if (!empty($ids)) {
			foreach ($ids as $id) {
				$post = wp_delete_post($id, true);

				if ($post) {
					$deleted++;
				}
			}
		}

		return $deleted;
	}

	public function kong_option_export_templates_callback($request_data) {
		$params = $request_data->get_params();
		$templates = array();

		$posts = get_posts(array(
			'post_type' => 'kong_op_tpl',
			'numberposts' => -1,
			'post__in' => explode(',', $params['ids']),
			'orderby' => 'ID',
			'order' => 'ASC'
		));

		foreach ($posts as $post) {
			$template = new stdClass();
			$template->name = $post->post_title;
			$model = get_post_meta($post->ID, '_kong_option_tpl_model', true);
			$template->content = !empty($model) && is_array($model) ? $model : new stdClass();

			$templates[] = $template;
		}

		return $templates;
	}

	public function kong_option_import_templates_callback($request_data) {
		global $wp_filesystem;

		$templates = array();

		if (kong_connect_fs('admin.php?page=kong-live-customizer')) {
			$files = $request_data->get_file_params();

			if (empty($files['templateFile'])) {
				return new WP_Error('kong_rest_invalid_param', 'File is empty', array('status' => 400));
			}

			$templatesImport = $wp_filesystem->get_contents($files['templateFile']['tmp_name']);
			$templatesImport = json_decode(str_replace('_kong_sharp_', '#', $templatesImport), true);

			if (json_last_error() === JSON_ERROR_NONE) {
				foreach ($templatesImport as $template) {
					$model = !empty($template['content']) && is_array($template['content']) ? $template['content'] : array();
					$this->remove_properties($model, array('$$hashKey'));

					$post_ID = wp_insert_post(array(
						'post_title' => $template['name'],
						'post_type' => 'kong_op_tpl',
						'post_status' => 'publish'
					));

					if ($post_ID) {
						update_post_meta($post_ID, '_kong_option_tpl_model', $model);
						$template['id'] = $post_ID;
						$template['content'] = (object)$model;
						$templates[] = $template;
					}
				}
			}
		}

		return $templates;
	}

	/* Permission callbacks */
	public function kong_frontend_option_save_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to access the live customizer', array('status' => 403));
		}

		return true;
	}

	public function kong_backend_option_save_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to access the site options', array('status' => 403));
		}

		return true;
	}

	public function kong_option_get_templates_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get templates', array('status' => 403));
		}

		return true;
	}

	public function kong_option_create_template_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to create template', array('status' => 403));
		}

		return true;
	}

	public function kong_option_get_template_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get template', array('status' => 403));
		}

		return true;
	}

	public function kong_option_remove_templates_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to remove templates', array('status' => 403));
		}

		return true;
	}

	public function kong_option_export_templates_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to export templates', array('status' => 403));
		}

		return true;
	}

	public function kong_option_import_templates_permission_callback($request_data) {
		if (!current_user_can('edit_theme_options')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to import templates', array('status' => 403));
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

	public function remove_properties(&$content, $properties){

		if (is_array($content)) {
			foreach ($content as $child) {
				$this->remove_properties($child, $properties);
			}
		}

		if (is_object($content)) {
			foreach ($properties as $property) {
				if (property_exists($content, $property)) {
					unset($content->{$property});
				}
			}

			if (property_exists($content, 'content') && is_array($content->content)) {
				foreach ($content->content as $child) {
					$this->remove_properties($child, $properties);
				}
			}
		}
	}
}