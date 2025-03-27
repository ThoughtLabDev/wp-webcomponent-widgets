<?php
/**
 * WP Components Storybook Generator
 *
 * @package WP_Components
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Classe responsável pela geração automática de histórias do Storybook
 * a partir dos componentes existentes no plugin
 */
class WPTL_Components_Storybook_Generator {

	/**
	 * Diretório dos componentes
	 *
	 * @var string
	 */
	private $components_dir;

	/**
	 * Diretório destino das histórias
	 *
	 * @var string
	 */
	private $stories_dir;

	/**
	 * Inicializa a classe
	 */
	public function __construct() {
		$this->components_dir = WP_COMPONENTS_PLUGIN_DIR . 'includes/components/';
		$this->stories_dir    = WP_COMPONENTS_PLUGIN_DIR . 'public/storybook/stories/components/';

		// Garantir que o diretório de destino existe
		if ( ! file_exists( $this->stories_dir ) ) {
			wp_mkdir_p( $this->stories_dir );
		}
	}

	/**
	 * Gera histórias para todos os componentes
	 * 
	 * @return array Lista de componentes processados e status
	 */
	public function generate_all_stories() {
		$results = array();
		
		// Listar todos os arquivos de componentes
		$component_files = glob( $this->components_dir . 'class-wp-component-*.php' );
		
		foreach ( $component_files as $file ) {
			$component_name = $this->get_component_name_from_file( $file );
			if ( ! $component_name ) {
				continue;
			}
			
			$results[ $component_name ] = $this->generate_story_for_component( $component_name, $file );
		}
		
		return $results;
	}

	/**
	 * Extrai o nome do componente a partir do nome do arquivo
	 * 
	 * @param string $file_path Caminho do arquivo.
	 * @return string|false Nome do componente ou false se não encontrado
	 */
	private function get_component_name_from_file( $file_path ) {
		$filename = basename( $file_path );
		
		// Remover 'class-wp-component-' e '.php'
		if ( preg_match( '/class-wp-component-(.+)\.php/', $filename, $matches ) ) {
			return $matches[1];
		}
		
		return false;
	}

	/**
	 * Gera uma história do Storybook para um componente específico
	 * 
	 * @param string $component_name Nome do componente.
	 * @param string $file_path Caminho do arquivo do componente.
	 * @return boolean Sucesso ou falha na geração
	 */
	public function generate_story_for_component( $component_name, $file_path ) {
		// Analisar o arquivo para extrair informações do componente
		$component_info = $this->analyze_component_file( $file_path );
		
		if ( ! $component_info ) {
			return false;
		}
		
		// Gerar o conteúdo da história
		$story_content = $this->generate_story_content( $component_name, $component_info );
		
		// Formatar nome do arquivo para o Storybook
		$component_story_name = $this->format_component_name_for_story( $component_name );
		$story_file_path = $this->stories_dir . $component_story_name . '.stories.js';
		
		// Salvar arquivo
		return (bool) file_put_contents( $story_file_path, $story_content );
	}

	/**
	 * Formata o nome do componente para uso no arquivo de história
	 * 
	 * @param string $component_name Nome do componente.
	 * @return string Nome formatado
	 */
	private function format_component_name_for_story( $component_name ) {
		// Converter kebab-case para PascalCase
		$parts = explode( '-', $component_name );
		$parts = array_map( 'ucfirst', $parts );
		return implode( '', $parts );
	}

