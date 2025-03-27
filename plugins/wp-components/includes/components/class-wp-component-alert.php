<?php
/**
 * Classe para o componente Alert.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Alert.
 */
class WP_Component_Alert {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Alert
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Alert
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Construtor.
     */
    private function __construct() {
        // Inicialização
    }

    /**
     * Renderiza o componente Alert.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'title'       => '',
            'content'     => '',
            'variant'     => 'primary',
            'dismissible' => true,
            'class'       => '',
            'id'          => '',
        ]);

        // Sanitizar argumentos
        $title       = esc_html($args['title']);
        $content     = wp_kses_post($args['content']);
        $variant     = sanitize_html_class($args['variant']);
        $dismissible = (bool) $args['dismissible'];
        $class       = sanitize_html_class($args['class']);
        $id          = sanitize_html_class($args['id']);

        // Construir classes
        $alert_class = 'wp-component-alert';
        if (!empty($variant)) {
            $alert_class .= ' wp-component-alert--' . $variant;
        }
        if (!empty($class)) {
            $alert_class .= ' ' . $class;
        }

        // Iniciar buffer de saída
        ob_start();
        ?>
        <div class="<?php echo esc_attr($alert_class); ?>"<?php echo !empty($id) ? ' id="' . esc_attr($id) . '"' : ''; ?>>
            <?php if ($dismissible) : ?>
                <button type="button" class="wp-component-alert__close" aria-label="<?php esc_attr_e('Fechar', 'wp-components'); ?>">
                    &times;
                </button>
            <?php endif; ?>
            
            <?php if (!empty($title)) : ?>
                <h4 class="wp-component-alert__title"><?php echo $title; ?></h4>
            <?php endif; ?>
            
            <?php if (!empty($content)) : ?>
                <div class="wp-component-alert__content">
                    <?php echo $content; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Alert::get_instance(); 