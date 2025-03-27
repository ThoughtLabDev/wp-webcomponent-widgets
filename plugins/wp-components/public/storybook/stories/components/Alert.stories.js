export default {
  title: 'Componentes/Alert',
  argTypes: {
    type: {
      control: { type: 'select' },
      options: ['info', 'success', 'warning', 'error'],
      description: 'Tipo do alerta'
    },
    title: {
      control: 'text',
      description: 'Título do alerta (opcional)'
    },
    message: {
      control: 'text',
      description: 'Mensagem do alerta'
    },
    dismissible: {
      control: 'boolean',
      description: 'Se o alerta pode ser fechado'
    },
    icon: {
      control: 'boolean',
      description: 'Se deve mostrar ícone'
    }
  },
};

const Template = ({ type, title, message, dismissible, icon }) => {
  // Criando o HTML para o alerta
  const classes = ['wptl-alert', `wptl-alert--${type}`];
  
  const classAttribute = classes.join(' ');
  
  let alertHTML = `<div class="${classAttribute}">`;
  
  // Adicionar ícone se necessário
  if (icon) {
    let iconName = 'info-circle';
    
    switch (type) {
      case 'success':
        iconName = 'check-circle';
        break;
      case 'warning':
        iconName = 'exclamation-triangle';
        break;
      case 'error':
        iconName = 'times-circle';
        break;
    }
    
    alertHTML += `<span class="wptl-alert__icon dashicons dashicons-${iconName}"></span>`;
  }
  
  // Adicionar título se fornecido
  if (title) {
    alertHTML += `<h4 class="wptl-alert__title">${title}</h4>`;
  }
  
  // Adicionar mensagem
  alertHTML += `<div class="wptl-alert__content">${message || 'Conteúdo do alerta'}</div>`;
  
  // Adicionar botão de fechar se necessário
  if (dismissible) {
    alertHTML += `<button class="wptl-alert__close" aria-label="Fechar">&times;</button>`;
  }
  
  alertHTML += `</div>`;
  
  return alertHTML;
};

export const Info = Template.bind({});
Info.args = {
  type: 'info',
  title: 'Informação',
  message: 'Esta é uma mensagem informativa para o usuário.',
  dismissible: true,
  icon: true
};

export const Success = Template.bind({});
Success.args = {
  type: 'success',
  title: 'Sucesso!',
  message: 'A operação foi concluída com sucesso.',
  dismissible: true,
  icon: true
};

export const Warning = Template.bind({});
Warning.args = {
  type: 'warning',
  title: 'Atenção',
  message: 'Esta ação pode ter consequências importantes.',
  dismissible: true,
  icon: true
};

export const Error = Template.bind({});
Error.args = {
  type: 'error',
  title: 'Erro',
  message: 'Ocorreu um erro ao processar sua solicitação.',
  dismissible: true,
  icon: true
};

export const NoTitle = Template.bind({});
NoTitle.args = {
  type: 'info',
  message: 'Alerta sem título, apenas com a mensagem.',
  dismissible: false,
  icon: true
};

export const NonDismissible = Template.bind({});
NonDismissible.args = {
  type: 'warning',
  title: 'Alerta Fixo',
  message: 'Este alerta não pode ser fechado pelo usuário.',
  dismissible: false,
  icon: true
};

export const NoIcon = Template.bind({});
NoIcon.args = {
  type: 'success',
  title: 'Sem Ícone',
  message: 'Este alerta não exibe um ícone.',
  dismissible: true,
  icon: false
}; 