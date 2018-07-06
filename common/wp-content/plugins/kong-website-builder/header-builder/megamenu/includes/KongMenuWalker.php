<?php

class KongMenuWalker extends Walker_Nav_Menu {

	protected $current_item;
	protected $item_stack = array();

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

		$has_children = !empty($children_elements[$element->db_id]);
		$id = $element->db_id;

		if (isset($children_elements[$id]) && !empty($children_elements[$id])) {
			$has_row = false;

			foreach ($children_elements[$id] as $children_element) {
				if ($children_element->type_label == '[Row]') {
					$has_row = true;
					break;
				}
			}

			$element->has_row = $has_row;
		}

		$parent_item = $this->get_parent_item();

		if (!empty($parent_item)) {
			$parent_type_label = $parent_item->get_type_label();
		} else {
			$parent_type_label = '';
		}

		$item_class = apply_filters('kongmenu_item_object_class', $element);
		$item = new $item_class($output, $element, $depth, $args[0], $id, $this, $has_children, $parent_type_label);

		$this->set_item($item);

		call_user_func_array(array($this, 'start_el'), array_merge(array(&$output, $element, $depth), $args));

		$new_level = false;

		if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

			foreach ($children_elements[$id] as $child_element) {
				if (!$new_level) {
					$new_level = true;
					call_user_func_array(array($this, 'start_lvl'), array_merge(array(&$output, $depth), $args));
				}

				$this->display_element($child_element, $children_elements, $max_depth, $depth + 1, $args, $output);
			}

			unset($children_elements[$id]);
		}

		if ($new_level) {
			call_user_func_array(array($this, 'end_lvl'), array_merge(array(&$output, $depth), $args));
		}

		call_user_func_array(array($this, 'end_el'), array_merge(array(&$output, $element, $depth), $args));

	}

	function set_item($item) {
		$this->item_stack[] = $item;
		$this->current_item = $item;
	}

	function revert_item() {
		array_pop($this->item_stack);
		$this->current_item = end($this->item_stack);
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$this->current_item->start_el();
	}

	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$this->current_item->end_el();
		$this->revert_item();
	}

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$this->current_item->start_lvl();
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$this->current_item->end_lvl();
	}

	function get_parent_item() {
		if (count($this->item_stack) > 0) {
			return $this->item_stack[count($this->item_stack) - 1];
		} else {
			return null;
		}
	}

}