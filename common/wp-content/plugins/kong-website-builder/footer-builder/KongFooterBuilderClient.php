<?php

class KongFooterBuilderClient
{

	const KONG_DUMB_HEADING = 'What is Lorem Ipsum?';
	const KONG_DUMB_PARAGRAPH = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.';
	const KONG_DUMB_NAME = 'John Doe';
	const KONG_DUMB_BTN = 'Click me';
	const KONG_SHORTCODE_ATTS_FILTER = 'kong_fb';

	function __construct()
	{
		if (!is_admin()) {
			$this->enqueue_styles();
			$this->register_admin_bar();

			if (!isset($_GET['kong-fb-dnd-enable'])) {
				$this->shortcode_atts_fillter();
			}
		}
	}

	public function enqueue_styles() {
		add_action('wp_enqueue_scripts', array($this, 'add_footer_style'), 16);

		if (isset($_GET['preview-footer']) && get_post_type($_GET['preview-footer']) == 'kong_footer') {
			add_action('wp_enqueue_scripts', array($this, "footer_preview_style"));
		}
	}

	public function footer_preview_style(){
		wp_enqueue_style('kong_footer_admin', KONG_FB_DIR.'/dist/css/preview.min.css', array(), KONG_APP_VERSION ,'all');
	}

	public function add_footer_style() {
		if (!isset($_GET['kong-fb-dnd-enable'])) {
			if (isset($_GET['preview-footer']) && get_post_type($_GET['preview-footer']) == 'kong_footer') {
				$footer_id = $_GET['preview-footer'];
			} else {
				$footer_id = kong_get_footer_id(kong_get_footer_data());
			}

			$footer = get_post($footer_id);
			if (!empty($footer)) {
				$footer_style = '';
				$styles = get_post_meta($footer_id, '_kong_fb_styles', true);
				$custom_css = get_post_meta($footer_id, '_kong_fb_custom_css', true);

				if (!is_array($styles)) {
					$styles = array();
				}

				if (!empty($styles['style'])) {
					$footer_style .= $styles['style'];
				}

				$footer_style .= $custom_css;

				if (!empty($styles['link']) && is_array($styles['link'])) {
					$i = 1;
					foreach ($styles['link'] as $link) {
						wp_enqueue_style('kong-footer-link-' . $i, $link);
						$i++;
					}
				}

				$footer_style = preg_replace('/\r?\n|\r/', '', preg_replace('/\s*\{\s*/', '{', preg_replace('/\s*}\s*/', '}', preg_replace('/\s*;\s*/', ';', preg_replace('/\s*,\s*/', ',', preg_replace('/\s*:\s*/', ':', $footer_style))))));
				wp_add_inline_style('kong_builder_css', $footer_style);
			}
		}
	}

	public static function render_generate_footer() {
		$html = '';
		$data = kong_get_footer_data();

		if (isset($_GET['preview-footer']) && get_post_type($_GET['preview-footer']) == 'kong_footer' && (is_home() || is_page())) {
			if (is_home()) {
				$id = 0;
			} else {
				$id = get_the_ID();
			}

			$footer_id = $_GET['preview-footer'];
			$footer_setting_id = kong_get_footer_id($data);
			$html .= '<div class="kong-bs__itemPreview">';

			if ($footer_setting_id != $footer_id) {
				if (!$footer_setting_id || !get_post($footer_setting_id)) {
					$message = 'Currently, There is no Footer set for this page. Click on this button to apply the Footer for this page.';
				} else {
					$footer = get_post($footer_setting_id);
					$old_footer_name = $footer->post_title;
					$old_footer_url = add_query_arg(array(
						'kong-fb-enable' => true,
						'post_id' => $id,
						'footer_id' => $footer_setting_id
					), get_admin_url());

					$message = 'This page currently uses <a href="' . $old_footer_url . '">' . $old_footer_name . '</a> Footer. If you want to apply the Footer for this page, please click on this button.';
				}

				ob_start();?>
				<button class="kong-bs__itemPreview__setBtn" id="y67123PnCyO8" state="ready" data-footer-id="<?php echo $footer_id; ?>" data-page-id="<?php echo $id; ?>">
					<span>Apply Footer</span>
					<span><i class="kong-bs__itemPreview__preloader"></i><small>Applying</small></span>
					<span><i class="fa fa-check"></i> Applied</span>
				</button>
				<div class="kong-bs__itemPreview__message">
					<p><?php echo $message; ?></p>
				</div>
				<i class="fa fa-check" style="position:absolute;z-index:-1;opacity:0"></i>
				<script type="text/javascript" id="BS4uQxW20G57">
					jQuery(window).ready(function(){
						jQuery("#y67123PnCyO8").on('click', function() {
							var t = jQuery(this);
							t.attr('state', 'loading');

							jQuery.ajax({
								method: 'POST',
								url: '<?php echo get_rest_url(); ?>kong-footer-builder/v1/set-footer',
								data: {
									data: '<?php echo json_encode($data); ?>',
									footer_id: <?php echo $footer_id; ?>
								},
								beforeSend: function (xhr) {
									xhr.setRequestHeader('X-WP-Nonce', '<?php echo wp_create_nonce('wp_rest'); ?>');
								},
								success: function(data) {
									if (data) {
										t.attr('state', 'saved');

										setTimeout(function () {
											t.attr('state', 'disabled');
										}, 2000);
									}
								},
								error: function(jqXHR, textStatus, error) {
									console.log(error);
								}
							});
						});
						jQuery("#BS4uQxW20G57").remove();
					});
				</script>
				<?php
				$html .= ob_get_clean();
			}

			$edit_link = add_query_arg(array(
				'kong-fb-enable' => 1,
				'post_id' => $id,
				'footer_id' => $footer_id
			), get_admin_url());

			$html .= '</div>';
			$html .= '<a class="kong-bs__itemPreview__editBtn" href="' . $edit_link . '"><span class="lnr lnr-pencil"></span></a>';
		} else {
			$footer_id = kong_get_footer_id($data);
		}

		if (!empty($footer_id)) {
			$html .= '<footer class="kong-site__footer">';
			$footer = get_post($footer_id);
			if (!empty($footer)) {
				$shortcode = $footer->post_content;
				$html .= do_shortcode($shortcode);
				$html .= '</footer>';
			}
		}

		return $html;
	}

