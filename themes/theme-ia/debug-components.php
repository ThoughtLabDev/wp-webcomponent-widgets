<?php
/**
 * Template Name: Depuração Completa de Componentes
 *
 * Modelo para depuração completa dos componentes e seus estilos.
 */

get_header();
?>

<div class="container" style="padding: 20px; max-width: 1200px; margin: 0 auto;">
    <h1>Depuração Completa de Componentes</h1>
    
    <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 30px; border-radius: 5px;">
        <h2>Informações de Depuração</h2>
        
        <h3>Estilos Enfileirados</h3>
        <div style="background-color: #fff; padding: 15px; border: 1px solid #ddd; overflow: auto; max-height: 200px;">
            <pre><?php 
                global $wp_styles;
                foreach ($wp_styles->queue as $handle) {
                    echo esc_html($handle) . ' - ' . esc_html($wp_styles->registered[$handle]->src) . "\n";
                }
            ?></pre>
        </div>
        
        <h3>Scripts Enfileirados</h3>
        <div style="background-color: #fff; padding: 15px; border: 1px solid #ddd; overflow: auto; max-height: 200px;">
            <pre><?php 
                global $wp_scripts;
                foreach ($wp_scripts->queue as $handle) {
                    echo esc_html($handle) . ' - ' . esc_html($wp_scripts->registered[$handle]->src) . "\n";
                }
            ?></pre>
        </div>
        
        <h3>Teste de Estilo Inline</h3>
        <div style="margin-top: 20px;">
            <button style="display: inline-block; font-weight: 500; text-align: center; white-space: nowrap; vertical-align: middle; user-select: none; border: 1px solid transparent; padding: .5rem 1rem; font-size: 1rem; line-height: 1.5; border-radius: 0.375rem; transition: all 0.3s ease; cursor: pointer; text-decoration: none; color: #fff; background-color: #4a6cf7; border-color: #4a6cf7;">
                Botão com Estilo Inline
            </button>
            <p><small>Se este botão estiver estilizado, o CSS inline está funcionando.</small></p>
        </div>
    </div>
    
    <div style="margin-bottom: 30px;">
        <h2>Teste de Componentes</h2>
        <p>Abaixo estão os componentes renderizados para teste. Cada componente tem uma versão com classes CSS e uma versão com estilos inline para comparação.</p>
    </div>
    
    <!-- Teste de Botões -->
    <div style="margin-bottom: 40px; border: 1px solid #eee; padding: 20px; border-radius: 5px;">
        <h3>Botões</h3>
        
        <div style="margin-bottom: 20px;">
            <h4>Com Classes CSS</h4>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <?php echo wp_component_button(['text' => 'Botão Primário', 'variant' => 'primary']); ?>
                <?php echo wp_component_button(['text' => 'Botão Secundário', 'variant' => 'secondary']); ?>
                <?php echo wp_component_button(['text' => 'Botão Sucesso', 'variant' => 'success']); ?>
                <?php echo wp_component_button(['text' => 'Botão Perigo', 'variant' => 'danger']); ?>
            </div>
        </div>
        
        <div>
            <h4>Com Estilos Inline</h4>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="#" style="display: inline-block; font-weight: 500; text-align: center; white-space: nowrap; vertical-align: middle; user-select: none; border: 1px solid transparent; padding: .5rem 1rem; font-size: 1rem; line-height: 1.5; border-radius: 0.375rem; transition: all 0.3s ease; cursor: pointer; text-decoration: none; color: #fff; background-color: #4a6cf7; border-color: #4a6cf7;">Botão Primário</a>
                <a href="#" style="display: inline-block; font-weight: 500; text-align: center; white-space: nowrap; vertical-align: middle; user-select: none; border: 1px solid transparent; padding: .5rem 1rem; font-size: 1rem; line-height: 1.5; border-radius: 0.375rem; transition: all 0.3s ease; cursor: pointer; text-decoration: none; color: #fff; background-color: #6c757d; border-color: #6c757d;">Botão Secundário</a>
                <a href="#" style="display: inline-block; font-weight: 500; text-align: center; white-space: nowrap; vertical-align: middle; user-select: none; border: 1px solid transparent; padding: .5rem 1rem; font-size: 1rem; line-height: 1.5; border-radius: 0.375rem; transition: all 0.3s ease; cursor: pointer; text-decoration: none; color: #fff; background-color: #2ecc71; border-color: #2ecc71;">Botão Sucesso</a>
                <a href="#" style="display: inline-block; font-weight: 500; text-align: center; white-space: nowrap; vertical-align: middle; user-select: none; border: 1px solid transparent; padding: .5rem 1rem; font-size: 1rem; line-height: 1.5; border-radius: 0.375rem; transition: all 0.3s ease; cursor: pointer; text-decoration: none; color: #fff; background-color: #e74c3c; border-color: #e74c3c;">Botão Perigo</a>
            </div>
        </div>
    </div>
    
    <!-- Teste de Cards -->
    <div style="margin-bottom: 40px; border: 1px solid #eee; padding: 20px; border-radius: 5px;">
        <h3>Cards</h3>
        
        <div style="margin-bottom: 20px;">
            <h4>Com Classes CSS</h4>
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
        
        <div>
            <h4>Com Estilos Inline</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="background-color: #fff; border-radius: 0.375rem; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); padding: 1.5rem; margin-bottom: 1.5rem; transition: all 0.3s ease; border: 1px solid #eaeaea; border-top: 3px solid #4a6cf7;">
                    <div style="margin-bottom: 1rem; border-bottom: 1px solid #eaeaea; padding-bottom: 1rem;">
                        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.25rem; margin-top: 0;">Card Primário</h2>
                        <p style="color: #666; font-size: .875rem; margin-top: 0; margin-bottom: 0;">Subtítulo do card</p>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <p>Este é um card primário com conteúdo de exemplo.</p>
                    </div>
                    <div style="border-top: 1px solid #eaeaea; padding-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                        Rodapé do Card
                    </div>
                </div>
                
                <div style="background-color: #fff; border-radius: 0.375rem; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); padding: 1.5rem; margin-bottom: 1.5rem; transition: all 0.3s ease; border: 1px solid #eaeaea; border-top: 3px solid #2ecc71;">
                    <div style="margin-bottom: 1rem; border-bottom: 1px solid #eaeaea; padding-bottom: 1rem;">
                        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.25rem; margin-top: 0;">Card Sucesso</h2>
                        <p style="color: #666; font-size: .875rem; margin-top: 0; margin-bottom: 0;">Subtítulo do card</p>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <p>Este é um card de sucesso com conteúdo de exemplo.</p>
                    </div>
                    <div style="border-top: 1px solid #eaeaea; padding-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                        Rodapé do Card
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Teste de Alertas -->
    <div style="margin-bottom: 40px; border: 1px solid #eee; padding: 20px; border-radius: 5px;">
        <h3>Alertas</h3>
        
        <div style="margin-bottom: 20px;">
            <h4>Com Classes CSS</h4>
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
            ?>
        </div>
        
        <div>
            <h4>Com Estilos Inline</h4>
            <div style="position: relative; padding: 1rem 1.5rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: 0.375rem; color: #2c4080; background-color: #e0e6fd; border-color: #d4dcfc;">
                <h4 style="font-weight: 600; margin-bottom: 0.25rem; margin-top: 0;">Alerta Primário</h4>
                <div>Este é um alerta primário com uma mensagem importante.</div>
            </div>
            
            <div style="position: relative; padding: 1rem 1.5rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: 0.375rem; color: #1d7a4d; background-color: #d7f3e3; border-color: #c7eed8;">
                <h4 style="font-weight: 600; margin-bottom: 0.25rem; margin-top: 0;">Alerta de Sucesso</h4>
                <div>Este é um alerta de sucesso. A operação foi concluída com êxito.</div>
            </div>
        </div>
    </div>
    
    <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
        <h3>Teste de CSS Inline no Tema</h3>
        <p>Vamos adicionar estilos diretamente no tema para garantir que os componentes tenham estilos básicos.</p>
        
        <div style="margin-top: 20px;">
            <button id="add-inline-styles" style="background-color: #4a6cf7; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">
                Adicionar Estilos Inline
            </button>
        </div>
        
        <script>
            document.getElementById('add-inline-styles').addEventListener('click', function() {
                // Criar elemento de estilo
                var style = document.createElement('style');
                style.textContent = `
                    .wp-component-button {
                        display: inline-block !important;
                        font-weight: 500 !important;
                        text-align: center !important;
                        white-space: nowrap !important;
                        vertical-align: middle !important;
                        user-select: none !important;
                        border: 1px solid transparent !important;
                        padding: .5rem 1rem !important;
                        font-size: 1rem !important;
                        line-height: 1.5 !important;
                        border-radius: 0.375rem !important;
                        transition: all 0.3s ease !important;
                        cursor: pointer !important;
                        text-decoration: none !important;
                    }
                    
                    .wp-component-button--primary {
                        color: #fff !important;
                        background-color: #4a6cf7 !important;
                        border-color: #4a6cf7 !important;
                    }
                    
                    .wp-component-button--secondary {
                        color: #fff !important;
                        background-color: #6c757d !important;
                        border-color: #6c757d !important;
                    }
                    
                    .wp-component-button--success {
                        color: #fff !important;
                        background-color: #2ecc71 !important;
                        border-color: #2ecc71 !important;
                    }
                    
                    .wp-component-button--danger {
                        color: #fff !important;
                        background-color: #e74c3c !important;
                        border-color: #e74c3c !important;
                    }
                `;
                document.head.appendChild(style);
                
                alert('Estilos inline adicionados com sucesso! Os componentes devem estar estilizados agora.');
            });
        </script>
    </div>
</div>

<?php
get_footer(); 