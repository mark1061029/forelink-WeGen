<?php

require_once 'KongMenuItem.php';
require_once 'KongMenuItemDefault.php';
require_once 'KongMenuItemRow.php';
require_once 'KongMenuItemColumn.php';

add_filter('kongmenu_item_object_class', 'kongmenu_get_item_object_class', 10, 1);
function kongmenu_get_item_object_class($item) {
	$item_type = get_post_meta($item->db_id, '_kongmenu_item_type', true);

	switch ($item_type) {
		case 'row':
			$class = 'KongMenuItemRow';
			break;
		case 'column':
			$class = 'KongMenuItemColumn';
			break;
		default:
			$class = 'KongMenuItemDefault';
			break;
	}

	return $class;
}