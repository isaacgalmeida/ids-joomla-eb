# Project Structure & Organization

## Repository Structure

```
├── .git/                          # Git version control
├── .kiro/                         # Kiro IDE configuration
├── CHANGELOG.md                   # Version history (Keep a Changelog format)
├── LICENSE                        # Dual MIT/GPL v2 license
├── MIGRATION.md                   # Migration guide for version updates
├── README.md                      # Project documentation
├── SUMMARY.md                     # Project summary
├── compose.yaml                   # Docker development environment
├── dockerfile                     # Custom Joomla container
├── pkg_ids_joomla_eb.xml         # Main package manifest
├── script.php                     # Package installation script
├── language/                      # Package-level language files
│   ├── en-GB.pkg_ids_joomla_eb.ini
│   ├── en-GB.pkg_ids_joomla_eb.sys.ini
│   ├── pt-BR.pkg_ids_joomla_eb.ini
│   └── pt-BR.pkg_ids_joomla_eb.sys.ini
├── packages/                      # Individual extension packages
│   ├── novpadraoegov.zip         # Template: IDS Gov - EB
│   ├── com_aniversariantes.zip   # Component: Birthday management
│   ├── com_pagtesouro.zip        # Component: Payment system
│   ├── mod_aniver.zip            # Module: Anniversary section
│   ├── mod_imagempopup.zip       # Module: Image popup
│   ├── mod_instafeed.zip         # Module: Instagram feed
│   ├── mod_links.zip             # Module: Custom links
│   ├── mod_readmorenews.zip      # Module: Read more button
│   └── mod_videosiframe.zip      # Module: YouTube carousel
└── updates/                       # Update server XMLs
    ├── ids-joomla-eb-updates.xml
    ├── template-govbr-updates.xml
    ├── com_aniversariantes-updates.xml
    ├── com_pagtesouro-updates.xml
    └── mod_*-updates.xml
```

## Package Organization

### Main Package (pkg_ids_joomla_eb)

- **Type**: Joomla package extension
- **Purpose**: Bundles all extensions into single installer
- **Manifest**: `pkg_ids_joomla_eb.xml`
- **Script**: `script.php` (handles installation logic)
- **Namespace**: `IDS\Package\IDSJoomlaEB`

### Template (novpadraoegov)

- **Name**: IDS Gov - Exército Brasileiro
- **ID**: govbr-ds
- **Purpose**: Brazilian Government Digital Standard implementation
- **Namespace**: `IDS\Template\GovBRDS`

### Components

1. **com_aniversariantes** - Birthday/anniversary management system
2. **com_pagtesouro** - Payment system integration (legacy structure)

### Modules (6 total)

All modules are site-side (client="site"):

1. **mod_aniver** - Anniversary display section
2. **mod_imagempopup** - Image popup functionality
3. **mod_instafeed** - Instagram feed integration
4. **mod_links** - Custom links section
5. **mod_readmorenews** - Read more button enhancement
6. **mod_videosiframe** - YouTube video carousel

## File Naming Conventions

### Extensions

- **Packages**: `pkg_[name].xml`, `pkg_[name].zip`
- **Components**: `com_[name].zip`
- **Modules**: `mod_[name].zip`
- **Templates**: Use descriptive names (e.g., `novpadraoegov.zip`)

### Language Files

- **Format**: `[lang-code].[extension-name].[type].ini`
- **Types**: `.ini` (frontend), `.sys.ini` (system/admin)
- **Languages**: `en-GB`, `pt-BR`

### Update Files

- **Format**: `[extension-name]-updates.xml`
- **Location**: `/updates/` directory
- **Naming**: Matches extension identifier

## Version Management

### Semantic Versioning

- **Format**: MAJOR.MINOR.PATCH (e.g., 2.0.0)
- **Scope**: All extensions use same version number
- **Current**: 2.0.0 (October 2025)

### Version Synchronization

- Package version drives all extension versions
- Update XMLs reference GitHub releases
- CHANGELOG.md tracks all changes

## Development Workflow

### Local Development

1. Use Docker environment (`docker-compose up -d`)
2. Access Joomla at `http://localhost:8080`
3. Install package via Joomla admin interface
4. Test extensions individually

### Release Process

1. Update version numbers across all manifests
2. Update CHANGELOG.md with changes
3. Create GitHub release with tag (e.g., v2.0.0)
4. Update XML files in `/updates/` directory
5. Test automatic update system

### Documentation Standards

- **CHANGELOG.md**: Follow Keep a Changelog format
- **MIGRATION.md**: Version-specific migration guides
- **README.md**: User-facing documentation
- **Code Comments**: PHPDoc standards for PHP files
