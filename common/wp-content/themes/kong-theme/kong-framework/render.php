<?php
$options = kong_fw_get_options();

function kong_fw_single_post_info_render($author_id) {
	?>
	<header class="kong-singlePost__header">
		<div class="kong-singlePost__avatar-wrap">
			<?php
			$href = get_author_posts_url($author_id);
			$url = get_avatar_url($author_id);
			echo kong_fw_get_avatar($href, $url, ['kong-singlePost__avatar']);
			?>
		</div>
		<div class="kong-singlePost__info">
			<a href="<?php echo get_author_posts_url($author_id); ?>" class="kong-singlePost__author lc-p kong--mBold"><?php the_author(); ?></a>
			<div class="kong-singlePost__date lc-d"><?php echo _e('on', 'kong') ?> <?php the_date('M d, Y'); ?></div>
		</div>
	</header>
	<?php
}

function kong_fw_single_post_hero_render($options, $author_id) {
	?>
	<div class="kong-singlePost__hero<?php if(!empty($options['single_post_hero_parallax'])) echo ' kong-singlePost__hero--parallax';?>">
		<?php
		if(has_post_thumbnail()):
		?>
		<div class="kong-hero__background">
			<?php echo kong_fw_get_post_feature_lazy_image(); ?>
		</div>
		<?php
		endif;
		?>

		<div class="kong-singlePost__hero__overlay"></div>
		<div class="kong-singlePost__hero__content">
			<div class="kong-singlePost__hero__content__wrap">
				<div class="kong-container">
					<div class="kong-singlePost__hero__cats kong--bold"><?php echo kong_fw_get_category_list_html(get_the_category()); ?></div>
					<h1 class="kong-singlePost__hero__title"><?php the_title(); ?></h1>
					<div class="kong-singlePost__hero__info">
						<?php
						$href = get_author_posts_url($author_id);
						$url = get_avatar_url($author_id);
						echo kong_fw_get_avatar($href, $url, ['kong-singlePost__hero__avatar']);
						?>
						<div class="kong-singlePost__hero__author kong--marginTop5"><a href="<?php echo get_author_posts_url($author_id); ?>" class="kong--eBold"><?php the_author(); ?></a></div>
						<div class="kong-singlePost__hero__date"><?php _e('on','kong') ?> <?php the_date('M d, Y'); ?></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function kong_fw_single_post_tags_render() {
	$tags = get_the_tags();

	if (!empty($tags)):
		$tags_html = array();

		foreach ($tags as $tag) {
			$tags_html[] = '<a href="' . get_tag_link($tag->term_id) . '" class="kong-singlePost__tag kong-link">' . $tag->name . '</a>';
		}
		?>
		<div class="kong-singlePost__tags">
			<?php echo implode('', $tags_html); ?>
		</div><!-- post tags -->
	<?php endif;
}

function kong_fw_single_post_share_render($options) {
	?>
	<div class="kong-singlePost__share">
		<span><?php _e('Share to', 'kong')?>:</span>
		<?php

		if(!empty($options['single_twitter_enable'])){
			echo '<a class="kong-singlePost__share__twitter" target="_blank" href="http://twitter.com/share?text='.get_the_title().'&url='.get_the_permalink().'"><span class="fa fa-twitter"></a>';
		}

		if(!empty($options['single_facebook_enable'])){
			echo '<a class="kong-singlePost__share__facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink().'"><span class="fa fa-facebook"></a>';
		}

		if(!empty($options['single_linkedin_enable'])){
			echo '<a class="kong-singlePost__share__linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&source=LinkedIn">
						<span class="fa fa-linkedin"></span>
					</a>';
		}

		if(!empty($options['single_pinterest_enable']) && has_post_thumbnail()){
			echo '<a class="kong-singlePost__share__pinterest" href="http://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&media=' . get_the_post_thumbnail_url() . '&description=' . get_the_title() . '" count-layout="horizontal" target="_blank">
						<span class="fa fa-pinterest"></span>
					</a>';
		}

		if(!empty($options['single_email_enable'])){
			echo '<a class="kong-singlePost__share__email" href="mailto:" target="_blank"><span class="fa fa-envelope"></span></a>';
		}
		?>
	</div>
	<?php
}

function kong_fw_single_post_author_summary_render($author_id, $options) {
	?>
	<div class="kong-authorSummary lc-b">
		<div class="kong-media kong-media--top">
			<div class="kong-media__image">
				<?php
				$url = get_avatar_url($author_id);
				echo kong_fw_get_avatar('', $url, ['kong-authorSummary__avatar']);
				?>
			</div>
			<div class="kong-media__content kong-authorSummary__detail">
				<h6 class="kong-authorSummary__name lc-h kong--eBold"><?php the_author(); ?></h6>
				<p class="kong-authorSummary__bio">
					<?php echo get_user_meta($author_id, 'description', true); ?>
				</p>
				<a href="<?php echo get_author_posts_url($author_id); ?>" class="kong-authorSummary__visitLink lc-h-p kong--eBold"><?php _e("All author posts", 'kong'); ?> »</a>
			</div>
		</div>
	</div><!-- single post author summary -->
	<?php
}

function kong_fw_single_post_nav_render() {
	$previous_post = get_previous_post();
	$next_post = get_next_post();
	if(!empty($previous_post) || !empty($next_post)):
	?>
		<div class="kong-postNav lc-b lcs-d-h">
			<?php
			if (!empty($previous_post)) :
				?>
				<div class="kong--floatLeft">
					<a href="<?php echo get_permalink($previous_post->ID); ?>">« <?php _e('Previous post','kong') ?></a>
				</div>
				<?php
			endif;

			if (!empty($next_post)) :
				?>
				<div class="kong--floatRight">
					<a href="<?php echo get_permalink($next_post->ID); ?>"><?php _e('Next post','kong'); ?> »</a>
				</div>
				<?php
			endif;
			?>
		</div><!-- single post navigation -->
	<?php
	endif;
}

function kong_fw_load_more_button_render($args = array(), $echo = true) {
	$args = array_merge(array(
		'settings' => array(
			'limit' => 5,
			'orderby' => 'date',
			'order' => 'DESC',
			'data' => json_encode(array('type' => 'posts')),
			'append_to' => '.kong-blogImage__wrap',
			'text' => __('Load More','kong'),
			'loading_text' => __('Loading...','kong')
		),
		'custom_settings' => array(),
		'custom_class' => '',
		'before' => '',
		'after' => ''
	), $args);

	$custom_settings = !empty($args['custom_settings']) ? ' data-custom-settings="' . esc_attr(json_encode($args['custom_settings'])) . '"' : '';

	ob_start(); ?>
	<?php echo $args['before']; ?>
	<div class="kong-loadMoreBtn__wrap">
		<button class="kong-loadMoreBtn kong--eBold<?php echo !empty($args['custom_class']) ? ' '.$args['custom_class'] : ''; ?>"
				data-settings="<?php echo esc_attr(json_encode($args['settings']));?>"<?php echo $custom_settings; ?>>
			<span class="kong-loadMoreBtn__icon"></span><span class="kong-loadMoreBtn__text"><?php echo $args['settings']['text']; ?></span>
		</button>
	</div>
	<?php
	echo $args['after'];
	$html = ob_get_clean();

	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function kong_fw_infinite_scroller_render($args = array(), $echo = true) {
	$args = array_merge(array(
		'settings' => array(
			'limit' => 5,
			'orderby' => 'date',
			'order' => 'DESC',
			'data' => json_encode(array('type' => 'posts')),
			'append_to' => '.kong-blogImage__wrap',
			'load_all_text' => __('No more posts to load','kong'),
		),
		'custom_settings' => array(),
		'custom_class' => ''
	), $args);

	$custom_settings = !empty($args['custom_settings']) ? ' data-custom-settings="' . esc_attr(json_encode($args['custom_settings'])) . '"' : '';

	ob_start() ?>
	<div class="kong-infiniteScroller<?php if(!empty($args['custom_class'])) echo ' '.$args['custom_class']; ?>"
		 data-settings="<?php echo esc_attr(json_encode($args['settings'])); ?>"<?php echo $custom_settings ?>></div>
	<?php
	$html = ob_get_clean();

	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function kong_fw_module_is_enabled($module, $frontend = true) {
	global $options;

	if(empty($options['exclude_modules'])){
		return false;
	}

	if ($frontend) {
		return !in_array($module, $options['exclude_modules']) && !empty($options[$module.'_enable']);
	} else {
		return !in_array($module, $options['exclude_modules']);
	}
}

function kong_fw_classic_post_item_render($args, $custom_class = array(), $echo = true) {
	global $options;
	$id = get_the_ID();
	$settings = kong_fw_get_settings($id);
	$short_info = !empty($args['info']);
	$custom_class[] = 'kong-blogClassic__item lc-b';

	if(!empty($options['blog_classic_scroll_effect']) && $options['blog_classic_scroll_effect'] != 'none'){
		$custom_class[] = 'kong-sa';
		$custom_class[] = $options['blog_classic_scroll_effect'];
	}

	ob_start();
	?>
	<article <?php post_class(implode(' ', $custom_class)); ?>>
		<div class="kong-bci__wrap">
			<?php if ($short_info) : ?>
				<div class="kong-bci__lookup">
					<div class="kong-bci__avatar-wrap kong--paddingRight10">
						<?php
						$author_id = get_the_author_meta('ID');
						$href = get_author_posts_url($author_id);
						$url = get_avatar_url($author_id);
						echo kong_fw_get_avatar($href, $url, ['kong-bci__avatar']);
						?>
					</div>

					<div class="kong-bci__info">
						<a href="<?php echo get_author_posts_url($author_id); ?>" class="kong-bci__author lc-p kong--bold"><?php the_author(); ?></a>
						<div class="kong-bci__date lc-d">
							<?php echo get_the_date('M d, Y'); ?>
						</div>
					</div>
				</div><!-- lookup-->
			<?php endif; ?>

			<div class="kong-bci__content">
				<?php
				if (!empty($settings['feature']['url'])) :
					$urls = !empty($settings['feature']['sizes']) ? $settings['feature']['sizes'] : array();
					?>
					<div class="kong-bci__media">
						<figure class="kong-bci__image">
						<?php
						echo kong_fw_get_lazy_image($settings['feature']['url'], $urls, array('600', '900', '1200', 'full'));
						?>
						</figure>
					</div>
				<?php
				elseif(has_post_thumbnail()):
				?>
					<div class="kong-bci__media">
						<figure class="kong-bci__image">
							<?php
							echo kong_fw_get_post_feature_lazy_image();;
							?>
						</figure>
					</div>
				<?php endif; ?>

				<h3 class="kong-bci__title lcs-h-p"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php
				if(has_excerpt()){
					echo '<div class="kong-bci__excerpt">' . kong_fw_trim_excerpt(get_the_excerpt(), 30) . '</div>';
				}
				?>
			</div>

			<a class="kong-bci__readMore lc-d-h" href="<?php the_permalink(); ?>"><?php _e('Read more', 'kong'); ?>...</a>
		</div>
	</article>
	<?php
	$html = ob_get_clean();

	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function kong_fw_classic_grid_post_item_render($args, $custom_class = array(), $echo = true) {
	$ID = get_the_ID();
	$custom_class[] = 'kong-bcgi kong-gCol';

	ob_start();
	?>
	<article <?php post_class(implode(' ', $custom_class)); ?>>
		<div class="kong-bcgi__wrap">
			<?php
			if (has_post_thumbnail()):
				echo '<a class="kong-bcgi__img" href="'.get_the_permalink().'">'.kong_fw_get_post_feature_lazy_image().'</a>';
			endif; ?>
			<div class="kong-bcgi__content">
				<div class="kong-bcgi__cats kong--bold">
					<?php echo kong_fw_get_category_list_html(get_the_category()); ?>
				</div>
				<h6 class="kong-bcgi__title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
				<?php if ($args['excerpt_enable'] && has_excerpt($ID)) : ?>
					<div class="kong-bcgi__excerpt"><?php echo kong_fw_trim_excerpt(get_the_excerpt($ID), 25); ?></div>
				<?php endif; ?>

				<footer class="kong-bcgi__footer">
					<?php
					$author_id = get_the_author_meta('ID');
					$href = get_author_posts_url($author_id);
					$url = get_avatar_url($author_id);
					echo kong_fw_get_avatar($href, $url, ['kong-bcgi__avatar']);
					?>
					<a href="<?php echo get_author_posts_url($author_id); ?>" class="kong-bcgi__author kong--bold"><?php echo get_the_author_meta('display_name', $author_id); ?></a>
				</footer>
			</div>
		</div>
	</article>
	<?php
	$html = ob_get_clean();

	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function kong_fw_search_item_render($custom_class = array(), $echo = true) {
	global $options;


	ob_start(); ?>
	<div class="kong-search__item">
		<?php
		$post_type = get_post_type();
		$id = get_the_ID();
		if (in_array($post_type, array('post', 'page', 'portfolio'))) :
			$settings = kong_fw_get_settings($id);

			?>

			<a class="kong-search__image lc-d" href="<?php the_permalink(); ?>">
			<?php
			if (has_post_thumbnail($id)):
				echo kong_fw_get_post_feature_lazy_image($id, array('medium'));
			else: ;
				echo '<div class="kong-search__thumb"></div>';
			endif;
			?>
			</a>
		<?php
		endif;
		?>
		<div class="kong-search__content lc-b">
			<h6 class="kong-search__title kong--eBold lcs-h-p"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<?php if (has_excerpt()) : ?>
				<p class="kong-search__excerpt"><?php echo kong_fw_trim_excerpt(get_the_excerpt(), 30); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php
	$html = ob_get_clean();

	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function kong_fw_thumbnail_generate($size, $url) {
	if (has_post_thumbnail()) {
		the_post_thumbnail($size);
	} else { ?>
		<img src="<?php echo $url; ?>" alt="<?php the_title(); ?>" />
	<?php }
}

function kong_fw_metro_post_item_render($args, $custom_class, $echo = true) {
	$custom_class[] = 'kong-blogMetro__item';

	if(!empty($args['scroll_effect']) && $args['scroll_effect'] != 'none'){
		$custom_class[] = 'kong-sa';
		$custom_class[] = $args['scroll_effect'];
	}

	ob_start(); ?>
	<article <?php post_class(implode(' ', $custom_class)); ?>>
		<a href="<?php echo get_the_permalink(); ?>" class="kong-bmi__wrap">
			<?php
			if(has_post_thumbnail()):
				echo kong_fw_get_post_feature_lazy_image();
			endif;?>
			<div class="kong-bmi__overlay"></div>

			<div class="kong-bmi__content">
				<header class="kong-bmi__header">
					<div class="kong-media kong-media--top">
						<div class="kong-media__image kong--paddingRight10">
							<?php
							$author_id = get_the_author_meta('ID');
							$url = get_avatar_url($author_id);
							echo kong_fw_get_avatar('', $url, ['kong-bmi__avatar']);
							?>
						</div>
						<div class="kong-media__content kong-bmi__info">
							<div class="kong-bmi__author kong--eBold"><?php the_author(); ?></div>
							<div class="kong-bmi__date"><?php echo get_the_date(); ?></div>
						</div>
					</div>
					<h4 class="kong-bmi__title"><?php the_title(); ?></h4>
				</header>

				<footer class="kong-bmi__footer kong--bold">
					<?php
					$categories = get_the_category();
					foreach ($categories as $category) {
						echo '<span>' . $category->name . '</span>';
					}
					?>
				</footer>
			</div>
		</a>
	</article>
	<?php
	$html = ob_get_clean();
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function kong_fw_fullwidth_page_render($content, $content_class = '', $wrap_class = '') {
	?>
	<div class="kong-page <?php echo $wrap_class; ?>">
		<div class="kong-container">
			<div class="kong-row">
				<div class="kong-page__content kong-page__column <?php echo $content_class; ?>">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function kong_fw_page_render() {
	$ID = get_the_ID();
	$setting = kong_fw_get_settings($ID);
	$options = kong_fw_get_options();
	$has_border = !empty($options['page_has_border']);

	if(!empty($setting['addition']['before'])){
		echo do_shortcode($setting['addition']['before']);
	}

	// Render Hero Feature Image
	if(!empty($setting['layout']['feature_image'])){
		kong_fw_get_page_hero_section($options);
	}

	// Render Page Breadcrumb
	if(!empty($setting['layout']['breadcrumb'])){
		kong_fw_get_page_breadcrumb();
	}

	// Render Page Content
	$type = !empty($setting['layout']['type']) ? $setting['layout']['type'] : 'blank';
	ob_start();
	the_content();
	$content = ob_get_clean();
	$sidebar = !empty($setting['layout']['sidebar']) ? $setting['layout']['sidebar'] : '';

	$page_content_layout = new KongPageLayout(array(
		'sidebar' => $sidebar,
		'type' => $type,
		'content' => $content,
		'content_class' => 'kong-entry',
		'has_border' => $has_border
	));

	$page_content_layout->render();

	if(!empty($setting['addition']['after'])){
		echo do_shortcode($setting['addition']['after']);
	}
}

function kong_fw_slideshow_post_render($slide_settings, $post_params){
	$posts = get_posts($post_params);

	ob_start();
	if (!empty($posts)) :
		?>
		<div class="kong-heroSlider owl-carousel" data-settings="<?php echo esc_attr(json_encode($slide_settings)); ?>">
			<?php foreach ($posts as $post) :
				$lazy_bg = '';
				if(has_post_thumbnail($post->ID)){
					$lazy_bg = kong_fw_get_post_feature_lazy_image($post->ID, array('full', 'large', 'medium_large'));
				}
				?>
				<div class="kong-heroSlider__slide">
					<?php echo $lazy_bg; ?>
					<div class="kong-heroSlider__overlay"></div>
					<div class="kong-heroSlider__content">
						<div class="kong-container">
							<div class="kong-heroSlider__info">
								<?php
								$href = get_author_posts_url($post->post_author);
								$url = get_avatar_url($post->post_author);
								echo kong_fw_get_avatar($href, $url, ['kong-heroSlider__avatar']);
								?>
								<div class="kong-heroSlider__author"><?php echo '<a href="'.$href.'" class="kong--eBold">'.get_the_author_meta('display_name',$post->post_author).'</a>'; ?></div>
							</div>
							<h3 class="kong-heroSlider__title"><?php echo get_the_title($post->ID); ?></h3>
							<?php if(has_excerpt($post->ID)) :?>
							<p class="kong-heroSlider__desc"><?php echo kong_fw_trim_excerpt(get_the_excerpt($post->ID), 30); ?></p>
							<?php endif; ?>
							<a class="kong-heroSlider__link kong--eBold" href="<?php echo get_the_permalink($post->ID); ?>"><?php _e('Read more','kong') ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	endif;

	return ob_get_clean();
}