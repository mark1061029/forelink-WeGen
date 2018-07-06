<?php

class KongOptionsManager
{
    protected static $instance = null;
    public static $dirs = array();

    public static $colors = array(
        "primary" => "#316FEA",
        "heading" => "#101010",
        "primary_context" => "#ffffff",
        "text" => "#6D6D6F",
        "desc" => "#9a9a9a",
        "border" => "#dddddd",
        "border_secondary" => "#cccccc",
        "body" => "#ffffff",
        "body_diff" => "#fafafa",
        "boxed_item" => "#ffffff",
        "pre_bg" => "#f5f5f5",
        "pre_color" => "#2b2e3b",
        "pre_border" => "#cccccc",
        "code_bg" => "#EAF1FD",
        "code_color" => "#316FEA",
        "overlay_bg" => "rgba(0,0,0,0.5)",
        "overlay_primary" => "#ffffff",
        "overlay_text" => "#e8e8e8",
        "overlay_link" => "#b9c4cc",
        "overlay_desc" => "#c2c4c6"
    );

    private static $panels = array();

    protected function __construct()
    {
    }

    public static function addPanel($name, $model, $position = 99)
    {
        if(!array_key_exists($name, self::$panels)){
            if(!is_int($position)){
                $position = 99;
            }

            $model['position'] = $position;

            self::$panels[$name] = $model;
        }
    }

    public static function addChildPanel($name, $parentPanelName, $model)
    {
        if(array_key_exists($parentPanelName, self::$panels)){
            if(!array_key_exists('childs', self::$panels[$parentPanelName])){
                self::$panels[$parentPanelName]['childs'] = array();
            }

            self::$panels[$parentPanelName]['childs'][$name] = $model;
        }
    }

    public static function fetch($side){
        $map = array();
        $options = kong_get_option();
        $modules = array_key_exists('exclude_modules', $options) ? $options['exclude_modules'] : array();

        foreach (self::$panels as $panelName => $panel) {
            if(($side == 'frontend' && (!array_key_exists('core', $panel) || (array_key_exists('core', $panel) && !$panel['core']))) && is_int(array_search($panelName, $modules)) ||
                (array_key_exists('side', $panel) && $panel['side'] != $side)){
                continue;
            }

            if(array_key_exists('childs', $panel) && count($panel['childs'])){
                $map[$panelName] = array();
                $map[$panelName]['childs'] = [];

                foreach($panel['childs'] as $childPanelName => $childPanel){
                    if(($side == 'frontend' && (!array_key_exists('core', $childPanel) || (array_key_exists('core', $childPanel) && !$childPanel['core']))) && is_int(array_search($childPanelName, $modules)) ||
                        (array_key_exists('side', $childPanel) && $childPanel['side'] != $side)){
                        continue;
                    }
                    $map[$panelName]['childs'][$childPanelName] = $childPanel;
                }

                if(!count($map[$panelName]['childs'])) {
                    unset($map[$panelName]);
                    continue;
                };

                foreach($panel as $prop => $content){
                    if($prop != 'childs'){
                        $map[$panelName][$prop] = $content;
                    }
                }
            }else if(!array_key_exists('childs', $panel)){
                $map[$panelName] = $panel;
            }
        }

        $positions = array();
        foreach($map as $name => $panel){
            $positions[$name] = $panel['position'];
        }
        asort($positions, SORT_NUMERIC);
        $sortMap = array();
        foreach($positions as $name => $position){
            $sortMap[$name] = $map[$name];
        }

        return json_encode($sortMap);
    }


    public static function getFrontendModules(){
        $modules = array();

        foreach (self::$panels as $panelName => $panel) {
            if((!array_key_exists('side',$panel) || (array_key_exists('side',$panel) && $panel['side'] == 'frontend'))
                && (!array_key_exists('core',$panel) || (array_key_exists('core',$panel) && !$panel['core']))){
                $modules[$panelName] = array("name" => $panel['name']);

                if(array_key_exists('childs', $panel)){
                    $modules[$panelName]['childs'] = array();

                    foreach($panel['childs'] as $childPanelName => $childPanel){
                        if((!array_key_exists('side',$childPanel) || (array_key_exists('side',$childPanel) && $childPanel['side'] == 'frontend'))
                            && (!array_key_exists('core',$childPanel) || (array_key_exists('core',$childPanel) && !$childPanel['core']))){
                            $modules[$panelName]['childs'][$childPanelName] = array("name" => $childPanel['name']);
                        }
                    }

                    if(!count($modules[$panelName]['childs'])){
                        unset($modules[$panelName]);
                    }
                }
            }
        }

        return $modules;
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;

            self::$dirs =  array(
                'client_img' => KONG_CORE_ROOT.'/client/img',
                'img' => KONG_FB_DIR.'/img/widgets/'
            );
        }
        return static::$instance;
    }
}