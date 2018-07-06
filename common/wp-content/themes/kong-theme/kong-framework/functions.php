<?php

function kong_fw_breadcrumbs() {
	// Settings
	$separator          = '»';
	$breadcrums_id      = 'kong-breadcrumb__link';
	$breadcrums_class   = 'kong-breadcrumb__link';
	$home_title         = 'Home';

	// Get the query & post information
	global $post;

	// Do not display on the homepage
	if ( !is_front_page() ) {

		// Build the breadcrums
		echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

		// Home page
		echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
		echo '<li class="separator separator-home"> ' . $separator . ' </li>';

		if ( is_page() ) {

			// Standard page
			if( $post->post_parent ){

				// If child page, get parents
				$anc = get_post_ancestors( $post->ID );

				// Get parents in the right order
				$anc = array_reverse($anc);

				// Parent page loop
				if ( !isset( $parents ) ) $parents = null;
				foreach ( $anc as $ancestor ) {
					$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
					$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
				}

				// Display parent pages
				echo $parents;

				// Current page
				echo '<li class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';

			} else {

				// Just display current page if not parents
				echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';

			}

		} elseif ( is_404() ) {

			// 404 page
			echo '<li>' . 'Error 404' . '</li>';
		}

		echo '</ul>';

	}

}

function get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach (get_intermediate_image_sizes() as $_size) {
		if (in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
			$sizes[$_size]['width'] = get_option("{$_size}_size_w");
			$sizes[$_size]['height'] = get_option("{$_size}_size_h");
			$sizes[$_size]['crop'] = (bool)get_option("{$_size}_crop");
		} elseif (isset($_wp_additional_image_sizes[$_size])) {
			$sizes[$_size] = array(
				'width'  => $_wp_additional_image_sizes[$_size]['width'],
				'height' => $_wp_additional_image_sizes[$_size]['height'],
				'crop'   => $_wp_additional_image_sizes[$_size]['crop'],
			);
		}
	}

	return $sizes;
}

function kong_fw_get_image_size($size) {
	$sizes = get_image_sizes();

	if (isset($sizes[$size])) {
		return $sizes[$size];
	}

	return false;
}

function kong_fw_get_image_width($size) {
	if (! $size = kong_fw_get_image_size($size)) {
		return false;
	}

	if (isset( $size['width'])) {
		return $size['width'];
	}

	return false;
}

function kong_fw_get_image_height($size) {
	if (! $size = kong_fw_get_image_size($size)) {
		return false;
	}

	if (isset($size['height'])) {
		return $size['height'];
	}

	return false;
}

function kong_fw_get_fw_image($name='article.png'){
	return KONG_FW_ROOT.'/img/'.$name;
}

function kong_fw_exist_url($file) {
	$file_headers = @get_headers($file);
	return stripos($file_headers[0],"200 OK") ? true : false;
}

function kong_fw_generate_pagination($range = 2, $args = array()) {
	global $paged, $wp_query;

	$pagination = '';
	$pages = $wp_query->max_num_pages;

	if (empty($paged)) $paged = 1;
	if (empty($pages)) $pages = 1;

	if ($pages != 1) {
		$pagination .= '<div class="kong-blogPagination">';
		$prev_disabled = '';
		$next_disabled = '';

		if ($paged == 1) {
			$prev_disabled = 'kong-blogPagination__link--disabled';
		}

		if ($paged == $pages) {
			$next_disabled = 'kong-blogPagination__link--disabled';
		}

		$pagination .= '<a href="' . get_pagenum_link($paged - 1) . '" class="kong-blogPagination__prev ' . $prev_disabled . '">« Prev</a>';

		$start = $paged - $range;
		$end = $paged + $range;

		if ($start < 1) {
			$start = 1;
		}

		if ($end > $pages) {
			$end = $pages;
		}

		if ($start > 1) {
			$pagination .= '<a href="' . get_pagenum_link(1) . '" class="kong-blogPagination__btn">1</a>';

			if ($start > 2) {
				$pagination .= '<span>...</span>';
			}
		}

		for ($i = $start; $i <= $end; $i++) {
			$current = '';

			if ($i == $paged) {
				$current = 'kong-blogPagination__link--current';
			}

			$pagination .= '<a href="' . get_pagenum_link($i) . '" class="kong-blogPagination__btn ' . $current . '">' . $i . '</a>';
		}

		if ($end < $pages) {
			if ($end < $pages - 1) {
				$pagination .= '<span>...</span>';
			}

			$pagination .= '<a href="' . get_pagenum_link($pages) . '" class="kong-blogPagination__btn">' . $pages . '</a>';
		}

		$pagination .= '<a href="' . get_pagenum_link($paged + 1) . '" class="kong-blogPagination__next ' . $next_disabled . '">Next »</a>';

		$pagination .= '</div>';
	}

	return $pagination;
}

