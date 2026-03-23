#!/bin/bash

# =============================================================================
# GD Extension Fix Script
# This script automatically fixes the missing GD extension issue in PHP
# =============================================================================

set -e

echo "🔧 Fixing PHP GD Extension..."
echo ""

# Check if .devcontainer directory exists
if [ ! -d ".devcontainer" ]; then
    echo "📁 Creating .devcontainer directory..."
    mkdir -p .devcontainer
fi

# Create/Update Dockerfile with GD support
echo "📝 Creating Dockerfile with GD extension..."
cat > .devcontainer/Dockerfile << 'EOF'
# =============================================================================
# DOCKERFILE - Bygger utvecklingsmiljön för PHP
# =============================================================================
# Den här filen beskriver hur vår utvecklingscontainer ska byggas.
# Tänk på det som ett recept för att skapa en virtuell dator med allt vi behöver.
# =============================================================================

# Basimage: Startar från Microsofts färdiga PHP 8.3-miljö för VS Code
# Detta ger oss PHP förinstallerat med vanliga verktyg
FROM mcr.microsoft.com/devcontainers/php:1-8.3

# Installerar systembibliotek som behövs för bildbehandling (GD-tillägget)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    && rm -rf /var/lib/apt/lists/*

# Konfigurerar och installerar GD-tillägget för bildbehandling
# GD används för att beskära, ändra storlek och manipulera bilder
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd

# Installerar PHP-tillägg för MySQL-databasanslutning
# pdo_mysql = Modern säker metod för databasanrop
# mysqli = Äldre metod, fortfarande vanlig i tutorials
RUN docker-php-ext-install pdo_mysql mysqli

# Node.js installeras via devcontainer features i devcontainer.json
# Detta ger en mer stabil installation utan GPG-nyckelproblem
EOF

# Create or update devcontainer.json if it doesn't exist
if [ ! -f ".devcontainer/devcontainer.json" ]; then
    echo "📝 Creating devcontainer.json..."
    cat > .devcontainer/devcontainer.json << 'EOF'
{
	"name": "PHP Dev Container",
	"build": {
		"dockerfile": "Dockerfile"
	},
	"customizations": {
		"vscode": {
			"extensions": [
				"bmewburn.vscode-intelephense-client"
			]
		}
	},
	"forwardPorts": [8000, 3306],
	"postCreateCommand": "php -v"
}
EOF
fi

echo ""
echo "✅ Dockerfile has been created/updated successfully!"
echo ""
echo "📌 NEXT STEP - Rebuild the container:"
echo "   1. Press F1 (or Ctrl+Shift+P)"
echo "   2. Type: 'Dev Containers: Rebuild Container'"
echo "   3. Select it and wait 1-2 minutes"
echo ""
echo "After rebuild, verify with: php -m | grep gd"
echo ""
