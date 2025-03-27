<?php
/**
 * Template para a página de configurações do plugin na área administrativa.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <div class="wp-components-admin-header">
        <p class="wp-components-admin-description">
            <?php _e('Configure as opções do plugin WP Components.', 'wp-components'); ?>
        </p>
    </div>
    
    <form method="post" action="options.php" class="wp-components-admin-form">
        <?php
        // Registrar configurações
        settings_fields('wp_components_settings');
        do_settings_sections('wp_components_settings');
        ?>
        
        <h2><?php _e('Configurações Gerais', 'wp-components'); ?></h2>
        
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="wp_components_enable_shortcodes"><?php _e('Habilitar Shortcodes', 'wp-components'); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="wp_components_enable_shortcodes" name="wp_components_settings[enable_shortcodes]" value="1" <?php checked(1, get_option('wp_components_settings')['enable_shortcodes'] ?? 1); ?>>
                    <p class="description"><?php _e('Habilitar o uso de shortcodes para os componentes.', 'wp-components'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="wp_components_primary_color"><?php _e('Cor Primária', 'wp-components'); ?></label>
                </th>
                <td>
                    <input type="text" id="wp_components_primary_color" name="wp_components_settings[primary_color]" value="<?php echo esc_attr(get_option('wp_components_settings')['primary_color'] ?? '#4a6cf7'); ?>" class="wp-components-color-picker">
                    <p class="description"><?php _e('Cor primária para os componentes.', 'wp-components'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="wp_components_border_radius"><?php _e('Raio da Borda', 'wp-components'); ?></label>
                </th>
                <td>
                    <select id="wp_components_border_radius" name="wp_components_settings[border_radius]">
                        <option value="0" <?php selected('0', get_option('wp_components_settings')['border_radius'] ?? '0.375rem'); ?>><?php _e('Sem arredondamento', 'wp-components'); ?></option>
                        <option value="0.25rem" <?php selected('0.25rem', get_option('wp_components_settings')['border_radius'] ?? '0.375rem'); ?>><?php _e('Pequeno', 'wp-components'); ?></option>
                        <option value="0.375rem" <?php selected('0.375rem', get_option('wp_components_settings')['border_radius'] ?? '0.375rem'); ?>><?php _e('Médio', 'wp-components'); ?></option>
                        <option value="0.5rem" <?php selected('0.5rem', get_option('wp_components_settings')['border_radius'] ?? '0.375rem'); ?>><?php _e('Grande', 'wp-components'); ?></option>
                        <option value="1rem" <?php selected('1rem', get_option('wp_components_settings')['border_radius'] ?? '0.375rem'); ?>><?php _e('Extra Grande', 'wp-components'); ?></option>
                    </select>
                    <p class="description"><?php _e('Raio da borda para os componentes.', 'wp-components'); ?></p>
                </td>
            </tr>
        </table>
        
        <h2><?php _e('Configurações Avançadas', 'wp-components'); ?></h2>
        
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="wp_components_load_styles"><?php _e('Carregar Estilos', 'wp-components'); ?></label>
                </th>
                <td>
                    <select id="wp_components_load_styles" name="wp_components_settings[load_styles]">
                        <option value="all" <?php selected('all', get_option('wp_components_settings')['load_styles'] ?? 'all'); ?>><?php _e('Todas as páginas', 'wp-components'); ?></option>
                        <option value="admin" <?php selected('admin', get_option('wp_components_settings')['load_styles'] ?? 'all'); ?>><?php _e('Apenas no admin', 'wp-components'); ?></option>
                        <option value="frontend" <?php selected('frontend', get_option('wp_components_settings')['load_styles'] ?? 'all'); ?>><?php _e('Apenas no frontend', 'wp-components'); ?></option>
                        <option value="none" <?php selected('none', get_option('wp_components_settings')['load_styles'] ?? 'all'); ?>><?php _e('Não carregar estilos', 'wp-components'); ?></option>
                    </select>
                    <p class="description"><?php _e('Onde carregar os estilos CSS dos componentes.', 'wp-components'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="wp_components_load_scripts"><?php _e('Carregar Scripts', 'wp-components'); ?></label>
                </th>
                <td>
                    <select id="wp_components_load_scripts" name="wp_components_settings[load_scripts]">
                        <option value="all" <?php selected('all', get_option('wp_components_settings')['load_scripts'] ?? 'all'); ?>><?php _e('Todas as páginas', 'wp-components'); ?></option>
                        <option value="admin" <?php selected('admin', get_option('wp_components_settings')['load_scripts'] ?? 'all'); ?>><?php _e('Apenas no admin', 'wp-components'); ?></option>
                        <option value="frontend" <?php selected('frontend', get_option('wp_components_settings')['load_scripts'] ?? 'all'); ?>><?php _e('Apenas no frontend', 'wp-components'); ?></option>
                        <option value="none" <?php selected('none', get_option('wp_components_settings')['load_scripts'] ?? 'all'); ?>><?php _e('Não carregar scripts', 'wp-components'); ?></option>
                    </select>
                    <p class="description"><?php _e('Onde carregar os scripts JavaScript dos componentes.', 'wp-components'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="wp_components_custom_css"><?php _e('CSS Personalizado', 'wp-components'); ?></label>
                </th>
                <td>
                    <textarea id="wp_components_custom_css" name="wp_components_settings[custom_css]" rows="10" cols="50" class="large-text code"><?php echo esc_textarea(get_option('wp_components_settings')['custom_css'] ?? ''); ?></textarea>
                    <p class="description"><?php _e('CSS personalizado para os componentes. Será adicionado após os estilos padrão.', 'wp-components'); ?></p>
                </td>
            </tr>
        </table>
        
        <?php submit_button(__('Salvar Configurações', 'wp-components')); ?>
    </form>
</div> 