<?php

$options = kong_fw_get_options();
$ID = get_the_ID();
$setting = kong_fw_get_settings($ID);
$author_id = get_the_author_meta('ID');

$wrap_class = !empty($options['single_post_has_container']) ? ' kong-container' : '';

kong_fw_single_post_hero_render($options, $author_id);
?>

<div class="kong-page__content">
	<article id="post-<?php the_ID(); ?>" <?php post_class('kong-singlePost'); ?>>
		<div class="kong-entry <?php echo $wrap_class; ?>">
			<?php the_content(); ?>
		</div>

		<div class="kong-container">
			<footer class="kong-singlePost__footer">
				<?php
				if (kong_fw_module_is_enabled('single_post_tags')) {
					kong_fw_single_post_tags_render();
				}

				if(kong_fw_module_is_enabled('single_post_share')){
					kong_fw_single_post_share_render($options);
				}
				?>

				<div class="kong-singlePost__linkPages"><?php wp_link_pages(); ?></div>

				<?php
				if (kong_fw_module_is_enabled('single_post_nav')) {
					kong_fw_single_post_nav_render();
				}
				?>
			</footer>
		</div>
	</article>

    <div class="kong-postsNav"><?php posts_nav_link(); ?></div>

	<?php
	if (kong_fw_module_is_enabled('single_post_comment') &&
		(comments_open() || get_comments_number()) && !post_password_required()) :
	?>
		<div class="kong-postComment kong-container">
			<div class="kong-postComment__wrap lc-b">
			<?php comments_template(); ?>
			</div>
		</div><!-- post comment -->
	<?php
	endif;
	?>
</div>