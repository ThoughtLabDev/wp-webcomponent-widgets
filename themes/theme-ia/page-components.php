<?php
/**
 * Template Name: Página de Componentes
 *
 * Template para exibir a biblioteca de componentes.
 *
 * @package Theme_IA
 */

get_header();
?>

<main id="primary" class="site-main components-page">
    <div class="container">
        <header class="components-page__header">
            <h1 class="components-page__title"><?php echo esc_html__('Biblioteca de Componentes', 'theme-ia'); ?></h1>
            <p class="components-page__subtitle"><?php echo esc_html__('Uma coleção de componentes WordPress reutilizáveis para acelerar o desenvolvimento de temas e plugins.', 'theme-ia'); ?></p>
            
            <div class="components-page__search">
                <input type="text" placeholder="<?php echo esc_attr__('Buscar componentes...', 'theme-ia'); ?>" id="component-search">
            </div>
        </header>

        <div class="components-page__categories">
            <button class="components-page__category active" data-filter="all"><?php echo esc_html__('Todos', 'theme-ia'); ?></button>
            <button class="components-page__category" data-filter="ui"><?php echo esc_html__('UI', 'theme-ia'); ?></button>
            <button class="components-page__category" data-filter="layout"><?php echo esc_html__('Layout', 'theme-ia'); ?></button>
            <button class="components-page__category" data-filter="form"><?php echo esc_html__('Formulários', 'theme-ia'); ?></button>
            <button class="components-page__category" data-filter="content"><?php echo esc_html__('Conteúdo', 'theme-ia'); ?></button>
            <button class="components-page__category" data-filter="navigation"><?php echo esc_html__('Navegação', 'theme-ia'); ?></button>
        </div>

        <div class="components-page__grid">
            <!-- Cartão (Card) -->
            <div class="components-page__card" data-category="ui">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/card.svg'); ?>" alt="Card Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Cartão', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Componente flexível para exibir conteúdo em um contêiner com cabeçalho, corpo e rodapé.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">UI</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/cartao/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Botão (Button) -->
            <div class="components-page__card" data-category="ui">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/button.svg'); ?>" alt="Button Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Botão', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Botões personalizáveis com diferentes estilos, tamanhos e estados.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">UI</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/botao/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Alerta (Alert) -->
            <div class="components-page__card" data-category="ui">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/alert.svg'); ?>" alt="Alert Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Alerta', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Componente para exibir mensagens importantes, avisos ou feedback ao usuário.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">UI</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/alerta/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Tabs -->
            <div class="components-page__card" data-category="navigation">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/tabs.svg'); ?>" alt="Tabs Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Abas', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Organiza conteúdo em abas para economizar espaço e melhorar a navegação.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">Navegação</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/abas/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Accordion -->
            <div class="components-page__card" data-category="content">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/accordion.svg'); ?>" alt="Accordion Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Acordeão', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Exibe conteúdo em seções expansíveis para economizar espaço vertical.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">Conteúdo</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/acordeao/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Form -->
            <div class="components-page__card" data-category="form">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/form.svg'); ?>" alt="Form Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Formulário', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Componentes de formulário estilizados e validação integrada.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">Formulário</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/formulario/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Modal -->
            <div class="components-page__card" data-category="ui">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/modal.svg'); ?>" alt="Modal Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Modal', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Janela de diálogo que aparece sobre o conteúdo principal para interações focadas.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">UI</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/modal/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Grid -->
            <div class="components-page__card" data-category="layout">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/grid.svg'); ?>" alt="Grid Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Grid', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Sistema de grid responsivo para layouts flexíveis.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">Layout</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/grid/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>

            <!-- Pagination -->
            <div class="components-page__card" data-category="navigation">
                <div class="components-page__card-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/components/pagination.svg'); ?>" alt="Pagination Component">
                </div>
                <div class="components-page__card-body">
                    <h3 class="components-page__card-title"><?php echo esc_html__('Paginação', 'theme-ia'); ?></h3>
                    <p class="components-page__card-text"><?php echo esc_html__('Controles de navegação para conteúdo paginado.', 'theme-ia'); ?></p>
                </div>
                <div class="components-page__card-footer">
                    <span class="components-page__card-tag">Navegação</span>
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/paginacao/')); ?>" class="wp-component-button wp-component-button--sm wp-component-button--outline-primary"><?php echo esc_html__('Ver Documentação', 'theme-ia'); ?></a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    (function() {
        // Filtro de categorias
        const categoryButtons = document.querySelectorAll('.components-page__category');
        const cards = document.querySelectorAll('.components-page__card');
        const searchInput = document.getElementById('component-search');
        
        // Filtrar por categoria
        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');
                
                // Atualizar botão ativo
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                // Filtrar cartões
                cards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
        
        // Busca
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            
            cards.forEach(card => {
                const title = card.querySelector('.components-page__card-title').textContent.toLowerCase();
                const description = card.querySelector('.components-page__card-text').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    })();
</script>

<?php
get_footer(); 