<?php
/**
 * Gerenciamento de assets (CSS, JavaScript)
 *
 * @package Theme_IA
 */

// Prevenir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra e enfileira os estilos e scripts
 */
function theme_ia_enqueue_assets() {
    // Estilos
    wp_enqueue_style(
        'theme-ia-styles',
        THEME_IA_ASSETS_URI . '/css/main.css',
        array(),
        THEME_IA_VERSION
    );

    // Scripts
    wp_enqueue_script(
        'theme-ia-scripts',
        THEME_IA_ASSETS_URI . '/js/main.js',
        array('jquery'),
        THEME_IA_VERSION,
        true
    );

    // Comentários
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_ia_enqueue_assets'); 