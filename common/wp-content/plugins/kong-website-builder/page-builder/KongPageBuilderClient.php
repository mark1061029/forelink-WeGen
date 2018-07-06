<?php

class KongPageBuilderClient extends KongPageBuilder
{
	const KONG_DUMB_HEADING = 'What is Lorem Ipsum?';
	const KONG_DUMB_PARAGRAPH = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.';
	const KONG_DUMB_NAME = 'John Doe';
	const KONG_DUMB_BTN = 'Click me';
	const KONG_COLOR_TEXT = '#31425d';
	const KONG_COLOR_PARAGRAPH = '#848e9d';
	const KONG_COLOR_HEADING = '#32435c';
	const KONG_COLOR_BORDER = '#ddd';
	const KONG_COLOR_PRIMARY = '#44D284';
	const KONG_COLOR_INSIDE_PRIMARY = '#fff';
	const KONG_SHORTCODE_ATTS_FILTER = 'kong_pb';

	function __construct()
	{
		parent::__construct();


		$this->block_shortcode();

		if (!is_admin()) {
			$this->enqueue_styles();
			$this->enqueue_scripts();
            $this->body_class_filter();

			if (!isset($_GET['kong-dnd-enable'])) {
				$this->content_filter();
				$this->register_admin_bar();
				$this->shortcode_atts_fillter();
			}
		}
	}

	public function register_scripts(){
		add_action("wp_enqueue_scripts", array(&$this, ('enqueue_scripts')));
	}

