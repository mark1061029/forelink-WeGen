<?php

if (!defined('ABSPATH')) exit;

if (!class_exists('KongMenu')) :

    final class KongMenu {

        public function __construct() {
            $this->includes();
        }

        private function includes() {
            require_once 'admin/custom-menu-item-types.php';
            require_once KONG_DIR_PATH . '/header-builder/megamenu/includes/KongMenuWalker.php';
            require_once KONG_DIR_PATH . '/header-builder/megamenu/includes/functions.php';
            require_once KONG_DIR_PATH . '/header-builder/megamenu/includes/menuitems/menuitems.php';
        }

    }

endif;

new KongMenu();