	public static function render_fb_dnd_area() {
		add_filter('edit_post_link', '__return_false');
		return '
			<footer class="kong-site__footer" id="kong-fb-dnd-area"></footer>
		';
	}

	public function register_admin_bar() {
		add_action('admin_bar_menu', array($this, 'toolbar_footer_builder'), 993);
	}

	public function toolbar_footer_builder($wp_admin_bar) {
		global $wp;

		$footer_id = kong_get_footer_id(kong_get_footer_data());

		if (!empty($footer_id)) {
			$args = array(
				'kong-fb-enable' => 1,
				'footer_id' => $footer_id
			);

			if (is_single() || is_page() || is_home() || get_post_type() == 'page') {
				if (is_home()) {
					$id = 0;
				} else {
					$id = get_the_ID();
				}

				$args['post_id'] = $id;
			} else if (is_category() || is_tag() || is_tax()) {
				if (is_category()) {
					$term_id = get_query_var('cat');
				} else if (is_tag()) {
					$tag = get_query_var('tag');
					$term = get_term_by('slug', $tag, 'post_tag');
					$term_id = $term->term_id;
				} else {
					$term_slug = get_query_var('term');
					$tax = get_query_var('taxonomy');
					$term = get_term_by('slug', $term_slug, $tax);
					$term_id = $term->term_id;
				}

				$args['term_id'] = $term_id;
			} else if (is_author()) {
				$args['author_id'] = get_query_var('author');
			} else if (is_date()) {
				$year = get_query_var('year');
				$month = get_query_var('monthnum');
				$day = get_query_var('day');

				if ($year) {
					$args['year'] = $year;
				}

				if ($month) {
					$args['month'] = $month;
				}

				if ($day) {
					$args['day'] = $day;
				}
			} else if (is_post_type_archive()) {
				$args['post_type'] = get_query_var('post_type');
			} else if (is_search()) {
				$args['search'] = get_search_query();
			}

			if (!empty($args)) {
				if (!$wp_admin_bar->get_node('builder_system')) {
					$wp_admin_bar->add_node(array(
						'id' => 'builder_system',
						'title' => '<span class="builder-system ab-item">Builder System</span>'
					));
				}

				$wp_admin_bar->add_node(array(
					'id' => 'footer_builder_link',
					'parent' => 'builder_system',
					'title' => 'Footer Builder',
					'href' => add_query_arg($args, get_admin_url())
				));
			}
		}
	}

	public function shortcode_atts_fillter() {
		add_filter('shortcode_atts_' . self::KONG_SHORTCODE_ATTS_FILTER, array($this, 'shortcode_atts_fillter_callback'));
	}

	public function shortcode_atts_fillter_callback($out) {
		if (!empty($out)) {
			foreach ($out as $attr => $value) {
				$out[$attr] = str_replace('_kong_bracket_open_', '[', str_replace('_kong_bracket_close_', ']', $value));
			}
		}

		return $out;
	}

	public static function render() {
		if (isset($_GET['kong-fb-dnd-enable'])) {
			echo self::render_fb_dnd_area();
		} else {
			echo self::render_generate_footer();
		}
	}
}

new KongFooterBuilderClient();