if(!function_exists('kong_fw_get_settings')) {
	function kong_fw_get_settings($ID) {
		$settings = get_post_meta($ID, 'kong-settings', true);
		return !empty($settings) && is_array($settings) ? $settings : array();
	}
}

function kong_fw_get_page_hero_section($options, $custom_class = '') {
	$hero_class = array();

	if(!empty($options['page_hero_parallax'])){
		$hero_class[] = 'kong-page__hero--parallax';
	}

	?>
	<div class="kong-page__hero <?php echo implode(' ', $hero_class); ?>">
		<?php
		if(has_post_thumbnail()):
			$bg_class = ['kong-hero__background__image'];
			$bg_class[] = 'kong-' . $custom_class . '__hero__background';

		?>
		<div class="kong-hero__background">
			<?php
			echo kong_fw_get_post_feature_lazy_image();
			?>
		</div>
		<?php
		endif;
		?>
		<div class="kong-hero__overlay"></div>

		<div class="kong-container">
			<div class="kong-page__hero__content kong-page__column">
				<h1 class="kong-page__hero__title"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
	<?php
}

function kong_fw_get_blog_hero_slide() {
	$options = kong_fw_get_options();

	$post_params = array(
		'posts_per_page' => !empty($options['blog_hero_slide_num_post']) ? $options['blog_hero_slide_num_post'] : 3,
		'post_status' => 'publish'
	);

	if (is_category()) {
		$post_params['category'] = get_query_var('cat');
	} else if (is_tag()) {
		$post_params['tag'] = get_query_var('tag');
	} else if (is_author()) {
		$post_params['author'] = get_query_var('author');
	} else if (is_date()) {
		$post_params['date_query'] = array();

		if (get_query_var('year')) {
			$post_params['date_query']['year'] = get_query_var('year');
		}

		if (get_query_var('month')) {
			$post_params['date_query']['month'] = get_query_var('month');
		}

		if (get_query_var('day')) {
			$post_params['date_query']['day'] = get_query_var('day');
		}
	}

	$slide_settings = array();
    $slide_settings['effect'] = !empty($options['blog_hero_slide_effect']) ? $options['blog_hero_slide_effect'] : 'fade';
    $slide_settings['autoplay'] = !empty($options['blog_hero_slide_autoplay']);
    $slide_settings['pagination'] = !empty($options['blog_hero_slide_pagination']);
    $slide_settings['nav'] = !empty($options['blog_hero_slide_nav']);


	echo kong_fw_slideshow_post_render($slide_settings, $post_params);
}

function kong_fw_get_page_breadcrumb($custom_class='') {
	if(empty($custom_class)){
		$custom_class = 'p';
	}
	?>
	<div class="kong-breadcrumb">
		<div class="kong-container">
			<div class="kong-breadcrumb__left">
				<h3 class="kong-breadcrumb__title<?php echo ' kong-' . $custom_class . '__breadcrumb__title'; ?>"><span><?php the_title(); ?></span></h3>
			</div>
			<div class="kong-breadcrumb__right">
				<?php
					kong_fw_breadcrumbs();
				?>
			</div>
		</div>
	</div>
	<?php
}

function kong_fw_get_blog_header() {
	$title = '';

	if (is_category()) {
		$category = get_term(get_query_var('cat'));
		$title = $category->name;
	} else if (is_tag()) {
		$title = get_query_var('tag');
	} else if (is_author()) {
		$title = get_the_author_meta('display_name', get_query_var('author'));
	} else if (is_date()) {
		$year = get_query_var('year');
		$month = get_query_var('monthnum');
		$day = get_query_var('day');

		$title = $year;

		if ($month) {
			$title .= '/' . $month;
		}

		if ($day) {
			$title .= '/' . $day;
		}
	}
	?>
	<div class="kong-blogHeader">
		<div class="kong-container">
			<h4 class="kong-blogHeader__label kong--eBold lc-h"><?php echo ucfirst($title); ?></h4>
		</div>
	</div>
	<?php
}

function kong_fw_blog_get_paging_data() {
	$data = array();

	if (is_category()) {
		$data['type'] = 'category';
		$data['data'] = array(get_query_var('cat'));
	} else if (is_tag()) {
		$data['type'] = 'tag';
		$data['data'] = get_query_var('tag');
	} else if (is_author()) {
		$data['type'] = 'author';
		$data['data'] = get_query_var('author');
	} else if (is_date()) {
		$data['type'] = 'date';
		$data['data'] = array(
			'year' => get_query_var('year'),
			'month' => get_query_var('monthnum'),
			'day' => get_query_var('day')
		);
	} else {
		$data['type'] = 'posts';
	}

	return $data;
}

function kong_fw_get_options() {
	$options = get_option('kongOptions');
	return !empty($options) && is_array($options) ? $options : array();
}

