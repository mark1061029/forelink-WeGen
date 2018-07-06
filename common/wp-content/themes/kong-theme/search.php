<?php

$wp_query->set('orderby', 'ID');
$wp_query->query($wp_query->query_vars);
get_header();

get_template_part('template-parts/search', 'content');

get_footer();
?>