<?php

add_action('widgets_init', 'kong_fw_sidebars_init');
function kong_fw_sidebars_init() {
	$options = kong_fw_get_options();

	if (!empty($options['sidebars']) && is_array($options['sidebars'])) {
		foreach ($options['sidebars'] as $sidebar) {
			register_sidebar( array(
				'name' => $sidebar['name'],
				'id' => 'kong-sidebar-' . $sidebar['id'],
				'description' => 'Widget',
				'before_widget' => '<li id="%1$s" class="kong-widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h2 class="kong-widget__title">',
				'after_title'   => '</h2>',
			) );
		}
	}
}