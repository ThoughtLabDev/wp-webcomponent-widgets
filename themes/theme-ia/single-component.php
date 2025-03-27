<?php
/**
 * Template Name: Documentação de Componente
 * Template Post Type: page
 *
 * Template para exibir a documentação de um componente específico.
 *
 * @package Theme_IA
 */

get_header();
?>

<div class="documentation">
    <aside class="documentation__sidebar">
        <nav>
            <ul class="documentation__nav">
                <li class="documentation__nav-title"><?php echo esc_html__('Introdução', 'theme-ia'); ?></li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/')); ?>" class="documentation__nav-link"><?php echo esc_html__('Visão Geral', 'theme-ia'); ?></a>
                </li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/instalacao/')); ?>" class="documentation__nav-link"><?php echo esc_html__('Instalação', 'theme-ia'); ?></a>
                </li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/uso/')); ?>" class="documentation__nav-link"><?php echo esc_html__('Como Usar', 'theme-ia'); ?></a>
                </li>
                
                <li class="documentation__nav-title"><?php echo esc_html__('Componentes UI', 'theme-ia'); ?></li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/cartao/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/cartao') ? 'active' : ''; ?>"><?php echo esc_html__('Cartão', 'theme-ia'); ?></a>
                </li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/botao/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/botao') ? 'active' : ''; ?>"><?php echo esc_html__('Botão', 'theme-ia'); ?></a>
                </li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/alerta/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/alerta') ? 'active' : ''; ?>"><?php echo esc_html__('Alerta', 'theme-ia'); ?></a>
                </li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/modal/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/modal') ? 'active' : ''; ?>"><?php echo esc_html__('Modal', 'theme-ia'); ?></a>
                </li>
                
                <li class="documentation__nav-title"><?php echo esc_html__('Navegação', 'theme-ia'); ?></li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/abas/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/abas') ? 'active' : ''; ?>"><?php echo esc_html__('Abas', 'theme-ia'); ?></a>
                </li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/paginacao/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/paginacao') ? 'active' : ''; ?>"><?php echo esc_html__('Paginação', 'theme-ia'); ?></a>
                </li>
                
                <li class="documentation__nav-title"><?php echo esc_html__('Layout', 'theme-ia'); ?></li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/grid/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/grid') ? 'active' : ''; ?>"><?php echo esc_html__('Grid', 'theme-ia'); ?></a>
                </li>
                
                <li class="documentation__nav-title"><?php echo esc_html__('Conteúdo', 'theme-ia'); ?></li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/acordeao/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/acordeao') ? 'active' : ''; ?>"><?php echo esc_html__('Acordeão', 'theme-ia'); ?></a>
                </li>
                
                <li class="documentation__nav-title"><?php echo esc_html__('Formulários', 'theme-ia'); ?></li>
                <li class="documentation__nav-item">
                    <a href="<?php echo esc_url(home_url('/documentacao/componentes/formulario/')); ?>" class="documentation__nav-link <?php echo is_page('documentacao/componentes/formulario') ? 'active' : ''; ?>"><?php echo esc_html__('Formulário', 'theme-ia'); ?></a>
                </li>
            </ul>
        </nav>
    </aside>
    
    <main class="documentation__content">
        <header class="documentation__header">
            <h1 class="documentation__title"><?php the_title(); ?></h1>
            <p class="documentation__subtitle"><?php echo get_the_excerpt(); ?></p>
        </header>
        
        <?php if (is_page('documentacao/componentes/cartao')) : ?>
            <!-- Exemplo de documentação para o componente Cartão -->
            <section class="documentation__section">
                <h2 class="documentation__section-title"><?php echo esc_html__('Visão Geral', 'theme-ia'); ?></h2>
                <p><?php echo esc_html__('O componente Cartão é um contêiner flexível com múltiplas variantes e opções. Pode ser usado para exibir conteúdo de forma organizada com cabeçalho, corpo e rodapé opcionais.', 'theme-ia'); ?></p>
            </section>
            
            <section class="documentation__section">
                <h2 class="documentation__section-title"><?php echo esc_html__('Exemplos', 'theme-ia'); ?></h2>
                
                <div class="documentation__component-header">
                    <h3><?php echo esc_html__('Cartão Básico', 'theme-ia'); ?></h3>
                    <div class="documentation__component-tags">
                        <span class="documentation__component-tag">UI</span>
                    </div>
                </div>
                
                <div class="documentation__tabs">
                    <div class="documentation__tabs-nav">
                        <a href="#preview-basic" class="documentation__tabs-link active"><?php echo esc_html__('Visualização', 'theme-ia'); ?></a>
                        <a href="#code-basic" class="documentation__tabs-link"><?php echo esc_html__('Código', 'theme-ia'); ?></a>
                    </div>
                    
                    <div class="documentation__tabs-content">
                        <div id="preview-basic" class="active">
                            <!-- Exemplo do componente -->
                            <div class="wp-component-card">
                                <div class="wp-component-card__header">
                                    <h3 class="wp-component-card__title"><?php echo esc_html__('Título do Cartão', 'theme-ia'); ?></h3>
                                    <p class="wp-component-card__subtitle"><?php echo esc_html__('Subtítulo opcional', 'theme-ia'); ?></p>
                                </div>
                                <div class="wp-component-card__body">
                                    <p><?php echo esc_html__('Este é um exemplo de cartão básico com cabeçalho, corpo e rodapé. Você pode personalizar cada parte conforme necessário.', 'theme-ia'); ?></p>
                                </div>
                                <div class="wp-component-card__footer">
                                    <button class="wp-component-button wp-component-button--primary"><?php echo esc_html__('Ação Primária', 'theme-ia'); ?></button>
                                    <button class="wp-component-button wp-component-button--outline-primary"><?php echo esc_html__('Ação Secundária', 'theme-ia'); ?></button>
                                </div>
                            </div>
                        </div>
                        
                        <div id="code-basic">
                            <div class="documentation__code">
