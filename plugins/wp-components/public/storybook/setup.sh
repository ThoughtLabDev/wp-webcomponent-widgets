#!/bin/bash

# Script de configuração do Storybook para WP Components

echo "=== Configurando Storybook para WP Components ==="
echo ""

# Verificar se o Node.js está instalado
if ! command -v node &> /dev/null; then
    echo "❌ Node.js não encontrado. Por favor, instale o Node.js antes de continuar."
    echo "   Visite https://nodejs.org/ para instruções de instalação."
    exit 1
fi

# Verificar se o npm está instalado
if ! command -v npm &> /dev/null; then
    echo "❌ npm não encontrado. Por favor, instale o npm antes de continuar."
    exit 1
fi

echo "✅ Node.js e npm encontrados."
echo ""

# Entrar no diretório do Storybook
echo "📁 Entrando no diretório do Storybook..."
cd "$(dirname "$0")"

# Instalar dependências
echo "📦 Instalando dependências do Storybook..."
npm install

if [ $? -ne 0 ]; then
    echo "❌ Falha ao instalar dependências. Verifique os erros acima."
    exit 1
fi

echo "✅ Dependências instaladas com sucesso."
echo ""

# Criar diretório para build estático (se não existir)
if [ ! -d "storybook-static" ]; then
    mkdir -p storybook-static
    echo "📁 Diretório storybook-static criado."
fi

# Verificar permissões de diretório
echo "🔒 Verificando permissões..."
chmod -R 755 .
echo "✅ Permissões atualizadas."
echo ""

# Oferecer opções para iniciar o Storybook
echo "=== Storybook configurado com sucesso! ==="
echo ""
echo "Você pode agora:"
echo "1. Iniciar o servidor de desenvolvimento: npm run storybook"
echo "2. Criar uma versão estática: npm run build-storybook"
echo ""
echo "Para iniciar o servidor de desenvolvimento, execute:"
echo "cd $(pwd) && npm run storybook"
echo ""
echo "Após a compilação, a documentação estática estará disponível em:"
echo "$(pwd)/storybook-static/"
echo ""
echo "Obrigado por usar o WP Components Storybook!" 