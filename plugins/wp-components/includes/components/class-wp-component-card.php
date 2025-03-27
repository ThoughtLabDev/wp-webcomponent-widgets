<?php
/**
 * Classe para o componente Card.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Card.
 */
class WP_Component_Card {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Card
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Card
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
     * Renderiza o componente Card.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'title'    => '',
            'subtitle' => '',
            'content'  => '',
            'footer'   => [],
            'variant'  => '',
            'class'    => '',
            'id'       => '',
        ]);

        // Sanitizar argumentos
        $title    = esc_html($args['title']);
        $subtitle = esc_html($args['subtitle']);
        $content  = wp_kses_post($args['content']);
        $variant  = sanitize_html_class($args['variant']);
        $class    = sanitize_html_class($args['class']);
        $id       = sanitize_html_class($args['id']);

        // Construir classes
        $card_class = 'wp-component-card';
        if (!empty($variant)) {
            $card_class .= ' wp-component-card--' . $variant;
        }
        if (!empty($class)) {
            $card_class .= ' ' . $class;
        }

        // Iniciar buffer de saída
        ob_start();
        ?>
        <div class="<?php echo esc_attr($card_class); ?>"<?php echo !empty($id) ? ' id="' . esc_attr($id) . '"' : ''; ?>>
            <?php if (!empty($title) || !empty($subtitle)) : ?>
                <div class="wp-component-card__header">
                    <?php if (!empty($title)) : ?>
                        <h3 class="wp-component-card__title"><?php echo $title; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($subtitle)) : ?>
                        <p class="wp-component-card__subtitle"><?php echo $subtitle; ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($content)) : ?>
                <div class="wp-component-card__body">
                    <?php echo $content; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($args['footer'])) : ?>
                <div class="wp-component-card__footer">
                    <?php
                    // Botão primário
                    if (!empty($args['footer']['primary_button'])) {
                        $primary_button = wp_parse_args($args['footer']['primary_button'], [
                            'text' => '',
                            'url'  => '#',
                            'class' => '',
                        ]);
                        
                        echo '<a href="' . esc_url($primary_button['url']) . '" class="wp-component-button wp-component-button--primary ' . esc_attr($primary_button['class']) . '">' . esc_html($primary_button['text']) . '</a>';
                    }
                    
                    // Botão secundário
                    if (!empty($args['footer']['secondary_button'])) {
                        $secondary_button = wp_parse_args($args['footer']['secondary_button'], [
                            'text' => '',
                            'url'  => '#',
                            'class' => '',
                        ]);
                        
                        echo '<a href="' . esc_url($secondary_button['url']) . '" class="wp-component-button wp-component-button--outline-primary ' . esc_attr($secondary_button['class']) . '">' . esc_html($secondary_button['text']) . '</a>';
                    }
                    
                    // Conteúdo personalizado do rodapé
                    if (!empty($args['footer']['content'])) {
                        echo wp_kses_post($args['footer']['content']);
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Card::get_instance(); 