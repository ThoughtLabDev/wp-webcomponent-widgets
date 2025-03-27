<?php
/**
 * Classe para o componente Avatar.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Avatar.
 */
class WP_Component_Avatar {

    /**
     * Instância única desta classe.
     *
     * @var WP_Component_Avatar
     */
    private static $instance;

    /**
     * Obtém a instância única desta classe.
     *
     * @return WP_Component_Avatar
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
     * Renderiza o componente Avatar.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        $defaults = array(
            'src'         => '', // URL da imagem
            'alt'         => '', // Texto alternativo
            'size'        => 'md', // xs, sm, md, lg, xl
            'variant'     => 'circular', // circular, rounded, square
            'text'        => '', // Texto para avatar (usado se src estiver vazio)
            'icon'        => '', // Ícone para avatar (usado se src e text estiverem vazios)
            'color'       => '', // Cor de fundo (primary, secondary, success, warning, danger, info)
            'class'       => '', // Classes adicionais
            'attributes'  => array(), // Atributos adicionais
        );

        $args = wp_parse_args($args, $defaults);
        
        $avatar_class = 'wp-component-avatar';
        $avatar_class .= ' wp-component-avatar--' . esc_attr($args['size']);
        $avatar_class .= ' wp-component-avatar--' . esc_attr($args['variant']);
        
        if (!empty($args['color'])) {
            $avatar_class .= ' wp-component-avatar--' . esc_attr($args['color']);
        }
        
        if (!empty($args['class'])) {
            $avatar_class .= ' ' . esc_attr($args['class']);
        }
        
        $attributes = '';
        if (!empty($args['attributes'])) {
            foreach ($args['attributes'] as $attr => $value) {
                $attributes .= ' ' . esc_attr($attr) . '="' . esc_attr($value) . '"';
            }
        }
        
        ob_start();
        ?>
        <div class="<?php echo esc_attr($avatar_class); ?>"<?php echo $attributes; ?>>
            <?php if (!empty($args['src'])) : ?>
                <img src="<?php echo esc_url($args['src']); ?>" alt="<?php echo esc_attr($args['alt']); ?>" class="wp-component-avatar__img">
            <?php elseif (!empty($args['text'])) : ?>
                <span class="wp-component-avatar__text"><?php echo esc_html($this->get_initials($args['text'])); ?></span>
            <?php elseif (!empty($args['icon'])) : ?>
                <i class="wp-component-avatar__icon <?php echo esc_attr($args['icon']); ?>"></i>
            <?php else : ?>
                <span class="wp-component-avatar__fallback">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="currentColor"/>
                    </svg>
                </span>
            <?php endif; ?>
        </div>
        <?php
        
        return ob_get_clean();
    }
    
    /**
     * Obtém as iniciais de um nome.
     *
     * @param string $name Nome completo.
     * @return string Iniciais (máximo 2 caracteres).
     */
    private function get_initials($name) {
        $words = explode(' ', $name);
        $initials = '';
        
        if (count($words) >= 2) {
            // Pegar a primeira letra do primeiro e último nome
            $initials = mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1);
        } elseif (count($words) === 1) {
            // Pegar a primeira letra do único nome
            $initials = mb_substr($words[0], 0, 1);
        }
        
        return mb_strtoupper($initials);
    }
}

// Inicializar o componente
WP_Component_Avatar::get_instance(); 