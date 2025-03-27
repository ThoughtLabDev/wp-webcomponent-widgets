<?php
/**
 * Script para construir a documentação Storybook
 * 
 * Este script pode ser executado diretamente ou através do painel de administração WordPress
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    // Define constantes básicas se executado diretamente
    define('ABSPATH', dirname(dirname(dirname(dirname(dirname(__FILE__))))));
    define('WP_COMPONENTS_PLUGIN_DIR', dirname(dirname(__FILE__)) . '/');
}

// Configurações
$storybook_dir = WP_COMPONENTS_PLUGIN_DIR . 'public/storybook/';
$node_path = '/usr/bin/node'; // Caminho para o executável Node.js (ajuste conforme necessário)
$npm_path = '/usr/bin/npm';   // Caminho para o executável npm (ajuste conforme necessário)

// Função para executar comandos e registrar a saída
function run_command($command, $log_file = null) {
    $output = array();
    $return_var = 0;
    
    echo "Executando: $command\n";
    
    exec($command . ' 2>&1', $output, $return_var);
    
    $output_text = implode("\n", $output);
    echo $output_text . "\n";
    
    if ($log_file) {
        file_put_contents($log_file, $output_text, FILE_APPEND);
    }
    
    return array(
        'success' => ($return_var === 0),
        'output' => $output,
        'return_var' => $return_var
    );
}

// Iniciar o processo
echo "Iniciando a construção do Storybook para WP Components\n";
echo "Diretório: $storybook_dir\n\n";

// Verificar se o Storybook está instalado
$log_file = $storybook_dir . 'build_log.txt';
file_put_contents($log_file, "=== Construção do Storybook: " . date('Y-m-d H:i:s') . " ===\n\n");

// Verificar o Node.js
$node_version = run_command("$node_path --version", $log_file);
if (!$node_version['success']) {
    echo "ERRO: Node.js não encontrado. Verifique o caminho: $node_path\n";
    exit(1);
}

// Verificar o npm
$npm_version = run_command("$npm_path --version", $log_file);
if (!$npm_version['success']) {
    echo "ERRO: npm não encontrado. Verifique o caminho: $npm_path\n";
    exit(1);
}

// Tentar instalar as dependências
echo "\nInstalando dependências...\n";
$install_result = run_command("cd $storybook_dir && $npm_path install", $log_file);

if (!$install_result['success']) {
    echo "ERRO: Falha ao instalar as dependências do Storybook.\n";
    file_put_contents($log_file, "\nFALHA: Instalação das dependências\n", FILE_APPEND);
    exit(1);
}

// Construir o Storybook
echo "\nConstruindo o Storybook...\n";
$build_result = run_command("cd $storybook_dir && $npm_path run build-storybook", $log_file);

if (!$build_result['success']) {
    echo "ERRO: Falha ao construir o Storybook.\n";
    file_put_contents($log_file, "\nFALHA: Construção do Storybook\n", FILE_APPEND);
    exit(1);
}

// Verificar se o diretório de saída existe
$output_dir = $storybook_dir . 'storybook-static';
if (!file_exists($output_dir) || !file_exists($output_dir . '/index.html')) {
    echo "ERRO: Diretório de saída não encontrado ou incompleto: $output_dir\n";
    file_put_contents($log_file, "\nFALHA: Diretório de saída não encontrado\n", FILE_APPEND);
    exit(1);
}

// Concluído com sucesso
echo "\nStorybook construído com sucesso!\n";
echo "A documentação está disponível em: $output_dir\n";
file_put_contents($log_file, "\nSUCESSO: Storybook construído em " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

// Se estiver sendo executado via WordPress, enviar cabeçalho JSON
if (defined('WP_ADMIN') && WP_ADMIN) {
    header('Content-Type: application/json');
    echo json_encode(array(
        'success' => true,
        'message' => 'Storybook construído com sucesso',
        'output_dir' => $output_dir
    ));
}

exit(0); 