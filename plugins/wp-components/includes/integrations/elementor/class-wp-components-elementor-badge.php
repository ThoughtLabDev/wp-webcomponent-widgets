<?php
/**
 * Widget de Badge para o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget de Badge para o Elementor.
 */
class WP_Components_Elementor_Badge extends \Elementor\Widget_Base {

    /**
     * Obtém o nome do widget.
     *
     * @return string Nome do widget.
     */
    public function get_name() {
        return 'wp_components_badge';
    }

    /**
     * Obtém o título do widget.
     *
     * @return string Título do widget.
     */
    public function get_title() {
        return __('WP Badge', 'wp-components');
    }

    /**
     * Obtém o ícone do widget.
     *
     * @return string Ícone do widget.
     */
    public function get_icon() {
        return 'eicon-counter';
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
        return ['badge', 'emblema', 'contador', 'wp', 'components'];
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
            'content',
            [
                'label' => __('Conteúdo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('<button class="wp-component-button wp-component-button--primary">Notificações</button>', 'wp-components'),
                'description' => __('Conteúdo ao qual o badge será anexado. Pode ser um botão, texto, ícone, etc.', 'wp-components'),
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __('Texto do Badge', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '4',
                'placeholder' => __('Digite o texto do badge', 'wp-components'),
                'condition' => [
                    'dot' => '',
                ],
            ]
        );

        $this->add_control(
            'dot',
            [
                'label' => __('Exibir como Ponto', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sim', 'wp-components'),
                'label_off' => __('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'max',
            [
                'label' => __('Valor Máximo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '',
                'description' => __('Se o valor do badge for maior que este número, será exibido como "X+". Deixe em branco para desativar.', 'wp-components'),
                'condition' => [
                    'dot' => '',
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
                ],
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => __('Posição', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => [
                    'top-right' => __('Superior Direito', 'wp-components'),
                    'top-left' => __('Superior Esquerdo', 'wp-components'),
                    'bottom-right' => __('Inferior Direito', 'wp-components'),
                    'bottom-left' => __('Inferior Esquerdo', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'overlap',
            [
                'label' => __('Sobrepor', 'wp-components'),
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
            'content' => $settings['content'],
            'badge_text' => $settings['badge_text'],
            'variant' => $settings['variant'],
            'position' => $settings['position'],
            'overlap' => $settings['overlap'] === 'yes',
            'dot' => $settings['dot'] === 'yes',
        ];

        if (!empty($settings['max'])) {
            $args['max'] = intval($settings['max']);
        }

        echo wp_component_badge($args);
    }

    /**
     * Renderiza o conteúdo do widget no editor.
     */
    protected function content_template() {
        ?>
        <# 
        var badgeClass = 'wp-component-badge';
        
        if (settings.variant) {
            badgeClass += ' wp-component-badge--' + settings.variant;
        }
        
        if (settings.position) {
            badgeClass += ' wp-component-badge--' + settings.position;
        }
        
        if (settings.overlap === 'yes') {
            badgeClass += ' wp-component-badge--overlap';
        }
        
        if (settings.dot === 'yes') {
            badgeClass += ' wp-component-badge--dot';
        }
        
        var badgeText = settings.badge_text;
        
        if (settings.max && !isNaN(settings.max) && !isNaN(badgeText) && parseInt(badgeText) > parseInt(settings.max)) {
            badgeText = settings.max + '+';
        }
        #>
        
        <div class="wp-component-badge-wrapper">
            {{{ settings.content }}}
            <# if (settings.dot !== 'yes') { #>
                <span class="{{ badgeClass }}">{{ badgeText }}</span>
            <# } else { #>
                <span class="{{ badgeClass }}"></span>
            <# } #>
        </div>
        <?php
    }
} 