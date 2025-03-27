# WP Components

Uma biblioteca de componentes reutilizáveis para WordPress.

## Descrição

WP Components é um plugin que fornece uma coleção de componentes de interface facilmente reutilizáveis em temas e plugins WordPress. O objetivo é facilitar a criação de layouts e interfaces consistentes, sem a necessidade de reescrever código HTML, CSS e JavaScript para elementos comuns.

## Recursos

- **Biblioteca de Componentes**: Botões, cards, alertas, abas, acordeões e mais
- **Integração com Editores**: Suporte para Gutenberg e Elementor
- **API Simples**: Função única para renderização de qualquer componente
- **Personalizável**: Adaptável através de filtros WordPress
- **Documentação Interativa**: Storybook integrado para documentação visual

## Instalação

1. Faça o upload do plugin para a pasta `/wp-content/plugins/`
2. Ative o plugin através do menu 'Plugins' no WordPress
3. Use os componentes em seus temas e plugins

## Uso Básico

Para usar um componente em qualquer parte do seu site:

```php
// Renderizar um botão
echo wptl_render_component('button', [
    'text' => 'Clique Aqui',
    'type' => 'primary',
    'url'  => 'https://exemplo.com'
]);

// Renderizar um card
echo wptl_render_component('card', [
    'title'   => 'Título do Card',
    'content' => 'Conteúdo do card',
    'variant' => 'bordered'
]);
```

## Documentação com Storybook

Este plugin inclui uma documentação interativa construída com o Storybook, permitindo visualizar e testar todos os componentes.

### Como Acessar a Documentação

1. No painel de administração, acesse "WP Components" > "Documentação"
2. A documentação interativa será exibida com todos os componentes disponíveis

### Desenvolvimento com Storybook

Para desenvolvedores que desejam trabalhar com o Storybook localmente:

1. Navegue até o diretório do plugin: `cd wp-content/plugins/wp-components/public/storybook`
2. Instale as dependências: `npm install`
3. Inicie o servidor de desenvolvimento: `npm run storybook`
4. Acesse http://localhost:6006 no seu navegador

### Construindo a Documentação Estática

Para gerar uma versão estática da documentação para o painel administrativo:

```bash
cd wp-content/plugins/wp-components/public/storybook
npm install
npm run build-storybook
```

Ou acesse "WP Components" > "Configuração" no painel administrativo e clique em "Gerar Histórias dos Componentes".

## Componentes Disponíveis

- **Button**: Botões com várias aparências e tamanhos
- **Card**: Contêineres para organizar informações
- **Alert**: Mensagens informativas, de aviso, erro ou sucesso
- **Tabs**: Organizadores de conteúdo em abas
- **Accordion**: Seções expansíveis de conteúdo
- **Modal**: Janelas modais ou diálogos
- **Form Elements**: Campos de formulário estilizados
- **Badge**: Indicadores numéricos ou de status
- **Avatar**: Representações de usuários

## Personalização

Todos os componentes podem ser personalizados através de filtros WordPress:

```php
// Personalizar valores padrão do botão
add_filter('wptl_component_button_defaults', function($defaults) {
    $defaults['size'] = 'large';
    return $defaults;
});

// Modificar o HTML de saída
add_filter('wptl_component_button_html', function($html, $atts) {
    // Personalizar o HTML
    return $html;
}, 10, 2);
```

## Requisitos

- WordPress 5.0 ou superior
- PHP 7.0 ou superior

## Licença

GPL v2 ou posterior

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests. 