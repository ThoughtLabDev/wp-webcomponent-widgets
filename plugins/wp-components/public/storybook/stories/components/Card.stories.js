export default {
  title: 'Componentes/Card',
  argTypes: {
    title: { control: 'text' },
    content: { control: 'text' },
    imageUrl: { control: 'text' },
    footerContent: { control: 'text' },
    hasHeader: { control: 'boolean' },
    hasFooter: { control: 'boolean' },
    variant: { 
      control: { type: 'select' }, 
      options: ['default', 'bordered', 'shadowed', 'flat'],
    },
  },
};

const Template = ({ title, content, imageUrl, footerContent, hasHeader, hasFooter, variant }) => {
  // Criando classes CSS baseadas nos argumentos
  const cardClasses = ['wptl-card', `wptl-card--${variant}`].join(' ');
  
  // Construir o HTML do componente
  let cardHTML = `<div class="${cardClasses}">`;
  
  // Header opcional
  if (hasHeader) {
    cardHTML += `<div class="wptl-card__header">
      <h3 class="wptl-card__title">${title}</h3>
    </div>`;
  }
  
  // Imagem opcional
  if (imageUrl) {
    cardHTML += `<div class="wptl-card__image">
      <img src="${imageUrl}" alt="${title}" />
    </div>`;
  }
  
  // Conteúdo
  cardHTML += `<div class="wptl-card__content">
    <p>${content}</p>
  </div>`;
  
  // Footer opcional
  if (hasFooter && footerContent) {
    cardHTML += `<div class="wptl-card__footer">
      ${footerContent}
    </div>`;
  }
  
  cardHTML += '</div>';
  
  return cardHTML;
};

export const Default = Template.bind({});
Default.args = {
  title: 'Título do Card',
  content: 'Este é um exemplo de conteúdo para o card. Você pode adicionar texto e outros elementos aqui.',
  imageUrl: 'https://via.placeholder.com/600x300',
  footerContent: '<button class="wptl-button wptl-button--primary">Ação</button>',
  hasHeader: true,
  hasFooter: true,
  variant: 'default'
};

export const BorderedCard = Template.bind({});
BorderedCard.args = {
  ...Default.args,
  variant: 'bordered'
};

export const ShadowedCard = Template.bind({});
ShadowedCard.args = {
  ...Default.args,
  variant: 'shadowed'
};

export const FlatCard = Template.bind({});
FlatCard.args = {
  ...Default.args,
  variant: 'flat'
};

export const NoHeader = Template.bind({});
NoHeader.args = {
  ...Default.args,
  hasHeader: false
};

export const NoFooter = Template.bind({});
NoFooter.args = {
  ...Default.args,
  hasFooter: false
};

export const ImageOnly = Template.bind({});
ImageOnly.args = {
  title: '',
  content: '',
  imageUrl: 'https://via.placeholder.com/600x400',
  footerContent: '',
  hasHeader: false,
  hasFooter: false,
  variant: 'default'
}; 