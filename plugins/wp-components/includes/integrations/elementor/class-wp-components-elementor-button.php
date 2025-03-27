<?php
/**
 * Widget de Botão para o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget de Botão para o Elementor.
 */
class WP_Components_Elementor_Button extends \Elementor\Widget_Base {

    /**
     * Obtém o nome do widget.
     *
     * @return string Nome do widget.
     */
    public function get_name() {
        return 'wp_components_button';
    }

    /**
     * Obtém o título do widget.
     *
     * @return string Título do widget.
     */
    public function get_title() {
        return __('WP Button', 'wp-components');
    }

    /**
     * Obtém o ícone do widget.
     *
     * @return string Ícone do widget.
     */
    public function get_icon() {
        return 'eicon-button';
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
        return ['button', 'botão', 'wp', 'components'];
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
            'text',
            [
                'label' => __('Texto', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Clique Aqui', 'wp-components'),
                'placeholder' => __('Digite o texto do botão', 'wp-components'),
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => __('Link', 'wp-components'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://seu-link.com', 'wp-components'),
                'default' => [
                    'url' => '#',
                ],
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
                    'outline-primary' => __('Contorno Primário', 'wp-components'),
                    'outline-secondary' => __('Contorno Secundário', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => __('Tamanho', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'sm' => __('Pequeno', 'wp-components'),
                    '' => __('Médio', 'wp-components'),
                    'lg' => __('Grande', 'wp-components'),
                ],
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
            'text' => $settings['text'],
            'variant' => $settings['variant'],
            'size' => $settings['size'],
        ];

        if (!empty($settings['url']['url'])) {
            $args['url'] = $settings['url']['url'];
            $args['target'] = $settings['url']['is_external'] ? '_blank' : '';
            $args['rel'] = $settings['url']['nofollow'] ? 'nofollow' : '';
        }

        echo wp_component_button($args);
    }

    /**
     * Renderiza o conteúdo do widget no editor.
     */
    protected function content_template() {
        ?>
        <# 
        var buttonClasses = 'wp-component-button';
        
        if (settings.variant) {
            buttonClasses += ' wp-component-button--' + settings.variant;
        }
        
        if (settings.size) {
            buttonClasses += ' wp-component-button--' + settings.size;
        }
        
        var target = settings.url.is_external ? ' target="_blank"' : '';
        var nofollow = settings.url.nofollow ? ' rel="nofollow"' : '';
        #>
        
        <a href="{{ settings.url.url }}" class="{{ buttonClasses }}" {{{ target }}} {{{ nofollow }}}>
            {{ settings.text }}
        </a>
        <?php
    }
} 