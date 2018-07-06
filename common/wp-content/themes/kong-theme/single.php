<?php

$options = kong_fw_get_options();

get_header(); ?>
<?php
while ( have_posts() ) : the_post();
	get_template_part('template-parts/single', 'content');
endwhile;
?>
<?php get_footer(); ?>
