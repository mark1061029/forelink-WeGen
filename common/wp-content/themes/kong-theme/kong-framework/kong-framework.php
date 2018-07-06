<?php

define('KONG_FW_ROOT', get_template_directory_uri().'/kong-framework');
define('KONG_FW_DIR', get_template_directory() . '/kong-framework');
define('KONG_FW_SHARE_DIR', get_template_directory_uri().'/kong-framework/share-resources');
define('KONG_FW_VERSION', '1.0');
define('KONG_FW_DEV', false);

require_once ABSPATH . '/wp-admin/includes/plugin.php';
require_once 'page-builder-widgets/require.php';
require_once 'setup.php';
require_once 'KongPageLayout.php';
require_once 'KongSingleLayout.php';
require_once 'KongBlogLayout.php';
require_once 'functions.php';
require_once 'metabox/page-metabox.php';
require_once 'metabox/sidebars.php';
require_once 'KongTheme.php';
require_once 'render.php';
require_once 'site-options/require.php';