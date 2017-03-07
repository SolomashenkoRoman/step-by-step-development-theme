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

    $subMenuPage = add_submenu_page(
        STEPBYSTEP_THEME_TEXTDOMAIN,
        _x(
            'Sub Step By Step theme',
            'admin menu page' ,
            STEPBYSTEP_THEME_TEXTDOMAIN
        ),
        _x(
            'Sub Step By Step theme',
            'admin menu page' ,
            STEPBYSTEP_THEME_TEXTDOMAIN
        ),
        'manage_options',
        'step_by_step_theme_control_sub_menu',
        'renderSubMenu'
        );



    $themeMenuPage = add_theme_page(
        __('Sub theme Step By Step', STEPBYSTEP_THEME_TEXTDOMAIN),
        __('Sub theme Step By Step', STEPBYSTEP_THEME_TEXTDOMAIN),
        'read',
        'step_by_step_theme_control_sub_theme_menu',
        'renderThemeMenu'
    );
}

function renderMainMenu(){
    _e('Step By Step theme page', STEPBYSTEP_THEME_TEXTDOMAIN);
}

function renderSubMenu(){
    _e('Sub Step By Step theme page', STEPBYSTEP_THEME_TEXTDOMAIN);
}

function renderThemeMenu(){
    _e('Sub theme Step By Step', STEPBYSTEP_THEME_TEXTDOMAIN);
}

function register_my_widgets(){
    register_sidebar( array(
        'name' => "Правая боковая панель сайта",
        'id' => 'right-sidebar',
        'description' => 'Эти виджеты будут показаны с правой колонке сайта',
        'before_title' => '<h1>',
        'after_title' => '</h1>'
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );

function true_remove_default_widget() {
    unregister_widget('WP_Widget_Archives'); // Архивы
    unregister_widget('WP_Widget_Calendar'); // Календарь
    /*unregister_widget('WP_Widget_Categories'); // Рубрики
    unregister_widget('WP_Widget_Meta'); // Мета
    unregister_widget('WP_Widget_Pages'); // Страницы
    unregister_widget('WP_Widget_Recent_Comments'); // Свежие комментарии
    unregister_widget('WP_Widget_Recent_Posts'); // Свежие записи
    unregister_widget('WP_Widget_RSS'); // RSS
    unregister_widget('WP_Widget_Search'); // Поиск
    unregister_widget('WP_Widget_Tag_Cloud'); // Облако меток
    unregister_widget('WP_Widget_Text'); // Текст
    unregister_widget('WP_Nav_Menu_Widget'); // Произвольное меню*/
}

add_action( 'widgets_init', 'true_remove_default_widget', 20 );

require get_template_directory().'/widgets/StepByStepExampleWidget.php';
add_action('widgets_init', create_function('', 'return register_widget("widgets\StepByStepExampleWidget");'));