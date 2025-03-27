<?php
/**
 * Template Name: Teste de Componentes
 *
 * @package Theme_IA
 */

get_header();
?>

<div class="container" style="padding: 40px 20px;">
    <h1>Teste de Componentes</h1>
    <p>Esta página mostra os componentes com estilos aplicados diretamente do arquivo style.css do tema.</p>
    
    <hr style="margin: 30px 0;">
    
    <h2>Botões</h2>
    <div style="margin-bottom: 30px;">
        <a href="#" class="wp-component-button wp-component-button--primary">Botão Primário</a>
        <a href="#" class="wp-component-button wp-component-button--secondary">Botão Secundário</a>
        <a href="#" class="wp-component-button wp-component-button--success">Botão Sucesso</a>
        <a href="#" class="wp-component-button wp-component-button--danger">Botão Perigo</a>
        <a href="#" class="wp-component-button wp-component-button--outline-primary">Botão Outline</a>
    </div>
    
    <h2>Cards</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="wp-component-card wp-component-card--primary">
            <div class="wp-component-card__header">
                <h2 class="wp-component-card__title">Card Primário</h2>
                <p class="wp-component-card__subtitle">Subtítulo do card</p>
            </div>
            <div class="wp-component-card__body">
                <p>Este é um card primário com conteúdo de exemplo.</p>
            </div>
            <div class="wp-component-card__footer">
                Rodapé do Card
            </div>
        </div>
        
        <div class="wp-component-card wp-component-card--success">
            <div class="wp-component-card__header">
                <h2 class="wp-component-card__title">Card Sucesso</h2>
                <p class="wp-component-card__subtitle">Subtítulo do card</p>
            </div>
            <div class="wp-component-card__body">
                <p>Este é um card de sucesso com conteúdo de exemplo.</p>
            </div>
            <div class="wp-component-card__footer">
                Rodapé do Card
            </div>
        </div>
    </div>
    
    <h2>Alertas</h2>
    <div style="margin-bottom: 30px;">
        <div class="wp-component-alert wp-component-alert--primary">
            <h4 class="wp-component-alert__title">Alerta Primário</h4>
            <div>Este é um alerta primário com uma mensagem importante.</div>
        </div>
        
        <div class="wp-component-alert wp-component-alert--success">
            <h4 class="wp-component-alert__title">Alerta de Sucesso</h4>
            <div>Este é um alerta de sucesso. A operação foi concluída com êxito.</div>
        </div>
        
        <div class="wp-component-alert wp-component-alert--warning">
            <h4 class="wp-component-alert__title">Alerta de Aviso</h4>
            <div>Este é um alerta de aviso. Preste atenção a esta mensagem.</div>
        </div>
        
        <div class="wp-component-alert wp-component-alert--danger">
            <h4 class="wp-component-alert__title">Alerta de Perigo</h4>
            <div>Este é um alerta de perigo. Ocorreu um erro crítico.</div>
        </div>
    </div>
    
    <h2>Usando Funções do Tema</h2>
    <div style="margin-bottom: 30px;">
        <?php echo theme_ia_button([
            'text' => 'Botão via Função',
            'variant' => 'primary',
            'size' => 'lg'
        ]); ?>
        
        <?php echo theme_ia_card([
            'title' => 'Card via Função',
            'subtitle' => 'Criado usando a função do tema',
            'content' => '<p>Este card foi criado usando a função theme_ia_card() definida no arquivo functions.php.</p>',
            'footer' => 'Rodapé do Card',
            'variant' => 'primary'
        ]); ?>
    </div>
    
    <h2>Usando Componentes do Plugin</h2>
    <div style="margin-bottom: 30px;">
        <?php 
        if (function_exists('wp_component_button')) {
            echo wp_component_button([
                'text' => 'Botão do Plugin',
                'variant' => 'primary'
            ]);
            
            echo wp_component_card([
                'title' => 'Card do Plugin',
                'content' => 'Este card foi criado usando a função do plugin WP Components.',
                'variant' => 'primary'
            ]);
        } else {
            echo '<p>O plugin WP Components não está ativo ou as funções não estão disponíveis.</p>';
        }
        ?>
    </div>
</div>

<?php
get_footer(); 