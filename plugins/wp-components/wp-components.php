<?php
/**
 * Plugin Name: WP Components
 * Plugin URI: https://example.com/wp-components
 * Description: Uma biblioteca de componentes reutilizáveis para WordPress.
 * Version: 1.0.0
 * Author: WP Components Team
 * Author URI: https://example.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-components
 * Domain Path: /languages
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe principal do plugin.
 */
class WP_Components {

    /**
     * Instância única desta classe.
     *
     * @var WP_Components
     */
    private static $instance;

    /**
     * Prefixo do plugin.
     *
     * @var string
     */
    private $prefix = 'wp_components';

    /**
     * Versão do plugin.
     *
     * @var string
     */
    private $version = '1.0.0';

    /**
     * Obtém a instância única desta classe.
     *
     * @return WP_Components
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
        $this->define_constants();
        $this->load_dependencies();
        $this->define_hooks();
    }

    /**
     * Define as constantes do plugin.
     */
    private function define_constants() {
        define('WP_COMPONENTS_VERSION', $this->version);
        define('WP_COMPONENTS_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('WP_COMPONENTS_PLUGIN_URL', plugin_dir_url(__FILE__));
        define('WP_COMPONENTS_PLUGIN_BASENAME', plugin_basename(__FILE__));
        define('WP_COMPONENTS_FILE', __FILE__);
    }

    /**
     * Carrega as dependências do plugin.
     */
    private function load_dependencies() {
        // Carrega as funções auxiliares
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/wp-components-functions.php';
        
        // Carrega as classes dos componentes
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-card.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-button.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-alert.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-tabs.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-accordion.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-form.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-modal.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-grid.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-pagination.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-badge.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-chip.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-avatar.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/components/class-wp-component-hero.php';
        
        // Carrega as classes de administração e pública
        require_once WP_COMPONENTS_PLUGIN_DIR . 'admin/class-wp-components-admin.php';
        require_once WP_COMPONENTS_PLUGIN_DIR . 'public/class-wp-components-public.php';
        
        // Carrega as integrações
        $this->load_integrations();

        // Carrega a classe de Web Components
        require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/class-wp-components-web-components.php';

        // Incluir a integração com o Storybook
        if ( file_exists( plugin_dir_path( __FILE__ ) . 'includes/class-wp-components-storybook.php' ) ) {
            require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-components-storybook.php';
        }
    }
    
    /**
     * Carrega as integrações do plugin.
     */
    private function load_integrations() {
        // Cria as pastas necessárias se não existirem
        $this->create_required_directories();
        
        // Carrega o arquivo de funções de compatibilidade com o Elementor
        $elementor_compatibility_file = WP_COMPONENTS_PLUGIN_DIR . 'includes/functions/elementor-compatibility.php';
        if (!file_exists($elementor_compatibility_file)) {
            // Cria a pasta functions se não existir
            $functions_dir = WP_COMPONENTS_PLUGIN_DIR . 'includes/functions';
            if (!file_exists($functions_dir)) {
                wp_mkdir_p($functions_dir);
            }
            
            // Tenta incluir o arquivo
            @include_once $elementor_compatibility_file;
        }

        // Integração com o Elementor
        add_action('plugins_loaded', function() {
            // Verifica se o Elementor está ativo
            if (did_action('elementor/loaded')) {
                // Carrega a classe de integração com o Elementor
                require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/class-wp-components-elementor.php';

                // Adiciona mensagem de administração se a versão for incompatível
                if (defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, '3.5.0', '<')) {
                    add_action('admin_notices', function() {
                        if (!current_user_can('manage_options')) {
                            return;
                        }
                        
                        echo '<div class="notice notice-warning is-dismissible">';
                        echo '<p>' . __('WP Components: Para usar os widgets do Elementor, é necessário o Elementor versão 3.5.0 ou superior. Sua versão atual é ', 'wp-components') . ELEMENTOR_VERSION . '.</p>';
                        echo '</div>';
                    });
                }
            }
        });
    }

    /**
     * Cria as pastas necessárias para o plugin.
     */
    private function create_required_directories() {
        $directories = array(
            'includes/functions',
            'includes/integrations',
            'includes/integrations/elementor',
            'admin/css',
            'admin/js',
            'public/css',
            'public/js',
        );
        
        foreach ($directories as $directory) {
            $dir_path = WP_COMPONENTS_PLUGIN_DIR . $directory;
            if (!file_exists($dir_path)) {
                wp_mkdir_p($dir_path);
            }
        }
    }

    /**
     * Define os hooks do plugin.
     */
    private function define_hooks() {
        // Hooks de administração
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'), 5);
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'), 5);
        
        // Hooks públicos - prioridade baixa para garantir que carregue primeiro
        add_action('wp_enqueue_scripts', array($this, 'enqueue_public_styles'), 5);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_public_scripts'), 5);

        // Debug hook para listar scripts e estilos registrados
        if (WP_DEBUG) {
            add_action('wp_footer', array($this, 'debug_scripts_styles'));
        }
    }

    /**
     * Registra os estilos para a área de administração.
     */
    public function enqueue_admin_styles() {
        wp_enqueue_style(
            $this->prefix . '-admin',
            WP_COMPONENTS_PLUGIN_URL . 'admin/css/wp-components-admin.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * Registra os scripts para a área de administração.
     */
    public function enqueue_admin_scripts() {
        wp_enqueue_script(
            $this->prefix . '-admin',
            WP_COMPONENTS_PLUGIN_URL . 'admin/js/wp-components-admin.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    /**
     * Registra os estilos para a área pública.
     */
    public function enqueue_public_styles() {
        // Enfileira os ícones do Dashicons para uso no frontend
        wp_enqueue_style('dashicons');
        
        // Enfileira o CSS principal do plugin
        wp_enqueue_style(
            $this->prefix,
            WP_COMPONENTS_PLUGIN_URL . 'public/css/wp-components.css',
            array(),
            $this->version,
            'all'
        );

        // Enfileira os estilos dos componentes individuais
        $component_styles = array(
            'hero' => 'public/css/components/hero.css',
        );

        foreach ($component_styles as $handle => $path) {
            wp_enqueue_style(
                $this->prefix . '-' . $handle,
                WP_COMPONENTS_PLUGIN_URL . $path,
                array(),
                $this->version,
                'all'
            );
        }
    }

    /**
     * Registra os scripts para a área pública.
     */
    public function enqueue_public_scripts() {
        wp_enqueue_script(
            $this->prefix,
            WP_COMPONENTS_PLUGIN_URL . 'public/js/wp-components.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    /**
     * Função de debug para listar scripts e estilos registrados
     */
    public function debug_scripts_styles() {
        global $wp_scripts, $wp_styles;
        
        echo '<!-- WP Components Debug - Scripts Registrados -->';
        echo '<script>';
        echo 'console.log("WP Components - Scripts Registrados:", ' . json_encode(array_keys($wp_scripts->registered)) . ');';
        echo 'console.log("WP Components - Estilos Registrados:", ' . json_encode(array_keys($wp_styles->registered)) . ');';
        echo '</script>';
    }
}

/**
 * Inicia o plugin.
 */
function wp_components_init() {
    return WP_Components::get_instance();
}

// Inicializa o plugin
wp_components_init(); 