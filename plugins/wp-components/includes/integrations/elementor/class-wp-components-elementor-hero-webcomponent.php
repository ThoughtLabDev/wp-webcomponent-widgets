<?php
/**
 * Hero Web Component Widget para Elementor
 *
 * @package WP_Components
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * WP_Components_Elementor_Hero_WebComponent Class
 */
class WP_Components_Elementor_Hero_WebComponent extends \Elementor\Widget_Base {
    /**
     * Get widget name
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'wp_components_hero_webcomponent';
    }

    /**
     * Get widget title
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Hero Web Component', 'wp-components');
    }

    /**
     * Get widget icon
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-banner';
    }

    /**
     * Get widget categories
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['wp-components'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        // Seção de Layout
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'wp-components'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'variant',
            [
                'label' => esc_html__('Variante', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'Split',
                'options' => [
                    'Split' => esc_html__('Split', 'wp-components'),
                    'VideoSplit' => esc_html__('Video Split', 'wp-components'),
                    'Centered' => esc_html__('Centered', 'wp-components'),
                    'FeatureSplit' => esc_html__('Feature Split', 'wp-components'),
                    'AccentedSplit' => esc_html__('Accented Split', 'wp-components'),
                    'FullBackground' => esc_html__('Full Background', 'wp-components'),
                ],
            ]
        );

        $this->add_control(
            'dark_background',
            [
                'label' => esc_html__('Fundo Escuro', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'wp-components'),
                'label_off' => esc_html__('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'light_text',
            [
                'label' => esc_html__('Texto Claro', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'wp-components'),
                'label_off' => esc_html__('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Use texto claro (branco) em vez de escuro', 'wp-components'),
            ]
        );

        $this->add_control(
            'is_mobile',
            [
                'label' => esc_html__('Forçar Layout Mobile', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'wp-components'),
                'label_off' => esc_html__('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Apenas para visualização', 'wp-components'),
            ]
        );

        $this->end_controls_section();

        // Seção de Conteúdo
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Conteúdo', 'wp-components'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__('Título', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Transform Lives Through Bible Translation', 'wp-components'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subheading',
            [
                'label' => esc_html__('Subtítulo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Heading Subtitle', 'wp-components'),
                'label_block' => true,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'variant',
                            'operator' => '!==',
                            'value' => 'AccentedSplit',
                        ],
                        [
                            'name' => 'variant',
                            'operator' => '!==',
                            'value' => 'FullBackground',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label' => esc_html__('Texto do Botão Primário', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Primary CTA', 'wp-components'),
            ]
        );

        $this->add_control(
            'cta_url',
            [
                'label' => esc_html__('Link do Botão Primário', 'wp-components'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://seu-link.com', 'wp-components'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'secondary_cta_text',
            [
                'label' => esc_html__('Texto do Botão Secundário', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Secondary CTA', 'wp-components'),
            ]
        );

        $this->add_control(
            'secondary_cta_url',
            [
                'label' => esc_html__('Link do Botão Secundário', 'wp-components'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://seu-link.com', 'wp-components'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Seção de Mídia
        $this->start_controls_section(
            'media_section',
            [
                'label' => esc_html__('Mídia', 'wp-components'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Imagem de Fundo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'FullBackground',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'media_url',
            [
                'label' => esc_html__('Mídia Principal', 'wp-components'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'Split',
                        ],
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'VideoSplit',
                        ],
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'Centered',
                        ],
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'FeatureSplit',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'media_alt',
            [
                'label' => esc_html__('Texto Alternativo da Mídia', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Descrição da imagem', 'wp-components'),
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'Split',
                        ],
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'VideoSplit',
                        ],
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'Centered',
                        ],
                        [
                            'name' => 'variant',
                            'operator' => '===',
                            'value' => 'FeatureSplit',
                        ],
                    ],
                ],
            ]
        );

        // Repeater para imagens adicionais (AccentedSplit)
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'url',
            [
                'label' => esc_html__('Imagem', 'wp-components'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'alt',
            [
                'label' => esc_html__('Texto Alternativo', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Descrição da imagem', 'wp-components'),
            ]
        );

        $this->add_control(
            'additional_images',
            [
                'label' => esc_html__('Imagens Adicionais', 'wp-components'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ alt }}}',
                'condition' => [
                    'variant' => 'AccentedSplit',
                ],
                'prevent_empty' => false,
                'description' => esc_html__('Adicione até 2 imagens para o layout AccentedSplit', 'wp-components'),
            ]
        );

        $this->end_controls_section();

        // Seção de Formulários
        $this->start_controls_section(
            'forms_section',
            [
                'label' => esc_html__('Formulários', 'wp-components'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_donation_form',
            [
                'label' => esc_html__('Mostrar Formulário de Doação', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'wp-components'),
                'label_off' => esc_html__('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_lead_gen_form',
            [
                'label' => esc_html__('Mostrar Formulário de Lead', 'wp-components'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Sim', 'wp-components'),
                'label_off' => esc_html__('Não', 'wp-components'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        // Seção de Estilos
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Estilos', 'wp-components'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => esc_html__('Tipografia do Título', 'wp-components'),
                'selector' => '{{WRAPPER}} .wycliffe-hero__heading',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_typography',
                'label' => esc_html__('Tipografia do Subtítulo', 'wp-components'),
                'selector' => '{{WRAPPER}} .wycliffe-hero__subtitle',
            ]
        );

        $this->add_control(
            'custom_css_class',
            [
                'label' => esc_html__('Classe CSS Personalizada', 'wp-components'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Prepara as imagens adicionais se estiverem definidas
        $additional_images = [];
        if (!empty($settings['additional_images']) && is_array($settings['additional_images'])) {
            foreach ($settings['additional_images'] as $image) {
                if (!empty($image['url']['url'])) {
                    $additional_images[] = [
                        'url' => $image['url']['url'],
                        'alt' => $image['alt']
                    ];
                }
            }
        }
        
        // Prepara os atributos para o web component
        $attributes = [
            'heading' => $settings['heading'],
            'subheading' => $settings['subheading'] ?? '',
            'cta-text' => $settings['cta_text'] ?? '',
            'cta-url' => $settings['cta_url']['url'] ?? '',
            'secondary-cta-text' => $settings['secondary_cta_text'] ?? '',
            'secondary-cta-url' => $settings['secondary_cta_url']['url'] ?? '',
            'background-image' => $settings['background_image']['url'] ?? '',
            'variant' => $settings['variant'] ?? 'Split',
            'media-url' => $settings['media_url']['url'] ?? '',
            'media-alt' => $settings['media_alt'] ?? '',
            'dark-background' => $settings['dark_background'] === 'yes' ? 'true' : 'false',
            'light-text' => $settings['light_text'] === 'yes' ? 'true' : 'false',
            'show-donation-form' => $settings['show_donation_form'] === 'yes' ? 'true' : 'false',
            'show-lead-gen-form' => $settings['show_lead_gen_form'] === 'yes' ? 'true' : 'false',
            'is-mobile' => $settings['is_mobile'] === 'yes' ? 'true' : 'false',
            'class' => $settings['custom_css_class'] ?? '',
        ];

        // Converte o array de imagens adicionais para JSON
        if (!empty($additional_images)) {
            $attributes['additional-images'] = json_encode($additional_images);
        }

        // Renderiza o web component
        echo '<wycliffe-hero ' . $this->render_attributes($attributes) . '></wycliffe-hero>';
        
        // Adiciona debug para verificar se os scripts estão sendo carregados
        if (WP_DEBUG) {
            echo '<!-- Debug: Verificando se os scripts do web component estão carregados -->
            <script>
            console.log("Scripts carregados:", {
                react: typeof React !== "undefined",
                reactDOM: typeof ReactDOM !== "undefined",
                customElements: typeof customElements !== "undefined",
                wycliffeHero: customElements.get("wycliffe-hero") !== undefined
            });
            </script>';
        }
    }

    /**
     * Renderiza os atributos do web component
     * 
     * @param array $attributes Array de atributos
     * @return string String de atributos formatada
     */
    private function render_attributes($attributes) {
        $rendered = [];
        foreach ($attributes as $key => $value) {
            if (!empty($value)) {
                $rendered[] = sprintf('%s="%s"', $key, esc_attr($value));
            }
        }
        return implode(' ', $rendered);
    }
} 