<?php

class KongPageBuilderWidgetManager
{
	protected static $instance = null;
	public static $dirs = array();
	public static $rest_url = '';

	public static $colors = array(
			'primary' => '#44D284',
			'heading' => '#32435c',
			'border' => '#dddddd',
			'desc' => '#999999',
			'text' => '#444444',
			'primary_context' => '#ffffff',
			'body' => '#ffffff',
			'body_diff' => '#fafafa'
	);

	public static $text = array(
			'heading' => 'Build Websites Fast & Furious',
			'paragraph' => 'No more wasting time of switching between backend and frontend. Instantly check your site while editing'
	);

	private static $widgets = [];

	protected function __construct()
	{
	}

	public static function add($widget)
	{
		if(array_key_exists('native',$widget) && $widget['native']){
			$widget['icon_url'] = static::$dirs['img'].(str_replace('_', '-', $widget['tag'])).'.png';
		}else if(!array_key_exists('icon_url', $widget)){
			$widget['icon_url'] = static::$dirs['img'].'default.png';
		}
		self::$widgets[] = $widget;
	}

	public static function fetch(){
		return json_encode(self::$widgets);
	}

	public static function getInstance()
	{
		if (!isset(static::$instance)) {
			static::$instance = new static;

			static::$dirs = array(
				'client_img' => KONG_CORE_ROOT.'/client/img',
				'img' => KONG_PB_DIR.'/img/widgets/'
			);

			$options = get_option('kongOptions');
			if(!empty($options) && is_array($options)){
				if (!empty($options['widget_primary_color'])) {
					static::$colors['primary'] = $options['widget_primary_color'];
				}

				if (!empty($options['widget_primary_context_color'])) {
					static::$colors['primary_context'] = $options['widget_primary_context_color'];
				}

				if (!empty($options['widget_heading_color'])) {
					static::$colors['heading'] = $options['widget_heading_color'];
				}

				if (!empty($options['widget_border_color'])) {
					static::$colors['border'] = $options['widget_border_color'];
				}

				if (!empty($options['widget_desc_color'])) {
					static::$colors['desc'] = $options['widget_desc_color'];
				}

				if (!empty($options['widget_text_color'])) {
					static::$colors['text'] = $options['widget_text_color'];
				}
			}
		}
		return static::$instance;
	}
}