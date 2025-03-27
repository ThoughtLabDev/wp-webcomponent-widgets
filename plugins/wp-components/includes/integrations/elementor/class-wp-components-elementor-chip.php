<?php
/**
 * Widget de Chip para o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget de Chip para o Elementor.
 */
class WP_Components_Elementor_Chip extends \Elementor\Widget_Base {

    /**
     * Obtém o nome do widget.
     *
     * @return string Nome do widget.
     */
    public function get_name() {
        return 'wp_components_chip';
    }

    /**
     * Obtém o título do widget.
     *
     * @return string Título do widget.
     */
    public function get_title() {
        return __('WP Chip', 'wp-components');
    }

    /**
     * Obtém o ícone do widget.
     *
     * @return string Ícone do widget.
     */
    public function get_icon() {
        return 'eicon-tags';
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
        return ['chip', 'tag', 'etiqueta', 'wp', 'components'];
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
                'default' => __('Chip', 'wp-components'),
                'placeholder' => __('Digite o texto do chip', 'wp-components'),
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

        $this->add_control(
            'size',
            [
                'label' => __('Tamanho', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'sm' => __('Pequeno', 'wp-components'),
                    'md' => __('Médio', 'wp-components'),
                    'lg' => __('Grande', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'outlined',
            [
                'label' => __('Contorno', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sim', 'wp-components'),
                'label_off' => __('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'clickable',
            [
                'label' => __('Clicável', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sim', 'wp-components'),
                'label_off' => __('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'href' => '',
                ],
            ]
        );

        $this->add_control(
            'href',
            [
                'label' => __('Link', 'wp-components'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://seu-link.com', 'wp-components'),
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'clickable' => '',
                ],
            ]
        );

        $this->add_control(
            'deletable',
            [
                'label' => __('Deletável', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Sim', 'wp-components'),
                'label_off' => __('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_avatar',
            [
                'label' => __('Avatar', 'wp-components'),
            ]
        );

        $this->add_control(
            'avatar',
            [
                'label' => __('Imagem do Avatar', 'wp-components'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'avatar_alt',
            [
                'label' => __('Texto Alternativo do Avatar', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __('Digite o texto alternativo do avatar', 'wp-components'),
                'condition' => [
                    'avatar[url]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Ícone', 'wp-components'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Ícone', 'wp-components'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid',
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
            'outlined' => $settings['outlined'] === 'yes',
            'clickable' => $settings['clickable'] === 'yes',
            'deletable' => $settings['deletable'] === 'yes',
        ];

        if (!empty($settings['href']['url'])) {
            $args['href'] = $settings['href']['url'];
        }

        if (!empty($settings['avatar']['url'])) {
            $args['avatar'] = $settings['avatar']['url'];
            $args['avatar_alt'] = $settings['avatar_alt'];
        }

        if (!empty($settings['icon']['value'])) {
            if (is_string($settings['icon']['value'])) {
                $args['icon'] = $settings['icon']['value'];
            } else {
                // Para ícones do Elementor, convertemos para classes do Dashicons
                $args['icon'] = 'dashicons dashicons-admin-generic';
            }
        }

        echo wp_component_chip($args);
    }

    /**
     * Renderiza o conteúdo do widget no editor.
     */
    protected function content_template() {
        ?>
        <# 
        var chipClass = 'wp-component-chip';
        
        if (settings.variant) {
            chipClass += ' wp-component-chip--' + settings.variant;
        }
        
        if (settings.size) {
            chipClass += ' wp-component-chip--' + settings.size;
        }
        
        if (settings.outlined === 'yes') {
            chipClass += ' wp-component-chip--outlined';
        }
        
        if (settings.clickable === 'yes' || settings.href.url) {
            chipClass += ' wp-component-chip--clickable';
        }
        
        var tag = settings.href.url ? 'a' : 'div';
        var href = settings.href.url ? 'href="' + settings.href.url + '"' : '';
        #>
        
        <{{{ tag }}} class="{{ chipClass }}" {{{ href }}}>
            <# if (settings.avatar.url) { #>
                <div class="wp-component-chip__avatar">
                    <img src="{{ settings.avatar.url }}" alt="{{ settings.avatar_alt }}">
                </div>
            <# } #>
            
            <# if (settings.icon.value) { #>
                <div class="wp-component-chip__icon">
                    <i class="dashicons dashicons-admin-generic"></i>
                </div>
            <# } #>
            
            <span class="wp-component-chip__label">{{ settings.text }}</span>
            
            <# if (settings.deletable === 'yes') { #>
                <button type="button" class="wp-component-chip__delete" aria-label="<?php echo esc_attr__('Remover', 'wp-components'); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="currentColor"/>
                    </svg>
                </button>
            <# } #>
        </{{{ tag }}}>
        <?php
    }
} 