<?php
/**
 * Widget de Card para o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget de Card para o Elementor.
 */
class WP_Components_Elementor_Card extends \Elementor\Widget_Base {

    /**
     * Obtém o nome do widget.
     *
     * @return string Nome do widget.
     */
    public function get_name() {
        return 'wp_components_card';
    }

    /**
     * Obtém o título do widget.
     *
     * @return string Título do widget.
     */
    public function get_title() {
        return __('WP Card', 'wp-components');
    }

    /**
     * Obtém o ícone do widget.
     *
     * @return string Ícone do widget.
     */
    public function get_icon() {
        return 'eicon-posts-grid';
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
        return ['card', 'cartão', 'wp', 'components'];
    }

    /**
     * Registra os controles do widget.
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_header',
            [
                'label' => __('Cabeçalho', 'wp-components'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Título', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Título do Card', 'wp-components'),
                'placeholder' => __('Digite o título do card', 'wp-components'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtítulo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Subtítulo do Card', 'wp-components'),
                'placeholder' => __('Digite o subtítulo do card', 'wp-components'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Conteúdo', 'wp-components'),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Conteúdo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Conteúdo do card. Você pode adicionar texto, imagens e outros elementos aqui.', 'wp-components'),
                'placeholder' => __('Digite o conteúdo do card', 'wp-components'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_footer',
            [
                'label' => __('Rodapé', 'wp-components'),
            ]
        );

        $this->add_control(
            'footer',
            [
                'label' => __('Rodapé', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Rodapé do Card', 'wp-components'),
                'placeholder' => __('Digite o rodapé do card', 'wp-components'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Estilo', 'wp-components'),
            ]
        );

        $this->add_control(
            'variant',
            [
                'label' => __('Variante', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Padrão', 'wp-components'),
                    'primary' => __('Primário', 'wp-components'),
                    'secondary' => __('Secundário', 'wp-components'),
                    'success' => __('Sucesso', 'wp-components'),
                    'danger' => __('Perigo', 'wp-components'),
                    'warning' => __('Aviso', 'wp-components'),
                    'info' => __('Informação', 'wp-components'),
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
            'title' => $settings['title'],
            'subtitle' => $settings['subtitle'],
            'content' => $settings['content'],
            'footer' => $settings['footer'],
            'variant' => $settings['variant'],
        ];

        echo wp_component_card($args);
    }

    /**
     * Renderiza o conteúdo do widget no editor.
     */
    protected function content_template() {
        ?>
        <# 
        var cardClasses = 'wp-component-card';
        
        if (settings.variant && settings.variant !== 'default') {
            cardClasses += ' wp-component-card--' + settings.variant;
        }
        #>
        
        <div class="{{ cardClasses }}">
            <# if (settings.title || settings.subtitle) { #>
                <div class="wp-component-card__header">
                    <# if (settings.title) { #>
                        <h2 class="wp-component-card__title">{{{ settings.title }}}</h2>
                    <# } #>
                    <# if (settings.subtitle) { #>
                        <p class="wp-component-card__subtitle">{{{ settings.subtitle }}}</p>
                    <# } #>
                </div>
            <# } #>
            
            <# if (settings.content) { #>
                <div class="wp-component-card__body">
                    {{{ settings.content }}}
                </div>
            <# } #>
            
            <# if (settings.footer) { #>
                <div class="wp-component-card__footer">
                    {{{ settings.footer }}}
                </div>
            <# } #>
        </div>
        <?php
    }
} 