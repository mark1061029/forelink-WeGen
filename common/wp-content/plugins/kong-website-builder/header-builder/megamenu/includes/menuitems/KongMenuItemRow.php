<?php

class KongMenuItemRow extends KongMenuItem {

	protected $type = 'row';

	function get_start_el() {
		$style = '';
		$image_id = get_post_meta($this->item->ID, '_kong_menu_item_row_bg', true);
		$width = get_post_meta($this->item->ID, '_kong_menu_item_row_width', true);

		if (!empty($image_id)) {
			$image = wp_get_attachment_image_src($image_id, 'full');
			$style = ' style="background-image: url(' . $image[0] . ')"';
		}

		$width = ' data-width="' . $width . '"';

		$output = '<ul class="kong-menu-row kong-menu-row-id-' . $this->item->ID . ' clearfix"' . $width . $style . '>';

		return $output;
	}

	function get_end_el() {
		$output = '</ul>';

		return $output;
	}

	function get_submenu_wrap_start() {
		return '';
	}

	function get_submenu_wrap_end() {
		return '';
	}

}