function kong_fw_get_category_list_html($categories, $limit = null, $class = '', $separate = ', ', $link = true) {
	$categories_html = array();
	$limit = absint($limit);

	if (!empty($categories)) {
		if (!empty($limit)) {
			$categories = array_slice($categories, 0, $limit);
		}

		if($link){
			foreach ($categories as $category) {
				$categories_html[] = '<a href="' . get_category_link($category->term_id) . '" class="' . $class . '">' . $category->name . '</a>';
			}
		}else{
			foreach ($categories as $category) {
				$categories_html[] = $category->name;
			}
		}

	}

	return implode($separate, $categories_html);
}

function kong_fw_debug($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
	die;
}

function kong_fw_connect_fs($url) {
	require_once(ABSPATH . '/wp-admin/includes/file.php');

	global $wp_filesystem;

	if(false === ($credentials = request_filesystem_credentials($url, '', false))) {
		return false;
	}

	if(!WP_Filesystem($credentials)) {
		request_filesystem_credentials($url, '', true);
		return false;
	}

	return true;
}

function kong_fw_cf_remove_update_notifications($value) {
	if (!empty($value) && is_object($value) && !empty($value->response)) {
		foreach ($value->response as $path => $plugin) {
			if ($plugin->slug == 'contact-form-7') {
				unset($value->response[$path]);
			}
		}
	}

	return $value;
}

add_filter('site_transient_update_plugins', 'kong_fw_cf_remove_update_notifications');

function kong_fw_trim_excerpt($content, $length = 10) {
	$content = explode(' ', $content);

	if (count($content) > $length) {
		$content = array_slice($content, 0, $length);

		if ($content[count($content) - 1] != '...') {
			$content[] = '...';
		}
	}

	return implode(' ', $content);
}

function kong_fw_get_thumb($href, $url, $classes=[]){
	$classes[] = 'kong-lazyImage';
	$classes[] = 'kong-thumb';
	if($href){
		$href = ' href="'.$href.'"';
		$tag = 'a';
	}else{
		$tag = 'div';
	}

	$src = Array();
	$src['full'] = $url;

	return '<'.$tag.$href.' class="'.implode($classes,' ').'" data-src="'.esc_attr(json_encode($src)).'"></'.$tag.'>';
}

function kong_fw_get_avatar($href, $url, $classes=[]){
	$classes[] = 'kong-lazyImage';
	$classes[] = 'kong-avatar';
	if($href){
		$href = ' href="'.$href.'"';
		$tag = 'a';
	}else{
		$tag = 'div';
	}

	$src = Array();
	$src['full'] = $url;

	return '<'.$tag.$href.' class="'.implode($classes,' ').'" data-src="'.esc_attr(json_encode($src)).'"></'.$tag.'>';
}

function kong_fw_get_metro_sizes($size_list, $size_list_custom) {
	$sizes = '';

	if (!empty($size_list)) {
		if ($size_list == 'custom') {
			$sizes = !empty($size_list_custom) ? $size_list_custom : '';
		} else {
			$sizes = $size_list;
		}
	}

	if (empty($sizes)) {
		$sizes = 's14';
	}

	return explode(',', str_replace(' ', '', $sizes));
}

function kong_fw_in_live_customizer_preview() {
	return isset($_GET['kong-preview-enable']);
}

function kong_fw_theme_to_boolean($val) {
	return filter_var($val, FILTER_VALIDATE_BOOLEAN);
}

function kong_fw_get_post_feature_lazy_image($id = null, $sizes = null, $method = '') {
	$html = '';
	if(!$id){
		$id = get_the_ID();
	}
	if ( has_post_thumbnail($id) ) {
		$thumb_id = get_post_thumbnail_id($id);

		$urls = array();
		if(is_array($sizes) && count($sizes)){
			$matches = array("full" => "full", "large" => "1024", "medium_large" => "768", "medium" => "300");
			$urls = array();
			foreach ($sizes as $item) {
				$url = wp_get_attachment_image_src( $thumb_id, $item );
				if($url){
					$urls[$matches[$item]] = $url[0];
				}
			}
		}

		if(!count($urls)){
			$urls = array(
				"full" => wp_get_attachment_image_src($thumb_id, 'full' )[0],
			);

			$large = wp_get_attachment_image_src($thumb_id, 'large' );
			if($large){
				$urls["1024"] = $large[0];
			}

			$medium_large = wp_get_attachment_image_src($thumb_id, 'medium_large' );
			if($large){
				$urls["768"] = $medium_large[0];
			}

			$medium = wp_get_attachment_image_src($thumb_id, 'medium' );
			if($large){
				$urls["300"] = $medium[0];
			}
		}

		$data_method = '';
		if(!empty($method) && $method != 'scroll-to-load'){
			$data_method = ' data-method="' . $method . '"';
		}

		$html = '<div class="kong-lazyImage" data-src="' . esc_attr(json_encode($urls)) . '"' . $data_method . '></div>';
	}

	return $html;
}