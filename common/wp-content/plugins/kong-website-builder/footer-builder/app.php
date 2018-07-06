<?php
require_once('widgets/widgets.php');
require_once('KongFooterBuilderAPI.php');
require_once "KongFooterBuilderAdmin.php";
require_once "KongFooterBuilderClient.php";

function kong_get_footer_options() {
	$options = get_option('kongFooterOptions');

	return is_array($options) ? $options : array();
}

function kong_get_footer_setting($id) {
	$footer_setting = get_post_meta($id, 'kong-page-footer-setting', true);
	return !empty($footer_setting) && is_array($footer_setting) ? $footer_setting : array();
}

function kong_get_footer_id($data) {
	$footer_options = kong_get_footer_options();
	$footer_id = 0;

	if (!empty($data['type'])) {
		switch ($data['type']) {
			case 'search':
				if (!empty($footer_options['search'])) {
					$footer_id = !empty($footer_options['search']['value']) ? $footer_options['search']['value'] : 0;
				}

				break;
			case 'page':
				$footer_setting = kong_get_footer_setting($data['value']);

				if (!empty($footer_setting['footer'])) {
					$footer_id = $footer_setting['footer'];
				}

				break;
			case 'archive':
				if (!empty($footer_options[$data['value']])) {
					$footer_option = $footer_options[$data['value']];

					if ($footer_option['enable']) {
						$footer_id = !empty($footer_option['value']['archive']) ? $footer_option['value']['archive'] : 0;
					}
				}

				break;
			case 'single':
				if (!empty($footer_options[$data['value']])) {
					$footer_option = $footer_options[$data['value']];

					if ($footer_option['enable']) {
						$footer_id = !empty($footer_option['value']['single']) ? $footer_option['value']['single'] : 0;
					}
				}

				break;
			case 'taxonomy':
				if (!empty($footer_options[$data['value']])) {
					$footer_option = $footer_options[$data['value']];

					if ($footer_option['enable']) {
						$footer_id = !empty($footer_option['value']) ? $footer_option['value'] : 0;
					}
				}

				break;
			default:
				break;
		}
	}


	if ($footer_id === 0 || $footer_id === 'primary') {
		$footer_id = !empty($footer_options['primary']['value']) ? $footer_options['primary']['value'] : 0;
	}

	$footer_id = $footer_id == 'none' ? 0 : $footer_id;

	if (!empty($footer_id)) {
		$footer = get_post($footer_id);

		if (!$footer || $footer->post_status != 'publish' || $footer->post_type != 'kong_footer') {
			$footer_id = 0;
		}
	}

	return $footer_id;
}

function kong_fb_get_post_types() {
	return get_post_types(array('show_ui' => true), 'objects');
}

function kong_get_footer_data() {
	$data = array();
	if (is_home()) {
		$data['type'] = 'home';
	} else if (is_search()) {
		$data['type'] = 'search';
	} else if (is_page() || get_post_type() == 'page') {
		$data['type'] = 'page';
		$data['value'] = get_the_ID();
	} else if (is_tax()) {
		$data['type'] = 'taxonomy';
		$data['value'] = get_queried_object()->taxonomy;
	} else if (is_archive()) {
		$data['type'] = 'archive';
		$data['value'] = get_post_type(get_the_ID());
	} else if (is_single()) {
		$data['type'] = 'single';
		$data['value'] = get_post_type(get_the_ID());
	}

	return $data;
}


function kong_footer_builder_render(){
	KongFooterBuilderClient::render();
}
