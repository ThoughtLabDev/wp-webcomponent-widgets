<?php
/**
 * Integração com o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para integração com o Elementor.
 */
class WP_Components_Elementor {

    /**
     * Instância única desta classe.
     *
     * @var WP_Components_Elementor
     */
    private static $instance;

    /**
     * Obtém a instância única desta classe.
     *
     * @return WP_Components_Elementor
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Construtor privado para implementar o padrão Singleton.
     */
    private function __construct() {
        // Inicializa os hooks
        $this->init_hooks();
    }

    /**
     * Inicializa os hooks.
     */
    private function init_hooks() {
        // Carrega o arquivo de registro de widgets
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/register-widgets.php';
        
        // Registra a categoria de widgets
        add_action('elementor/elements/categories_registered', array($this, 'register_widget_category'));
        
        // Registra os widgets
        add_action('elementor/widgets/register', 'wp_components_register_elementor_widgets');
    }

    /**
     * Registra a categoria de widgets.
     *
     * @param \Elementor\Elements_Manager $elements_manager Gerenciador de elementos do Elementor.
     */
    public function register_widget_category($elements_manager) {
        $elements_manager->add_category(
            'wp-components',
            array(
                'title' => __('WP Components', 'wp-components'),
                'icon' => 'fa fa-plug',
            )
        );
    }
}

// Inicializa a integração com o Elementor
WP_Components_Elementor::get_instance(); 