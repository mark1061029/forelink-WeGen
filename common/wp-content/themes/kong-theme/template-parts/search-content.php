<?php
$options = kong_fw_get_options();

?>
<div class="kong-search__header">
	<div class="kong-search__bg">
		<?php if (kong_fw_in_live_customizer_preview()) : ?>
		<div class="kong-search__bg__image"></div>
		<?php elseif (!empty($options['search_header_bg']['sizes'])) : ?>
			<?php echo kong_fw_get_lazy_image($options['search_header_bg']['sizes']); ?>
		<?php endif; ?>
	</div>
	<div class="kong-search__overlay"></div>
	<div class="kong-container kong-search__info">
		<form class="kong-search__form" role="search" method="get" action="<?php echo get_home_url(); ?>">
			<input  class="kong-search__input" type="text" name="s" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''; ?>" placeholder="<?php _e('Type and hit enter', 'kong'); ?>" />
			<button class="kong-search__submit" type="submit"><span class="fa fa-search"></span></button>
		</form>
	</div>
</div>

<div class="kong-search__container kong-page__content">
	<div class="kong-container">
		<div class="kong-search__result kong-eBold lc-h lc-b"><h5><?php _e('Search results','kong'); ?></h5> <span class="kong-search__count"><?php echo $wp_query->found_posts.' '.__('found', 'kong'); ?></span></div>
		<?php
		if (have_posts()) :
			echo '<div class="kong-search__list">';
			while (have_posts()) : the_post();
				kong_fw_search_item_render();
			endwhile;
			echo '</div>';
		else:
			echo '<div class="kong-search__noResult">'.__('No result was found', 'kong').'</div>';
		endif;
		?>
	<div>
</div>

<?php
$per_page = get_option('posts_per_page');

if ($wp_query->found_posts > $per_page) {
	echo kong_fw_generate_pagination(2);
}