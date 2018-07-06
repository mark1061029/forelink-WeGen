<?php
require_once "widgets/widgets.php";
require_once "section-dividers/section-divider-switcher.php";
require_once('KongPageBuilderAPI.php');
require_once('KongPageBuilder.php');
require_once "KongPageBuilderAdmin.php";
require_once "KongPageBuilderClient.php";
require_once 'KongBlockWidget.php';

function lpb_register_widgets() {
	register_widget('KongBlockWidget');
}
add_action('widgets_init', 'lpb_register_widgets');