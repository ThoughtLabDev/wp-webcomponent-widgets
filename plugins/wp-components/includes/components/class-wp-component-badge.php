<?php
/**
 * Classe para o componente Badge.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Badge.
 */
class WP_Component_Badge {

    /**
     * Instância única desta classe.
     *
     * @var WP_Component_Badge
     */
    private static $instance;

    /**
     * Obtém a instância única desta classe.
     *
     * @return WP_Component_Badge
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
        // Inicialização do componente
    }

    /**
     * Renderiza o componente Badge.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        $defaults = array(
            'content'     => '',
            'badge_text'  => '',
            'variant'     => 'primary', // primary, secondary, success, warning, danger, info
            'position'    => 'top-right', // top-right, top-left, bottom-right, bottom-left
            'overlap'     => true,
            'max'         => null,
            'dot'         => false,
            'class'       => '',
        );

        $args = wp_parse_args($args, $defaults);
        
        $badge_class = 'wp-component-badge';
        $badge_class .= ' wp-component-badge--' . esc_attr($args['variant']);
        $badge_class .= ' wp-component-badge--' . esc_attr($args['position']);
        
        if ($args['overlap']) {
            $badge_class .= ' wp-component-badge--overlap';
        }
        
        if ($args['dot']) {
            $badge_class .= ' wp-component-badge--dot';
        }
        
        if (!empty($args['class'])) {
            $badge_class .= ' ' . esc_attr($args['class']);
        }
        
        $badge_text = $args['badge_text'];
        
        // Se max for definido e o texto do badge for numérico e maior que max
        if ($args['max'] !== null && is_numeric($badge_text) && intval($badge_text) > $args['max']) {
            $badge_text = $args['max'] . '+';
        }
        
        ob_start();
        ?>
        <div class="wp-component-badge-wrapper">
            <?php echo wp_kses_post($args['content']); ?>
            <?php if (!$args['dot']) : ?>
                <span class="<?php echo esc_attr($badge_class); ?>"><?php echo esc_html($badge_text); ?></span>
            <?php else : ?>
                <span class="<?php echo esc_attr($badge_class); ?>"></span>
            <?php endif; ?>
        </div>
        <?php
        
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Badge::get_instance(); 