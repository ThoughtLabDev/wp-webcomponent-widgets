<?php
/**
 * Hero Component
 *
 * @package WPComponents
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * WP_Component_Hero Class
 */
class WP_Component_Hero {
    /**
     * Component name
     *
     * @var string
     */
    private $component_name = 'hero';

    /**
     * Default attributes
     *
     * @var array
     */
    private $default_attributes = array(
        'heading' => '',
        'subheading' => '',
        'ctaText' => '',
        'ctaUrl' => '',
        'secondaryCtaText' => '',
        'secondaryCtaUrl' => '',
        'backgroundImage' => '',
        'variant' => 'Split',
        'mediaUrl' => '',
        'mediaAlt' => '',
        'additionalImages' => [],
        'className' => '',
        'darkBackground' => false,
        'lightText' => false,
        'showDonationForm' => false,
        'showLeadGenForm' => false,
        'isMobile' => false,
    );

    /**
     * Constructor
     */
    public function __construct() {
        // Registra os estilos no init para garantir que as constantes estejam disponíveis
        add_action('init', array($this, 'register_styles'));
        // Enfileira os estilos quando necessário
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('elementor/frontend/after_register_styles', array($this, 'enqueue_styles'));
        add_action('elementor/preview/enqueue_styles', array($this, 'enqueue_styles'));
        
        // Registra o widget do Elementor
        if (did_action('elementor/loaded')) {
            add_action('elementor/widgets/register', array($this, 'register_elementor_widget'));
        }
    }

    /**
     * Register component styles
     */
    public function register_styles() {
        wp_register_style(
            'wp-component-hero',
            WP_COMPONENTS_PLUGIN_URL . 'public/css/components/hero.css',
            array(),
            WP_COMPONENTS_VERSION
        );
    }

    /**
     * Enqueue component styles
     */
    public function enqueue_styles() {
        if (!wp_style_is('wp-component-hero', 'registered')) {
            $this->register_styles();
        }
        wp_enqueue_style('wp-component-hero');
    }

    /**
     * Register Elementor widget
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_elementor_widget($widgets_manager) {
        require_once plugin_dir_path(WP_COMPONENTS_FILE) . 'includes/integrations/elementor/class-wp-components-elementor-hero.php';
        $widgets_manager->register(new WP_Components_Elementor_Hero());
    }

    /**
     * Render the hero component
     *
     * @param array $attributes Component attributes.
     * @return string
     */
    public function render($attributes = array()) {
        $attributes = wp_parse_args($attributes, $this->default_attributes);
        
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
        
        ob_start();
        ?>
        <section class="<?php echo esc_attr(implode(' ', $classes)); ?>" style="<?php echo esc_attr($background_style); ?>" role="region" aria-labelledby="hero-heading">
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
        return ob_get_clean();
    }
} 