<?php
/**
 * Widget de Alerta para o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget de Alerta para o Elementor.
 */
class WP_Components_Elementor_Alert extends \Elementor\Widget_Base {

    /**
     * Obtém o nome do widget.
     *
     * @return string Nome do widget.
     */
    public function get_name() {
        return 'wp_components_alert';
    }

    /**
     * Obtém o título do widget.
     *
     * @return string Título do widget.
     */
    public function get_title() {
        return __('WP Alert', 'wp-components');
    }

    /**
     * Obtém o ícone do widget.
     *
     * @return string Ícone do widget.
     */
    public function get_icon() {
        return 'eicon-alert';
    }

    /**
     * Obtém as categorias do widget.
     *
     * @return array Categorias do widget.
     */
    public function get_categories() {
        return ['wp-components'];
    }

    /**
     * Obtém as palavras-chave do widget.
     *
     * @return array Palavras-chave do widget.
     */
    public function get_keywords() {
        return ['alert', 'alerta', 'notificação', 'wp', 'components'];
    }

    /**
     * Registra os controles do widget.
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Conteúdo', 'wp-components'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Título', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Título do Alerta', 'wp-components'),
                'placeholder' => __('Digite o título do alerta', 'wp-components'),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Conteúdo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Conteúdo do alerta. Esta é uma mensagem importante.', 'wp-components'),
                'placeholder' => __('Digite o conteúdo do alerta', 'wp-components'),
            ]
        );

        $this->add_control(
            'variant',
            [
                'label' => __('Variante', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary' => __('Primário', 'wp-components'),
                    'secondary' => __('Secundário', 'wp-components'),
                    'success' => __('Sucesso', 'wp-components'),
                    'danger' => __('Perigo', 'wp-components'),
                    'warning' => __('Aviso', 'wp-components'),
                    'info' => __('Informação', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'dismissible',
            [
                'label' => __('Dispensável', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sim', 'wp-components'),
                'label_off' => __('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Renderiza o widget.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = [
            'title' => $settings['title'],
            'content' => $settings['content'],
            'variant' => $settings['variant'],
            'dismissible' => $settings['dismissible'] === 'yes',
        ];

        echo wp_component_alert($args);
    }

    /**
     * Renderiza o conteúdo do widget no editor.
     */
    protected function content_template() {
        ?>
        <# 
        var alertClasses = 'wp-component-alert';
        
        if (settings.variant) {
            alertClasses += ' wp-component-alert--' + settings.variant;
        }
        #>
        
        <div class="{{ alertClasses }}">
            <# if (settings.title) { #>
                <h4 class="wp-component-alert__title">{{{ settings.title }}}</h4>
            <# } #>
            
            <div>{{{ settings.content }}}</div>
            
            <# if (settings.dismissible === 'yes') { #>
                <button class="wp-component-alert__close" aria-label="<?php echo esc_attr__('Fechar', 'wp-components'); ?>">×</button>
            <# } #>
        </div>
        <?php
    }
} 