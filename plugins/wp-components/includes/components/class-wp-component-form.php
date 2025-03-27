<?php
/**
 * Classe para o componente Form.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe para o componente Form.
 */
class WP_Component_Form {

    /**
     * Instância única da classe.
     *
     * @var WP_Component_Form
     */
    private static $instance = null;

    /**
     * Obtém a instância única da classe.
     *
     * @return WP_Component_Form
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Construtor.
     */
    private function __construct() {
        // Inicialização
    }

    /**
     * Renderiza o componente Form.
     *
     * @param array $args Argumentos para o componente.
     * @return string HTML do componente.
     */
    public function render($args = []) {
        // Mesclar argumentos padrão
        $args = wp_parse_args($args, [
            'action'    => '',
            'method'    => 'post',
            'fields'    => [],
            'submit'    => __('Enviar', 'wp-components'),
            'enctype'   => '',
            'class'     => '',
            'id'        => '',
            'ajax'      => false,
            'callback'  => '',
        ]);

        // Sanitizar argumentos
        $action   = esc_url($args['action']);
        $method   = in_array(strtolower($args['method']), ['get', 'post']) ? strtolower($args['method']) : 'post';
        $fields   = $args['fields'];
        $submit   = esc_html($args['submit']);
        $enctype  = esc_attr($args['enctype']);
        $class    = sanitize_html_class($args['class']);
        $id       = sanitize_html_class($args['id']);
        $ajax     = (bool) $args['ajax'];
        $callback = esc_attr($args['callback']);

        // Verificar se há campos
        if (empty($fields) || !is_array($fields)) {
            return '';
        }

        // Construir classes
        $form_class = 'wp-component-form';
        if (!empty($class)) {
            $form_class .= ' ' . $class;
        }

        // Gerar ID único se não fornecido
        $form_id = !empty($id) ? $id : 'form-' . wp_rand();

        // Iniciar buffer de saída
        ob_start();
        ?>
        <form class="<?php echo esc_attr($form_class); ?>" 
              id="<?php echo esc_attr($form_id); ?>" 
              action="<?php echo $action; ?>" 
              method="<?php echo $method; ?>"
              <?php echo !empty($enctype) ? ' enctype="' . $enctype . '"' : ''; ?>
              <?php echo $ajax ? ' data-ajax="true"' : ''; ?>
              <?php echo !empty($callback) && $ajax ? ' data-callback="' . $callback . '"' : ''; ?>>
            
            <?php foreach ($fields as $field) : 
                // Mesclar argumentos padrão do campo
                $field = wp_parse_args($field, [
                    'type'        => 'text',
                    'name'        => '',
                    'id'          => '',
                    'label'       => '',
                    'placeholder' => '',
                    'value'       => '',
                    'options'     => [],
                    'required'    => false,
                    'class'       => '',
                    'wrapper'     => true,
                ]);
                
                // Sanitizar argumentos do campo
                $type        = esc_attr($field['type']);
                $name        = esc_attr($field['name']);
                $field_id    = !empty($field['id']) ? esc_attr($field['id']) : $name;
                $label       = esc_html($field['label']);
                $placeholder = esc_attr($field['placeholder']);
                $value       = esc_attr($field['value']);
                $options     = $field['options'];
                $required    = (bool) $field['required'];
                $field_class = sanitize_html_class($field['class']);
                $wrapper     = (bool) $field['wrapper'];
                
                // Verificar se o nome do campo está definido
                if (empty($name)) {
                    continue;
                }
                
                // Construir classes do campo
                $input_class = 'wp-component-form__input wp-component-form__input--' . $type;
                if (!empty($field_class)) {
                    $input_class .= ' ' . $field_class;
                }
                
                // Abrir wrapper do campo
                if ($wrapper) {
                    echo '<div class="wp-component-form__group">';
                }
                
                // Renderizar label se existir
                if (!empty($label)) {
                    echo '<label class="wp-component-form__label" for="' . esc_attr($field_id) . '">' . $label . ($required ? ' <span class="required">*</span>' : '') . '</label>';
                }
                
                // Renderizar campo com base no tipo
                switch ($type) {
                    case 'textarea':
                        ?>
                        <textarea class="<?php echo esc_attr($input_class); ?>" 
                                  id="<?php echo esc_attr($field_id); ?>" 
                                  name="<?php echo $name; ?>" 
                                  placeholder="<?php echo $placeholder; ?>"
                                  <?php echo $required ? ' required' : ''; ?>><?php echo esc_textarea($value); ?></textarea>
                        <?php
                        break;
                        
                    case 'select':
                        ?>
                        <select class="<?php echo esc_attr($input_class); ?>" 
                                id="<?php echo esc_attr($field_id); ?>" 
                                name="<?php echo $name; ?>"
                                <?php echo $required ? ' required' : ''; ?>>
                            <?php if (!empty($placeholder)) : ?>
                                <option value=""><?php echo $placeholder; ?></option>
                            <?php endif; ?>
                            
                            <?php foreach ($options as $option_value => $option_label) : ?>
                                <option value="<?php echo esc_attr($option_value); ?>"<?php selected($value, $option_value); ?>>
                                    <?php echo esc_html($option_label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        break;
                        
                    case 'radio':
                    case 'checkbox':
                        if (!empty($options) && is_array($options)) {
                            echo '<div class="wp-component-form__' . $type . '-group">';
                            
                            foreach ($options as $option_value => $option_label) {
                                $option_id = $field_id . '-' . sanitize_title($option_value);
                                ?>
                                <div class="wp-component-form__<?php echo $type; ?>">
                                    <input type="<?php echo $type; ?>" 
                                           class="<?php echo esc_attr($input_class); ?>" 
                                           id="<?php echo esc_attr($option_id); ?>" 
                                           name="<?php echo $name . ($type === 'checkbox' ? '[]' : ''); ?>" 
                                           value="<?php echo esc_attr($option_value); ?>"
                                           <?php echo $type === 'radio' ? checked($value, $option_value, false) : ''; ?>
                                           <?php echo $type === 'checkbox' && is_array($value) ? checked(in_array($option_value, $value), true, false) : ''; ?>
                                           <?php echo $required ? ' required' : ''; ?>>
                                    <label for="<?php echo esc_attr($option_id); ?>"><?php echo esc_html($option_label); ?></label>
                                </div>
                                <?php
                            }
                            
                            echo '</div>';
                        }
                        break;
                        
                    default:
                        ?>
                        <input type="<?php echo $type; ?>" 
                               class="<?php echo esc_attr($input_class); ?>" 
                               id="<?php echo esc_attr($field_id); ?>" 
                               name="<?php echo $name; ?>" 
                               value="<?php echo $value; ?>" 
                               placeholder="<?php echo $placeholder; ?>"
                               <?php echo $required ? ' required' : ''; ?>>
                        <?php
                        break;
                }
                
                // Fechar wrapper do campo
                if ($wrapper) {
                    echo '</div>';
                }
            endforeach; ?>
            
            <div class="wp-component-form__actions">
                <button type="submit" class="wp-component-button wp-component-button--primary">
                    <?php echo $submit; ?>
                </button>
            </div>
            
            <?php if ($ajax) : ?>
                <div class="wp-component-form__message" style="display: none;"></div>
            <?php endif; ?>
        </form>
        <?php
        return ob_get_clean();
    }
}

// Inicializar o componente
WP_Component_Form::get_instance(); 