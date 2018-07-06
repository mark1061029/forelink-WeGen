<?php

class KongHeaderBuilderClient
{
	const KONG_SHORTCODE_ATTS_FILTER = 'kong_hb';

	function __construct()
	{
		$this->ROOT =  KONG_CORE_ROOT.'/app/client';
		$this->CSS = $this->ROOT.'/dist/css';
		$this->JS = $this->ROOT.'/dist/js';
		$this->_3RD = KONG_CORE_ROOT.'/modules/3rd/';

		if (!is_admin()) {
			$this->enqueue_styles();
			$this->register_admin_bar();

			if (!isset($_GET['kong-hb-dnd-enable'])) {
				$this->shortcode_atts_fillter();
			}
		}
	}

	public function enqueue_styles() {
		add_action('wp_enqueue_scripts', array($this, 'add_header_style'), 14);

		if (isset($_GET['preview-header']) && get_post_type($_GET['preview-header']) == 'kong_header') {
			add_action('wp_enqueue_scripts', array($this, "header_preview_style"));
		}
	}

	public function add_header_style() {
		if (!isset($_GET['kong-hb-dnd-enable'])) {
			if (isset($_GET['preview-header']) && get_post_type($_GET['preview-header']) == 'kong_header') {
				$header_id = $_GET['preview-header'];
			} else {
				$header_id = kong_get_header_id(kong_get_header_data());
			}

			$header = get_post($header_id);
			if (!empty($header)) {
				$header_style = '';
				$styles = get_post_meta($header_id, '_kong_hb_styles', true);
				$custom_css = get_post_meta($header_id, '_kong_hb_custom_css', true);
				$body_padding = get_post_meta($header_id, '_kong_hb_body_padding', true);
				$styles = !empty($styles) && is_array($styles) ? $styles : array();

				if (!empty($styles['style'])) {
					$header_style .= $styles['style'];
				}

				$header_style .= $custom_css;

				if (!empty($body_padding) && is_array($body_padding)) {

					$header_style .= '
						@media screen and (min-width: 1025px) {
							body{
								padding: ' . $body_padding['desktop'] . ';
							}
						}

						@media screen and (max-width: 1024px) and (min-width: 769px){
							body{
								padding: ' . $body_padding['tablet-l'] . ';
							}
						}

						@media screen and (max-width: 768px) and (min-width: 513px) {
							body{
								padding: ' . $body_padding['tablet'] . ';
							}
						}

						@media screen and (max-width: 512px){
							body{
								padding: ' . $body_padding['mobile'] . ';
							}
						}
					';
				}

				if (!empty($styles['link']) && is_array($styles['link'])) {
					$i = 1;
					foreach ($styles['link'] as $link) {
						wp_enqueue_style('kong-header-link-' . $i, $link);
						$i++;
					}
				}

				$header_style = preg_replace('/\r?\n|\r/', '', preg_replace('/\s*\{\s*/', '{', preg_replace('/\s*}\s*/', '}', preg_replace('/\s*;\s*/', ';', preg_replace('/\s*,\s*/', ',', preg_replace('/\s*:\s*/', ':', $header_style))))));
				wp_add_inline_style('kong_builder_css', $header_style);
			}
		}
	}

	public function header_preview_style(){
		wp_enqueue_style('kong_header_admin', KONG_HB_DIR.'/dist/css/preview.min.css', array(), KONG_APP_VERSION ,'all');
	}

	public static function render_frontend_header() {
		$html = '';
		$data = kong_get_header_data();

		if (isset($_GET['preview-header']) && get_post_type($_GET['preview-header']) == 'kong_header' && (is_home() || is_page())) {
			if (is_home()) {
				$id = 0;
			} else {
				$id = get_the_ID();
			}

			$header_id = $_GET['preview-header'];
			$header_setting_id = kong_get_header_id($data);
			$html .= '<div class="kong-bs__itemPreview">';

			if ($header_setting_id != $header_id) {
				if (!$header_setting_id || !get_post($header_setting_id)) {
					$message = 'Currently, There is no Header set for this page. Click on this button to apply the Header for this page.';
				} else {
					$header = get_post($header_setting_id);
					$old_header_name = $header->post_title;
					$old_header_url = add_query_arg(array(
						'kong-hb-enable' => true,
						'post_id' => $id,
						'header_id' => $header_setting_id
					), get_admin_url());

					$message = 'This page currently uses <a href="' . $old_header_url . '">' . $old_header_name . '</a> Header. If you want to apply the Header for this page, please click on this button.';
				}

				ob_start();?>
				<button class="kong-bs__itemPreview__setBtn" id="y67123PnCyO8" state="ready" data-header-id="<?php echo $header_id; ?>" data-page-id="<?php echo $id; ?>">
					<span>Apply Header</span>
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
								url: '<?php echo get_rest_url(); ?>kong-header-builder/v1/set-header',
								data: {
									data: '<?php echo json_encode($data); ?>',
									header_id: <?php echo $header_id; ?>
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
				'kong-hb-enable' => 1,
				'post_id' => $id,
				'header_id' => $header_id
			), get_admin_url());

			$html .= '</div>';
			$html .= '<a class="kong-bs__itemPreview__editBtn" href="' . $edit_link . '"><span class="lnr lnr-pencil"></span></a>';
		} else {
			$header_id = kong_get_header_id($data);
		}

		if (!empty($header_id)) {
			$html .= '<header class="kong-site__header">';
			$header = get_post($header_id);
			if (!empty($header)) {
				$shortcode = $header->post_content;
				$html .= do_shortcode($shortcode);
				$html .= '</header>';
			}
		}

		return $html;
	}

	public static function render_dnd_area() {
		add_filter('edit_post_link', '__return_false');
			return '
			<header class="kong-site__header" id="kong-hb-dnd-side"></header>
		';
	}

	public static function render(){
		if (isset($_GET['kong-hb-dnd-enable'])) {
			echo KongHeaderBuilderClient::render_dnd_area();
		} else {
			echo KongHeaderBuilderClient::render_frontend_header();
		}
	}

	public function register_admin_bar() {
		add_action('admin_bar_menu', array($this, 'toolbar_header_builder'), 991);
	}

	public function toolbar_header_builder($wp_admin_bar) {
		global $wp;

		$header_id = kong_get_header_id(kong_get_header_data());

		if (!empty($header_id)) {
			$args = array(
				'kong-hb-enable' => 1,
				'header_id' => $header_id
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
					'id' => 'header_builder_link',
					'parent' => 'builder_system',
					'title' => 'Header Builder',
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
}

new KongHeaderBuilderClient();