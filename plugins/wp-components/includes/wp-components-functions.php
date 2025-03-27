<?php
/**
 * Funções auxiliares para os componentes.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Renderiza um componente Card.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_card($args = []) {
    $card = WP_Component_Card::get_instance();
    return $card->render($args);
}

/**
 * Renderiza um componente Button.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_button($args = []) {
    $button = WP_Component_Button::get_instance();
    return $button->render($args);
}

/**
 * Renderiza um componente Alert.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_alert($args = []) {
    $alert = WP_Component_Alert::get_instance();
    return $alert->render($args);
}

/**
 * Renderiza um componente Tabs.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_tabs($args = []) {
    $tabs = WP_Component_Tabs::get_instance();
    return $tabs->render($args);
}

/**
 * Renderiza um componente Accordion.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_accordion($args = []) {
    $accordion = WP_Component_Accordion::get_instance();
    return $accordion->render($args);
}

/**
 * Renderiza um componente Form.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_form($args = []) {
    $form = WP_Component_Form::get_instance();
    return $form->render($args);
}

/**
 * Renderiza um componente Modal.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_modal($args = []) {
    $modal = WP_Component_Modal::get_instance();
    return $modal->render($args);
}

/**
 * Renderiza um componente Grid.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_grid($args = []) {
    $grid = WP_Component_Grid::get_instance();
    return $grid->render($args);
}

/**
 * Renderiza um componente Pagination.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_pagination($args = []) {
    $pagination = WP_Component_Pagination::get_instance();
    return $pagination->render($args);
}

/**
 * Renderiza um componente Badge.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_badge($args = []) {
    $badge = WP_Component_Badge::get_instance();
    return $badge->render($args);
}

/**
 * Renderiza um componente Chip.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_chip($args = []) {
    $chip = WP_Component_Chip::get_instance();
    return $chip->render($args);
}

/**
 * Renderiza um componente Avatar.
 *
 * @param array $args Argumentos para o componente.
 * @return string HTML do componente.
 */
function wp_component_avatar($args = []) {
    $avatar = WP_Component_Avatar::get_instance();
    return $avatar->render($args);
}

/**
 * Registra um shortcode para um componente.
 *
 * @param string $component Nome do componente.
 * @param array  $atts      Atributos do shortcode.
 * @param string $content   Conteúdo do shortcode.
 * @return string HTML do componente.
 */
function wp_component_shortcode($component, $atts = [], $content = null) {
    $function = 'wp_component_' . $component;
    
    if (function_exists($function)) {
        // Adicionar conteúdo aos atributos
        if ($content !== null) {
            $atts['content'] = do_shortcode($content);
        }
        
        return call_user_func($function, $atts);
    }
    
    return '';
}

/**
 * Registra todos os shortcodes de componentes.
 */
function wp_components_register_shortcodes() {
    $components = [
        'card',
        'button',
        'alert',
        'tabs',
        'accordion',
        'form',
        'modal',
        'grid',
        'pagination',
        'badge',
        'chip',
        'avatar',
    ];
    
    foreach ($components as $component) {
        add_shortcode('wp_' . $component, function($atts, $content = null) use ($component) {
            return wp_component_shortcode($component, $atts, $content);
        });
    }
}
add_action('init', 'wp_components_register_shortcodes');

/**
 * Verifica se a versão do Elementor é compatível.
 *
 * @return bool Verdadeiro se o Elementor estiver instalado e for compatível, falso caso contrário.
 */
function wp_components_is_elementor_compatible() {
    // Verifica se o Elementor está ativo
    if (!did_action('elementor/loaded')) {
        return false;
    }
    
    // Verifica a versão mínima do Elementor (3.5.0 ou superior é recomendado)
    if (defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, '3.5.0', '>=')) {
        return true;
    }
    
    return false;
} 