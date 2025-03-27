<?php
/**
 * Template para a página principal do plugin na área administrativa.
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
            <?php _e('WP Components é uma biblioteca de componentes reutilizáveis para WordPress. Use os componentes em seus temas e plugins para criar interfaces consistentes e modernas.', 'wp-components'); ?>
        </p>
    </div>
    
    <div class="wp-components-admin-tabs">
        <div class="wp-components-admin-tabs-nav">
            <a href="#components" class="active"><?php _e('Componentes', 'wp-components'); ?></a>
            <a href="#usage"><?php _e('Como Usar', 'wp-components'); ?></a>
            <a href="#shortcodes"><?php _e('Shortcodes', 'wp-components'); ?></a>
            <a href="#about"><?php _e('Sobre', 'wp-components'); ?></a>
        </div>
        
        <div class="wp-components-admin-tabs-content">
            <div id="components" class="active">
                <h2><?php _e('Componentes Disponíveis', 'wp-components'); ?></h2>
                
                <div class="wp-components-admin-cards">
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Card', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Componente de card para exibir conteúdo em um contêiner com título, corpo e rodapé.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Button', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Botões estilizados com várias opções de cores, tamanhos e estilos.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Alert', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Alertas para exibir mensagens importantes, avisos ou erros.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Tabs', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Sistema de abas para organizar conteúdo em diferentes seções.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Accordion', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Acordeão para exibir conteúdo em seções expansíveis.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Form', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Componente de formulário com vários tipos de campos e validação.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Modal', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Janelas modais para exibir conteúdo em sobreposição.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Grid', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Sistema de grid responsivo para organizar conteúdo em colunas.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                    
                    <div class="wp-components-admin-card">
                        <div class="wp-components-admin-card-header">
                            <h2><?php _e('Pagination', 'wp-components'); ?></h2>
                        </div>
                        <div class="wp-components-admin-card-body">
                            <p><?php _e('Componente de paginação para navegar entre páginas de conteúdo.', 'wp-components'); ?></p>
                        </div>
                        <div class="wp-components-admin-card-footer">
                            <a href="#" class="button button-secondary"><?php _e('Ver Documentação', 'wp-components'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="usage">
                <h2><?php _e('Como Usar os Componentes', 'wp-components'); ?></h2>
                
                <div class="wp-components-admin-section">
                    <h3><?php _e('Usando Funções PHP', 'wp-components'); ?></h3>
                    <p><?php _e('Você pode usar as funções auxiliares para renderizar os componentes em seus temas ou plugins:', 'wp-components'); ?></p>
                    
                    <div class="wp-components-admin-code-example">
                        <pre><code>&lt;?php
// Exemplo de uso do componente Card
echo wp_component_card([
    'title' => 'Título do Card',
    'content' => 'Conteúdo do card',
    'footer' => 'Rodapé do card',
    'variant' => 'primary'
]);

// Exemplo de uso do componente Button
echo wp_component_button([
    'text' => 'Clique Aqui',
    'url' => '#',
    'variant' => 'primary'
]);
?&gt;</code></pre>
                        <button class="wp-components-admin-copy-code button button-secondary"><?php _e('Copiar', 'wp-components'); ?></button>
                    </div>
                </div>
                
                <div class="wp-components-admin-section">
                    <h3><?php _e('Usando Shortcodes', 'wp-components'); ?></h3>
                    <p><?php _e('Você também pode usar shortcodes para inserir componentes em posts ou páginas:', 'wp-components'); ?></p>
                    
                    <div class="wp-components-admin-code-example">
                        <pre><code><!-- Exemplo de shortcode para Card -->
[wp_component_card title="Título do Card" variant="primary"]
    Conteúdo do card
[/wp_component_card]

<!-- Exemplo de shortcode para Button -->
[wp_component_button text="Clique Aqui" url="#" variant="primary"]</code></pre>
                        <button class="wp-components-admin-copy-code button button-secondary"><?php _e('Copiar', 'wp-components'); ?></button>
                    </div>
                </div>
            </div>
            
            <div id="shortcodes">
                <h2><?php _e('Shortcodes Disponíveis', 'wp-components'); ?></h2>
                
                <div class="wp-components-admin-section">
                    <table class="widefat">
                        <thead>
                            <tr>
                                <th><?php _e('Shortcode', 'wp-components'); ?></th>
                                <th><?php _e('Descrição', 'wp-components'); ?></th>
                                <th><?php _e('Atributos', 'wp-components'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>[wp_component_card]</code></td>
                                <td><?php _e('Renderiza um card', 'wp-components'); ?></td>
                                <td><code>title, subtitle, variant, class, id</code></td>
                            </tr>
                            <tr>
                                <td><code>[wp_component_button]</code></td>
                                <td><?php _e('Renderiza um botão', 'wp-components'); ?></td>
                                <td><code>text, url, variant, size, class, id, target, rel</code></td>
                            </tr>
                            <tr>
                                <td><code>[wp_component_alert]</code></td>
                                <td><?php _e('Renderiza um alerta', 'wp-components'); ?></td>
                                <td><code>title, variant, dismissible, class, id</code></td>
                            </tr>
                            <tr>
                                <td><code>[wp_component_tabs]</code></td>
                                <td><?php _e('Renderiza um sistema de abas', 'wp-components'); ?></td>
                                <td><code>active, class, id</code></td>
                            </tr>
                            <tr>
                                <td><code>[wp_component_accordion]</code></td>
                                <td><?php _e('Renderiza um acordeão', 'wp-components'); ?></td>
                                <td><code>active, class, id</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="about">
                <h2><?php _e('Sobre o WP Components', 'wp-components'); ?></h2>
                
                <div class="wp-components-admin-section">
                    <p><?php _e('WP Components é uma biblioteca de componentes reutilizáveis para WordPress, projetada para ajudar desenvolvedores a criar interfaces consistentes e modernas para seus temas e plugins.', 'wp-components'); ?></p>
                    
                    <h3><?php _e('Recursos', 'wp-components'); ?></h3>
                    <ul>
                        <li><?php _e('Componentes reutilizáveis e personalizáveis', 'wp-components'); ?></li>
                        <li><?php _e('Design responsivo e moderno', 'wp-components'); ?></li>
                        <li><?php _e('Funções PHP e shortcodes para fácil implementação', 'wp-components'); ?></li>
                        <li><?php _e('Documentação completa', 'wp-components'); ?></li>
                    </ul>
                    
                    <h3><?php _e('Versão', 'wp-components'); ?></h3>
                    <p><?php echo sprintf(__('Você está usando a versão %s do WP Components.', 'wp-components'), WP_COMPONENTS_VERSION); ?></p>
                </div>
            </div>
        </div>
    </div>
</div> 