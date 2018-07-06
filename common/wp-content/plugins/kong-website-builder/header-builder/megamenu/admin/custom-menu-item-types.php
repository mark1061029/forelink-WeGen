<?php

function kong_get_custom_menu_item_types() {
	return array(
		'row' => array(
			'label'	=> 'Row',
			'title' => '[Row]',
			'panels' => array('row', 'responsive'),
		),

		'column' => array(
			'label'	=> 'Column',
			'title' => '[Column]',
			'panels' => array('column_layout', 'responsive'),
		),

	);

}

add_filter('wp_setup_nav_menu_item', 'kongmenu_setup_nav_menu_item');
function kongmenu_setup_nav_menu_item($menu_item) {

	if($menu_item->type == 'custom') {

		$item_type = '';
		$items = kong_get_custom_menu_item_types();
		$url = $menu_item->url;
		$kongmenu_prefix = '#kongmenu-';

		if (isset($menu_item->post_status) && $menu_item->post_status == 'draft') {
			if(strpos($url, $kongmenu_prefix) === 0) {
				$item_type = substr($url, strlen($kongmenu_prefix));
				update_post_meta($menu_item->ID, '_kongmenu_item_type', $item_type);
			}
		} else {
			$item_type = get_post_meta($menu_item->ID, '_kongmenu_item_type', true);
		}


		if ($item_type) {
			$menu_item->object = 'kongmenu-custom-' . $item_type;

			if (isset($items[$item_type])) {
				$label = $items[$item_type]['label'];
			} else {
				$label = $item_type . ' Undefined';
			}

			$menu_item->type_label = '[' . $label . ']';
		}

	}

	return $menu_item;
}

add_action( 'admin_init' , 'kong_add_custom_menu_items_meta_box' );
function kong_add_custom_menu_items_meta_box(){
	add_meta_box('kong_custom_menu_items', 'Kong Advanced Items', 'kong_custom_menu_items_meta_box', 'nav-menus', 'side', 'low' );
}

function kong_custom_menu_items_meta_box() {
	global $_nav_menu_placeholder;

	$items = kong_get_custom_menu_item_types();

	?>
	<div id="kong-custom-menu-metabox" class="posttypediv">
		<div id="tabs-panel-kongmenu-custom" class="tabs-panel tabs-panel-active">
			<ul id="kongmenu-custom-list" class="categorychecklist form-no-clear">

				<?php
					foreach ($items as $type => $item) :
						$url = '#kongmenu-' . $type;

						if(isset($item['url'])) {
							$url = $item['url'];
						}

					?>

					<li>
						<label class="menu-item-title">
							<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-label]" value="0"> <?php echo $item['label']; ?>
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-kongmenu-custom" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-kongmenu-custom]" value="on">
						<input type="hidden" class="menu-item-title" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-title]" value="<?php echo $item['title']; ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[<?php echo $_nav_menu_placeholder ?>][menu-item-url]" value="<?php echo $url; ?>">
					</li>

				<?php
						$_nav_menu_placeholder--;
					endforeach;
				?>

			</ul>
		</div>
		<p class="button-controls">

			<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-kong-custom-menu-item" id="submit-kong-custom-menu-metabox">
				<span class="spinner"></span>
			</span>
		</p>
	</div>
<?php
}