	public function enqueue_styles() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles_callback'), 15);
	}

	public function enqueue_scripts() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_callback'));
	}

	public function content_filter() {
		add_filter('the_content', array($this, 'page_check_content'));
		add_filter('the_content', array($this, 'cleanup_shortcode_fix'));
	}

	public function page_check_content($content) {
		$id = get_the_ID();

		if (self::post_type_is_accepted(get_post_type($id)) && get_post_meta($id, '_kong_pb_enable', true)) {
			$before = '';
			$after = '';

			if (get_post_type($id) == 'kong_block') {
				$before = '<div class="kong-dnd__blockBuilder__frame">';
				$after  = '</div>';
			}

			return $before . get_post_meta(get_the_ID(), '_kong_pb_shortcodes', true) . $after;
		}

		return $content;
	}

	public function cleanup_shortcode_fix($content) {
		$array = array('<p>[' => '[', ']</p>' => ']', ']<br />' => ']', ']<br>' => ']');
		$content = strtr($content, $array);
		return $content;
	}

	public function enqueue_styles_callback() {
		$id = get_the_ID();

		if (self::post_type_is_accepted(get_post_type($id)) && !isset($_GET['kong-dnd-enable']) && get_post_meta($id, '_kong_pb_enable', true)) {
			$styles = get_post_meta($id, '_kong_pb_styles', true);

			if (!is_array($styles)) {
				$styles = array();
			}

			if (!empty($styles['link'])) {
				$i = 1;

				foreach ($styles['link'] as $link) {
					wp_enqueue_style('kong-pb-link-' . $i, $link);
					$i++;
				}
			}

			$style = '';
			$custom_css = get_post_meta($id, '_kong_pb_custom_css', true);

			if (!empty($styles['style'])) {
				$style .= $styles['style'];
			}

			if (!empty($custom_css)) {
				$style .= $custom_css;
			}

			if (get_post_type($id) == 'kong_block') {
				$block_frame = get_post_meta($id, '_kong_block_frame', true);

				if (!empty($block_frame->body_bg)) {
					$style .= '.kong-dnd__blockBuilder{background-color:' . $block_frame->body_bg . ';}';
				}

				$style .= '.kong-dnd__blockBuilder__frame{margin: auto; min-height: 100vh;';

				if (!empty($block_frame->frame_bg)) {
					$style .= 'background-color:' . $block_frame->frame_bg . ';';
				}

				if (!empty($block_frame->max_width)) {
					$style .= 'max-width:' . $block_frame->max_width . ';';
				}

				if (!empty($block_frame->padding)) {
					$style .= 'padding:' . $block_frame->padding . ';';
				}


				$style .= '}';
			}

			$style = preg_replace('/\r?\n|\r/', '', preg_replace('/\s*\{\s*/', '{', preg_replace('/\s*}\s*/', '}', preg_replace('/\s*;\s*/', ';', preg_replace('/\s*,\s*/', ',', preg_replace('/\s*:\s*/', ':', $style))))));
			wp_add_inline_style('kong_builder_css', $style);
		}
	}

	public function enqueue_scripts_callback() {
		$id = get_the_ID();

		if (self::post_type_is_accepted(get_post_type($id)) && !isset($_GET['kong-dnd-enable']) && get_post_meta($id, '_kong_pb_enable', true)) {
			$custom_js = get_post_meta($id, '_kong_pb_custom_js', true);

			if (!empty($custom_js)) {
				preg_match_all('/[\'\"][^\'\"(\r?\n|\r)]*\/\/[^\'\"(\r?\n|\r)]*[\'\"]/', $custom_js, $matches);
				$maps = array();

				if (!empty($matches[0])) {
					$count = 1;

					foreach ($matches[0] as $match) {
						$custom_js = str_replace($match, '@match' . $count, $custom_js);
						$maps['@match' . $count] = $match;
						$count++;
					}
				}

				$custom_js = preg_replace('/\/\/.*/', '', $custom_js);

				if (!empty($maps)) {
					foreach ($maps as $key => $match) {
						$custom_js = str_replace($key, $match, $custom_js);
					}
				}

				$custom_js = 'try{' . $custom_js . '}catch(error){console.log(error);}';
				$custom_js = preg_replace('/\r?\n|\r/', '', preg_replace('/\s*\{\s*/', '{', preg_replace('/\s*}\s*/', '}', preg_replace('/\s*;\s*/', ';', preg_replace('/\s*,\s*/', ',', preg_replace('/\s*:\s*/', ':', $custom_js))))));
				wp_add_inline_script('kong_builder_js', $custom_js);
			}
		}
	}

	public function register_admin_bar() {
		add_action('admin_bar_menu', array($this, 'toolbar_page_builder'), 992);
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

	public function toolbar_page_builder($wp_admin_bar) {
		$id = get_the_ID();

		if (self::post_type_is_accepted(get_post_type($id)) && is_singular()
				&& get_post_meta($id, '_kong_pb_enable', true)) {
			if (!$wp_admin_bar->get_node('builder_system')) {
				$wp_admin_bar->add_node(array(
					'id' => 'builder_system',
					'title' => '<span class="builder-system ab-item">Builder System</span>'
				));
			}

			$wp_admin_bar->add_node(array(
				'id' => 'page_builder_link',
				'parent' => 'builder_system',
				'title' => 'Page Builder',
				'href' => add_query_arg(array(
					'kong-pb-enable' => 1,
					'post_id' => get_the_ID()
				), get_admin_url(null, 'post.php'))
			));
		}
	}

	public function block_shortcode() {
		add_shortcode('kong_block', array($this, 'kong_block_callback'));
	}

	public function kong_block_callback($attrs) {
		$attrs = shortcode_atts(array(
			'id' => ''
		), $attrs);

		$html = '';

		if (get_post_type($attrs['id']) == 'kong_block' && get_post_status($attrs['id']) == 'publish') {
			$can_edit = current_user_can('edit_posts', get_the_ID());

			if ($can_edit) {
				$html .= '<div class="kong-admin__blockEditor">';
			}

			if (get_post_meta($attrs['id'], '_kong_pb_enable', true)) {
				$shortcodes = get_post_meta($attrs['id'], '_kong_pb_shortcodes', true);
				$shortcodes = preg_replace('/\[kong_block[^\]]*]/', '', $shortcodes);
				$styles = get_post_meta($attrs['id'], '_kong_pb_styles', true);
				$custom_css = get_post_meta($attrs['id'], '_kong_pb_custom_css', true);
				$custom_js = get_post_meta($attrs['id'], '_kong_pb_custom_js', true);
				$style = '';

				if (!is_array($styles)) {
					$styles = array();
				}

				if (!empty($styles['style'])) {
					$style .= $styles['style'];
				}

				$style .= $custom_css;

				ob_start(); ?>
				<?php echo do_shortcode($shortcodes); ?>

				<?php
				if (!empty($styles['link'])) :
					$i = 1;
					foreach ($styles['link'] as $link):
						?>
						<link type="text/css" rel="stylesheet" id="kong-block-link-<?php echo $i; ?>" href="<?php echo $link; ?>" media="all"/>
						<?php
						$i++;
					endforeach;
				endif;
				?>

				<?php if ($style) : ?>
					<style type="text/css"><?php echo $style; ?></style>
				<?php endif; ?>
				<?php if ($custom_js) : ?>
					<script type="text/javascript">try {<?php echo $custom_js; ?>
						} catch (error) {
							console.log(error);
						}</script>
				<?php endif; ?>
				<?php
				$html .= ob_get_clean();
				$edit_link =  add_query_arg(array('kong-pb-enable' => 1, 'post_id' => $attrs['id']), get_admin_url('post.php'));
			} else {
				$post = get_post($attrs['id']);
				$content = preg_replace('/\[kong_block[^\]]*]/', '', $post->post_content);
				$html .= do_shortcode($content);
				$edit_link = get_edit_post_link($attrs['id']);
			}

			if ($can_edit) {
				$html .= '<a href="'. $edit_link .'" target="_blank" class="kong-admin__blockEditor__label">';
				$html .= '<span>'.get_the_title($attrs['id']).'</span>';
				$html .= '<i class="fa fa-pencil"></i>';
				$html .= '</a>';
			}

			$html .= '<div class="kong-admin__blockEditor__edge"><span></span><span></span><span></span><span></span></div>';

			if ($can_edit) {
				$html .= '</div>';
			}
		}

		return $html;
	}

	public function body_class_filter() {
		add_filter('body_class', array($this, 'body_class_filter_callback'));
	}

	public function body_class_filter_callback($classes) {
		$id = get_the_ID();

		if (self::post_type_is_accepted(get_post_type($id)) && get_post_meta($id, '_kong_pb_enable', true)) {
			$classes[] = 'kong-page-builder';
		}

		return $classes;
	}
}

new KongPageBuilderClient();


