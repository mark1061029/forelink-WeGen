<?php

function kongmenu_args_filter($args){
	$args['walker'] = new KongMenuWalker();

	return $args;
}
add_filter('wp_nav_menu_args' , 'kongmenu_args_filter', 1000);

add_action('admin_print_styles-nav-menus.php', 'kongmenu_admin_load_assets');
function kongmenu_admin_load_assets() {

	wp_enqueue_media();
	wp_register_script('kongmenu_admin_script', KONG_HB_DIR . '/megamenu/assets/js/admin.js', array(), KONG_APP_VERSION);

	wp_localize_script('kongmenu_admin_script', 'params', array(
		'plugin_dir' => KONG_CORE_ROOT,
	));

	wp_enqueue_script('kongmenu_admin_script');

	wp_register_style('kongmenu_admin_style', KONG_HB_DIR . '/megamenu/assets/css/admin.css', array(), KONG_APP_VERSION);
	wp_enqueue_style('kongmenu_admin_style');
}

add_action('wp_update_nav_menu_item', 'kongmenu_update_nav_menu_item', 10, 3);
function kongmenu_update_nav_menu_item($menu_id, $menu_item_db_id, $menu_item_data) {
	$item_type = get_post_meta($menu_item_db_id, '_kongmenu_item_type', true);

	if ($item_type == 'row') {
		$image_id = $_POST['menu-item-row-image'][$menu_item_db_id];
		update_post_meta($menu_item_db_id, '_kong_menu_item_row_bg', $image_id);

		$row_width = $_POST['menu-item-row-width'][$menu_item_db_id];

		if (!$row_width) {
			$row_width = '100%';
		}

		update_post_meta($menu_item_db_id, '_kong_menu_item_row_width', $row_width);
	}

	if ($item_type == 'column') {
		$column_width = $_POST['menu-item-column-width'][$menu_item_db_id];
		update_post_meta($menu_item_db_id, '_kong_menu_item_column_width', $column_width);

		$title = sanitize_text_field($_POST['menu-item-column-title'][$menu_item_db_id]);
		$title = $title ? $title : '';
		update_post_meta($menu_item_db_id, '_kong_menu_item_column_title', $title);
	}

	if (isset($_POST['menu-item-emphasis'][$menu_item_db_id])) {
		$emphasis = sanitize_text_field($_POST['menu-item-emphasis'][$menu_item_db_id]);
		update_post_meta($menu_item_db_id, '_kong_menu_item_emphasis', $emphasis);
	}
}

add_filter('wp_edit_nav_menu_walker', 'kongmenu_edit_nav_menu_walker', 10, 2);
function kongmenu_edit_nav_menu_walker($class, $menu_id) {
	require_once(KONG_DIR_PATH . '/header-builder/megamenu/admin/KongWalkerNavMenuEdit.php');

	return 'KongWalkerNavMenuEdit';
}