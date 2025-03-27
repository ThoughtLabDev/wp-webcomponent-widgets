/** @type { import('@storybook/html').Preview } */
const preview = {
  parameters: {
    actions: { argTypesRegex: '^on[A-Z].*' },
    controls: {
      matchers: {
        color: /(background|color)$/i,
        date: /Date$/i,
      },
    },
    docs: {
      description: {
        component: 'WP ThoughtLab Components - Biblioteca de componentes reutilizáveis para WordPress'
      }
    }
  },
};

// Importar estilos globais do WordPress
import './wp-styles.css';

// Importar estilos dos componentes WP Components
import '../stories/assets/wp-components.css';

export default preview; 