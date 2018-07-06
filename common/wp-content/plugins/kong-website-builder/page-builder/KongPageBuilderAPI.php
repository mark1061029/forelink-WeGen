<?php

class KongPageBuilderAPI
{
	private $_base_api, $_save_properties;

	public function __construct() {
		$this->_base_api = 'kong-page-builder/v1';
		$this->_save_properties = array('name', 'tag', 'content', 'attrs', 'nested');
	}

	public function register_routes() {
		register_rest_route($this->_base_api, '/components', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_components_callback')
		));

		register_rest_route($this->_base_api, '/templateItems', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_pb_create_tpl_item_callback'),
			'permission_callback' => array($this, 'kong_pb_create_tpl_item_permission_check'),
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
				),
				'type' => array(
					'type' => 'string',
					'default' => '',
					'validate_callback' => array($this, 'validate_not_empty')
				)
			)
		));

		register_rest_route($this->_base_api, '/templateItems/(?P<type>\w+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_tpl_items_callback'),
			'permission_callback' => array($this, 'kong_pb_get_tpl_items_permission_check')
		));

		register_rest_route($this->_base_api, '/templateItems', array(
			'methods' => WP_REST_Server::EDITABLE,
			'callback' => array($this, 'kong_pb_change_tpl_item_name_callback'),
			'permission_callback' => array($this, 'kong_pb_change_tpl_item_name_permission_check'),
			'args' => array(
				'id' => array(
					'type' => 'integer',
					'default' => 0,
					'sanitize_callback' => 'absint',
					'validate_callback' => array($this, 'validate_is_numeric')
				),
				'name' => array(
					'type' => 'string',
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				)
			)
		));

		register_rest_route($this->_base_api, '/templateItems/(?P<ids>(\d+,)*\d+)', array(
			'methods' => WP_REST_Server::DELETABLE,
			'callback' => array($this, 'kong_pb_remove_tpl_item_callback'),
			'permission_callback' => array($this, 'kong_pb_remove_tpl_item_permission_check')
		));

		register_rest_route($this->_base_api, '/templateItems/export/(?P<ids>(\d+,)*\d+)/(?P<type>(\w+))', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_tpl_item_export_callback'),
			'permission_callback' => array($this, 'kong_pb_get_tpl_item_export_permission_check')
		));

		register_rest_route($this->_base_api, '/templateItems/(?P<type>\w+)', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_pb_import_tpl_item_callback'),
			'permission_callback' => array($this, 'kong_pb_import_tpl_item_permission_check')
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_tpl_list_callback'),
			'permission_callback' => array($this, 'kong_pb_get_tpl_list_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_pb_create_tpl_callback'),
			'permission_callback' => array($this, 'kong_pb_create_tpl_permission_callback'),
			'args' => array(
				'title' => array(
					'type' => 'string',
					'default' => '',
					'sanitize_callback' => 'sanitize_text_field',
					'validate_callback' => array($this, 'validate_not_empty')
				),
				'content' => array(
					'type' => 'string',
					'default' => '[]'
				),
				'custom_css' => array(
					'type' => 'string',
					'default' => ''
				),
				'custom_js' => array(
					'type' => 'string',
					'default' => ''
				)
			)
		));

		register_rest_route($this->_base_api, '/templates/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_tpl_callback'),
			'permission_callback' => array($this, 'kong_pb_get_tpl_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates/(?P<ids>(\d+,)*\d+)', array(
			'methods' => WP_REST_Server::DELETABLE,
			'callback' => array($this, 'kong_pb_remove_tpl_callback'),
			'permission_callback' => array($this, 'kong_pb_remove_tpl_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates/export/(?P<ids>(\d+,)*\d+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_tpl_export_callback'),
			'permission_callback' => array($this, 'kong_pb_get_tpl_export_permission_callback')
		));

		register_rest_route($this->_base_api, '/templates/import', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_pb_import_tpl_callback'),
			'permission_callback' => array($this, 'kong_pb_import_tpl_permission_callback')
		));

		register_rest_route($this->_base_api, '/pages/(?P<id>\d+)', array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => array($this, 'kong_pb_save_page_callback'),
			'permission_callback' => array($this, 'kong_pb_save_page_permission_callback'),
			'args' => array(
				'model' => array(
					'type' => 'string',
					'default' => '[]',
					'validate_callback' => array($this, 'validate_is_json')
				),
				'custom_css' => array(
					'type' => 'string',
					'default' => ''
				),
				'custom_js' => array(
					'type' => 'string',
					'default' => ''
				),
				'shortcodes' => array(
					'type' => 'string',
					'default' => ''
				),
				'styles' => array(
					'type' => 'string',
					'default' => '{}'
				),
				'block_frame' => array(
					'type' => 'string',
					'default' => ''
				)
			)
		));

		register_rest_route($this->_base_api, '/get-identify-code/(?P<string>.+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_identify_code_callback'),
			'permission_callback' => array($this, 'kong_pb_get_identify_code_permission_callback')
		));

		register_rest_route($this->_base_api, '/cards', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_cards_callback'),
			'permission_callback' => array($this, 'kong_pb_get_cards_permission_callback')
		));

		register_rest_route($this->_base_api, '/cards/(?P<ids>(\d+,)*\d+)', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_cards_content_callback'),
			'permission_callback' => array($this, 'kong_pb_get_cards_content_permission_callback')
		));

		register_rest_route($this->_base_api, '/blocks', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_blocks_callback'),
			'permission_callback' => array($this, 'kong_pb_get_blocks_permission_callback')
		));

		register_rest_route($this->_base_api, '/post-shortcode', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_post_shortcode_callback'),
			'permission_callback' => array($this, 'kong_pb_post_shortcode_permission_callback'),
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

		register_rest_route($this->_base_api, '/section-separators', array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => array($this, 'kong_pb_get_section_separator_callback'),
			'permission_callback' => array($this, 'kong_pb_get_section_separator_permission_callback'),
			'args' => array(
				'style' => array(
					'type' => 'string',
					'default' => ''
				)
			)
		));
	}

	public function kong_pb_get_components_callback() {
		global $lb_pb_model;
		return $lb_pb_model->model_to_JSON();
	}

	public function kong_pb_create_tpl_item_callback($request_data) {
		$params = $request_data->get_params();
		$content = json_decode($params['content'], true);

		$post_ID = wp_insert_post(array(
			'post_title' => $params['title'],
			'post_type' => 'kong_pb_tpl_item',
			'post_status' => 'publish'
		));

		if ($post_ID) {
			update_post_meta($post_ID, '_kong_pb_tpl_item_type', $params['type']);
			update_post_meta($post_ID, '_kong_pb_tpl_item_model', $content);
			return $post_ID;
		}

		return -1;
	}

	public function kong_pb_get_tpl_items_callback($request_data) {
		$params = $request_data->get_params();
		$template_items = array();

		$posts = get_posts(array(
			'post_type' => 'kong_pb_tpl_item',
			'numberposts' => -1,
			'orderby' => 'ID',
			'meta_query' => array(
				array(
					'key' => '_kong_pb_tpl_item_type',
					'value' => $params['type']
				)
			)
		));

		foreach ($posts as $post) {
			$template_item = new stdClass();
			$template_item->template_id = $post->ID;
			$template_item->template_name = $post->post_title;
			$model = get_post_meta($post->ID, '_kong_pb_tpl_item_model', true);
			$template_item->content = !empty($model) && is_array($model) ? $model : new stdClass();

			$template_items[] = $template_item;
		}

		return $template_items;
	}

	public function kong_pb_change_tpl_item_name_callback($request_data) {
		$params = $request_data->get_params();

		$post_ID = wp_update_post(array(
			'ID' => $params['id'],
			'post_title' => $params['name']
		));

		return $post_ID;
	}

	public function kong_pb_remove_tpl_item_callback($request_data) {
		$params = $request_data->get_params();
		$ids = explode(',', $params['ids']);

		if (!empty($ids)) {
			foreach ($ids as $id) {
				wp_delete_post($id, true);
			}

			return 1;
		}

		return -1;
	}

	public function kong_pb_get_tpl_item_export_callback($request_data) {
		$params = $request_data->get_params();
		$data = array();
		$template_items = array();

		$data['identify'] = kong_get_identify_code('kong-pb-item-' . $params['type']);

		$posts = get_posts(array(
			'post_type' => 'kong_pb_tpl_item',
			'numberposts' => -1,
			'post__in' => explode(',', $params['ids']),
			'orderby' => 'ID',
			'order' => 'ASC'
		));

		foreach ($posts as $post) {
			$template_item = new stdClass();
			$template_item->template_name = $post->post_title;
			$template_item->type = get_post_meta($post->ID, '_kong_pb_tpl_item_type', true);
			$model = get_post_meta($post->ID, '_kong_pb_tpl_item_model', true);
			$template_item->content = !empty($model) && is_array($model) ? $model : new stdClass();

			$template_items[] = $template_item;
		}

		$data['templates'] = $template_items;

		return $data;
	}

	public function kong_pb_import_tpl_item_callback($request_data) {
		$params = $request_data->get_params();
		$files = $request_data->get_file_params();

		if (empty($files['templateFile'])) {
			return new WP_Error('kong_rest_invalid_param', 'File is empty', array('status' => 400));
		}

		$data = str_replace('_kong_sharp_', '#', file_get_contents($files['templateFile']['tmp_name']));
		$data = json_decode($data, true);

		if (json_last_error() == JSON_ERROR_NONE && !empty($data['identify']) && $data['identify'] == kong_get_identify_code('kong-pb-item-' . $params['type'])) {
			$templates = array();

			foreach ($data['templates'] as $template) {
				if ($template['type'] === $params['type']) {
					$this->filter_properties($template['content'], $this->_save_properties);

					$post_ID = wp_insert_post(array(
						'post_title' => $template['template_name'],
						'post_type' => 'kong_pb_tpl_item',
						'post_status' => 'publish'
					));

					if ($post_ID) {
						update_post_meta($post_ID, '_kong_pb_tpl_item_type', $params['type']);
						$model = !empty($template['content']) && is_array($template['content']) ? $template['content'] : array();
						update_post_meta($post_ID, '_kong_pb_tpl_item_model', $model);
						$template['template_id'] = $post_ID;
						unset($template['type']);
						$templates[] = $template;
					}
				}
			}

			return $templates;
		}

		return false;
	}

	public function kong_pb_get_tpl_list_callback($request_data) {
		$templates = array();

		$posts = get_posts(array(
			'post_type' => 'kong_pb_tpl',
			'numberposts' => -1,
			'orderby' => 'ID'
		));

		foreach ($posts as $post) {
			$template = new stdClass();
			$template->template_id = $post->ID;
			$template->template_name = $post->post_title;

			$templates[] = $template;
		}

		return $templates;
	}

	public function kong_pb_create_tpl_callback($request_data) {
		$params = $request_data->get_params();
		$content = json_decode($params['content'], true);
		$this->filter_properties($content, $this->_save_properties);

		$post_ID = wp_insert_post(array(
			'post_title' => $params['title'],
			'post_type' => 'kong_pb_tpl',
			'post_status' => 'publish'
		));

		if ($post_ID) {
			update_post_meta($post_ID, '_kong_pb_tpl_model', $content);
			update_post_meta($post_ID, '_kong_pb_tpl_custom_css', $params['custom_css']);
			update_post_meta($post_ID, '_kong_pb_tpl_custom_js', $params['custom_js']);

			return $post_ID;
		}

		return -1;
	}

	public function kong_pb_get_tpl_callback($request_data) {
		$params = $request_data->get_params();

		if ($post = get_post($params['id'])) {
			$template = new stdClass();
			$template->template_id = $post->ID;
			$template->template_name = $post->post_title;
			$model = get_post_meta($post->ID, '_kong_pb_tpl_model', true);
			$template->content = !empty($model) && is_array($model) ? $model : array();
			$template->custom_css = get_post_meta($post->ID, '_kong_pb_tpl_custom_css', true);
			$template->custom_js = get_post_meta($post->ID, '_kong_pb_tpl_custom_js', true);

			return $template;
		}

		return false;
	}

	public function kong_pb_remove_tpl_callback($request_data) {
		$params = $request_data->get_params();
		$ids = explode(',', $params['ids']);

		if (!empty($ids)) {
			foreach ($ids as $id) {
				wp_delete_post($id, true);
			}

			return true;
		}

		return false;
	}

	public function kong_pb_get_tpl_export_callback($request_data) {
		$params = $request_data->get_params();
		$data = array();
		$templates = array();

		$data['identify'] = kong_get_identify_code('kong-pb-template');

		$posts = get_posts(array(
			'post_type' => 'kong_pb_tpl',
			'numberposts' => -1,
			'post__in' => explode(',', $params['ids']),
			'orderby' => 'ID',
			'order' => 'ASC'
		));

		foreach ($posts as $post) {
			$template = new stdClass();
			$template->template_name = $post->post_title;
			$this->filter_properties($post->post_content, $this->_save_properties);
			$model = get_post_meta($post->ID, '_kong_pb_tpl_model', true);
			$template->content = !empty($model) && is_array($model) ? $model : array();
			$template->custom_css = get_post_meta($post->ID, '_kong_pb_tpl_custom_css', true);
			$template->custom_js = get_post_meta($post->ID, '_kong_pb_tpl_custom_js', true);

			$templates[] = $template;
		}

		$data['templates'] = $templates;

		return $data;
	}

	public function kong_pb_import_tpl_callback($request_data) {
		$files = $request_data->get_file_params();

		if (empty($files['templateFile'])) {
			return new WP_Error('kong_rest_invalid_param', 'File is empty', array('status' => 400));
		}

		$data = str_replace('_kong_sharp_', '#', file_get_contents($files['templateFile']['tmp_name']));
		$data = json_decode($data, true);

		if (json_last_error() == JSON_ERROR_NONE && !empty($data['identify']) && $data['identify'] == kong_get_identify_code('kong-pb-template')) {
			$templates = array();

			if (!empty($data['templates'])) {
				foreach ($data['templates'] as $template) {
					$this->filter_properties($template['content'], $this->_save_properties);

					$post_ID = wp_insert_post(array(
						'post_title' => $template['template_name'],
						'post_type' => 'kong_pb_tpl',
						'post_status' => 'publish'
					));

					if ($post_ID) {
						$model = !empty($template['content']) && is_array($template['content']) ? $template['content'] : array();
						update_post_meta($post_ID, '_kong_pb_tpl_model', $model);
						update_post_meta($post_ID, '_kong_pb_tpl_custom_css', $template['custom_css']);
						update_post_meta($post_ID, '_kong_pb_tpl_custom_js', $template['custom_js']);

						$template['template_id'] = $post_ID;
						$templates[] = $template;
					}
				}
			}

			return $templates;
		}

		return false;
	}

	public function kong_pb_save_page_callback($request_data) {
		$params = $request_data->get_params();
		$id = $params['id'];
		$model = json_decode($params['model'], true);
		$shortcodes = $params['shortcodes'];
		$custom_css = $params['custom_css'];
		$custom_js = $params['custom_js'];
		$styles = json_decode($params['styles'], true);

		$post = get_post($id);

		if ($post) {
			update_post_meta($id, '_kong_pb_enable', 1);
			update_post_meta($id, '_kong_pb_shortcodes', $shortcodes);
			update_post_meta($id, '_kong_pb_model', $model);
			update_post_meta($id, '_kong_pb_styles', $styles);
			update_post_meta($id, '_kong_pb_custom_css', $custom_css);
			update_post_meta($id, '_kong_pb_custom_js', $custom_js);

			if (!empty($params['block_frame'])) {
				update_post_meta($id, '_kong_block_frame', json_decode($params['block_frame']), true);
			}

			return $id;
		}

		return -1;
	}

	public function kong_pb_get_identify_code_callback($request_data) {
		$params = $request_data->get_params();

		return kong_get_identify_code($params['string']);
	}

	public function kong_pb_get_cards_callback($request_data) {
		$params = $request_data->get_params();

		$posts = get_posts(array(
			'post_type' => 'kong_pb_card',
			'numberposts' => -1,
			'order' => 'DESC',
			'post_status' => 'any'
		));

		$cards = array();

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$card = array();
				$card['id'] = $post->ID;
				$card['name'] = $post->post_title;
				$card['img'] = get_post_meta($post->ID, '_kong_pb_card_img', true);
				$card['filter'] = get_post_meta($post->ID, '_kong_pb_card_filter', true);
				$card['padding'] = get_post_meta($post->ID, '_kong_pb_card_padding', true);
				$cards[] = $card;
			}
		}

		return $cards;
	}

	public function kong_pb_get_cards_content_callback($request_data) {
		$params = $request_data->get_params();

		$posts = get_posts(array(
			'post_type' => 'kong_pb_card',
			'numberposts' => -1,
			'post__in' => explode(',', $params['ids']),
			'post_status' => 'any'
		));

		$cards = array();

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$card = array();
				$card['id'] = $post->ID;
				$model = get_post_meta($post->ID, '_kong_pb_card_model', true);
				$card['model'] = !empty($model) && is_array($model) ? $model : new stdClass();
				$cards[] = $card;
			}
		}

		return $cards;
	}

	public function kong_pb_get_blocks_callback($request_data) {
		$posts = get_posts(array(
			'post_type' => 'kong_block',
			'numberposts' => -1,
			'post_status' => 'publish',
			'order' => 'ASC'
		));

		$blocks = array();

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$block = array();
				$block['id'] = $post->ID;
				$block['name'] = $post->post_title;
				$blocks[] = $block;
			}
		}

		return $blocks;
	}

	public function kong_pb_post_shortcode_callback($request_data) {
		$params = $request_data->get_params();
		$post = get_post($params['id']);

		if (!empty($post) && $post->post_status == 'publish') {
			return do_shortcode($params['shortcode']);
		}

		return -1;
	}

	public function kong_pb_get_section_separator_callback($request_data) {
		$params = $request_data->get_params();
		return kong_get_section_separator($params['style']);
	}

	/* Permission callbacks */
	public function kong_pb_create_tpl_item_permission_check($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to create template item', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_tpl_items_permission_check($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get template items', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_change_tpl_item_name_permission_check($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to update template item', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_remove_tpl_item_permission_check($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to delete template item', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_tpl_item_export_permission_check($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to export template items', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_import_tpl_item_permission_check($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to import template items', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_tpl_list_permission_callback($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get templates', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_create_tpl_permission_callback($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to create template', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_tpl_permission_callback($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get template', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_remove_tpl_permission_callback($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to remove template', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_tpl_export_permission_callback($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to export templates', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_import_tpl_permission_callback($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to import templates', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_save_page_permission_callback($request_data) {

		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to save page', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_identify_code_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get identify code', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_cards_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get wire frames', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_cards_content_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get wire frames content', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_blocks_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get blocks', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_post_shortcode_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get shortcode', array('status' => 403));
		}

		return true;
	}

	public function kong_pb_get_section_separator_permission_callback($request_data) {
		if (!current_user_can('edit_posts')) {
			return new WP_Error('kong_forbidden_context', 'You are not allowed to get section separator', array('status' => 403));
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