	/**
	 * Analisa o arquivo do componente para extrair suas propriedades e variantes
	 * 
	 * @param string $file_path Caminho do arquivo do componente.
	 * @return array|false Informações do componente ou false se falhar
	 */
	private function analyze_component_file( $file_path ) {
		if ( ! file_exists( $file_path ) ) {
			return false;
		}
		
		$content = file_get_contents( $file_path );
		
		// Informações básicas do componente
		$info = array(
			'properties' => array(),
			'variants'   => array(),
			'description' => '',
		);
		
		// Extrair descrição do componente
		if ( preg_match( '/\/\*\*\s*(.*?)\s*\*\//s', $content, $matches ) ) {
			$info['description'] = $this->clean_comment( $matches[1] );
		}
		
		// Extrair propriedades de um método render ou similar
		if ( preg_match( '/function\s+render\s*\(\s*\$(\w+)\s*(?:=\s*array\(\s*\))?\s*\).*?{/s', $content, $matches ) ) {
			$props_var = $matches[1]; // Geralmente $atts ou $args
			
			// Procurar propriedades no trecho que extrai valores padrão
			if ( preg_match_all( '/\$' . $props_var . '\s*=\s*wp_parse_args\s*\(\s*\$' . $props_var . '\s*,\s*array\s*\((.*?)\)\s*\)/s', $content, $matches ) ) {
				$defaults_str = $matches[1][0];
				
				// Extrair cada par de chave-valor
				preg_match_all( '/\'(\w+)\'\s*=>\s*([^,]+)/', $defaults_str, $prop_matches, PREG_SET_ORDER );
				
				foreach ( $prop_matches as $prop ) {
					$prop_name = $prop[1];
					$default_value = trim( $prop[2] );
					
					// Determinar tipo da propriedade com base no valor padrão
					$type = $this->guess_property_type( $default_value );
					
					$info['properties'][ $prop_name ] = array(
						'type'    => $type,
						'default' => $default_value,
					);
				}
			}
		}
		
		// Extrair variantes (analisando constantes ou opções)
		if ( preg_match_all( '/const\s+(\w+)_TYPE(?:S)?_(\w+)\s*=\s*[\'"]([^\'"]+)[\'"]/', $content, $variant_matches, PREG_SET_ORDER ) ) {
			foreach ( $variant_matches as $variant ) {
				$property = strtolower( $variant[1] );
				$variant_name = $variant[2];
				$variant_value = $variant[3];
				
				if ( ! isset( $info['variants'][ $property ] ) ) {
					$info['variants'][ $property ] = array();
				}
				
				$info['variants'][ $property ][ $variant_name ] = $variant_value;
			}
		}
		
		return $info;
	}

