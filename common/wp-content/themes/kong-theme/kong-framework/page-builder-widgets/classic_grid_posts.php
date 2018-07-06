<?php
$manager = KongPageBuilderWidgetManager::getInstance();

$widget = array(
    "name" => "Classic Grid Posts",
    "tag" => "kong_fw_classic_grid_posts",
    "keywords" => ["posts","classic","grid"],
    "native" => false,
    "icon_url" => KONG_FW_ROOT."/page-builder-widgets/img/classic-grid-posts.png",
    "filter" => "other",
    "content" => [
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Content",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.num",
                    "attrs" => array(
                        "label" => "Number of Posts",
                        "type" => "number",
                        "config" => array(
                            "min" => 3,
                            "max" => 30,
                            "step" => 1
                        )
                    ),
                    "default_value" => 6
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.start",
                    "attrs" => array(
                        "label" => "Start",
                        "type" => "number",
                        "config" => array(
                            "min" => 1,
                            "max" => 100,
                            "step" => 1
                        )
                    ),
                    "default_value" => 1
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.categories",
                    "attrs" => array(
                        "label" => "Categories",
                        "type" => "multi-select",
                        "config" => array(
                            "message" => "Select Categories",
                            "list" => $category_obj
                        )
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.order",
                    "attrs" => array(
                        "label" => "Order",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "DESC" => "Descending",
                                "ASC" => "Ascending"
                            )
                        )
                    ),
                    "default_value" => "DESC"
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.custom_style",
                    "attrs" => array(
                        "label" => "Custom Style",
                        "type" => "switch"
                    ),
                    "default_value" => false
                )
            ]
        ),
        array(
            "if" => "@attrs.custom_style",
            "content" => [
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Box",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.column",
                            "attrs" => array(
                                "label" => "Number of Columns",
                                "type" => "text-buttons",
                                "config" => array(
                                    "options" => array(
                                        "2" => "2",
                                        "3" => "3",
                                        "4" => "4",
                                        "5" => "5",
                                        "6" => "6"
                                    ),
                                    "class" => "column"
                                )
                            ),
                            "default_value" => "4"
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.distance",
                            "attrs" => array(
                                "label" => "Item Distance",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 3,
                                    "max" => 50,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 15,
                            "styles" => array(
                                "@id .kong-bcgi" => array(
                                    "padding" => "0 {{@model}}px"
                                ),
                                "@id .kong-blogClassicGrid__wrap" => array(
                                    "margin" => "0 -{{@model}}px"
                                ),
                                "@id .kong-blogClassicGrid" => array(
                                    "margin" => "0 -{{@model}}px",
                                    "padding" => "0 {{@model}}px"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Image",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.image",
                            "attrs" => array(
                                "label" => "Height",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 20,
                                    "max" => 150,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 56
                            ),
                            "responsive_styles" => array(
                                "@id .kong-bcgi__img" => array(
                                    "paddingBottom" => "{{@model}}%"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.image_radius",
                            "attrs" => array(
                                "label" => "Border Radius",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 20,
                                    "step" => 1
                                )
                            ),
                            "default_value" => 0,
                            "styles" => array(
                                "@id .kong-bcgi__img" => array(
                                    "borderRadius" => "{{@model}}px"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Spacing",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.spacing",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "res-area",
                                "config" => array(
                                    "min" => 0,
                                    "max" => 150,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "15px 0px 20px 0px"
                            ),
                            "responsive_styles" => array(
                                "@id .kong-bcgi__content" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Category & Author",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.cat_color",
                            "attrs" => array(
                                "label" => "Category",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["desc"],
                            "styles" => array(
                                "@id .kong-bcgi__cats a" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.author_color",
                            "attrs" => array(
                                "label" => "Author",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["desc"],
                            "styles" => array(
                                "@id .kong-bcgi__author" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Title",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_size",
                            "attrs" => array(
                                "label" => "Font Size",
                                "type" => "res-slider",
                                "config" => array(
                                    "min" => 10,
                                    "max" => 60,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => 22
                            ),
                            "responsive_styles" => array(
                                "@id .kong-bcgi__title" => array(
                                    "fontSize" => "{{@model}}px"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["heading"],
                            "styles" => array(
                                "@id .kong-bcgi__title a" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_hover_color",
                            "attrs" => array(
                                "label" => "Hover Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["primary"],
                            "styles" => array(
                                "@id .kong-bcgi__title:hover a" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_margin",
                            "attrs" => array(
                                "label" => "Margin",
                                "type" => "res-area2",
                                "config" => array(
                                    "min" => -100,
                                    "max" => 200,
                                    "step" => 1
                                )
                            ),
                            "default_value" => array(
                                "desktop" => "5px 0px 10px 0px"
                            ),
                            "responsive_styles" => array(
                                "@id .kong-bcgi__title" => array(
                                    "margin" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_weight",
                            "attrs" => array(
                                "label" => "Weight",
                                "type" => "slider",
                                "config" => array(
                                    "min" => 100,
                                    "max" => 900,
                                    "step" => 100
                                )
                            ),
                            "default_value" => 700,
                            "styles" => array(
                                "@id .kong-bcgi__title a" => array(
                                    "fontWeight" => "{{@model}}"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_letter_spacing",
                            "attrs" => array(
                                "label" => "Letter Spacing",
                                "type" => "slider",
                                "config" => array(
                                    "min" => -0.1,
                                    "max" => 0.5,
                                    "step" => 0.01
                                )
                            ),
                            "default_value" => 0,
                            "styles" => array(
                                "@id .kong-bcgi__title a" => array(
                                    "letterSpacing" => "{{@model}}em"
                                )
                            )
                        ),
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.title_transform",
                            "attrs" => array(
                                "label" => "Text Transform",
                                "type" => "text-transform"
                            ),
                            "default_value" => "uppercase",
                            "styles" => array(
                                "@id .kong-bcgi__title a" => array(
                                    "textTransform" => "{{@model}}"
                                )
                            )
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Excerpt",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.excerpt_enable",
                            "attrs" => array(
                                "label" => "Enable",
                                "type" => "switch"
                            ),
                            "default_value" => false
                        ),
                        array(
                            "if" => "@attrs.excerpt_enable",
                            "content" => [
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.excerpt_size",
                                    "attrs" => array(
                                        "label" => "Font Size",
                                        "type" => "res-slider",
                                        "config" => array(
                                            "min" => 10,
                                            "max" => 60,
                                            "step" => 1
                                        )
                                    ),
                                    "default_value" => array(
                                        "desktop" => 14
                                    ),
                                    "responsive_styles" => array(
                                        "@id .kong-bcgi__excerpt" => array(
                                            "fontSize" => "{{@model}}px"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.excerpt_line_height",
                                    "attrs" => array(
                                        "label" => "Line Height",
                                        "type" => "slider",
                                        "config" => array(
                                            "min" => 0.5,
                                            "max" => 3,
                                            "step" => 0.1
                                        )
                                    ),
                                    "default_value" => 1.5,
                                    "styles" => array(
                                        "@id .kong-bcgi__excerpt" => array(
                                            "lineHeight" => "{{@model}}em"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.excerpt_margin",
                                    "attrs" => array(
                                        "label" => "Margin",
                                        "type" => "res-area2",
                                        "config" => array(
                                            "min" => -100,
                                            "max" => 100,
                                            "step" => 1
                                        )
                                    ),
                                    "default_value" => array(
                                        "desktop" => "0px 0px 20px 0px"
                                    ),
                                    "responsive_styles" => array(
                                        "@id .kong-bcgi__excerpt" => array(
                                            "margin" => "{{@model}}"
                                        )
                                    )
                                ),
                                array(
                                    "tag" => "editor-field",
                                    "bind_to" => "@attrs.excerpt_color",
                                    "attrs" => array(
                                        "label" => "Color",
                                        "type" => "colorpicker"
                                    ),
                                    "default_value" => $manager::$colors["text"],
                                    "styles" => array(
                                        "@id .kong-bcgi__excerpt" => array(
                                            "color" => "{{@model}}"
                                        )
                                    )
                                )
                            ]
                        )
                    ]
                ),
                array(
                    "tag" => "editor-container",
                    "attrs" => array(
                        "label" => "Author",
                        "collapsed" => false
                    ),
                    "content" => [
                        array(
                            "tag" => "editor-field",
                            "bind_to" => "@attrs.author_color",
                            "attrs" => array(
                                "label" => "Color",
                                "type" => "colorpicker"
                            ),
                            "default_value" => $manager::$colors["desc"],
                            "styles" => array(
                                "@id .kong-bcgi__author" => array(
                                    "color" => "{{@model}}"
                                )
                            )
                        )
                    ]
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Paging",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.paging",
                    "attrs" => array(
                        "label" => "Paging",
                        "type" => "text-buttons",
                        "config" => array(
                            "options" => array(
                                "none" => "None",
                                "button" => "Button",
                                "infinite" => "Infinite"
                            )
                        )
                    ),
                    "default_value" => "none"
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "Hidden on",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.hidden",
                    "attrs" => array(
                        "label" => "Devices",
                        "type" => "device-hidden"
                    ),
                    "default_value" => ""
                )
            ]
        ),
        array(
            "tag" => "editor-container",
            "attrs" => array(
                "label" => "ID & Class",
                "collapsed" => false
            ),
            "content" => [
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.class",
                    "attrs" => array(
                        "label" => "Class",
                        "type" => "class"
                    ),
                    "default_value" => ""
                ),
                array(
                    "tag" => "editor-field",
                    "bind_to" => "@attrs.id",
                    "attrs" => array(
                        "label" => "ID",
                        "type" => "id"
                    ),
                    "default_value" => ""
                )
            ]
        )
    ]
);

ob_start();
?>
<div class="kong-classic-grid-posts {{::$ctrl.getID()}}"
     ng-class="[$ctrl.edited.attrs.class, $ctrl.edited.attrs.hidden]"
     id="{{$ctrl.edited.attrs.id}}">
    <kong-shortcode tag="kong_fw_classic_grid_posts_content" model="$ctrl.edited"
                     attrs="['num', 'start', 'categories', 'order', 'excerpt_enable', 'paging', 'custom_style', 'column']"
                     callback="[{'function':'kongLazyImage','selector':'.kong-blogClassicGrid'}]"></div>
<?php
$widget['visual_view'] = ob_get_clean();

$manager->add($widget);


add_shortcode('kong_fw_classic_grid_posts', 'kong_fw_classic_grid_posts_callback');
function kong_fw_classic_grid_posts_callback($attrs) {
    $attrs = shortcode_atts(array(
        'class_id' => '',
        'class' => '',
        'id' => '',
        'hidden' => '',
        'num' => 6,
        'order' => 'DESC',
        'categories' => '',
        'paging' => 'none',
        'custom_style' => 'false',
        'start' => 1,
        'excerpt_enable' => 'false',
        'column' => 4
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $classes = array();

    if ($attrs['class']) {
        $classes[] = $attrs['class'];
    }

    if ($attrs['hidden']) {
        $classes[] = $attrs['hidden'];
    }

    $classes[] = $attrs['class_id'];
    $id = $attrs['id'] ? ' id="' . $attrs['id'] . '"' : '';

    ob_start(); ?>
    <div class="kong-classic-grid-posts <?php echo implode(' ', $classes); ?>"<?php echo $id; ?>>
        <?php echo do_shortcode('[kong_fw_classic_grid_posts_content num="' . $attrs['num'] . '" column="' . $attrs['column'] . '" start="' . $attrs['start'] . '" order="' . $attrs['order'] . '" categories="' . $attrs['categories'] . '" paging="' . $attrs['paging'] . '" custom_style="' . $attrs['custom_style'] . '" excerpt_enable="' . $attrs['excerpt_enable'] . '"]'); ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('kong_fw_classic_grid_posts_content', 'kong_fw_classic_grid_posts_content_callback');
function kong_fw_classic_grid_posts_content_callback($attrs) {
    $attrs = shortcode_atts(array(
        'num' => 6,
        'order' => 'DESC',
        'categories' => '',
        'paging' => 'none',
        'custom_style' => 'false',
        'start' => 1,
        'excerpt_enable' => 'false',
        'column' => 4
    ), $attrs, KongPageBuilderClient::KONG_SHORTCODE_ATTS_FILTER);

    $categories = array();
    $offset = $attrs['start'] - 1;

    $args = array(
        'numberposts' => $attrs['num'] + 1,
        'order' => $attrs['order'],
        'offset' => $offset
    );

    if (!empty($attrs['categories'])) {
        $attrs['categories'] = explode(',', $attrs['categories']);

        foreach ($attrs['categories'] as $category_id) {
            $categories[] = (int)$category_id;
        }

        $args['category__in'] = $categories;
    }

    $posts = get_posts($args);

    global $post;
    $has_paging = false;

    if (count($posts) > $attrs['num']) {
        $has_paging = true;
        array_pop($posts);
    }

    $options = kong_fw_get_options();

    if (kong_fw_theme_to_boolean($attrs['custom_style'])) {
        $excerpt_enable = kong_fw_theme_to_boolean($attrs['excerpt_enable']);
        $column = $attrs['column'];
    } else {
        $excerpt_enable = !empty($options['blog_classic_grid_excerpt_enable']);
        $column = !(empty($options['blog_classic_grid_column'])) ? $options['blog_classic_grid_column'] : '';
    }

    ob_start(); ?>
    <div class="kong-blog kong-blogClassicGrid" data-column="<?php echo $column; ?>">
        <div class="kong-blogClassicGrid__wrap">
            <?php
            if (!empty($posts)) :
                foreach ($posts as $post) :
                    setup_postdata($post);
                    kong_fw_classic_grid_post_item_render(array(
                        'excerpt_enable' => $excerpt_enable
                    ));

                endforeach;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>

    <?php
    if ($attrs['paging'] != 'none' && $has_paging) {
        $data = array();

        if (!empty($categories)) {
            $data['type'] = 'category';
            $data['data'] = $categories;
        } else {
            $data['type'] = 'posts';
        }

        switch($attrs['paging']):
            case 'button':
                kong_fw_load_more_button_render(array(
                    'settings' => array(
                        'limit' => $attrs['num'],
                        'offset' => $offset + $attrs['num'],
                        'orderby' => 'date',
                        'order' => $attrs['order'],
                        'data' => $data,
                        'type' => 'classic-grid',
                        'append_to' => '.kong-blogClassicGrid__wrap',
                        'text' => !empty($options['blog_loadmore_text']) ? $options['blog_loadmore_text'] : '',
                        'loading_text' => !empty($options['blog_loadmore_loading_text']) ? $options['blog_loadmore_loading_text'] : '',
                        'load_all_text' => !empty($options['blog_loadmore_load_all_text']) ? $options['blog_loadmore_load_all_text'] : ''
                    ),
                    'custom_settings' => array(
                        'excerpt_enable' => $excerpt_enable,
                    ),
                    'custom_class' => 'kong-blog__loadMoreBtn'
                ));

                break;
            case 'infinite':
                kong_fw_infinite_scroller_render(array(
                    'settings' => array(
                        'limit' => $attrs['num'],
                        'offset' => $offset + $attrs['num'],
                        'orderby' => 'date',
                        'order' => $attrs['order'],
                        'data' => $data,
                        'append_to' => '.kong-blogClassicGrid__wrap',
                        'type' => 'classic-grid'
                    ),
                    'custom_settings' => array(
                        'excerpt_enable' => $excerpt_enable
                    ),
                    'custom_class' => 'kong-blog__infiniteScroller'
                ));

                break;
            default:
                break;
        endswitch;
    }

    return ob_get_clean();
}