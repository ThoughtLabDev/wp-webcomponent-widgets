<?php
/**
 * Classe para o componente Pagination.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Pagination.
 */
class WP_Component_Pagination {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Pagination
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Pagination
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
     * Renderiza o componente Pagination.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'total'       => 1,
            'current'     => 1,
            'base'        => '%_%',
            'format'      => '?paged=%#%',
            'show_all'    => false,
            'end_size'    => 1,
            'mid_size'    => 2,
            'prev_text'   => __('&laquo; Anterior', 'wp-components'),
            'next_text'   => __('Próximo &raquo;', 'wp-components'),
            'type'        => 'list',
            'add_args'    => [],
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number'  => '',
            'class'       => '',
            'id'          => '',
        ]);

        // Sanitizar argumentos
        $total       = absint($args['total']);
        $current     = absint($args['current']);
        $class       = sanitize_html_class($args['class']);
        $id          = sanitize_html_class($args['id']);

        // Verificar se a paginação é necessária
        if ($total <= 1) {
            return '';
        }

        // Construir classes
        $pagination_class = 'wp-component-pagination';
        if (!empty($class)) {
            $pagination_class .= ' ' . $class;
        }

        // Iniciar buffer de saída
        ob_start();
        
        // Adicionar wrapper com classes
        echo '<div class="' . esc_attr($pagination_class) . '"' . (!empty($id) ? ' id="' . esc_attr($id) . '"' : '') . '>';
        
        // Usar a função de paginação do WordPress
        echo paginate_links(array(
            'base'         => $args['base'],
            'format'       => $args['format'],
            'total'        => $total,
            'current'      => $current,
            'show_all'     => $args['show_all'],
            'end_size'     => $args['end_size'],
            'mid_size'     => $args['mid_size'],
            'prev_text'    => $args['prev_text'],
            'next_text'    => $args['next_text'],
            'type'         => $args['type'],
            'add_args'     => $args['add_args'],
            'add_fragment' => $args['add_fragment'],
            'before_page_number' => $args['before_page_number'],
            'after_page_number'  => $args['after_page_number'],
        ));
        
        echo '</div>';
        
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Pagination::get_instance(); 