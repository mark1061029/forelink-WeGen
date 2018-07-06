<?php
$options = kong_fw_get_options();
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title lc-h kong--eBold">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( __( '1 comment', 'kong' ) );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx('%1$s comment', '%1$s comments', $comments_number, '', 'kong'),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
					'callback' => 'kong_fw_custom_comment_list'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments lc-d"><?php _e( 'Comments are closed.', 'kong' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');

		comment_form(array(
			'class_form' => 'comment-form comment-form--hasBorder',
			'comment_field' => '<div class="comment-form-comment"><label class="kong--bold" for="comment">' . _x('Comment', 'noun', 'kong') .
								'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
								'</textarea></div>',
			'fields' => array(
					'author' => '<div class="kong-row comment-form-fields"><div class="kong-column kong-col-sm-1-3 comment-form-author"><label class="kong--mBold" for="author">' . __('Name', 'kong') . ($req ? '<span class="required">*</span>' : "").'</label> '.
							'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
							'" size="30"' . $aria_req . ' /></div>',

					'email' => '<div class="kong-column kong-col-sm-1-3 comment-form-email"><label class="kong--bold" for="email">' . __('Email', 'kong') .($req ? '<span class="required">*</span>' : '') .'</label> ' .
							'<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
							'" size="30"' . $aria_req . ' /></div>',

					'url' => '<div class="kong-column kong-col-sm-1-3 comment-form-url"><label class="kong--bold" for="url">' . __('Website', 'kong') . '</label>' .
							'<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
							'" size="30" /></div></div>',
			),
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title kong--eBold">',
			'title_reply_after'  => '</h2>',
		));
	?>

</div><!-- .comments-area -->

<?php

function kong_fw_custom_comment_list($comment, $args, $depth) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<footer class="kong-vCard">

			<?php
			if ( 0 != $args['avatar_size'] && get_avatar( $comment, $args['avatar_size'] )):
				echo '<div class="comment-avatar">';
				$url = get_avatar_url( $comment, $args['avatar_size'] );
				echo kong_fw_get_avatar('', $url);
				echo '</div>';
			endif;
			?>

			<div class="comment-metadata">
				<?php printf( sprintf( '<div class="comment-author kong--bold lc-h lcs-h-p">%s</div>', get_comment_author_link() ) ); ?>
				<div class="comment-time kong--subLinks">
					<time class="lc-d" datetime="<?php comment_time( 'c' ); ?>">
						<?php printf( _x( '%1$s', '1: date', 'kong' ), get_comment_date('M d, Y') ); ?>
					</time>
					<?php edit_comment_link( __( 'Edit', 'kong' ), '<span class="edit-link lch-d-h kong--marginLeft5">', '</span>' ); ?>
				</div>
			</div><!-- .comment-metadata -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kong' ); ?></p>
			<?php endif; ?>
		</footer><!-- .comment-meta -->

		<div class="comment-content kong-entry">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php
		comment_reply_link( array_merge( $args, array(
				'add_below' => 'div-comment',
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<div class="reply">',
				'after'     => '</div>'
		) ) );
		?>
	</article><!-- .comment-body -->
<?php

}