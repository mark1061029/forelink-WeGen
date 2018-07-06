<?php

abstract class KongMenuItem {

	protected $type = 'unknown';
	protected $output;
	protected $item;
	protected $depth;
	protected $args;
	protected $id;
	protected $walker;
	protected $submenu_tag = 'ul';
	protected $classes = array();
	protected $has_children = false;
	protected $type_label;
	protected $parent_type_label;

	function __construct(&$output, &$item, $depth = 0, &$args = array(), $id = 0, &$walker, $has_children = false, $parent_type_label = '') {
		$this->output 	= &$output;
		$this->item 	= &$item;
		$this->depth 	= $depth;
		$this->args 	= (object)$args;
		$this->id 		= $id;
		$this->walker 	= &$walker;
		$this->has_children = $has_children;
		$this->type_label = $item->type_label;
		$this->parent_type_label = $parent_type_label;

		if (isset($item->has_row) && $item->has_row) {
			$this->submenu_tag = 'div';
		}
	}

	function start_el() {
		$this->output .= $this->get_start_el();
	}

	function end_el() {
		$this->output .= $this->get_end_el();
	}

	function start_lvl() {
		$this->output .= $this->get_submenu_wrap_start();
	}

	function end_lvl() {
		$this->output .= $this->get_submenu_wrap_end();
	}

	abstract function get_start_el();

	function get_end_el() {
		$output = '</li>';
		return $output;
	}

	function get_submenu_wrap_start() {
		$class = 'kong-menu-submenu kong-menu-submenu-id-' . $this->item->ID;

		if ($this->depth == 0) {
			$class .= ' kong-menu-dropdown';
		}

		if (isset($this->item->has_row) && $this->item->has_row) {
			$class .= ' kong-menu-section';
		}

		$output = "<$this->submenu_tag class='$class'>";

		return $output;

	}

	function get_submenu_wrap_end() {
		$output = "</$this->submenu_tag>";

		return $output;
	}

	function add_class_defaults() {
		if (is_array($this->item->classes)) {
			$this->classes = array_merge($this->classes, $this->item->classes);
		}
	}

	function add_class_id() {
		$this->classes[] = 'menu-item-' . $this->item->ID;
	}

	function add_prefix_classes() {
		foreach($this->classes as $k => $class){
			if($class) {
				if(substr($class, 0, 4) == 'menu') {
					$this->classes[$k] = 'kong-' . $class;
				} else {
					$this->classes[$k] = 'kong-menu-' . $class;
				}
			}
		}
	}

	function add_class_level(){
		$this->classes[] = 'kong-menu-item-level-' . $this->depth;
	}

	function add_class($class) {
		$this->classes[] = $class;
	}

	function get_item_classes() {
		$classes = join(' ', apply_filters('nav_menu_css_class', array_filter( $this->classes), $this->item, $this->args));
		$classes = $classes ? ' class="' . esc_attr($classes) . '"' : '';
		return $classes;
	}

	function get_item_id() {
		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $this->item->ID, $this->item, $this->args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		return $id;
	}

	function get_anchor_atts() {
		$atts = array();
		$atts['class']	= 'kong-menu-anchor';
		$atts['title']  = !empty($this->item->attr_title) ? $this->item->attr_title : '';
		$atts['target'] = !empty($this->item->target) ? $this->item->target : '';
		$atts['rel']    = !empty($this->item->xfn) ? $this->item->xfn : '';
		$atts['href']   = !empty($this->item->url) ? $this->item->url : '';

		$atts = apply_filters('nav_menu_link_attributes', $atts, $this->item, $this->args);

		return $atts;
	}

	function get_anchor($atts) {

		// Icon
		$icon = '';
		$icon_class = get_post_meta($this->item->ID, '_kong_menu_item_icon', true);

		if (!empty($icon_class)) {
			$icon = '<i class="fa ' . $icon_class . '"></i>';
		}

		// Arrow
		$arrow = '';

		if ($this->has_children && (!property_exists($this->args, 'depth') || $this->args->depth != 1)) {
			$arrow .= ' <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-right" aria-hidden="true"></i>';
		}

		// Emphasis
		$emphasis = '';

		if ($this->depth > 0) {
			$emphasis_label = sanitize_text_field(get_post_meta($this->id, '_kong_menu_item_emphasis', true));

			if (!empty($emphasis_label)) {
				$emphasis = '<em>' . $emphasis_label . '</em>';
			}
		}

		// Title
		$title = '<span class="kong-menu-anchor-title">';
		$title .= apply_filters('the_title', $this->item->title, $this->item->ID);
		$title .= $emphasis;
		$title .= $arrow;
		$title .= '</span>';

		// Attributes
		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (!empty($value) || $value === 0) {
				$value = ('href' == $attr) ? esc_url($value) : esc_attr($value);

				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$output = $this->args->before;
		$output .= '<a' . $attributes . '>';
		$output .= $this->args->link_before;

		$output.= $icon . $title;

		$output .= $this->args->link_after;
		$output .= '</a>';
		$output .= $this->args->after;

		return $output;
	}

	function get_type_label() {
		return $this->type_label;
	}

}