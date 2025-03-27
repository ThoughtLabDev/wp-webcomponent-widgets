<?php
/**
 * Registro de widgets do Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra todos os widgets do WP Components para o Elementor.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Gerenciador de widgets do Elementor.
 */
function wp_components_register_elementor_widgets($widgets_manager) {
    // Verifica se o Elementor está ativo
    if (!did_action('elementor/loaded')) {
        return;
    }

    // Carrega os arquivos dos widgets
    $widget_files = array(
        'button'   => WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-button.php',
        'card'     => WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-card.php',
        'alert'    => WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-alert.php',
        'badge'    => WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-badge.php',
        'chip'     => WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-chip.php',
        'avatar'   => WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-avatar.php',
        'hero'     => WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-hero.php',
    );

    // Carrega e registra cada widget
    foreach ($widget_files as $widget_name => $widget_file) {
        if (file_exists($widget_file)) {
            require_once $widget_file;
            
            $class_name = '\WP_Components_Elementor_' . ucfirst($widget_name);
            if (class_exists($class_name)) {
                $widgets_manager->register(new $class_name());
            }
        }
    }
} 