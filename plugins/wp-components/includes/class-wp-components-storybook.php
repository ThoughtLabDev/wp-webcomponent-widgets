<?php
/**
 * WP Components Storybook Integration
 *
 * @package WP_Components
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class responsável pela integração do Storybook
 */
class WPTL_Components_Storybook {

	/**
	 * Inicializa a classe
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_storybook_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_storybook_assets' ) );
		add_action( 'rest_api_init', array( $this, 'register_storybook_endpoints' ) );
		add_action( 'admin_init', array( $this, 'maybe_generate_storybook_stories' ) );
	}

	/**
	 * Registra a página do Storybook no menu do WordPress
	 */
	public function register_storybook_page() {
		add_menu_page(
			'WP Components',
			'WP Components',
			'manage_options',
			'wp-components',
			array( $this, 'render_main_page' ),
			'dashicons-layout',
			30
		);
		
		add_submenu_page(
			'wp-components',
			'Documentação de Componentes',
			'Documentação',
			'manage_options',
			'wp-components-storybook',
			array( $this, 'render_storybook_page' )
		);
		
		add_submenu_page(
			'wp-components',
			'Configuração do Storybook',
			'Configuração',
			'manage_options',
			'wp-components-storybook-config',
			array( $this, 'render_storybook_config_page' )
		);
	}

	/**
	 * Renderiza a página principal do plugin
	 */
	public function render_main_page() {
		?>
		<div class="wrap">
			<h1>WP Components</h1>
			
			<div class="wp-components-dashboard">
				<div class="wp-components-dashboard-section">
					<h2>Biblioteca de Componentes para WordPress</h2>
					<p>Este plugin fornece componentes reutilizáveis para facilitar a criação de layouts e interfaces no WordPress.</p>
					
					<div class="wp-components-dashboard-actions">
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-components-storybook' ) ); ?>" class="button button-primary">
							Ver Documentação
						</a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-components-storybook-config' ) ); ?>" class="button">
							Configurações do Storybook
						</a>
					</div>
				</div>
			</div>
		</div>
		
		<style>
			.wp-components-dashboard {
				margin-top: 20px;
			}
			
			.wp-components-dashboard-section {
				background: #fff;
				border: 1px solid #ccd0d4;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
				padding: 20px;
				border-radius: 4px;
				margin-bottom: 20px;
			}
			
			.wp-components-dashboard-actions {
				margin-top: 20px;
			}
			
			.wp-components-dashboard-actions .button {
				margin-right: 10px;
			}
		</style>
		<?php
	}

	/**
	 * Renderiza a página do Storybook
	 */
	public function render_storybook_page() {
		$storybook_static_dir = WP_COMPONENTS_PLUGIN_DIR . 'public/storybook/storybook-static';
		$storybook_url = plugins_url( 'public/storybook/storybook-static/index.html', dirname( __FILE__ ) );
		
		// Verificar se a versão estática existe
		$storybook_built = file_exists( $storybook_static_dir . '/index.html' );
		?>
		<div class="wrap">
			<h1>Documentação de Componentes WP ThoughtLab</h1>
			
			<p>Esta é a documentação interativa dos componentes disponíveis no plugin WP Components.</p>
			
			<?php if ( ! $storybook_built ) : ?>
				<div class="notice notice-warning">
					<p>
						<strong>Documentação estática não encontrada.</strong> 
						A versão estática do Storybook precisa ser gerada. Por favor, visite a 
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-components-storybook-config' ) ); ?>">página de configuração</a> 
						para gerar a documentação.
					</p>
				</div>
				
				<div class="wp-components-storybook-info">
					<h2>Como gerar a documentação</h2>
					<p>Para gerar a documentação estática do Storybook, siga estes passos:</p>
					
					<ol>
						<li>Acesse o servidor via SSH ou terminal</li>
						<li>Navegue até o diretório do Storybook: <code><?php echo esc_html( WP_COMPONENTS_PLUGIN_DIR . 'public/storybook' ); ?></code></li>
						<li>Execute os comandos:
							<pre>npm install
npm run build-storybook</pre>
						</li>
						<li>Atualize esta página após a conclusão</li>
					</ol>
				</div>
			<?php else : ?>
				<div class="wp-components-storybook-container">
					<div class="storybook-frame-container">
						<iframe src="<?php echo esc_url( $storybook_url ); ?>" width="100%" height="800" frameborder="0"></iframe>
					</div>
					
					<div class="wp-components-storybook-info">
						<h2>Sobre o Storybook</h2>
						<p>O Storybook é uma ferramenta para desenvolvimento de componentes de UI isolados. Ele ajuda a construir componentes reutilizáveis de forma organizada e documentada.</p>
						
						<h3>Como usar esta documentação</h3>
						<ul>
							<li>Navegue pelos componentes usando o menu lateral do Storybook</li>
							<li>Experimente diferentes configurações usando os controles</li>
							<li>Veja o código de uso de cada componente na aba "Docs"</li>
						</ul>
						
						<div class="wp-components-storybook-notice">
							<h4>Atualizar a documentação</h4>
							<p>Sempre que novos componentes forem adicionados ou modificados, você pode atualizar a documentação na 
							<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-components-storybook-config' ) ); ?>">página de configuração</a>.</p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		
		<style>
			.wp-components-storybook-container {
				margin-top: 20px;
			}
			
			.storybook-frame-container {
				background: #f5f5f5;
				border: 1px solid #ccc;
				border-radius: 4px;
			}
			
			.wp-components-storybook-info {
				margin-top: 30px;
				background: #fff;
				padding: 20px;
				border-radius: 4px;
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
			}
			
			.wp-components-storybook-info h2 {
				margin-top: 0;
				padding-bottom: 10px;
				border-bottom: 1px solid #eee;
			}
			
			.wp-components-storybook-info h3 {
				margin: 1.5em 0 0.5em;
			}
			
			.wp-components-storybook-info ul {
				margin-left: 1.5em;
			}
			
			.wp-components-storybook-info pre {
				background: #f5f5f5;
				padding: 15px;
				border-radius: 4px;
				overflow: auto;
				font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
				font-size: 13px;
				line-height: 1.5;
				color: #333;
				border: 1px solid #ddd;
			}
			
			.wp-components-storybook-notice {
				background: #f0f6fc;
				border-left: 4px solid #0073aa;
				padding: 12px;
				margin: 15px 0;
			}
		</style>
		<?php
	}

