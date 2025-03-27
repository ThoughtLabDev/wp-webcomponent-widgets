<?php
/**
 * Widget de Avatar para o Elementor.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget de Avatar para o Elementor.
 */
class WP_Components_Elementor_Avatar extends \Elementor\Widget_Base {

    /**
     * Obtém o nome do widget.
     *
     * @return string Nome do widget.
     */
    public function get_name() {
        return 'wp_components_avatar';
    }

    /**
     * Obtém o título do widget.
     *
     * @return string Título do widget.
     */
    public function get_title() {
        return __('WP Avatar', 'wp-components');
    }

    /**
     * Obtém o ícone do widget.
     *
     * @return string Ícone do widget.
     */
    public function get_icon() {
        return 'eicon-user-circle-o';
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
        return ['avatar', 'usuário', 'perfil', 'wp', 'components'];
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
            'avatar_type',
            [
                'label' => __('Tipo de Avatar', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => __('Imagem', 'wp-components'),
                    'text' => __('Texto', 'wp-components'),
                    'icon' => __('Ícone', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'src',
            [
                'label' => __('Imagem', 'wp-components'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'avatar_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'alt',
            [
                'label' => __('Texto Alternativo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __('Digite o texto alternativo da imagem', 'wp-components'),
                'condition' => [
                    'avatar_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Texto', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('JD', 'wp-components'),
                'placeholder' => __('Digite o texto para o avatar', 'wp-components'),
                'description' => __('Serão exibidas as iniciais do texto. Ex: "John Doe" será exibido como "JD".', 'wp-components'),
                'condition' => [
                    'avatar_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Ícone', 'wp-components'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'dashicons dashicons-admin-users',
                    'library' => 'solid',
                ],
                'condition' => [
                    'avatar_type' => 'icon',
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
                    'xs' => __('Extra Pequeno', 'wp-components'),
                    'sm' => __('Pequeno', 'wp-components'),
                    'md' => __('Médio', 'wp-components'),
                    'lg' => __('Grande', 'wp-components'),
                    'xl' => __('Extra Grande', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'variant',
            [
                'label' => __('Variante', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'circular',
                'options' => [
                    'circular' => __('Circular', 'wp-components'),
                    'rounded' => __('Arredondado', 'wp-components'),
                    'square' => __('Quadrado', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __('Cor', 'wp-components'),
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
                'condition' => [
                    'avatar_type!' => 'image',
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
            'size' => $settings['size'],
            'variant' => $settings['variant'],
        ];

        if ($settings['avatar_type'] === 'image' && !empty($settings['src']['url'])) {
            $args['src'] = $settings['src']['url'];
            $args['alt'] = $settings['alt'];
        } elseif ($settings['avatar_type'] === 'text') {
            $args['text'] = $settings['text'];
            $args['color'] = $settings['color'];
        } elseif ($settings['avatar_type'] === 'icon') {
            if (is_string($settings['icon']['value'])) {
                $args['icon'] = $settings['icon']['value'];
            } else {
                // Para ícones do Elementor, convertemos para classes do Dashicons
                $args['icon'] = 'dashicons dashicons-admin-users';
            }
            $args['color'] = $settings['color'];
        }

        echo wp_component_avatar($args);
    }

    /**
     * Renderiza o conteúdo do widget no editor.
     */
    protected function content_template() {
        ?>
        <# 
        var avatarClass = 'wp-component-avatar';
        
        if (settings.size) {
            avatarClass += ' wp-component-avatar--' + settings.size;
        }
        
        if (settings.variant) {
            avatarClass += ' wp-component-avatar--' + settings.variant;
        }
        
        if (settings.avatar_type !== 'image' && settings.color) {
            avatarClass += ' wp-component-avatar--' + settings.color;
        }
        #>
        
        <div class="{{ avatarClass }}">
            <# if (settings.avatar_type === 'image' && settings.src.url) { #>
                <img src="{{ settings.src.url }}" alt="{{ settings.alt }}" class="wp-component-avatar__img">
            <# } else if (settings.avatar_type === 'text') { #>
                <span class="wp-component-avatar__text">
                    <# 
                    var words = settings.text.split(' ');
                    var initials = '';
                    
                    if (words.length >= 2) {
                        initials = words[0].charAt(0) + words[words.length - 1].charAt(0);
                    } else if (words.length === 1) {
                        initials = words[0].charAt(0);
                    }
                    
                    initials = initials.toUpperCase();
                    #>
                    {{ initials }}
                </span>
            <# } else if (settings.avatar_type === 'icon') { #>
                <i class="wp-component-avatar__icon dashicons dashicons-admin-users"></i>
            <# } #>
        </div>
        <?php
    }
} 