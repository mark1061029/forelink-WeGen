<?php

$options = kong_fw_get_options();
?>

</main><!--Content-->


<?php
if (function_exists('kong_footer_builder_render')) {
	kong_footer_builder_render();
}

if(kong_fw_module_is_enabled('go_top_button')):
	$go_top_data = 'data-time="'.$options['go_top_time'].'" ';
	$go_top_data .= 'data-show-when="'.$options['go_top_show_when'].'"';
?>
	<button class="kong-siteGoTopBtn" <?php echo $go_top_data; ?>>
		<i class="fa fa-chevron-up" aria-hidden="true"></i>
	</button>
<?php
endif;
?>

<?php wp_footer(); ?>

</body>
</html>
