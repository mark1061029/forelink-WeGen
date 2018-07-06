<?php

$options = kong_fw_get_options();
$post = get_post($options['maintenance_page_id']);
setup_postdata($post);
get_header();
kong_fw_page_render();
get_footer();

