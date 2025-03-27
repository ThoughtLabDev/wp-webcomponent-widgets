export default {
  title: 'Componentes/Button',
  argTypes: {
    text: { control: 'text' },
    type: { 
      control: { type: 'select' }, 
      options: ['primary', 'secondary', 'tertiary', 'link'],
    },
    url: { control: 'text' },
    size: {
      control: { type: 'select' },
      options: ['small', 'medium', 'large'],
    },
    isDisabled: { control: 'boolean' },
    onClick: { action: 'clicked' }
  },
};

const Template = ({ text, type, url, size, isDisabled }) => {
  // Criando o HTML para o botão
  const classes = ['wptl-button', `wptl-button--${type}`, `wptl-button--${size}`];
  if (isDisabled) classes.push('wptl-button--disabled');
  
  const classAttribute = classes.join(' ');
  
  if (url && !isDisabled) {
    return `<a href="${url}" class="${classAttribute}">${text}</a>`;
  } else {
    const disabled = isDisabled ? 'disabled' : '';
    return `<button class="${classAttribute}" ${disabled}>${text}</button>`;
  }
};

export const Primary = Template.bind({});
Primary.args = {
  text: 'Botão Primário',
  type: 'primary',
  size: 'medium',
  isDisabled: false
};

export const Secondary = Template.bind({});
Secondary.args = {
  text: 'Botão Secundário',
  type: 'secondary',
  size: 'medium',
  isDisabled: false
};

export const Link = Template.bind({});
Link.args = {
  text: 'Botão Link',
  type: 'link',
  url: 'https://exemplo.com.br',
  size: 'medium',
  isDisabled: false
};

export const Small = Template.bind({});
Small.args = {
  text: 'Botão Pequeno',
  type: 'primary',
  size: 'small',
  isDisabled: false
};

export const Large = Template.bind({});
Large.args = {
  text: 'Botão Grande',
  type: 'primary',
  size: 'large',
  isDisabled: false
};

export const Disabled = Template.bind({});
Disabled.args = {
  text: 'Botão Desabilitado',
  type: 'primary',
  size: 'medium',
  isDisabled: true
}; 