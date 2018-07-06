<?php
function kong_client_enqueue_scripts(){
    $options = kong_get_option();

    $data = array(
        'api' => get_rest_url() . 'kong-website-builder/v1',
        'nonce' => wp_create_nonce('wp_rest'),
        'parallax_delta' => 3
    );

    if (!empty($options['google_map_api_key'])) {
        $data['map_api_key'] = $options['google_map_api_key'];
    }

    if (!empty($options['parallax_bg_delta'])) {
        $data['parallax_delta'] = $options['parallax_bg_delta'];
    }

    if (current_user_can('edit_theme_options')) {
        $data['theme_options_url'] = admin_url('admin.php?page=kong-options');
    }

    wp_enqueue_script('jquery');

    wp_register_script('kong_builder_js', KONG_CORE_ROOT . '/client/dist/js/core.min.js', array('jquery'), KONG_APP_VERSION);
    wp_localize_script('kong_builder_js', 'kong_builder_data', $data);
    wp_enqueue_script('kong_builder_js');

    wp_register_style('fontawesome', KONG_CORE_ROOT.'/modules/3rd/fontawesome/font-awesome.min.css',array(), '4.7.0', 'screen');
    wp_enqueue_style('fontawesome');

    wp_register_style('linearicons_free',KONG_CORE_ROOT.'/modules/3rd/linearicon-free/style.css',array(), '1.0.0', 'screen');
    wp_enqueue_style('linearicons_free');

    wp_register_style('kong_builder_css', KONG_CORE_ROOT . '/client/dist/css/main.min.css', array(), KONG_APP_VERSION, 'all');
    wp_enqueue_style('kong_builder_css');
}

add_action("wp_enqueue_scripts", 'kong_client_enqueue_scripts', 12);