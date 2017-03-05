<?php

function loadScriptSite(){

    /*
     * get_template_directory_uri()
     * Получает URL текущей темы. Учитывает SSL. Не учитывает наличие дочерней темы. Не содержит закрывающий слэш.
     * https://wp-kama.ru/function/get_template_directory_uri
     */

    $version = false;

    wp_register_style(
        'StepByStep-font-awesome', //$handle
        get_template_directory_uri().'/css/font-awesome.min.css', // $src
        array(), //$deps,
        $version // $ver
    );
    wp_register_style(
        'StepByStep-core', //$handle
        get_template_directory_uri().'/css/core.css', // $src
        array(), //$deps,
        $version // $ver
    );
    wp_register_style(
        'StepByStep-skins', //$handle
        get_template_directory_uri().'/css/skins/red.css', // $src
        array(), //$deps,
        $version // $ver
    );
    wp_register_style(
        'StepByStep-custom', //$handle
        get_template_directory_uri().'/css/custom.css', // $src
        array(), //$deps,
        $version // $ver
    );

    wp_enqueue_style('StepByStep-font-awesome');
    wp_enqueue_style('StepByStep-core');
    wp_enqueue_style('StepByStep-skins');
    wp_enqueue_style('StepByStep-custom');

    wp_register_script(
        'StepByStep-main', //$handle
        get_template_directory_uri().'/js/main.js', //$src
        array(
            'jquery'
        ), //$deps
        $version, //$ver
        true //$$in_footer
    );
    wp_enqueue_script('StepByStep-main');
}
add_action( 'wp_enqueue_scripts', 'loadScriptSite');

/**
 * Включаем поддержку произвольных меню
 */
function registerNavMenu() {
    register_nav_menu( 'primary', 'Primary Menu' );
}
add_action( 'after_setup_theme', 'registerNavMenu' );
