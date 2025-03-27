<?php
/**
 * Template Name: Depuração de Estilos
 *
 * Modelo para depurar os estilos enfileirados no WordPress.
 */

get_header();
?>

<div class="container">
    <h1>Depuração de Estilos Enfileirados</h1>
    
    <div class="debug-info">
        <h2>Estilos Registrados</h2>
        <pre><?php global $wp_styles; print_r($wp_styles->registered); ?></pre>
        
        <h2>Estilos Enfileirados</h2>
        <pre><?php print_r($wp_styles->queue); ?></pre>
    </div>
    
    <div class="components-demo">
        <h2>Demonstração de Componentes</h2>
        
        <h3>Botões</h3>
        <div class="demo-section">
            <?php echo wp_component_button(['text' => 'Botão Primário', 'variant' => 'primary']); ?>
            <?php echo wp_component_button(['text' => 'Botão Secundário', 'variant' => 'secondary']); ?>
            <?php echo wp_component_button(['text' => 'Botão Sucesso', 'variant' => 'success']); ?>
            <?php echo wp_component_button(['text' => 'Botão Perigo', 'variant' => 'danger']); ?>
        </div>
        
        <h3>Cards</h3>
        <div class="demo-section">
            <?php 
            echo wp_component_card([
                'title' => 'Título do Card',
                'content' => 'Este é o conteúdo do card. Você pode adicionar qualquer HTML aqui.',
                'footer' => 'Rodapé do Card',
                'variant' => 'primary'
            ]); 
            ?>
        </div>
        
        <h3>Alertas</h3>
        <div class="demo-section">
            <?php 
            echo wp_component_alert([
                'title' => 'Alerta de Sucesso',
                'content' => 'Esta é uma mensagem de sucesso.',
                'variant' => 'success'
            ]); 
            ?>
        </div>
    </div>
</div>

<?php
get_footer(); 