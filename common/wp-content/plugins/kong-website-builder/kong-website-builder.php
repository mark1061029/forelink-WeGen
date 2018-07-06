<?php
/*
Plugin Name: Kong Website Builder
Plugin URI: https://kolumn.io/kong
Description: A combination of visual editors help you quickly to build completed web pages including headers, footers, page content & global style with drag n drop and real time editing feature.
Author: kolumn.io
Author URI: https://kolumn.io
Version: 1.1.0
Text Domain:
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define('KONG_PLUGIN_PATH', __FILE__);
define('KONG_DIR_PATH', plugin_dir_path(__FILE__));
define('KONG_CORE_ROOT', plugins_url('', __FILE__));
define('KONG_SO_DIR', KONG_CORE_ROOT.'/site-options');
define('KONG_PB_DIR', KONG_CORE_ROOT.'/page-builder');
define('KONG_FB_DIR', KONG_CORE_ROOT.'/footer-builder');
define('KONG_HB_DIR', KONG_CORE_ROOT.'/header-builder');
define('KONG_APP_VERSION', '1.0');
define('KONG_DEBUG_MODE', false);

require_once('functions.php');
require_once('modules/KongWebsiteBuilderAPI.php');
require_once('client/client_enqueue_scripts.php');
require_once('site-options/app.php');
require_once('footer-builder/app.php');
require_once('header-builder/app.php');
require_once('page-builder/app.php');
?>