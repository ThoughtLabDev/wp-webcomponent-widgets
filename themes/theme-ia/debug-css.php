<?php
/**
 * Template Name: Depuração de CSS
 *
 * Modelo para depurar o CSS dos componentes.
 */

get_header();
?>

<div class="container">
    <h1>Depuração de CSS dos Componentes</h1>
    
    <div class="debug-info">
        <h2>Informações de Depuração</h2>
        <p>Esta página exibe todos os componentes para verificar se o CSS está sendo aplicado corretamente.</p>
        
        <h3>Estilos Enfileirados</h3>
        <pre><?php 
            global $wp_styles;
            foreach ($wp_styles->queue as $handle) {
                echo esc_html($handle) . ' - ' . esc_html($wp_styles->registered[$handle]->src) . "\n";
            }
        ?></pre>
    </div>
    
    <hr>
    
    <div class="component-demo">
        <h2>Botões</h2>
        <div class="demo-section" style="margin-bottom: 20px;">
            <div style="margin-bottom: 10px;">
                <?php echo wp_component_button(['text' => 'Botão Primário', 'variant' => 'primary']); ?>
                <?php echo wp_component_button(['text' => 'Botão Secundário', 'variant' => 'secondary']); ?>
                <?php echo wp_component_button(['text' => 'Botão Sucesso', 'variant' => 'success']); ?>
                <?php echo wp_component_button(['text' => 'Botão Perigo', 'variant' => 'danger']); ?>
            </div>
            <div>
                <?php echo wp_component_button(['text' => 'Botão Outline', 'variant' => 'outline-primary']); ?>
                <?php echo wp_component_button(['text' => 'Botão Pequeno', 'variant' => 'primary', 'size' => 'sm']); ?>
                <?php echo wp_component_button(['text' => 'Botão Grande', 'variant' => 'primary', 'size' => 'lg']); ?>
            </div>
        </div>
        
        <h2>Cards</h2>
        <div class="demo-section" style="margin-bottom: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <?php 
                echo wp_component_card([
                    'title' => 'Card Primário',
                    'subtitle' => 'Subtítulo do card',
                    'content' => '<p>Este é um card primário com conteúdo de exemplo.</p>',
                    'footer' => 'Rodapé do Card',
                    'variant' => 'primary'
                ]); 
                
                echo wp_component_card([
                    'title' => 'Card Sucesso',
                    'subtitle' => 'Subtítulo do card',
                    'content' => '<p>Este é um card de sucesso com conteúdo de exemplo.</p>',
                    'footer' => 'Rodapé do Card',
                    'variant' => 'success'
                ]); 
                ?>
            </div>
        </div>
        
        <h2>Alertas</h2>
        <div class="demo-section" style="margin-bottom: 20px;">
            <?php 
            echo wp_component_alert([
                'title' => 'Alerta Primário',
                'content' => 'Este é um alerta primário com uma mensagem importante.',
                'variant' => 'primary',
                'dismissible' => true
            ]); 
            
            echo wp_component_alert([
                'title' => 'Alerta de Sucesso',
                'content' => 'Este é um alerta de sucesso. A operação foi concluída com êxito.',
                'variant' => 'success',
                'dismissible' => true
            ]); 
            
            echo wp_component_alert([
                'title' => 'Alerta de Aviso',
                'content' => 'Este é um alerta de aviso. Preste atenção a esta mensagem.',
                'variant' => 'warning',
                'dismissible' => true
            ]); 
            
            echo wp_component_alert([
                'title' => 'Alerta de Perigo',
                'content' => 'Este é um alerta de perigo. Ocorreu um erro crítico.',
                'variant' => 'danger',
                'dismissible' => true
            ]); 
            ?>
        </div>
        
        <h2>Abas</h2>
        <div class="demo-section" style="margin-bottom: 20px;">
            <?php 
            echo wp_component_tabs([
                'tabs' => [
                    [
                        'title' => 'Aba 1',
                        'content' => '<p>Conteúdo da primeira aba. Você pode adicionar qualquer HTML aqui.</p>'
                    ],
                    [
                        'title' => 'Aba 2',
                        'content' => '<p>Conteúdo da segunda aba. Este é um exemplo de conteúdo em uma aba.</p>'
                    ],
                    [
                        'title' => 'Aba 3',
                        'content' => '<p>Conteúdo da terceira aba. As abas são úteis para organizar conteúdo em seções.</p>'
                    ]
                ],
                'active' => 0
            ]); 
            ?>
        </div>
        
        <h2>Acordeão</h2>
        <div class="demo-section" style="margin-bottom: 20px;">
            <?php 
            echo wp_component_accordion([
                'items' => [
                    [
                        'title' => 'Item 1 do Acordeão',
                        'content' => '<p>Conteúdo do primeiro item do acordeão. Você pode adicionar qualquer HTML aqui.</p>'
                    ],
                    [
                        'title' => 'Item 2 do Acordeão',
                        'content' => '<p>Conteúdo do segundo item do acordeão. Este é um exemplo de conteúdo em um acordeão.</p>'
                    ],
                    [
                        'title' => 'Item 3 do Acordeão',
                        'content' => '<p>Conteúdo do terceiro item do acordeão. Os acordeões são úteis para economizar espaço vertical.</p>'
                    ]
                ],
                'active' => 0
            ]); 
            ?>
        </div>
    </div>
    
    <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
        <h3>Código HTML Gerado</h3>
        <p>Inspecione o código HTML gerado para verificar se as classes CSS estão sendo aplicadas corretamente.</p>
    </div>
</div>

<?php
get_footer(); 