<?php
/**
 * Funcionalidades do plugin para a área administrativa.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para gerenciar funcionalidades do plugin na área administrativa.
 */
class WP_Components_Admin {

    /**
     * O ID do plugin.
     *
     * @var string
     */
    private $plugin_name;

    /**
     * A versão do plugin.
     *
     * @var string
     */
    private $version;

    /**
     * Inicializa a classe e define suas propriedades.
     *
     * @param string $plugin_name O nome do plugin.
     * @param string $version A versão do plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        
        // Registrar configurações
        add_action('admin_init', array($this, 'register_settings'));
    }

    /**
     * Registra os estilos para a área administrativa.
     */
    public function enqueue_styles() {
        // Registra e enfileira o CSS principal
        wp_register_style(
            $this->plugin_name . '-admin',
            plugin_dir_url(__FILE__) . 'css/wp-components-admin.min.css',
            array(),
            $this->version,
            'all'
        );
        
        // Enfileira o CSS
        wp_enqueue_style($this->plugin_name . '-admin');
    }

    /**
     * Registra os scripts para a área administrativa.
     */
    public function enqueue_scripts() {
        // Registra e enfileira o JavaScript principal
        wp_register_script(
            $this->plugin_name . '-admin',
            plugin_dir_url(__FILE__) . 'js/wp-components-admin.min.js',
            array('jquery'),
            $this->version,
            true
        );
        
        // Enfileira o JavaScript
        wp_enqueue_script($this->plugin_name . '-admin');
    }

    /**
     * Adiciona a página de menu do plugin no painel administrativo.
     */
    public function add_menu_page() {
        add_menu_page(
            __('WP Components', 'wp-components'),
            __('WP Components', 'wp-components'),
            'manage_options',
            'wp-components',
            array($this, 'display_plugin_admin_page'),
            'dashicons-layout',
            30
        );
        
        add_submenu_page(
            'wp-components',
            __('Configurações', 'wp-components'),
            __('Configurações', 'wp-components'),
            'manage_options',
            'wp-components-settings',
            array($this, 'display_plugin_settings_page')
        );
    }

    /**
     * Renderiza a página principal do plugin.
     */
    public function display_plugin_admin_page() {
        include_once WP_COMPONENTS_PATH . 'admin/partials/wp-components-admin-display.php';
    }

    /**
     * Renderiza a página de configurações do plugin.
     */
    public function display_plugin_settings_page() {
        include_once WP_COMPONENTS_PATH . 'admin/partials/wp-components-admin-settings.php';
    }

    /**
     * Registra as configurações do plugin.
     */
    public function register_settings() {
        register_setting(
            'wp_components_settings',
            'wp_components_settings',
            array(
                'sanitize_callback' => array($this, 'sanitize_settings'),
                'default' => array(
                    'enable_shortcodes' => 1,
                    'primary_color' => '#4a6cf7',
                    'border_radius' => '0.375rem',
                    'load_styles' => 'all',
                    'load_scripts' => 'all',
                    'custom_css' => '',
                ),
            )
        );
    }

    /**
     * Sanitiza as configurações do plugin.
     *
     * @param array $input As configurações a serem sanitizadas.
     * @return array As configurações sanitizadas.
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        // Sanitizar enable_shortcodes
        $sanitized['enable_shortcodes'] = isset($input['enable_shortcodes']) ? 1 : 0;
        
        // Sanitizar primary_color
        $sanitized['primary_color'] = isset($input['primary_color']) ? sanitize_hex_color($input['primary_color']) : '#4a6cf7';
        
        // Sanitizar border_radius
        $valid_border_radius = array('0', '0.25rem', '0.375rem', '0.5rem', '1rem');
        $sanitized['border_radius'] = in_array($input['border_radius'], $valid_border_radius) ? $input['border_radius'] : '0.375rem';
        
        // Sanitizar load_styles
        $valid_load_options = array('all', 'admin', 'frontend', 'none');
        $sanitized['load_styles'] = in_array($input['load_styles'], $valid_load_options) ? $input['load_styles'] : 'all';
        
        // Sanitizar load_scripts
        $sanitized['load_scripts'] = in_array($input['load_scripts'], $valid_load_options) ? $input['load_scripts'] : 'all';
        
        // Sanitizar custom_css
        $sanitized['custom_css'] = wp_strip_all_tags($input['custom_css']);
        
        return $sanitized;
    }
} 