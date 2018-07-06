<?php
$options = kong_fw_get_options();
$excerpt_enable = !empty($options['blog_classic_grid_excerpt_enable']);
?>
<div class="kong-blog kong-blogClassicGrid" data-column="<?php echo !(empty($options['blog_classic_grid_column'])) ? $options['blog_classic_grid_column'] : ''; ?>">
    <div class="kong-blogClassicGrid__wrap">
        <?php
        $count = 0;
        while (have_posts()) : the_post();
            $count++;
            kong_fw_classic_grid_post_item_render(array(
                'excerpt_enable' => $excerpt_enable
            ));
        endwhile; ?>
    </div>
</div><!-- blog classic grid -->

<?php
$per_page = get_option('posts_per_page');

if (!empty($options['blog_paging_style'])) {
    if ($options['blog_paging_style'] == 'pagination') {
        if ($wp_query->found_posts > $per_page) {
            echo kong_fw_generate_pagination(2, array('pagination_position' => $options['pagination_position']));
        }
    } else {
        if ($wp_query->found_posts > $count) {
            $data = kong_fw_blog_get_paging_data();

            if ($options['blog_paging_style'] == 'button') {
                $config = array(
                    'settings' => array(
                        'limit' => $per_page,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'data' => $data,
                        'type' => 'classic-grid',
                        'append_to' => '.kong-blogClassicGrid__wrap',
                        'text' => !empty($options['blog_loadmore_text']) ? $options['blog_loadmore_text'] : '',
                        'loading_text' => !empty($options['blog_loadmore_loading_text']) ? $options['blog_loadmore_loading_text'] : '',
                        'load_all_text' => !empty($options['blog_loadmore_load_all_text']) ? $options['blog_loadmore_load_all_text'] : ''
                    ),
                    'custom_settings' => array(
                        'excerpt_enable' => $excerpt_enable
                    ),
                    'custom_class' => 'kong-blog__loadMoreBtn'
                );

                kong_fw_load_more_button_render($config);
            } else {
                $config = array(
                    'settings' => array(
                        'limit' => $per_page,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'data' => $data,
                        'append_to' => '.kong-blogClassicGrid__wrap',
                        'type' => 'classic-grid'
                    ),
                    'custom_settings' => array(
                        'excerpt_enable' => $excerpt_enable
                    ),
                    'custom_class' => 'kong-blog__infiniteScroller'
                );

                kong_fw_infinite_scroller_render($config);
            }
        }
    }
}