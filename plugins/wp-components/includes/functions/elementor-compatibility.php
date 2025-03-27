<?php
/**
 * Funções de compatibilidade com o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Verifica se a versão do Elementor é compatível.
 *
 * @return bool True se o Elementor for compatível, false caso contrário.
 */
function wp_components_is_elementor_compatible() {
    // Se o Elementor não estiver ativo, retorna false
    if (!did_action('elementor/loaded')) {
        return false;
    }
    
    // Verifica a versão do Elementor
    if (version_compare(ELEMENTOR_VERSION, '3.5.0', '<')) {
        return false;
    }
    
    return true;
}

/**
 * Verifica se o Elementor está ativo.
 *
 * @return bool True se o Elementor estiver ativo, false caso contrário.
 */
function wp_components_is_elementor_active() {
    return did_action('elementor/loaded');
} 