	/**
	 * Gera o conteúdo da história do Storybook para um componente
	 * 
	 * @param string $component_name Nome do componente.
	 * @param array  $component_info Informações do componente.
	 * @return string Conteúdo da história
	 */
	private function generate_story_content( $component_name, $component_info ) {
		$pascal_case_name = $this->format_component_name_for_story( $component_name );
		
		// Início do arquivo
		$content = "/**
 * Storybook para o componente {$pascal_case_name}
 * Gerado automaticamente a partir do componente WP_Component_{$component_name}
 */

export default {
  title: 'Componentes/{$pascal_case_name}',
  parameters: {
    docs: {
      description: {
        component: " . json_encode( $component_info['description'] ) . ",
      },
    },
  },
  argTypes: {\n";
		
		// Adicionar tipos de argumentos
		foreach ( $component_info['properties'] as $prop_name => $prop_info ) {
			$content .= "    {$prop_name}: { ";
			
			// Determinar o tipo de controle com base no tipo de propriedade
			switch ( $prop_info['type'] ) {
				case 'boolean':
					$content .= "control: 'boolean'";
					break;
				case 'number':
					$content .= "control: { type: 'number' }";
					break;
				case 'select':
					if ( isset( $component_info['variants'][ $prop_name ] ) ) {
						$options = array_values( $component_info['variants'][ $prop_name ] );
						$options_str = json_encode( $options );
						$content .= "control: { type: 'select' }, options: {$options_str}";
					} else {
						$content .= "control: 'text'";
					}
					break;
				case 'array':
					$content .= "control: 'object'";
					break;
				default:
					$content .= "control: 'text'";
			}
			
			$content .= " },\n";
		}
		
		// Adicionar manipulador de eventos (se aplicável)
		$content .= "    onClick: { action: 'clicked' },\n";
		$content .= "  },\n};\n\n";
		
		// Função de template
		$content .= "/**
 * Template para renderizar o componente
 */
const Template = (args) => {
  // Construir a representação HTML do componente
  // Esta é uma simulação baseada nos argumentos, para visualização no Storybook
  
  const getClassNames = () => {
    const classes = ['wptl-{$component_name}'];
    
    // Adicionar classes baseadas nos argumentos
";

		// Adicionar lógica para classes CSS baseadas em propriedades
		foreach ( $component_info['properties'] as $prop_name => $prop_info ) {
			if ( $prop_info['type'] === 'select' && isset( $component_info['variants'][ $prop_name ] ) ) {
				$content .= "    if (args.{$prop_name}) {
      classes.push(`wptl-{$component_name}--\${args.{$prop_name}}`);
    }\n";
			} elseif ( $prop_info['type'] === 'boolean' ) {
				$content .= "    if (args.{$prop_name}) {
      classes.push('wptl-{$component_name}--{$prop_name}');
    }\n";
			}
		}
		
		$content .= "    
    return classes.join(' ');
  };
  
  // Construir o HTML do componente
  let componentHtml = '';
  
";

		// Lógica específica baseada no tipo de componente
		switch ( $component_name ) {
			case 'button':
				$content .= "  const disabled = args.isDisabled ? 'disabled' : '';
  
  if (args.url && !args.isDisabled) {
    componentHtml = `<a href=\"\${args.url}\" class=\"\${getClassNames()}\">\${args.text || 'Botão'}</a>`;
  } else {
    componentHtml = `<button class=\"\${getClassNames()}\" \${disabled}>\${args.text || 'Botão'}</button>`;
  }\n";
				break;
			case 'card':
				$content .= "  componentHtml = `<div class=\"\${getClassNames()}\">`;
  
  if (args.hasHeader && args.title) {
    componentHtml += `
      <div class=\"wptl-card__header\">
        <h3 class=\"wptl-card__title\">\${args.title}</h3>
      </div>
    `;
  }
  
  if (args.imageUrl) {
    componentHtml += `
      <div class=\"wptl-card__image\">
        <img src=\"\${args.imageUrl}\" alt=\"\${args.title || 'Card image'}\" />
      </div>
    `;
  }
  
  componentHtml += `
    <div class=\"wptl-card__content\">
      <p>\${args.content || 'Conteúdo do card'}</p>
    </div>
  `;
  
  if (args.hasFooter && args.footerContent) {
    componentHtml += `
      <div class=\"wptl-card__footer\">
        \${args.footerContent}
      </div>
    `;
  }
  
  componentHtml += `</div>`;\n";
				break;
			case 'alert':
				$content .= "  componentHtml = `
    <div class=\"\${getClassNames()}\">
      \${args.title ? `<h4 class=\"wptl-alert__title\">\${args.title}</h4>` : ''}
      <div class=\"wptl-alert__content\">
        \${args.message || 'Mensagem de alerta'}
      </div>
      \${args.dismissible ? '<button class=\"wptl-alert__close\">&times;</button>' : ''}
    </div>
  `;\n";
				break;
			case 'tabs':
				$content .= "  // Simular tabs a partir do conteúdo
  const tabs = args.tabs || [
    { title: 'Tab 1', content: 'Conteúdo da tab 1' },
    { title: 'Tab 2', content: 'Conteúdo da tab 2' }
  ];
  
  componentHtml = `<div class=\"\${getClassNames()}\">`;
  
  // Tab headers
  componentHtml += `<div class=\"wptl-tabs__nav\">`;
  tabs.forEach((tab, index) => {
    const isActive = index === 0 ? 'wptl-tabs__nav-item--active' : '';
    componentHtml += `<button class=\"wptl-tabs__nav-item \${isActive}\">\${tab.title}</button>`;
  });
  componentHtml += `</div>`;
  
  // Tab content
  componentHtml += `<div class=\"wptl-tabs__content\">`;
  tabs.forEach((tab, index) => {
    const isActive = index === 0 ? 'wptl-tabs__panel--active' : '';
    componentHtml += `<div class=\"wptl-tabs__panel \${isActive}\">\${tab.content}</div>`;
  });
  componentHtml += `</div>`;
  
  componentHtml += `</div>`;\n";
				break;
			case 'accordion':
				$content .= "  // Simular itens do accordion a partir do conteúdo
  const items = args.items || [
    { title: 'Item 1', content: 'Conteúdo do item 1' },
    { title: 'Item 2', content: 'Conteúdo do item 2' }
  ];
  
  componentHtml = `<div class=\"\${getClassNames()}\">`;
  
  items.forEach((item, index) => {
    const isOpen = index === 0 ? 'wptl-accordion__item--open' : '';
    componentHtml += `
      <div class=\"wptl-accordion__item \${isOpen}\">
        <div class=\"wptl-accordion__header\">
          <h3 class=\"wptl-accordion__title\">\${item.title}</h3>
          <button class=\"wptl-accordion__toggle\"></button>
        </div>
        <div class=\"wptl-accordion__content\">
          <div class=\"wptl-accordion__body\">
            \${item.content}
          </div>
        </div>
      </div>
    `;
  });
  
  componentHtml += `</div>`;\n";
				break;
			default:
				// Template genérico para outros componentes
				$content .= "  componentHtml = `<div class=\"\${getClassNames()}\">`;
  
  // Conteúdo principal
  componentHtml += `
    <div class=\"wptl-{$component_name}__content\">
      Visualização do componente {$pascal_case_name}
    </div>
  `;
  
  componentHtml += `</div>`;\n";
		}
		
		$content .= "
  return componentHtml;
};

";

		// Adicionar variantes do componente
		
		// Variante padrão
		$content .= "export const Default = Template.bind({});
Default.args = {\n";
		
		// Valores padrão para as propriedades
		foreach ( $component_info['properties'] as $prop_name => $prop_info ) {
			$default_value = $prop_info['default'];
			
			// Formatar o valor padrão de acordo com o tipo
			switch ( $prop_info['type'] ) {
				case 'string':
					$content .= "  {$prop_name}: {$default_value},\n";
					break;
				case 'boolean':
					$bool_value = ( $default_value === 'true' || $default_value === 'TRUE' || $default_value === true ) ? 'true' : 'false';
					$content .= "  {$prop_name}: {$bool_value},\n";
					break;
				case 'number':
					$content .= "  {$prop_name}: {$default_value},\n";
					break;
				case 'select':
					// Usar o primeiro valor das variantes, se disponível
					if ( isset( $component_info['variants'][ $prop_name ] ) && ! empty( $component_info['variants'][ $prop_name ] ) ) {
						$first_value = json_encode( reset( $component_info['variants'][ $prop_name ] ) );
						$content .= "  {$prop_name}: {$first_value},\n";
					} else {
						$content .= "  {$prop_name}: {$default_value},\n";
					}
					break;
				default:
					$content .= "  {$prop_name}: {$default_value},\n";
			}
		}
		
		$content .= "};\n\n";
		
		// Adicionar variantes específicas para tipos de propriedades "select"
		foreach ( $component_info['properties'] as $prop_name => $prop_info ) {
			if ( $prop_info['type'] === 'select' && isset( $component_info['variants'][ $prop_name ] ) ) {
				foreach ( $component_info['variants'][ $prop_name ] as $variant_name => $variant_value ) {
					$variant_export_name = ucfirst( $variant_name );
					
					$content .= "export const {$variant_export_name} = Template.bind({});
{$variant_export_name}.args = {
  ...Default.args,
  {$prop_name}: " . json_encode( $variant_value ) . "
};\n\n";
				}
			} elseif ( $prop_info['type'] === 'boolean' && $prop_info['default'] !== 'true' ) {
				// Adicionar variante para propriedades boolean (se o padrão for false)
				$variant_export_name = ucfirst( $prop_name );
				
				$content .= "export const With{$variant_export_name} = Template.bind({});
With{$variant_export_name}.args = {
  ...Default.args,
  {$prop_name}: true
};\n\n";
			}
		}
		
		return $content;
	}

	/**
	 * Tenta adivinhar o tipo de uma propriedade com base no valor padrão
	 * 
	 * @param string $value_str Representação em string do valor.
	 * @return string Tipo da propriedade
	 */
	private function guess_property_type( $value_str ) {
		$value_str = trim( $value_str );
		
		if ( $value_str === 'true' || $value_str === 'false' || $value_str === 'TRUE' || $value_str === 'FALSE' ) {
			return 'boolean';
		}
		
		if ( is_numeric( $value_str ) ) {
			return 'number';
		}
		
		if ( preg_match( '/^array\s*\(/', $value_str ) ) {
			return 'array';
		}
		
		// Verificar por referências a constantes de tipo (indício de select)
		if ( preg_match( '/self::(\w+)_TYPE_(\w+)/', $value_str ) ) {
			return 'select';
		}
		
		return 'string';
	}

	/**
	 * Limpa um bloco de comentário
	 * 
	 * @param string $comment Comentário bruto do PHP.
	 * @return string Comentário limpo
	 */
	private function clean_comment( $comment ) {
		// Remover asteriscos e espaços extras
		$lines = explode( "\n", $comment );
		$clean_lines = array();
		
		foreach ( $lines as $line ) {
			$clean_line = preg_replace( '/^\s*\*\s*/', '', $line );
			$clean_line = trim( $clean_line );
			
			if ( ! empty( $clean_line ) && ! preg_match( '/^@\w+/', $clean_line ) ) {
				$clean_lines[] = $clean_line;
			}
		}
		
		return implode( ' ', $clean_lines );
	}
} 