<pre><code>&lt;div class="wp-component-card"&gt;
    &lt;div class="wp-component-card__header"&gt;
        &lt;h3 class="wp-component-card__title"&gt;Título do Cartão&lt;/h3&gt;
        &lt;p class="wp-component-card__subtitle"&gt;Subtítulo opcional&lt;/p&gt;
    &lt;/div&gt;
    &lt;div class="wp-component-card__body"&gt;
        &lt;p&gt;Este é um exemplo de cartão básico com cabeçalho, corpo e rodapé. Você pode personalizar cada parte conforme necessário.&lt;/p&gt;
    &lt;/div&gt;
    &lt;div class="wp-component-card__footer"&gt;
        &lt;button class="wp-component-button wp-component-button--primary"&gt;Ação Primária&lt;/button&gt;
        &lt;button class="wp-component-button wp-component-button--outline-primary"&gt;Ação Secundária&lt;/button&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="documentation__component-header">
                    <h3><?php echo esc_html__('Variantes de Cartão', 'theme-ia'); ?></h3>
                </div>
                
                <div class="documentation__tabs">
                    <div class="documentation__tabs-nav">
                        <a href="#preview-variants" class="documentation__tabs-link active"><?php echo esc_html__('Visualização', 'theme-ia'); ?></a>
                        <a href="#code-variants" class="documentation__tabs-link"><?php echo esc_html__('Código', 'theme-ia'); ?></a>
                    </div>
                    
                    <div class="documentation__tabs-content">
                        <div id="preview-variants" class="active">
                            <!-- Exemplo de variantes -->
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1rem;">
                                <div class="wp-component-card wp-component-card--primary">
                                    <div class="wp-component-card__header">
                                        <h3 class="wp-component-card__title"><?php echo esc_html__('Cartão Primário', 'theme-ia'); ?></h3>
                                    </div>
                                    <div class="wp-component-card__body">
                                        <p><?php echo esc_html__('Variante com destaque primário.', 'theme-ia'); ?></p>
                                    </div>
                                </div>
                                
                                <div class="wp-component-card wp-component-card--success">
                                    <div class="wp-component-card__header">
                                        <h3 class="wp-component-card__title"><?php echo esc_html__('Cartão Sucesso', 'theme-ia'); ?></h3>
                                    </div>
                                    <div class="wp-component-card__body">
                                        <p><?php echo esc_html__('Variante com destaque de sucesso.', 'theme-ia'); ?></p>
                                    </div>
                                </div>
                                
                                <div class="wp-component-card wp-component-card--warning">
                                    <div class="wp-component-card__header">
                                        <h3 class="wp-component-card__title"><?php echo esc_html__('Cartão Alerta', 'theme-ia'); ?></h3>
                                    </div>
                                    <div class="wp-component-card__body">
                                        <p><?php echo esc_html__('Variante com destaque de alerta.', 'theme-ia'); ?></p>
                                    </div>
                                </div>
                                
                                <div class="wp-component-card wp-component-card--danger">
                                    <div class="wp-component-card__header">
                                        <h3 class="wp-component-card__title"><?php echo esc_html__('Cartão Perigo', 'theme-ia'); ?></h3>
                                    </div>
                                    <div class="wp-component-card__body">
                                        <p><?php echo esc_html__('Variante com destaque de perigo.', 'theme-ia'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="code-variants">
                            <div class="documentation__code">
<pre><code>&lt;!-- Cartão Primário --&gt;
&lt;div class="wp-component-card wp-component-card--primary"&gt;
    &lt;div class="wp-component-card__header"&gt;
        &lt;h3 class="wp-component-card__title"&gt;Cartão Primário&lt;/h3&gt;
    &lt;/div&gt;
    &lt;div class="wp-component-card__body"&gt;
        &lt;p&gt;Variante com destaque primário.&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- Cartão Sucesso --&gt;
&lt;div class="wp-component-card wp-component-card--success"&gt;
    &lt;div class="wp-component-card__header"&gt;
        &lt;h3 class="wp-component-card__title"&gt;Cartão Sucesso&lt;/h3&gt;
    &lt;/div&gt;
    &lt;div class="wp-component-card__body"&gt;
        &lt;p&gt;Variante com destaque de sucesso.&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- Cartão Alerta --&gt;
&lt;div class="wp-component-card wp-component-card--warning"&gt;
    &lt;div class="wp-component-card__header"&gt;
        &lt;h3 class="wp-component-card__title"&gt;Cartão Alerta&lt;/h3&gt;
    &lt;/div&gt;
    &lt;div class="wp-component-card__body"&gt;
        &lt;p&gt;Variante com destaque de alerta.&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- Cartão Perigo --&gt;
&lt;div class="wp-component-card wp-component-card--danger"&gt;
    &lt;div class="wp-component-card__header"&gt;
        &lt;h3 class="wp-component-card__title"&gt;Cartão Perigo&lt;/h3&gt;
    &lt;/div&gt;
    &lt;div class="wp-component-card__body"&gt;
        &lt;p&gt;Variante com destaque de perigo.&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="documentation__section">
                <h2 class="documentation__section-title"><?php echo esc_html__('Uso com WordPress', 'theme-ia'); ?></h2>
                
                <p><?php echo esc_html__('Para usar o componente Cartão em seu tema ou plugin WordPress, você pode usar a função de ajuda fornecida pelo plugin WP Components:', 'theme-ia'); ?></p>
                
                <div class="documentation__code">
<pre><code>&lt;?php
// Exibir um cartão básico
echo wp_component_card([
    'title' => 'Título do Cartão',
    'subtitle' => 'Subtítulo opcional',
    'content' => 'Conteúdo do cartão aqui.',
    'footer' => [
        'primary_button' => [
            'text' => 'Ação Primária',
            'url' => '#',
        ],
        'secondary_button' => [
            'text' => 'Ação Secundária',
            'url' => '#',
        ],
    ],
    'variant' => 'primary', // Opções: primary, success, warning, danger
]);
?&gt;</code></pre>
                </div>
                
                <h3><?php echo esc_html__('Parâmetros', 'theme-ia'); ?></h3>
                
                <table class="documentation__props-table">
                    <thead>
                        <tr>
                            <th><?php echo esc_html__('Parâmetro', 'theme-ia'); ?></th>
                            <th><?php echo esc_html__('Tipo', 'theme-ia'); ?></th>
                            <th><?php echo esc_html__('Padrão', 'theme-ia'); ?></th>
                            <th><?php echo esc_html__('Descrição', 'theme-ia'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>title</code></td>
                            <td>string</td>
                            <td><code>''</code></td>
                            <td><?php echo esc_html__('Título do cartão.', 'theme-ia'); ?></td>
                        </tr>
                        <tr>
                            <td><code>subtitle</code></td>
                            <td>string</td>
                            <td><code>''</code></td>
                            <td><?php echo esc_html__('Subtítulo opcional do cartão.', 'theme-ia'); ?></td>
                        </tr>
                        <tr>
                            <td><code>content</code></td>
                            <td>string</td>
                            <td><code>''</code></td>
                            <td><?php echo esc_html__('Conteúdo principal do cartão.', 'theme-ia'); ?></td>
                        </tr>
                        <tr>
                            <td><code>footer</code></td>
                            <td>array</td>
                            <td><code>[]</code></td>
                            <td><?php echo esc_html__('Configurações do rodapé, incluindo botões.', 'theme-ia'); ?></td>
                        </tr>
                        <tr>
                            <td><code>variant</code></td>
                            <td>string</td>
                            <td><code>''</code></td>
                            <td><?php echo esc_html__('Variante do cartão: primary, success, warning, danger.', 'theme-ia'); ?></td>
                        </tr>
                        <tr>
                            <td><code>class</code></td>
                            <td>string</td>
                            <td><code>''</code></td>
                            <td><?php echo esc_html__('Classes CSS adicionais.', 'theme-ia'); ?></td>
                        </tr>
                        <tr>
                            <td><code>id</code></td>
                            <td>string</td>
                            <td><code>''</code></td>
                            <td><?php echo esc_html__('ID do elemento.', 'theme-ia'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </section>
            
            <section class="documentation__section">
                <h2 class="documentation__section-title"><?php echo esc_html__('Personalização', 'theme-ia'); ?></h2>
                
                <p><?php echo esc_html__('Você pode personalizar o componente Cartão através de variáveis SASS ou sobrescrevendo as classes CSS.', 'theme-ia'); ?></p>
                
                <div class="documentation__code">
<pre><code>// Personalizar via SASS
$card-border-radius: 0.5rem;
$card-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
$card-padding: 1.5rem;

// Sobrescrever via CSS
.wp-component-card {
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
}</code></pre>
                </div>
            </section>
            
        <?php else : ?>
            <!-- Conteúdo padrão da página -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </main>
</div>

<script>
    (function() {
        // Navegação por tabs
        const tabLinks = document.querySelectorAll('.documentation__tabs-link');
        
        tabLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                const tabId = link.getAttribute('href');
                const tabsNav = link.closest('.documentation__tabs-nav');
                const tabsContent = link.closest('.documentation__tabs').querySelector('.documentation__tabs-content');
                
                // Remover classe ativa de todas as tabs
                tabsNav.querySelectorAll('.documentation__tabs-link').forEach(tab => {
                    tab.classList.remove('active');
                });
                
                tabsContent.querySelectorAll('> div').forEach(content => {
                    content.classList.remove('active');
                });
                
                // Adicionar classe ativa à tab clicada
                link.classList.add('active');
                document.querySelector(tabId).classList.add('active');
            });
        });
    })();
</script>

<?php
get_footer(); 