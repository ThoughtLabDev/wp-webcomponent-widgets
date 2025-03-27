<?php
/**
 * Classe para o componente Button.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Button.
 */
class WP_Component_Button {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Button
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Button
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
     * Renderiza o componente Button.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'text'    => '',
            'url'     => '#',
            'variant' => 'primary',
            'size'    => '',
            'class'   => '',
            'id'      => '',
            'target'  => '',
            'rel'     => '',
            'onclick' => '',
        ]);

        // Sanitizar argumentos
        $text    = esc_html($args['text']);
        $url     = esc_url($args['url']);
        $variant = sanitize_html_class($args['variant']);
        $size    = sanitize_html_class($args['size']);
        $class   = sanitize_html_class($args['class']);
        $id      = sanitize_html_class($args['id']);
        $target  = esc_attr($args['target']);
        $rel     = esc_attr($args['rel']);
        $onclick = esc_js($args['onclick']);

        // Construir classes
        $button_class = 'wp-component-button';
        if (!empty($variant)) {
            $button_class .= ' wp-component-button--' . $variant;
        }
        if (!empty($size)) {
            $button_class .= ' wp-component-button--' . $size;
        }
        if (!empty($class)) {
            $button_class .= ' ' . $class;
        }

        // Construir atributos adicionais
        $attributes = '';
        if (!empty($id)) {
            $attributes .= ' id="' . esc_attr($id) . '"';
        }
        if (!empty($target)) {
            $attributes .= ' target="' . $target . '"';
        }
        if (!empty($rel)) {
            $attributes .= ' rel="' . $rel . '"';
        }
        if (!empty($onclick)) {
            $attributes .= ' onclick="' . $onclick . '"';
        }

        // Iniciar buffer de saída
        ob_start();
        ?>
        <a href="<?php echo $url; ?>" class="<?php echo esc_attr($button_class); ?>"<?php echo $attributes; ?>>
            <?php echo $text; ?>
        </a>
        <?php
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Button::get_instance(); 