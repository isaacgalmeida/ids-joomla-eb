# Technology Stack & Build System

## Tech Stack

### Core Platform

- **Joomla CMS**: 5.4+ and 6.x compatible
- **PHP**: 8.3.0+ (required minimum)
- **MySQL**: 5.7+ or 8.0+
- **Apache/Nginx**: with mod_rewrite enabled

### Development Standards

- **Semantic Versioning**: Following semver.org standards
- **Namespace Architecture**: Modern PHP namespaces (e.g., `IDS\Template\GovBRDS`, `IDS\Package\IDSJoomlaEB`)
- **Language Support**: Portuguese (pt-BR) and English (en-GB)
- **Licensing**: Dual MIT/GPL v2 license

### Package Architecture

- **Package Type**: Joomla extension package (.zip)
- **Manifest**: XML-based extension definitions
- **Update System**: GitHub-based automatic updates
- **Installation**: Via Joomla installer with custom script.php

## Build System

### Package Structure

```
pkg_ids_joomla_eb.xml          # Main package manifest
script.php                     # Installation/update script
packages/                      # Individual extension packages
├── novpadraoegov.zip         # Template
├── com_aniversariantes.zip   # Component
├── com_pagtesouro.zip        # Component
└── mod_*.zip                 # Modules (6 total)
```

### Development Environment

- **Docker Support**: Complete docker-compose.yaml setup
- **Container**: Custom Dockerfile based on joomla:php8.3-apache
- **Database**: MySQL 8.0 container
- **Port**: 8080 (configurable)

### Common Commands

#### Docker Development

```bash
# Start development environment
docker-compose up -d

# View logs
docker-compose logs -f

# Stop environment
docker-compose down

# Rebuild containers
docker-compose up --build
```

#### Package Management

```bash
# Install package via Joomla admin
# Sistema → Instalar → Extensões
# Upload pkg_ids_joomla_eb.zip

# Check for updates
# Sistema → Atualizar → Extensões → Verificar Atualizações
```

#### Version Management

- All extensions follow semantic versioning (MAJOR.MINOR.PATCH)
- Current version: 2.0.0 across all components
- Update XMLs maintained in `/updates/` directory

### Update System

- **Server**: GitHub raw content delivery
- **Base URL**: `https://raw.githubusercontent.com/astatonn/ids-joomla-eb/master/updates/`
- **Individual XMLs**: Each extension has its own update XML
- **Automatic Detection**: Joomla checks for updates periodically

### Installation Requirements Check

The script.php performs automatic validation:

- PHP version >= 8.3.0
- Joomla version >= 5.4.0
- Joomla 6 compatibility warnings
- Extension dependency checks
