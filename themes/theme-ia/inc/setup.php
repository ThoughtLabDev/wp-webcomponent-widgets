<?php
/**
 * Configurações do tema
 *
 * @package Theme_IA
 */

// Prevenir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuração do tema
 */
function theme_ia_setup() {
    // Adiciona suporte para tradução
    load_theme_textdomain('theme-ia', THEME_IA_DIR . '/languages');

    // Adiciona suporte para título dinâmico
    add_theme_support('title-tag');

    // Adiciona suporte para imagens destacadas
    add_theme_support('post-thumbnails');

    // Adiciona suporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Adiciona suporte para menus
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'theme-ia'),
        'footer'  => esc_html__('Menu Rodapé', 'theme-ia'),
    ));
}
add_action('after_setup_theme', 'theme_ia_setup'); 