<?php
/**
 * Funcionalidades do plugin para o frontend.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para gerenciar funcionalidades do plugin no frontend.
 */
class WP_Components_Public {

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
     * As configurações do plugin.
     *
     * @var array
     */
    private $settings;

    /**
     * Inicializa a classe e define suas propriedades.
     *
     * @param string $plugin_name O nome do plugin.
     * @param string $version A versão do plugin.
     */
    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->settings = get_option('wp_components_settings', array(
            'enable_shortcodes' => 1,
            'primary_color' => '#4a6cf7',
            'border_radius' => '0.375rem',
            'load_styles' => 'all',
            'load_scripts' => 'all',
            'custom_css' => '',
        ));
        
        // Registrar ações diretamente no construtor para garantir que sejam executadas
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'), 99);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 99);
    }

    /**
     * Registra os estilos para o frontend.
     */
    public function enqueue_styles() {
        // Forçar o carregamento dos estilos, independentemente das configurações
        // Registra e enfileira o CSS principal
        wp_register_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__) . 'css/wp-components.min.css',
            array(),
            $this->version . '.' . time(), // Adicionar timestamp para evitar cache
            'all'
        );
        
        // Enfileira o CSS
        wp_enqueue_style($this->plugin_name);
        
        // Adicionar CSS personalizado se existir
        if (!empty($this->settings['custom_css'])) {
            wp_add_inline_style($this->plugin_name, $this->settings['custom_css']);
        }
        
        // Adicionar variáveis CSS personalizadas
        $custom_variables = "
            :root {
                --wp-component-primary: {$this->settings['primary_color']};
                --wp-component-border-radius: {$this->settings['border_radius']};
            }
        ";
        wp_add_inline_style($this->plugin_name, $custom_variables);
        
        // Adicionar CSS de depuração para verificar se está funcionando
        $debug_css = "
            /* CSS de depuração do WP Components */
            .wp-component-debug-active {
                border: 2px solid red !important;
            }
            
            .wp-component-button {
                display: inline-block;
                font-weight: 500;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                user-select: none;
                border: 1px solid transparent;
                padding: .5rem 1rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: var(--wp-component-border-radius, 0.375rem);
                transition: all 0.3s ease;
                cursor: pointer;
                text-decoration: none;
            }
            
            .wp-component-button--primary {
                color: #fff;
                background-color: var(--wp-component-primary, #4a6cf7);
                border-color: var(--wp-component-primary, #4a6cf7);
            }
        ";
        wp_add_inline_style($this->plugin_name, $debug_css);
    }

    /**
     * Registra os scripts para o frontend.
     */
    public function enqueue_scripts() {
        // Forçar o carregamento dos scripts, independentemente das configurações
        // Registra e enfileira o JavaScript principal
        wp_register_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__) . 'js/wp-components.min.js',
            array('jquery'),
            $this->version . '.' . time(), // Adicionar timestamp para evitar cache
            true
        );
        
        // Enfileira o JavaScript
        wp_enqueue_script($this->plugin_name);
        
        // Adicionar script de depuração
        $debug_script = "
            jQuery(document).ready(function($) {
                console.log('WP Components scripts carregados com sucesso!');
                // Adicionar classe de depuração para verificar se o CSS está funcionando
                $('.wp-component-button').addClass('wp-component-debug-active');
                setTimeout(function() {
                    $('.wp-component-debug-active').removeClass('wp-component-debug-active');
                }, 3000);
            });
        ";
        wp_add_inline_script($this->plugin_name, $debug_script);
    }
} 