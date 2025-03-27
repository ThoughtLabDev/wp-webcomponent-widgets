<?php
/**
 * Funções para os templates
 *
 * @package Theme_IA
 */

// Prevenir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adiciona classes ao body
 *
 * @param array $classes Classes do body.
 * @return array
 */
function theme_ia_body_classes($classes) {
    // Adiciona uma classe para páginas
    if (is_page()) {
        $classes[] = 'page-' . get_post_field('post_name', get_queried_object_id());
    }

    // Adiciona uma classe para posts
    if (is_single() && 'post' === get_post_type()) {
        $classes[] = 'single-post';
    }

    return $classes;
}
add_filter('body_class', 'theme_ia_body_classes');

/**
 * Retorna o título da página
 *
 * @return string
 */
function theme_ia_get_page_title() {
    if (is_home()) {
        return esc_html__('Blog', 'theme-ia');
    } elseif (is_archive()) {
        return get_the_archive_title();
    } elseif (is_search()) {
        return sprintf(
            esc_html__('Resultados da busca: %s', 'theme-ia'),
            '<span>' . get_search_query() . '</span>'
        );
    } elseif (is_404()) {
        return esc_html__('Página não encontrada', 'theme-ia');
    } else {
        return get_the_title();
    }
} 