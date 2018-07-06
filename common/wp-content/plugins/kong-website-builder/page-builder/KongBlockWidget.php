<?php

class KongBlockWidget extends WP_Widget {

	public function __construct() {
		parent::__construct('kong_block_widget', 'Kong Block');
	}

	public function widget($args, $instance) {
		echo $args['before_widget'];

		if ($instance['title']) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		echo do_shortcode('[kong_block id="' . $instance['id'] . '"]');
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags(absint($new_instance['id']));

		return $instance;
	}

	public function form($instance) {
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$id = !empty($instance['id']) ? $instance['id'] : '';

		$blocks = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'kong_block',
			'post_status' => 'publish',
			'order' => 'ASC'
		));
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
		</p>

		<p>
			<?php
				$edit_link = add_query_arg(array(
					'post' => '@block_id',
					'action' => 'edit'
				), get_admin_url('', 'post.php'));
			?>
			<label for="<?php echo $this->get_field_id('id'); ?>">Block:</label>
			<select onchange="generate_edit_link(this);" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>">
				<option value="">Select a block</option>
				<?php
					if (!empty($blocks)) :
						foreach ($blocks as $block) :
							$selected = ($id == $block->ID) ? ' selected="selected"' : '';
				?>
				<option value="<?php echo $block->ID; ?>"<?php echo $selected; ?>><?php echo $block->post_title; ?></option>
				<?php
						endforeach;
					endif;
				?>
			</select>
			<script type="text/javascript">
				function generate_edit_link(element) {
					var block_id = element.value;
					var edit_block = jQuery(element).parent().parent().find('.kong-edit-block');
					var edit_link = '<?php echo $edit_link; ?>';

					if (!block_id) {
						edit_block.css('display', 'none');
						edit_block.find('a').attr('href', '#');
					} else {
						edit_block.css('display', 'block');
						edit_block.find('a').attr('href', edit_link.replace('@block_id', block_id));
					}
				}
			</script>
		</p>

		<?php
			if (!$id) {
				$display = ' style="display: none;"';
				$link = '#';
			} else {
				$display = ' style="display: block;"';
				$link = str_replace('@block_id', $id, $edit_link);
			}
		?>
		<p class="kong-edit-block"<?php echo $display; ?>>
			<a href="<?php echo $link; ?>" target="_blank">Edit this block</a>
		</p>
		<?php
	}

}