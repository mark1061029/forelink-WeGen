<?php

function kong_get_identify_code($text){
    return md5($text . '-kong-' . $text);
}

function kong_to_boolean($val) {
    return filter_var($val, FILTER_VALIDATE_BOOLEAN);
}

function kong_get_option() {
    $options = get_option('kongOptions');
    return !empty($options) && is_array($options) ? $options : array();
}

function kong_get_menu_content($menu_id, $type = '', $depth = 0) {
    $menu_items = wp_get_nav_menu_items($menu_id);

    if (!empty($menu_items)) {
        return wp_nav_menu(array(
            'menu' => $menu_id,
            'echo' => false,
            'container' => '',
            'type' => $type,
            'depth' => $depth
        ));
    }

    return '';
}

function kong_get_attachment_srcset($attachment_id) {
    $srcset = '';
    $image = wp_get_attachment_image_src($attachment_id, 'full');
    if ($image) {
        list($src, $width, $height) = $image;
        $image_meta = wp_get_attachment_metadata($attachment_id);

        if (is_array($image_meta)) {
            $size_array = array(absint($width), absint($height));
            $srcset = wp_calculate_image_srcset($size_array, $src, $image_meta, $attachment_id);

        }
    }

    return $srcset;
}

function kong_get_attachment_id_from_url($url) {
    global $wpdb;

    if ($url) {
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url));
        return !empty($attachment[0]) ? $attachment[0] : false;
    }

    return false;
}

function kong_get_image_sizes($data){
    $sizes = '';

    if (!empty($data['desktop']) && !empty($data['tablet']) && !empty($data['mobile'])) {
        $desktop = $data['desktop'];
        $tablet = $data['tablet'];
        $mobile = $data['mobile'];

        if ($desktop == $tablet && $tablet == $mobile) {
            $sizes = $desktop;
        } else {
            if ($mobile == $tablet) {
                $sizes .= '(max-width:768px) ' . $mobile . ', ' . $desktop;
            } else {
                $sizes .= '(max-width:512px) ' . $mobile . ', ';
                if ($tablet == $desktop) {
                    $sizes .= $desktop;
                } else {
                    $sizes .= '(max-width:768px) ' . $tablet . ', ' . $desktop;
                }
            }
        }
    }

    return $sizes;
}

function kong_form_res_class($obj, $prefix, $suffix='') {
    $cl = '';

    if($suffix != ''){
        $suffix = $suffix.'-';
    }
    if($obj['desktop']){
        $cl = $prefix . '--'.$suffix. $obj['desktop'];
    }

    if (isset($obj['tablet'])) {
        $cl .= ' ' . $prefix . '--tb-'.$suffix . $obj['tablet'];
    }

    if (isset($obj['mobile'])) {
        $cl .= ' ' . $prefix . '--mb-'.$suffix . $obj['mobile'];
    }

    return trim($cl);
}

function kong_form_parallax_data($obj) {
    if(kong_to_boolean($obj['enable'])){
        $attrs = array('x' => 0, 'y' => 0, 'z' => 0, 'rotateX' => 0, 'rotateY' => 0, 'rotateZ' => 0, 'scale' => 1);

        foreach($attrs as $key => $ignore){
            if(!empty($obj[$key]) && $obj[$key] == $ignore){
                unset($obj[$key]);
            }
        }

        if(count($obj) > 1){
            unset($obj['enable']);
            return ' data-parallax="'.esc_attr(json_encode($obj)).'"';
        }
    }

    return '';
}

function kong_form_animation_data($obj) {
    if(kong_to_boolean($obj['enable'])){
        $attrs = array('distance' => '20px', 'delay' => 0, 'origin' => 'bottom', 'viewFactor' => 0.2, 'reset' => false, 'rotate' => array('x' => 0, 'y' => 0, 'z' => 0), 'scale' => 0.9, 'opacity' => 1);

        foreach($attrs as $key => $ignore){
            if(!empty($obj[$key]) && $obj[$key] == $ignore){
                unset($obj[$key]);
            }
        }

        if(count($obj) > 1){
            unset($obj['enable']);
            return ' data-animation="'.esc_attr(json_encode($obj)).'"';
        }
    }

    return '';
}

function kong_get_uploaded_image_url_queries($image, $method = 'load') {
    $html = '';
    if (!empty($image['url'])) {
        $urls = !empty($image['sizes']) ? $image['sizes'] : array("full" => $image['url']);

        $data_method = '';
        if(!empty($method) && $method != 'scroll-to-load'){
            $data_method = ' data-method="' . $method . '"';
        }

        $html = '<div class="kong-lazyImage" data-src="' . esc_attr(json_encode($urls)) . '"' . $data_method . '></div>';
    }

    return $html;
}
?>