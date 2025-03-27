<?php
/**
 * Classe para o componente Tabs.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Tabs.
 */
class WP_Component_Tabs {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Tabs
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Tabs
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
     * Renderiza o componente Tabs.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'tabs'    => [],
            'active'  => 0,
            'class'   => '',
            'id'      => '',
        ]);

        // Sanitizar argumentos
        $tabs   = $args['tabs'];
        $active = absint($args['active']);
        $class  = sanitize_html_class($args['class']);
        $id     = sanitize_html_class($args['id']);

        // Verificar se há tabs
        if (empty($tabs) || !is_array($tabs)) {
            return '';
        }

        // Construir classes
        $tabs_class = 'wp-component-tabs';
        if (!empty($class)) {
            $tabs_class .= ' ' . $class;
        }

        // Gerar ID único se não fornecido
        $tabs_id = !empty($id) ? $id : 'tabs-' . wp_rand();

        // Iniciar buffer de saída
        ob_start();
        ?>
        <div class="<?php echo esc_attr($tabs_class); ?>"<?php echo !empty($id) ? ' id="' . esc_attr($id) . '"' : ''; ?>>
            <ul class="wp-component-tabs__nav" role="tablist">
                <?php foreach ($tabs as $index => $tab) : 
                    $tab_id = $tabs_id . '-' . $index;
                    $is_active = ($index === $active);
                ?>
                    <li class="wp-component-tabs__item" role="presentation">
                        <a href="#<?php echo esc_attr($tab_id); ?>" 
                           class="wp-component-tabs__link<?php echo $is_active ? ' active' : ''; ?>" 
                           id="<?php echo esc_attr($tab_id); ?>-tab" 
                           data-toggle="tab" 
                           role="tab" 
                           aria-controls="<?php echo esc_attr($tab_id); ?>" 
                           aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
                            <?php echo esc_html($tab['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <div class="wp-component-tabs__content">
                <?php foreach ($tabs as $index => $tab) : 
                    $tab_id = $tabs_id . '-' . $index;
                    $is_active = ($index === $active);
                ?>
                    <div class="wp-component-tabs__pane<?php echo $is_active ? ' active' : ''; ?>" 
                         id="<?php echo esc_attr($tab_id); ?>" 
                         role="tabpanel" 
                         aria-labelledby="<?php echo esc_attr($tab_id); ?>-tab">
                        <?php echo wp_kses_post($tab['content']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Tabs::get_instance(); 