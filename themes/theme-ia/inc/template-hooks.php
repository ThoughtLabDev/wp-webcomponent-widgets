<?php
/**
 * Hooks para os templates
 *
 * @package Theme_IA
 */

// Prevenir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Hooks para o cabeçalho
 */
function theme_ia_header_hooks() {
    // Adicione hooks para o cabeçalho aqui
}
add_action('theme_ia_header', 'theme_ia_header_hooks');

/**
 * Hooks para o rodapé
 */
function theme_ia_footer_hooks() {
    // Adicione hooks para o rodapé aqui
}
add_action('theme_ia_footer', 'theme_ia_footer_hooks'); 