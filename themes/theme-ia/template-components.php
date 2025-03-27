<?php
/**
 * Template Name: Componentes WP
 *
 * Template para demonstrar os componentes do plugin WP Components.
 */

get_header();
?>

<div class="container">
    <h1>Demonstração de Componentes WP</h1>
    
    <section class="component-section">
        <h2>Botões</h2>
        <div class="component-demo">
            <?php echo wp_component_button(['text' => 'Botão Primário', 'variant' => 'primary', 'url' => 'https://www.google.com', 'target' => '_blank']); ?>
            <?php echo wp_component_button(['text' => 'Botão Secundário', 'variant' => 'secondary']); ?>
            <?php echo wp_component_button(['text' => 'Botão Sucesso', 'variant' => 'success']); ?>
            <?php echo wp_component_button(['text' => 'Botão Perigo', 'variant' => 'danger']); ?>
            <?php echo wp_component_button(['text' => 'Botão Outline', 'variant' => 'outline-primary']); ?>
            <?php echo wp_component_button(['text' => 'Botão Pequeno', 'variant' => 'primary', 'size' => 'sm']); ?>
            <?php echo wp_component_button(['text' => 'Botão Grande', 'variant' => 'primary', 'size' => 'lg']); ?>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Cards</h2>
        <div class="component-demo">
            <div class="row">
                <div class="col-md-6">
                    <?php 
                    echo wp_component_card([
                        'title' => 'Card Primário',
                        'subtitle' => 'Subtítulo do card',
                        'content' => '<p>Este é um card primário com conteúdo de exemplo. Você pode adicionar qualquer HTML aqui.</p>',
                        'footer' => 'Rodapé do Card',
                        'variant' => 'primary'
                    ]); 
                    ?>
                </div>
                <div class="col-md-6">
                    <?php 
                    echo wp_component_card([
                        'title' => 'Card Sucesso',
                        'subtitle' => 'Subtítulo do card',
                        'content' => '<p>Este é um card de sucesso com conteúdo de exemplo. Você pode adicionar qualquer HTML aqui.</p>',
                        'footer' => 'Rodapé do Card',
                        'variant' => 'success'
                    ]); 
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Alertas</h2>
        <div class="component-demo">
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
    </section>
    
    <section class="component-section">
        <h2>Abas</h2>
        <div class="component-demo">
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
    </section>
    
    <section class="component-section">
        <h2>Acordeão</h2>
        <div class="component-demo">
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
    </section>
    
    <section class="component-section">
        <h2>Formulário</h2>
        <div class="component-demo">
            <?php 
            echo wp_component_form([
                'action' => '',
                'method' => 'post',
                'fields' => [
                    [
                        'type' => 'text',
                        'name' => 'nome',
                        'label' => 'Nome',
                        'placeholder' => 'Digite seu nome',
                        'required' => true
                    ],
                    [
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'E-mail',
                        'placeholder' => 'Digite seu e-mail',
                        'required' => true
                    ],
                    [
                        'type' => 'select',
                        'name' => 'assunto',
                        'label' => 'Assunto',
                        'placeholder' => 'Selecione um assunto',
                        'options' => [
                            'suporte' => 'Suporte Técnico',
                            'vendas' => 'Vendas',
                            'outro' => 'Outro Assunto'
                        ],
                        'required' => true
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'mensagem',
                        'label' => 'Mensagem',
                        'placeholder' => 'Digite sua mensagem',
                        'required' => true
                    ]
                ],
                'submit' => 'Enviar Mensagem'
            ]); 
            ?>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Modal</h2>
        <div class="component-demo">
            <h3>Modal Simples</h3>
            <?php 
            echo wp_component_modal([
                'id' => 'exemplo-modal-1',
                'title' => 'Título do Modal',
                'content' => '<p>Este é o conteúdo do modal. Você pode adicionar qualquer HTML aqui.</p>',
                'footer' => '<button type="button" class="wp-component-button wp-component-button--secondary wp-component-modal-close">Fechar</button> <button type="button" class="wp-component-button wp-component-button--primary">Salvar</button>',
                'trigger' => [
                    'text' => 'Abrir Modal Simples',
                    'class' => 'wp-component-button wp-component-button--primary',
                    'element' => 'button'
                ]
            ]); 
            ?>
            
            <h3>Modal Grande</h3>
            <?php 
            echo wp_component_modal([
                'id' => 'exemplo-modal-2',
                'title' => 'Modal Grande',
                'content' => '<p>Este é um modal grande com mais conteúdo.</p><p>Você pode adicionar muito mais conteúdo aqui, como imagens, tabelas, formulários, etc.</p>',
                'footer' => '<button type="button" class="wp-component-button wp-component-button--secondary wp-component-modal-close">Cancelar</button> <button type="button" class="wp-component-button wp-component-button--primary">Confirmar</button>',
                'size' => 'lg',
                'trigger' => [
                    'text' => 'Abrir Modal Grande',
                    'class' => 'wp-component-button wp-component-button--secondary',
                    'element' => 'button'
                ]
            ]); 
            ?>
            
            <h3>Modal com Formulário</h3>
            <?php 
            $form_content = wp_component_form([
                'fields' => [
                    [
                        'type' => 'text',
                        'name' => 'nome_modal',
                        'label' => 'Nome',
                        'placeholder' => 'Digite seu nome',
                        'required' => true
                    ],
                    [
                        'type' => 'email',
                        'name' => 'email_modal',
                        'label' => 'E-mail',
                        'placeholder' => 'Digite seu e-mail',
                        'required' => true
                    ]
                ],
                'submit' => false
            ]);
            
            echo wp_component_modal([
                'id' => 'exemplo-modal-3',
                'title' => 'Formulário em Modal',
                'content' => $form_content,
                'footer' => '<button type="button" class="wp-component-button wp-component-button--secondary wp-component-modal-close">Cancelar</button> <button type="button" class="wp-component-button wp-component-button--primary">Enviar</button>',
                'trigger' => [
                    'text' => 'Abrir Modal com Formulário',
                    'class' => 'wp-component-button wp-component-button--success',
                    'element' => 'button'
                ]
            ]); 
            ?>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Grid</h2>
        <div class="component-demo">
            <?php 
            $items = [];
            for ($i = 1; $i <= 6; $i++) {
                $items[] = wp_component_card([
                    'title' => 'Item ' . $i,
                    'content' => '<p>Este é o conteúdo do item ' . $i . ' no grid.</p>',
                    'variant' => 'primary'
                ]);
            }
            
            echo wp_component_grid([
                'columns' => [
                    'xs' => 1,
                    'sm' => 2,
                    'md' => 3
                ],
                'gap' => 'md',
                'items' => $items
            ]); 
            ?>
        </div>
    </section>
    
    <section class="component-section">
        <h2>Paginação</h2>
        <div class="component-demo">
            <?php 
            echo wp_component_pagination([
                'total' => 10,
                'current' => 3
            ]); 
            ?>
        </div>
    </section>
    
    <!-- Novos componentes estilo Material UI -->
    
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
            
            <h3>Lista de Usuários com Avatar e Chip</h3>
            <div style="max-width: 500px; margin-bottom: 20px; border: 1px solid #eaeaea; border-radius: 4px; overflow: hidden;">
                <?php
                $users = [
                    [
                        'name' => 'John Doe',
                        'role' => 'Administrador',
                        'status' => 'online',
                        'avatar' => 'https://i.pravatar.cc/300?img=1'
                    ],
                    [
                        'name' => 'Jane Smith',
                        'role' => 'Editor',
                        'status' => 'offline',
                        'avatar' => 'https://i.pravatar.cc/300?img=5'
                    ],
                    [
                        'name' => 'Robert Johnson',
                        'role' => 'Autor',
                        'status' => 'away',
                        'avatar' => 'https://i.pravatar.cc/300?img=7'
                    ]
                ];
                
                foreach ($users as $index => $user) {
                    $status_variant = $user['status'] === 'online' ? 'success' : ($user['status'] === 'away' ? 'warning' : 'secondary');
                    
                    echo '<div style="display: flex; align-items: center; padding: 15px; ' . ($index > 0 ? 'border-top: 1px solid #eaeaea;' : '') . '">';
                    
                    // Avatar
                    echo wp_component_avatar([
                        'src' => $user['avatar'],
                        'alt' => $user['name'],
                        'size' => 'md'
                    ]);
                    
                    // Informações do usuário
                    echo '<div style="margin-left: 15px; flex-grow: 1;">
                        <div style="font-weight: 500;">' . esc_html($user['name']) . '</div>
                        <div style="font-size: 0.875rem; color: #666;">' . esc_html($user['role']) . '</div>
                    </div>';
                    
                    // Chip de status
                    echo wp_component_chip([
                        'text' => ucfirst($user['status']),
                        'variant' => $status_variant,
                        'size' => 'sm'
                    ]);
                    
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
</div>

<?php
get_footer(); 