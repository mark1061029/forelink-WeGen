<?php
	$options = kong_fw_get_options();

	if (kong_fw_module_is_enabled('blog_hero_slide')) {
		$display = !empty($options['blog_hero_slide_display']) ? $options['blog_hero_slide_display'] : 'blog';

		if ((is_home() && in_array($display, array('blog', 'both')))
				|| (!is_home() && in_array($display, array('archive', 'both')))) {
			kong_fw_get_blog_hero_slide();
		}
	}

	if (kong_fw_module_is_enabled('blog_header') && !is_home()) {
		kong_fw_get_blog_header();
	}

	echo '<div class="kong-blog__wrap">';

	if (have_posts()) {
		$blog_style = 'classic-grid';

		get_template_part('template-parts/blog', $blog_style);
	}  else {
		get_template_part('template-parts/blog', 'none');
	}

	echo '</div>';
?>