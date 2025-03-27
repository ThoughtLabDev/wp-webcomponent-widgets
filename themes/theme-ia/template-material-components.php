<?php
/**
 * Template Name: Componentes Material
 *
 * Template para demonstrar os componentes estilo Material UI.
 */

get_header();
?>

<div class="container">
    <h1>Componentes Estilo Material UI</h1>
    <p>Esta página demonstra os componentes do plugin WP Components inspirados no Material UI.</p>
    
    <section class="component-section">
        <h2>Badges</h2>
        <div class="component-demo">
            <h3>Badges em Botões</h3>
            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <?php 
                echo wp_component_badge([
                    'content' => wp_component_button(['text' => 'Notificações', 'variant' => 'primary']),
                    'badge_text' => '4',
                    'variant' => 'primary',
                    'position' => 'top-right'
                ]); 
                
                echo wp_component_badge([
                    'content' => wp_component_button(['text' => 'Mensagens', 'variant' => 'secondary']),
                    'badge_text' => '12',
                    'variant' => 'secondary',
                    'position' => 'top-right',
                    'max' => 9
                ]); 
                
                echo wp_component_badge([
                    'content' => wp_component_button(['text' => 'Alertas', 'variant' => 'danger']),
                    'dot' => true,
                    'variant' => 'danger',
                    'position' => 'top-right'
                ]); 
                ?>
            </div>
            
            <h3>Posições do Badge</h3>
            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <?php 
                $positions = ['top-right', 'top-left', 'bottom-right', 'bottom-left'];
                
                foreach ($positions as $position) {
                    echo wp_component_badge([
                        'content' => '<div style="width: 40px; height: 40px; background-color: #f0f0f0; border-radius: 4px;"></div>',
                        'badge_text' => '1',
                        'variant' => 'primary',
                        'position' => $position
                    ]); 
                }
                ?>
            </div>
            
            <h3>Variantes de Badge</h3>
            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <?php 
                $variants = ['primary', 'secondary', 'success', 'warning', 'danger', 'info'];
                
                foreach ($variants as $variant) {
                    echo wp_component_badge([
                        'content' => '<div style="width: 40px; height: 40px; background-color: #f0f0f0; border-radius: 4px;"></div>',
                        'badge_text' => '1',
                        'variant' => $variant,
                        'position' => 'top-right'
                    ]); 
                }
                ?>
            </div>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Chips</h2>
        <div class="component-demo">
            <h3>Chips Básicos</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                <?php 
                echo wp_component_chip(['text' => 'Chip Básico']); 
                echo wp_component_chip(['text' => 'Chip Clicável', 'clickable' => true]); 
                echo wp_component_chip(['text' => 'Chip com Link', 'href' => '#']); 
                echo wp_component_chip(['text' => 'Chip Deletável', 'deletable' => true]); 
                ?>
            </div>
            
            <h3>Tamanhos de Chips</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                <?php 
                echo wp_component_chip(['text' => 'Chip Pequeno', 'size' => 'sm']); 
                echo wp_component_chip(['text' => 'Chip Médio', 'size' => 'md']); 
                echo wp_component_chip(['text' => 'Chip Grande', 'size' => 'lg']); 
                ?>
            </div>
            
            <h3>Variantes de Chips</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                <?php 
                $variants = ['default', 'primary', 'secondary', 'success', 'warning', 'danger', 'info'];
                
                foreach ($variants as $variant) {
                    echo wp_component_chip([
                        'text' => ucfirst($variant),
                        'variant' => $variant
                    ]); 
                }
                ?>
            </div>
            
            <h3>Chips Outline</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                <?php 
                foreach ($variants as $variant) {
                    echo wp_component_chip([
                        'text' => ucfirst($variant),
                        'variant' => $variant,
                        'outlined' => true
                    ]); 
                }
                ?>
            </div>
            
            <h3>Chips com Avatar</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                <?php 
                echo wp_component_chip([
                    'text' => 'John Doe',
                    'avatar' => 'https://i.pravatar.cc/300?img=1',
                    'avatar_alt' => 'John Doe'
                ]); 
                
                echo wp_component_chip([
                    'text' => 'Jane Smith',
                    'avatar' => 'https://i.pravatar.cc/300?img=5',
                    'avatar_alt' => 'Jane Smith',
                    'deletable' => true
                ]); 
                ?>
            </div>
            
            <h3>Chips com Ícones</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                <?php 
                echo wp_component_chip([
                    'text' => 'Add',
                    'icon' => 'dashicons dashicons-plus',
                    'variant' => 'primary'
                ]); 
                
                echo wp_component_chip([
                    'text' => 'Delete',
                    'icon' => 'dashicons dashicons-trash',
                    'variant' => 'danger'
                ]); 
                
                echo wp_component_chip([
                    'text' => 'Done',
                    'icon' => 'dashicons dashicons-yes',
                    'variant' => 'success'
                ]); 
                ?>
            </div>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Avatares</h2>
        <div class="component-demo">
            <h3>Tamanhos de Avatar</h3>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                <?php 
                $sizes = ['xs', 'sm', 'md', 'lg', 'xl'];
                
                foreach ($sizes as $size) {
                    echo wp_component_avatar([
                        'src' => 'https://i.pravatar.cc/300?img=3',
                        'alt' => 'Avatar',
                        'size' => $size
                    ]); 
                }
                ?>
            </div>
            
            <h3>Variantes de Avatar</h3>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                <?php 
                $variants = ['circular', 'rounded', 'square'];
                
                foreach ($variants as $variant) {
                    echo wp_component_avatar([
                        'src' => 'https://i.pravatar.cc/300?img=4',
                        'alt' => 'Avatar',
                        'variant' => $variant
                    ]); 
                }
                ?>
            </div>
            
            <h3>Avatares com Texto</h3>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                <?php 
                echo wp_component_avatar([
                    'text' => 'John Doe',
                    'color' => 'primary'
                ]); 
                
                echo wp_component_avatar([
                    'text' => 'Jane Smith',
                    'color' => 'secondary'
                ]); 
                
                echo wp_component_avatar([
                    'text' => 'Alice',
                    'color' => 'success'
                ]); 
                ?>
            </div>
            
            <h3>Avatares com Ícones</h3>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                <?php 
                echo wp_component_avatar([
                    'icon' => 'dashicons dashicons-admin-users',
                    'color' => 'primary'
                ]); 
                
                echo wp_component_avatar([
                    'icon' => 'dashicons dashicons-businesswoman',
                    'color' => 'secondary'
                ]); 
                
                echo wp_component_avatar([
                    'icon' => 'dashicons dashicons-businessman',
                    'color' => 'info'
                ]); 
                ?>
            </div>
            
            <h3>Cores de Avatar</h3>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                <?php 
                $colors = ['primary', 'secondary', 'success', 'warning', 'danger', 'info'];
                
                foreach ($colors as $color) {
                    echo wp_component_avatar([
                        'text' => substr(ucfirst($color), 0, 1),
                        'color' => $color
                    ]); 
                }
                ?>
            </div>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Combinando Componentes</h2>
        <div class="component-demo">
            <h3>Card com Avatar e Chips</h3>
            <div style="max-width: 400px; margin-bottom: 20px;">
                <?php 
                $card_content = '
                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                        ' . wp_component_avatar([
                            'src' => 'https://i.pravatar.cc/300?img=8',
                            'alt' => 'John Doe',
                            'size' => 'lg'
                        ]) . '
                        <div style="margin-left: 15px;">
                            <h3 style="margin: 0; font-size: 1.2rem;">John Doe</h3>
                            <p style="margin: 5px 0 0; color: #666;">Desenvolvedor Web</p>
                        </div>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 15px;">
                        ' . wp_component_chip(['text' => 'WordPress', 'variant' => 'primary', 'size' => 'sm']) . '
                        ' . wp_component_chip(['text' => 'PHP', 'variant' => 'secondary', 'size' => 'sm']) . '
                        ' . wp_component_chip(['text' => 'JavaScript', 'variant' => 'info', 'size' => 'sm']) . '
                    </div>
                ';
                
                echo wp_component_card([
                    'content' => $card_content,
                    'variant' => 'default'
                ]); 
                ?>
            </div>
            
            <h3>Botão com Badge e Avatar</h3>
            <div style="margin-bottom: 20px;">
                <?php 
                $button_content = '
                    <div style="display: flex; align-items: center; gap: 8px;">
                        ' . wp_component_avatar([
                            'src' => 'https://i.pravatar.cc/300?img=2',
                            'alt' => 'Avatar',
                            'size' => 'xs'
                        ]) . '
                        <span>Mensagens</span>
                    </div>
                ';
                
                echo wp_component_badge([
                    'content' => wp_component_button([
                        'html' => $button_content,
                        'variant' => 'primary'
                    ]),
                    'badge_text' => '5',
                    'variant' => 'danger',
                    'position' => 'top-right'
                ]); 
                ?>
            </div>
        </div>
    </section>
</div>

<?php
get_footer(); 