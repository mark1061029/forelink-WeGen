<?php
require_once 'megamenu/KongMegaMenu.php';
require_once 'widgets/widgets.php';
require_once 'KongHeaderBuilderAdminAPI.php';
require_once 'KongHeaderBuilderAdmin.php';
require_once 'KongHeaderBuilderClient.php';


function kong_get_header_options() {
	$options = get_option('kongHeaderOptions');

	return is_array($options) ? $options : array();
}

function kong_get_header_setting($id) {
	$setting = get_post_meta($id, 'kong-page-header-setting', true);
	return !empty($setting) && is_array($setting) ? $setting : array();
}

function kong_get_header_id($data) {
	$header_options = kong_get_header_options();
	$header_id = 0;

	if (!empty($data['type'])) {
		switch ($data['type']) {
			case 'search':
				if (!empty($header_options['search'])) {
					$header_id = !empty($header_options['search']['value']) ? $header_options['search']['value'] : 0;
				}

				break;
			case 'page':
				$header_setting = kong_get_header_setting($data['value']);

				if (!empty($header_setting['header'])) {
					$header_id = $header_setting['header'];
				}

				break;
			case 'archive':
				if (!empty($header_options[$data['value']])) {
					$header_option = $header_options[$data['value']];

					if ($header_option['enable']) {
						$header_id = !empty($header_option['value']['archive']) ? $header_option['value']['archive'] : 0;
					}
				}

				break;
			case 'single':
				if (!empty($header_options[$data['value']])) {
					$header_option = $header_options[$data['value']];

					if ($header_option['enable']) {
						$header_id = !empty($header_option['value']['single']) ? $header_option['value']['single'] : 0;
					}
				}

				break;
			case 'taxonomy':
				if (!empty($header_options[$data['value']])) {
					$header_option = $header_options[$data['value']];

					if ($header_option['enable']) {
						$header_id = !empty($header_option['value']) ? $header_option['value'] : 0;
					}
				}

				break;
			default:
				break;
		}
	}

	if ($header_id === 0 || $header_id === 'primary') {
		$header_id = !empty($header_options['primary']['value']) ? $header_options['primary']['value'] : 0;
	}

	$header_id = $header_id == 'none' ? 0 : $header_id;

	if (!empty($header_id)) {
		$header = get_post($header_id);

		if (!$header || $header->post_status != 'publish' || $header->post_type != 'kong_header') {
			$header_id = 0;
		}
	}

	return $header_id;
}

function kong_hb_get_post_types() {
	return get_post_types(array('show_ui' => true), 'objects');
}

function kong_get_header_data() {
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

function kong_header_builder_render(){
	KongHeaderBuilderClient::render();
}