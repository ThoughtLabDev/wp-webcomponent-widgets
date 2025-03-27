<?php
/**
 * Theme IA functions and definitions
 *
 * @package Theme_IA
 */

// Prevenir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define constantes do tema
 */
define('THEME_IA_VERSION', '1.0.0');
define('THEME_IA_DIR', get_template_directory());
define('THEME_IA_URI', get_template_directory_uri());

/**
 * Configuração do tema
 */
function theme_ia_setup() {
    // Adicionar suporte para título automático
    add_theme_support('title-tag');
    
    // Adicionar suporte para miniaturas de posts
    add_theme_support('post-thumbnails');
    
    // Adicionar suporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Registrar menus
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'theme-ia'),
        'footer' => __('Menu Rodapé', 'theme-ia'),
    ));
}
add_action('after_setup_theme', 'theme_ia_setup');

/**
 * Enfileirar estilos e scripts
 */
function theme_ia_enqueue_scripts() {
    // Enfileirar o estilo principal do tema
    wp_enqueue_style(
        'theme-ia-style',
        get_stylesheet_uri(),
        array(),
        THEME_IA_VERSION
    );
    
    // Enfileirar o script principal do tema
    wp_enqueue_script(
        'theme-ia-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        THEME_IA_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'theme_ia_enqueue_scripts');

/**
 * Registrar áreas de widgets
 */
function theme_ia_widgets_init() {
    register_sidebar(array(
        'name'          => __('Barra Lateral', 'theme-ia'),
        'id'            => 'sidebar-1',
        'description'   => __('Adicione widgets aqui.', 'theme-ia'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'theme_ia_widgets_init'); 