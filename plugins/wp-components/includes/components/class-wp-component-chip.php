<?php
/**
 * Classe para o componente Chip.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Chip.
 */
class WP_Component_Chip {

    /**
     * Instância única desta classe.
     *
     * @var WP_Component_Chip
     */
    private static $instance;

    /**
     * Obtém a instância única desta classe.
     *
     * @return WP_Component_Chip
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Construtor privado para implementar o padrão Singleton.
     */
    private function __construct() {
        // Inicialização do componente
    }

    /**
     * Renderiza o componente Chip.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        $defaults = array(
            'text'        => '',
            'variant'     => 'default', // default, primary, secondary, success, warning, danger, info
            'size'        => 'md', // sm, md, lg
            'avatar'      => '', // URL da imagem do avatar
            'avatar_alt'  => '', // Texto alternativo para o avatar
            'icon'        => '', // Nome do ícone (FontAwesome ou outro)
            'deletable'   => false, // Se o chip pode ser deletado
            'outlined'    => false, // Se o chip deve ter apenas contorno
            'clickable'   => false, // Se o chip é clicável
            'href'        => '', // URL para chips clicáveis
            'class'       => '', // Classes adicionais
            'attributes'  => array(), // Atributos adicionais
        );

        $args = wp_parse_args($args, $defaults);
        
        $chip_class = 'wp-component-chip';
        $chip_class .= ' wp-component-chip--' . esc_attr($args['variant']);
        $chip_class .= ' wp-component-chip--' . esc_attr($args['size']);
        
        if ($args['outlined']) {
            $chip_class .= ' wp-component-chip--outlined';
        }
        
        if ($args['clickable'] || !empty($args['href'])) {
            $chip_class .= ' wp-component-chip--clickable';
        }
        
        if (!empty($args['class'])) {
            $chip_class .= ' ' . esc_attr($args['class']);
        }
        
        $attributes = '';
        if (!empty($args['attributes'])) {
            foreach ($args['attributes'] as $attr => $value) {
                $attributes .= ' ' . esc_attr($attr) . '="' . esc_attr($value) . '"';
            }
        }
        
        ob_start();
        
        if (!empty($args['href'])) {
            // Renderizar como link
            ?>
            <a href="<?php echo esc_url($args['href']); ?>" class="<?php echo esc_attr($chip_class); ?>"<?php echo $attributes; ?>>
                <?php $this->render_chip_content($args); ?>
            </a>
            <?php
        } else {
            // Renderizar como div
            ?>
            <div class="<?php echo esc_attr($chip_class); ?>"<?php echo $attributes; ?>>
                <?php $this->render_chip_content($args); ?>
            </div>
            <?php
        }
        
        return ob_get_clean();
    }
    
    /**
     * Renderiza o conteúdo interno do chip.
     *
     * @param array $args Argumentos para o componente.
     */
    private function render_chip_content($args) {
        // Avatar (se fornecido)
        if (!empty($args['avatar'])) {
            ?>
            <div class="wp-component-chip__avatar">
                <img src="<?php echo esc_url($args['avatar']); ?>" alt="<?php echo esc_attr($args['avatar_alt']); ?>">
            </div>
            <?php
        }
        
        // Ícone (se fornecido)
        if (!empty($args['icon'])) {
            ?>
            <div class="wp-component-chip__icon">
                <i class="<?php echo esc_attr($args['icon']); ?>"></i>
            </div>
            <?php
        }
        
        // Texto do chip
        if (!empty($args['text'])) {
            ?>
            <span class="wp-component-chip__label"><?php echo esc_html($args['text']); ?></span>
            <?php
        }
        
        // Botão de deletar (se habilitado)
        if ($args['deletable']) {
            ?>
            <button type="button" class="wp-component-chip__delete" aria-label="<?php esc_attr_e('Remover', 'wp-components'); ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="currentColor"/>
                </svg>
            </button>
            <?php
        }
    }
}

// Inicializar o componente
WP_Component_Chip::get_instance(); 