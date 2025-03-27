<?php
/**
 * Classe para o componente Grid.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Grid.
 */
class WP_Component_Grid {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Grid
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Grid
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
     * Renderiza o componente Grid.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'columns'     => [
                'xs' => 1,
                'sm' => 2,
                'md' => 3,
                'lg' => 4,
            ],
            'gap'         => 'md',
            'items'       => [],
            'container'   => true,
            'class'       => '',
            'id'          => '',
        ]);

        // Sanitizar argumentos
        $columns   = $args['columns'];
        $gap       = sanitize_html_class($args['gap']);
        $items     = $args['items'];
        $container = (bool) $args['container'];
        $class     = sanitize_html_class($args['class']);
        $id        = sanitize_html_class($args['id']);

        // Verificar se há itens
        if (empty($items) || !is_array($items)) {
            return '';
        }

        // Construir classes
        $grid_class = 'wp-component-grid';
        
        // Adicionar classes de colunas
        foreach ($columns as $breakpoint => $count) {
            if (in_array($breakpoint, ['xs', 'sm', 'md', 'lg', 'xl']) && is_numeric($count) && $count > 0) {
                $grid_class .= ' wp-component-grid--' . $breakpoint . '-' . $count;
            }
        }
        
        // Adicionar classe de gap
        if (!empty($gap)) {
            $grid_class .= ' wp-component-grid--gap-' . $gap;
        }
        
        // Adicionar classe personalizada
        if (!empty($class)) {
            $grid_class .= ' ' . $class;
        }

        // Iniciar buffer de saída
        ob_start();
        
        // Abrir container se necessário
        if ($container) {
            echo '<div class="wp-component-container">';
        }
        ?>
        
        <div class="<?php echo esc_attr($grid_class); ?>"<?php echo !empty($id) ? ' id="' . esc_attr($id) . '"' : ''; ?>>
            <?php foreach ($items as $item) : ?>
                <div class="wp-component-grid__item">
                    <?php echo wp_kses_post($item); ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php
        // Fechar container se necessário
        if ($container) {
            echo '</div>';
        }
        
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Grid::get_instance(); 