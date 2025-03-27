# WP ThoughtLab Components - Storybook

Esta é a documentação interativa dos componentes disponíveis no plugin WP Components, construída com o Storybook.

## 🚀 Início Rápido

Para iniciar o Storybook em modo de desenvolvimento:

```bash
# Instalar dependências
npm install

# Iniciar o servidor de desenvolvimento do Storybook
npm run storybook
```

O servidor de desenvolvimento será iniciado na porta 6006. Acesse http://localhost:6006 para ver a documentação.

## 📦 Construindo uma Versão Estática

Para criar uma versão estática do Storybook para produção:

```bash
npm run build-storybook
```

Isso criará uma pasta `storybook-static` com os arquivos estáticos que podem ser hospedados em qualquer servidor web.

## 📂 Estrutura do Projeto

```
storybook/
├── .storybook/           # Configuração do Storybook
│   ├── main.js           # Configuração principal
│   ├── preview.js        # Configuração de visualização
│   └── wp-styles.css     # Estilos do WordPress
├── stories/              # Histórias dos componentes
│   ├── Introduction.stories.mdx  # Página de introdução
│   ├── components/       # Histórias de cada componente
│   └── assets/           # Assets para as histórias
├── assets/               # Assets para a integração com WP
└── package.json          # Dependências e scripts
```

## 🧩 Adicionando Novos Componentes

Para adicionar um novo componente à documentação:

1. Crie um novo arquivo na pasta `stories/components/` com o formato `NomeDoComponente.stories.js`
2. Defina o componente, seus argumentos e suas variações
3. Adicione estilos relacionados em `stories/assets/components.css`

Exemplo básico:

```javascript
export default {
  title: 'Componentes/NomeDoComponente',
  argTypes: {
    // Defina os argumentos do componente aqui
  },
};

const Template = (args) => {
  // Retorne o HTML do componente
};

export const Variacao1 = Template.bind({});
Variacao1.args = {
  // Argumentos para esta variação
};
```

## 🔄 Integração com WordPress

O Storybook está integrado com o WordPress através da classe `WPTL_Components_Storybook` que:

1. Adiciona uma página de administração para visualizar a documentação
2. Fornece endpoints REST API para obter dados dos componentes
3. Inclui estilos e scripts necessários para a integração

Para acessar a documentação no WordPress, vá para "WP Components > Documentação" no painel de administração.

## 📖 Recursos Adicionais

- [Documentação do Storybook](https://storybook.js.org/docs/html/get-started/introduction)
- [Storybook para HTML](https://storybook.js.org/docs/html/get-started/install)
- [Escrevendo Histórias](https://storybook.js.org/docs/html/writing-stories/introduction)

## 🤝 Contribuição

Contribuições são bem-vindas! Se você quiser adicionar novos componentes ou melhorar os existentes, fique à vontade para enviar um pull request. 