<?php
/**
 * Hero Widget para Elementor
 *
 * @package WP_Components
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * WP_Components_Elementor_Hero Class
 */
class WP_Components_Elementor_Hero extends \Elementor\Widget_Base {
    /**
     * Get widget name
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'wp_components_hero';
    }

    /**
     * Get widget title
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Hero', 'wp-components');
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
        
        $attributes = [
            'heading' => $settings['heading'],
            'subheading' => $settings['subheading'] ?? '',
            'ctaText' => $settings['cta_text'] ?? '',
            'ctaUrl' => $settings['cta_url']['url'] ?? '',
            'secondaryCtaText' => $settings['secondary_cta_text'] ?? '',
            'secondaryCtaUrl' => $settings['secondary_cta_url']['url'] ?? '',
            'backgroundImage' => $settings['background_image']['url'] ?? '',
            'variant' => $settings['variant'] ?? 'Split',
            'mediaUrl' => $settings['media_url']['url'] ?? '',
            'mediaAlt' => $settings['media_alt'] ?? '',
            'additionalImages' => $additional_images,
            'className' => $settings['custom_css_class'] ?? '',
            'darkBackground' => $settings['dark_background'] === 'yes',
            'lightText' => $settings['light_text'] === 'yes',
            'showDonationForm' => $settings['show_donation_form'] === 'yes',
            'showLeadGenForm' => $settings['show_lead_gen_form'] === 'yes',
            'isMobile' => $settings['is_mobile'] === 'yes',
        ];

        $this->render_hero($attributes);
    }
    
    /**
     * Renderiza o componente Hero
     * 
     * @param array $attributes Atributos do componente.
     */
    protected function render_hero($attributes) {
        $baseClassName = 'wycliffe-hero';
        
        // Converte o nome da variante para formato kebab-case (para classe CSS)
        $variant_name = $attributes['variant'];
        $variant_class = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $variant_name));
        
        // Define se o texto deve ser claro com base na variante e no fundo
        $has_light_text_by_default = in_array($variant_class, ['centered', 'feature-split']) || $attributes['darkBackground'];
        $should_use_light_text = isset($attributes['lightText']) ? $attributes['lightText'] : $has_light_text_by_default;
        
        $classes = [
            $baseClassName,
            "{$baseClassName}--{$variant_class}",
            $attributes['darkBackground'] ? "{$baseClassName}--dark-background" : '',
            $should_use_light_text ? "{$baseClassName}--light-text" : '',
            $attributes['isMobile'] ? "{$baseClassName}--mobile" : '',
            $attributes['className'] ?? ''
        ];
        
        $classes = array_filter($classes);
        
        // Estilo de fundo para variante FullBackground
        $background_style = '';
        if (!empty($attributes['backgroundImage'])) {
            $background_style = "background-image: url({$attributes['backgroundImage']}); background-size: cover; background-position: center;";
        }
        
        // Verifica se é um vídeo
        $has_video = $attributes['variant'] === 'VideoSplit' && !empty($attributes['mediaUrl']);
        
        // Verifica se a variante deve exibir mídia
        $should_display_media = in_array($attributes['variant'], ['Split', 'VideoSplit', 'Centered', 'FeatureSplit']);
        
        // Tratamento especial para variantes AccentedSplit e FullBackground
        $is_accented_split = $attributes['variant'] === 'AccentedSplit';
        $is_full_background = $attributes['variant'] === 'FullBackground';
        
        ?>
        <section 
        class="<?php echo esc_attr(implode(' ', $classes)); ?>" 
        style="<?php echo esc_attr($background_style); ?>" 
        role="region" 
        aria-labelledby="hero-heading"
        >
            <div class="<?php echo esc_attr($baseClassName); ?>__content">
                <div class="<?php echo esc_attr($baseClassName); ?>__text-layout">
                    <?php if (!empty($attributes['subheading']) && !$is_accented_split && !$is_full_background) : ?>
                        <p class="<?php echo esc_attr($baseClassName); ?>__subtitle"><?php echo esc_html($attributes['subheading']); ?></p>
                    <?php endif; ?>
                    
                    <h1 id="hero-heading" class="<?php echo esc_attr($baseClassName); ?>__heading"><?php echo esc_html($attributes['heading']); ?></h1>
                    
                    <?php if (!empty($attributes['ctaText']) || !empty($attributes['secondaryCtaText'])) : ?>
                        <div class="<?php echo esc_attr($baseClassName); ?>__cta-container">
                            <?php if (!empty($attributes['ctaText']) && !empty($attributes['ctaUrl'])) : ?>
                                <a href="<?php echo esc_url($attributes['ctaUrl']); ?>" 
                                   class="<?php echo esc_attr($baseClassName); ?>__cta <?php echo esc_attr($baseClassName); ?>__cta--primary">
                                    <?php echo esc_html($attributes['ctaText']); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($attributes['secondaryCtaText']) && !empty($attributes['secondaryCtaUrl'])) : ?>
                                <a href="<?php echo esc_url($attributes['secondaryCtaUrl']); ?>" 
                                   class="<?php echo esc_attr($baseClassName); ?>__cta <?php echo esc_attr($baseClassName); ?>__cta--secondary">
                                    <?php echo esc_html($attributes['secondaryCtaText']); ?>
                                    <span class="<?php echo esc_attr($baseClassName); ?>__cta-caret"></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($attributes['showDonationForm']) : ?>
                    <div class="<?php echo esc_attr($baseClassName); ?>__donation-form">
                        <h3><?php echo esc_html__('Help share God\'s Word today!', 'wp-components'); ?></h3>
                        <div class="<?php echo esc_attr($baseClassName); ?>__donation-form-content">
                            <!-- Conteúdo do formulário de doação -->
                            <button class="<?php echo esc_attr($baseClassName); ?>__donate-button"><?php echo esc_html__('Donate', 'wp-components'); ?></button>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($attributes['showLeadGenForm']) : ?>
                    <div class="<?php echo esc_attr($baseClassName); ?>__lead-gen-form">
                        <h3><?php echo esc_html__('Stay Connected', 'wp-components'); ?></h3>
                        <div class="<?php echo esc_attr($baseClassName); ?>__lead-gen-form-content">
                            <!-- Campos do formulário -->
                            <button class="<?php echo esc_attr($baseClassName); ?>__signup-button"><?php echo esc_html__('Sign Up', 'wp-components'); ?></button>
                        </div>
                        <p class="<?php echo esc_attr($baseClassName); ?>__privacy-note"><?php echo esc_html__('We take your privacy seriously.', 'wp-components'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($attributes['mediaUrl']) && $should_display_media) : ?>
                <div class="<?php echo esc_attr($baseClassName); ?>__media-container">
                    <?php if ($has_video) : ?>
                        <div class="<?php echo esc_attr($baseClassName); ?>__video-wrapper">
                            <img 
                                src="<?php echo esc_url($attributes['mediaUrl']); ?>" 
                                alt="<?php echo esc_attr($attributes['mediaAlt'] ?? esc_html__('Video thumbnail', 'wp-components')); ?>" 
                                class="<?php echo esc_attr($baseClassName); ?>__video-thumbnail"
                            />
                            <button class="<?php echo esc_attr($baseClassName); ?>__play-button" aria-label="<?php echo esc_attr__('Play video', 'wp-components'); ?>">
                                <span class="<?php echo esc_attr($baseClassName); ?>__play-icon"></span>
                            </button>
                        </div>
                    <?php else : ?>
                        <img 
                            src="<?php echo esc_url($attributes['mediaUrl']); ?>" 
                            alt="<?php echo esc_attr($attributes['mediaAlt'] ?? ''); ?>" 
                            class="<?php echo esc_attr($baseClassName); ?>__image"
                        />
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($is_accented_split && !empty($attributes['additionalImages'])) : ?>
                <div class="<?php echo esc_attr($baseClassName); ?>__accent-media-container">
                    <?php foreach (array_slice($attributes['additionalImages'], 0, 2) as $index => $image) : ?>
                        <img 
                            src="<?php echo esc_url($image['url']); ?>" 
                            alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" 
                            class="<?php echo esc_attr($baseClassName); ?>__accent-image <?php echo esc_attr($baseClassName); ?>__accent-image--<?php echo esc_attr($index + 1); ?>"
                        />
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        <?php
    }
} 