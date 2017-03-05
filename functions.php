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
    register_nav_menu( 'primary', __('Primary Menu', STEPBYSTEP_THEME_TEXTDOMAIN) );
}
add_action( 'after_setup_theme', 'registerNavMenu', 100 );


define("STEPBYSTEP_THEME_TEXTDOMAIN", 'step-by-step-development-theme');

/**
 * Загрузка Text Domain
 */
function themeLocalization(){
    load_theme_textdomain(STEPBYSTEP_THEME_TEXTDOMAIN, get_template_directory() . '/languages/');
}
add_action('after_setup_theme', 'themeLocalization');


//post-formats
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
//post-thumbnails
add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-header', array(
    'video' => true,
) );

add_theme_support( 'automatic-feed-links' );


add_theme_support('custom-logo');


add_action('admin_menu', 'addAdminMenu');

function addAdminMenu(){

    $mainMenuPage = add_menu_page(
        _x(
            'Step By Step theme',
            'admin menu page' ,
            STEPBYSTEP_THEME_TEXTDOMAIN
        ),
        _x(
            'Step By Step theme',
            'admin menu page' ,
            STEPBYSTEP_THEME_TEXTDOMAIN
        ),
        'manage_options',
        STEPBYSTEP_THEME_TEXTDOMAIN,
        'renderMainMenu',
        get_template_directory_uri() .'/images/main-menu.png'
    );
}

function renderMainMenu(){
    _e('Step By Step theme page', STEPBYSTEP_THEME_TEXTDOMAIN);
}