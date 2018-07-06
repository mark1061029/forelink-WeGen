<?php

class KongMenuItemDefault extends KongMenuItem {

	protected $type = 'default';

	function get_start_el(){

		$output = '';

		// Setup Classes
		$this->add_class_defaults();
		$this->add_class_id();
		$this->add_prefix_classes();
		$this->add_class_level();

		if ($this->depth == 0) {
			$this->add_class('kong-menu-item-top');
		}

		if ($this->parent_type_label != '[Column]') {
			$this->add_class('kong-menu-column');
		}

		if ($this->item->has_row) {
			$this->add_class('kong-menu-mega-menu');
		}

		if (isset($this->args->current_menu_type) && $this->args->current_menu_type) {
			$current_object_id = $this->args->current_menu_object;
			$item_type = get_post_meta($this->item->ID, '_menu_item_type', true);

			if (in_array($item_type, array('post_type', 'custom', 'taxonomy'))) {
				$object_id = get_post_meta($this->item->ID, '_menu_item_object_id', true);

				switch ($this->args->current_menu_type) {
					case 'post':
						if ($item_type == 'post_type' && $object_id == $current_object_id) {
							$this->add_class('kong-menu-current-menu-item');
						}

						break;
					case 'term':
						if ($item_type == 'taxonomy' && $object_id == $current_object_id) {
							$this->add_class('kong-menu-current-menu-item');
						}

						break;
				}
			}
		}

		$classes = $this->get_item_classes();

		// Setup ID
		$id = $this->get_item_id();

		$output .= '<li' . $id . $classes . '>';

		// Setup Anchor
		$atts = $this->get_anchor_atts();
		$output .= $this->get_anchor($atts);

		return $output;
	}

}