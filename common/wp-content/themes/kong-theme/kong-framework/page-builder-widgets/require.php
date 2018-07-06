<?php

if(class_exists('KongPageBuilderWidgetManager')){
    $category_obj = new stdClass();
    $categories = get_categories(array(
        'hide_empty' => false
    ));

    if (!empty($categories)) {
        foreach ($categories as $category) {
            $category_obj->{$category->term_id} = new stdClass();
            $category_obj->{$category->term_id}->name = $category->name;
        }
    }

    require_once 'classic_grid_posts.php';
    require_once 'hero_slide_posts.php';
    require_once 'metro_posts.php';
}
?>