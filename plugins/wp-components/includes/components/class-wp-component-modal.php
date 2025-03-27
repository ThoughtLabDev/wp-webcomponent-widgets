<?php
/**
 * Classe para o componente Modal.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Modal.
 */
class WP_Component_Modal {

    /**
     * Instância única desta classe.
     *
     * @var WP_Component_Modal
     */
    private static $instance;

    /**
     * Obtém a instância única desta classe.
     *
     * @return WP_Component_Modal
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
     * Renderiza o componente Modal.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        $defaults = array(
            'id'      => 'modal-' . uniqid(),
            'title'   => '',
            'content' => '',
            'footer'  => '',
            'size'    => '', // sm, lg, xl
            'trigger' => array(
                'text'    => 'Abrir Modal',
                'class'   => 'wp-component-button wp-component-button--primary',
                'element' => 'button',
            ),
        );

        $args = wp_parse_args($args, $defaults);
        
        $modal_class = 'wp-component-modal';
        $dialog_class = 'wp-component-modal__dialog';
        
        if (!empty($args['size'])) {
            $dialog_class .= ' wp-component-modal__dialog--' . $args['size'];
        }
        
        ob_start();
        
        // Botão ou link para abrir o modal
        if (!empty($args['trigger'])) {
            $trigger_atts = array(
                'class' => $args['trigger']['class'],
                'data-modal-target' => $args['id'],
            );
            
            $trigger_atts_str = '';
            foreach ($trigger_atts as $key => $value) {
                $trigger_atts_str .= ' ' . $key . '="' . esc_attr($value) . '"';
            }
            
            if ($args['trigger']['element'] === 'a') {
                echo '<a href="#"' . $trigger_atts_str . '>' . esc_html($args['trigger']['text']) . '</a>';
            } else {
                echo '<button type="button"' . $trigger_atts_str . '>' . esc_html($args['trigger']['text']) . '</button>';
            }
        }
        
        // Modal
        ?>
        <div id="<?php echo esc_attr($args['id']); ?>" class="<?php echo esc_attr($modal_class); ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="<?php echo esc_attr($dialog_class); ?>" role="document">
                <div class="wp-component-modal__content">
                    <?php if (!empty($args['title'])) : ?>
                    <div class="wp-component-modal__header">
                        <h5 class="wp-component-modal__title"><?php echo esc_html($args['title']); ?></h5>
                        <button type="button" class="wp-component-modal__close" data-modal-dismiss aria-label="<?php esc_attr_e('Fechar', 'wp-components'); ?>">×</button>
                    </div>
                    <?php endif; ?>
                    
                    <div class="wp-component-modal__body">
                        <?php echo wp_kses_post($args['content']); ?>
                    </div>
                    
                    <?php if (!empty($args['footer'])) : ?>
                    <div class="wp-component-modal__footer">
                        <?php echo wp_kses_post($args['footer']); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Modal::get_instance(); 