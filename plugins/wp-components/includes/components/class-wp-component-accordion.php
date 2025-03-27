<?php
/**
 * Classe para o componente Accordion.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Accordion.
 */
class WP_Component_Accordion {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Accordion
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Accordion
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
     * Renderiza o componente Accordion.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'items'  => [],
            'active' => -1, // -1 significa nenhum item ativo inicialmente
            'class'  => '',
            'id'     => '',
        ]);

        // Sanitizar argumentos
        $items  = $args['items'];
        $active = intval($args['active']);
        $class  = sanitize_html_class($args['class']);
        $id     = sanitize_html_class($args['id']);

        // Verificar se há itens
        if (empty($items) || !is_array($items)) {
            return '';
        }

        // Construir classes
        $accordion_class = 'wp-component-accordion';
        if (!empty($class)) {
            $accordion_class .= ' ' . $class;
        }

        // Gerar ID único se não fornecido
        $accordion_id = !empty($id) ? $id : 'accordion-' . wp_rand();

        // Iniciar buffer de saída
        ob_start();
        ?>
        <div class="<?php echo esc_attr($accordion_class); ?>"<?php echo !empty($id) ? ' id="' . esc_attr($id) . '"' : ''; ?>>
            <?php foreach ($items as $index => $item) : 
                $item_id = $accordion_id . '-' . $index;
                $is_active = ($index === $active);
            ?>
                <div class="wp-component-accordion__item">
                    <h2 class="wp-component-accordion__header" id="heading-<?php echo esc_attr($item_id); ?>">
                        <button class="wp-component-accordion__button<?php echo !$is_active ? ' collapsed' : ''; ?>" 
                                type="button" 
                                data-toggle="collapse" 
                                data-target="#collapse-<?php echo esc_attr($item_id); ?>" 
                                aria-expanded="<?php echo $is_active ? 'true' : 'false'; ?>" 
                                aria-controls="collapse-<?php echo esc_attr($item_id); ?>">
                            <?php echo esc_html($item['title']); ?>
                        </button>
                    </h2>
                    
                    <div id="collapse-<?php echo esc_attr($item_id); ?>" 
                         class="wp-component-accordion__collapse<?php echo $is_active ? ' show' : ''; ?>" 
                         aria-labelledby="heading-<?php echo esc_attr($item_id); ?>" 
                         data-parent="#<?php echo esc_attr($accordion_id); ?>">
                        <div class="wp-component-accordion__body">
                            <?php echo wp_kses_post($item['content']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Accordion::get_instance(); 