<?php
/**
 * Classe para gerenciar os Web Components
 *
 * @package WP_Components
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Classe WP_Components_Web_Components
 */
class WP_Components_Web_Components {
    /**
     * Instância singleton da classe
     *
     * @var WP_Components_Web_Components
     */
    private static $instance = null;

    /**
     * Lista de web components registrados
     *
     * @var array
     */
    private $registered_components = [];

    /**
     * Construtor da classe
     */
    private function __construct() {
        $this->init();
    }

    /**
     * Obtém a instância singleton da classe
     *
     * @return WP_Components_Web_Components
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Inicializa a classe
     *
     * @return void
     */
    private function init() {
        // Registra os web components padrão
        $this->register_component( 'wycliffe-hero', 'wycliffe-hero' );

        // Hooks para carregar os web components - com prioridade alta para garantir carregamento
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999 );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999 );
        
        // Hooks específicos do Elementor
        add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999 );
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999 );
        add_action( 'elementor/preview/enqueue_scripts', [ $this, 'enqueue_scripts' ], 999 );

        // Registra o widget Elementor para Hero Web Component
        add_action( 'elementor/widgets/register', [ $this, 'register_elementor_widgets' ] );

        // Adiciona um script inline para garantir que o web component seja registrado
        add_action( 'wp_footer', function() {
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Verifica se o elemento já está registrado
                    if (!customElements.get('wycliffe-hero')) {
                        console.log('Tentando registrar wycliffe-hero novamente...');
                        // Tenta registrar novamente após um curto delay
                        setTimeout(function() {
                            try {
                                customElements.define('wycliffe-hero', WycliffeHeroElement);
                                console.log('Web component wycliffe-hero registrado com sucesso');
                            } catch (error) {
                                console.error('Erro ao registrar wycliffe-hero:', error);
                            }
                        }, 100);
                    }
                });
            </script>
            <?php
        }, 999 );
    }

    /**
     * Registra um web component
     *
     * @param string $tag_name Nome da tag HTML do web component
     * @param string $component_name Nome do componente sem o prefixo
     * @return void
     */
    public function register_component( $tag_name, $component_name ) {
        $this->registered_components[ $tag_name ] = $component_name;
    }

    /**
     * Carrega os scripts dos web components
     *
     * @return void
     */
    public function enqueue_scripts() {
        // Evita carregamento duplicado
        static $loaded = false;
        if ($loaded) {
            return;
        }
        $loaded = true;
        
        // Usa CDNs diretos para garantir o carregamento rápido
        wp_enqueue_script(
            'react',
            'https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js',
            [],
            '18.2.0',
            true // Carrega no footer
        );

        wp_enqueue_script(
            'react-dom',
            'https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js',
            [ 'react' ],
            '18.2.0',
            true // Carrega no footer
        );

        // Adiciona um script inline para garantir que React e ReactDOM sejam expostos globalmente
        wp_add_inline_script('react', '
            window.React = React;
            console.log("React carregado globalmente na versão " + React.version);
        ');
        
        wp_add_inline_script('react-dom', '
            window.ReactDOM = ReactDOM;
            console.log("ReactDOM carregado globalmente na versão " + ReactDOM.version);
        ');

        // Carrega os scripts dos web components registrados
        foreach ( $this->registered_components as $tag_name => $component_name ) {
            $script_path = WP_COMPONENTS_PLUGIN_DIR . "assets/js/web-components/{$component_name}.js";
            
            // Verifica se o arquivo JS existe
            if (file_exists($script_path)) {
                // Carrega o script do web component
                wp_enqueue_script(
                    "wp-component-{$component_name}-wc",
                    WP_COMPONENTS_PLUGIN_URL . "assets/js/web-components/{$component_name}.js",
                    [ 'react', 'react-dom' ],
                    WP_COMPONENTS_VERSION,
                    true // Carrega no footer
                );

                // Adiciona CSS inline diretamente do componente React
                $css_path = WP_COMPONENTS_PLUGIN_DIR . "wycliff-figma-to-storybook/src/components/HeroWebComponent/HeroWebComponent.css";
                if (file_exists($css_path)) {
                    $css_content = file_get_contents($css_path);
                    wp_add_inline_style("wp-component-{$component_name}-wc", $css_content);
                } else {
                    error_log("WP Components: Arquivo CSS não encontrado: {$css_path}");
                }
            } else {
                error_log("WP Components: Arquivo JS não encontrado: {$script_path}");
            }
        }
        
        // Adiciona um script para verificar o ambiente e tentar registrar novamente o elemento personalizado
        $script = '
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar se temos todos os requisitos
            if (typeof window.React === "undefined") {
                console.error("React não está disponível globalmente");
            }
            if (typeof window.ReactDOM === "undefined") {
                console.error("ReactDOM não está disponível globalmente");
            }
            if (typeof customElements === "undefined") {
                console.error("Custom Elements API não está disponível");
            } else {
                console.log("Custom Elements API disponível");
                if (!customElements.get("wycliffe-hero")) {
                    console.error("Elemento wycliffe-hero não registrado");
                    // Tenta registrar novamente
                    try {
                        customElements.define("wycliffe-hero", WycliffeHeroElement);
                        console.log("Elemento wycliffe-hero registrado com sucesso na segunda tentativa");
                    } catch (error) {
                        console.error("Erro ao registrar wycliffe-hero:", error);
                    }
                } else {
                    console.log("Elemento wycliffe-hero registrado com sucesso");
                }
            }
        });
        ';
        wp_add_inline_script('react-dom', $script);
    }

    /**
     * Registra os widgets do Elementor
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Gerenciador de widgets do Elementor
     * @return void
     */
    public function register_elementor_widgets( $widgets_manager ) {
        // Inclui o arquivo da classe do widget
        include_once WP_COMPONENTS_PLUGIN_DIR . 'includes/integrations/elementor/class-wp-components-elementor-hero-webcomponent.php';

        // Registra o widget
        $widgets_manager->register( new WP_Components_Elementor_Hero_WebComponent() );
    }
}

// Inicializa a classe
WP_Components_Web_Components::get_instance(); 