	/**
	 * Renderiza a página de configuração do Storybook
	 */
	public function render_storybook_config_page() {
		// Verificar se foi solicitada a geração de histórias
		$generated = false;
		$generation_results = array();
		
		if ( isset( $_POST['generate_stories'] ) && check_admin_referer( 'wp_components_generate_storybook_stories' ) ) {
			$generated = true;
			$generation_results = $this->generate_component_stories();
		}
		
		?>
		<div class="wrap">
			<h1>Configuração do Storybook</h1>
			
			<div class="wp-components-storybook-config">
				<?php if ( $generated ) : ?>
					<div class="notice notice-success">
						<p><strong>Histórias do Storybook geradas com sucesso!</strong></p>
						<p>Foram processados <?php echo count( $generation_results ); ?> componentes.</p>
					</div>
				<?php endif; ?>
				
				<div class="wp-components-storybook-config-section">
					<h2>Gerar Histórias do Storybook</h2>
					<p>Esta ferramenta irá analisar automaticamente seus componentes e gerar histórias do Storybook para eles.</p>
					
					<form method="post" action="">
						<?php wp_nonce_field( 'wp_components_generate_storybook_stories' ); ?>
						<p>
							<button type="submit" name="generate_stories" class="button button-primary">
								Gerar Histórias dos Componentes
							</button>
						</p>
					</form>
				</div>
				
				<div class="wp-components-storybook-config-section">
					<h2>Comandos do Storybook</h2>
					<p>Para trabalhar com o Storybook, você pode usar os seguintes comandos:</p>
					
					<div class="wp-components-storybook-command">
						<h3>Instalar Dependências</h3>
						<code>cd <?php echo esc_html( WP_COMPONENTS_PLUGIN_DIR . 'public/storybook' ); ?>
npm install</code>
					</div>
					
					<div class="wp-components-storybook-command">
						<h3>Iniciar Servidor de Desenvolvimento</h3>
						<code>cd <?php echo esc_html( WP_COMPONENTS_PLUGIN_DIR . 'public/storybook' ); ?>
npm run storybook</code>
						<p>Isso iniciará o servidor de desenvolvimento na porta 6006. Acesse <a href="http://localhost:6006" target="_blank">http://localhost:6006</a>.</p>
					</div>
					
					<div class="wp-components-storybook-command">
						<h3>Gerar Versão Estática</h3>
						<code>cd <?php echo esc_html( WP_COMPONENTS_PLUGIN_DIR . 'public/storybook' ); ?>
npm run build-storybook</code>
						<p>Isso criará uma versão estática do Storybook em <code>storybook-static/</code>, que será acessível na página de documentação.</p>
					</div>
				</div>
			</div>
		</div>
		
		<style>
			.wp-components-storybook-config {
				margin-top: 20px;
			}
			
			.wp-components-storybook-config-section {
				background: #fff;
				border: 1px solid #ccd0d4;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
				padding: 20px;
				border-radius: 4px;
				margin-bottom: 20px;
			}
			
			.wp-components-storybook-command {
				margin-bottom: 20px;
				padding-bottom: 20px;
				border-bottom: 1px solid #eee;
			}
			
			.wp-components-storybook-command:last-child {
				border-bottom: none;
				padding-bottom: 0;
			}
			
			.wp-components-storybook-command h3 {
				margin-top: 0;
				margin-bottom: 10px;
			}
			
			.wp-components-storybook-command code {
				display: block;
				background: #f5f5f5;
				padding: 15px;
				border-radius: 4px;
				overflow: auto;
				font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
				font-size: 13px;
				line-height: 1.5;
				color: #333;
				border: 1px solid #ddd;
			}
			
			.wp-components-storybook-command p {
				margin-top: 10px;
				color: #666;
			}
		</style>
		<?php
	}

