# Theme IA

Um tema limpo e moderno para WordPress, desenvolvido com princípios de clean code e arquitetura limpa.

## Características

- Design limpo e moderno
- Totalmente responsivo
- Otimizado para SEO
- Suporte para acessibilidade
- Código limpo e bem organizado
- Integração com Gulp para automação de tarefas
- Pré-processamento de SASS para CSS
- Compilação de JavaScript moderno

## Requisitos

- WordPress 5.0 ou superior
- PHP 7.4 ou superior
- Node.js 14.0 ou superior
- npm 6.0 ou superior

## Instalação

1. Faça o download ou clone este repositório para a pasta `wp-content/themes/` do seu WordPress.
2. Ative o tema através do painel administrativo do WordPress.

## Desenvolvimento

Este tema utiliza Gulp para automatizar tarefas de desenvolvimento. Para configurar o ambiente de desenvolvimento:

1. Navegue até a pasta do tema:
   ```
   cd wp-content/themes/theme-ia
   ```

2. Instale as dependências:
   ```
   npm install
   ```

3. Inicie o ambiente de desenvolvimento:
   ```
   npm start
   ```

   Isso iniciará o Gulp em modo de observação e abrirá o site no navegador com BrowserSync ativado.

## Comandos disponíveis

- `npm start` ou `gulp`: Inicia o ambiente de desenvolvimento com BrowserSync
- `npm run build` ou `gulp build`: Compila todos os assets para produção
- `npm run watch` ou `gulp watch`: Observa alterações nos arquivos e compila automaticamente

## Estrutura de arquivos

```
theme-ia/
├── assets/              # Arquivos compilados (CSS, JS, imagens)
├── inc/                 # Funções e hooks do tema
├── languages/           # Arquivos de tradução
├── src/                 # Arquivos fonte
│   ├── js/              # Arquivos JavaScript
│   ├── sass/            # Arquivos SASS
│   │   ├── abstracts/   # Variáveis, mixins, funções
│   │   ├── base/        # Estilos base
│   │   ├── components/  # Componentes reutilizáveis
│   │   ├── layout/      # Layouts principais
│   │   ├── pages/       # Estilos específicos de páginas
│   │   └── themes/      # Variações de tema
│   └── images/          # Imagens não otimizadas
├── template-parts/      # Partes reutilizáveis de templates
├── gulpfile.js          # Configuração do Gulp
├── package.json         # Dependências do npm
└── README.md            # Documentação
```

## Personalização

O tema foi projetado para ser facilmente personalizável. As principais configurações podem ser encontradas em:

- `src/sass/abstracts/_variables.scss`: Variáveis SASS para cores, tipografia, etc.
- `inc/setup.php`: Configurações do tema WordPress
- `gulpfile.js`: Configurações do Gulp

## Licença

Este tema é licenciado sob a GPL v2 ou posterior. 