	/**
	 * Gera automaticamente histórias do Storybook para os componentes
	 * 
	 * @return array Resultados da geração
	 */
	private function generate_component_stories() {
		// Incluir o gerador de histórias
		require_once WP_COMPONENTS_PLUGIN_DIR . 'includes/class-wp-components-storybook-generator.php';
		
		// Criar instância do gerador
		$generator = new WPTL_Components_Storybook_Generator();
		
		// Gerar histórias para todos os componentes
		return $generator->generate_all_stories();
	}

	/**
	 * Verifica se deve gerar histórias do Storybook automaticamente
	 */
	public function maybe_generate_storybook_stories() {
		// Verificar se as histórias devem ser geradas automaticamente
		// Por exemplo, quando um novo componente é adicionado ou quando o plugin é ativado
		$stories_dir = WP_COMPONENTS_PLUGIN_DIR . 'public/storybook/stories/components';
		
		// Se o diretório não existir ou estiver vazio, gerar histórias
		if ( ! file_exists( $stories_dir ) || ( is_dir( $stories_dir ) && count( scandir( $stories_dir ) ) <= 2 ) ) {
			// Certificar-se de que o diretório existe
			if ( ! file_exists( $stories_dir ) ) {
				wp_mkdir_p( $stories_dir );
			}
			
			// Gerar histórias apenas se o gerador existir
			if ( file_exists( WP_COMPONENTS_PLUGIN_DIR . 'includes/class-wp-components-storybook-generator.php' ) ) {
				$this->generate_component_stories();
			}
		}
	}

	/**
	 * Registra endpoints da REST API para o Storybook
	 */
	public function register_storybook_endpoints() {
		register_rest_route(
			'wp-components/v1',
			'/components',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_components_data' ),
				'permission_callback' => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	/**
	 * Retorna dados dos componentes para a API
	 *
	 * @return WP_REST_Response
	 */
	public function get_components_data() {
		// Aqui você pode adicionar lógica para extrair informações dos seus componentes
		// para uso no Storybook, como metadados, propriedades, etc.
		$components = array(
			'button'    => array(
				'name'        => 'Button',
				'description' => 'Componente de botão com várias variações',
				'props'       => array(
					'text'      => 'string',
					'type'      => 'string (primary, secondary, tertiary, link)',
					'url'       => 'string',
					'size'      => 'string (small, medium, large)',
					'isDisabled' => 'boolean',
				),
			),
			'card'      => array(
				'name'        => 'Card',
				'description' => 'Componente de card para exibição de conteúdo',
				'props'       => array(
					'title'         => 'string',
					'content'       => 'string',
					'imageUrl'      => 'string',
					'footerContent' => 'string',
					'hasHeader'     => 'boolean',
					'hasFooter'     => 'boolean',
					'variant'       => 'string (default, bordered, shadowed, flat)',
				),
			),
			'alert'     => array(
				'name'        => 'Alert',
				'description' => 'Componente de alerta para mensagens importantes',
				'props'       => array(
					'type'         => 'string (info, success, warning, error)',
					'title'        => 'string',
					'message'      => 'string',
					'dismissible'  => 'boolean',
				),
			),
			'tabs'      => array(
				'name'        => 'Tabs',
				'description' => 'Componente de abas para organizar conteúdo',
				'props'       => array(
					'tabs'         => 'array',
					'activeTab'    => 'number',
					'type'         => 'string (horizontal, vertical)',
				),
			),
			'accordion' => array(
				'name'        => 'Accordion',
				'description' => 'Componente de acordeão para seções expansíveis',
				'props'       => array(
					'items'        => 'array',
					'multiExpand'  => 'boolean',
					'defaultOpen'  => 'number',
				),
			),
		);

		return rest_ensure_response( $components );
	}

	/**
	 * Carrega os assets do Storybook na página de administração
	 *
	 * @param string $hook O hook da página atual.
	 */
	public function enqueue_storybook_assets( $hook ) {
		$storybook_pages = array(
			'wp-components_page_wp-components-storybook',
			'wp-components_page_wp-components-storybook-config',
			'toplevel_page_wp-components',
		);
		
		if ( ! in_array( $hook, $storybook_pages, true ) ) {
			return;
		}

		// Se necessário, adicione estilos ou scripts específicos para a página de administração
		$css_file = WP_COMPONENTS_PLUGIN_DIR . 'public/storybook/assets/admin-storybook.css';
		
		if ( file_exists( $css_file ) ) {
			wp_enqueue_style(
				'wp-components-storybook-admin',
				plugins_url( 'public/storybook/assets/admin-storybook.css', dirname( __FILE__ ) ),
				array(),
				filemtime( $css_file )
			);
		}
	}
}

// Inicializa a classe
new WPTL_Components_Storybook(); 