# Referência de Desenvolvimento: Componente com_aniversariantes

## Visão Geral

O componente `com_aniversariantes` serve como **modelo de referência** para desenvolvimento de componentes Joomla 5+ no projeto IDS Joomla EB. Este documento analisa sua estrutura e padrões para replicação em novos componentes.

## Arquitetura Moderna Joomla 5+

### Namespace Padrão

- **Namespace**: `Astatonn\Component\Aniversariantes`
- **Padrão do Projeto**: Usar `IDS\Component\[ComponentName]` para novos componentes
- **Estrutura**: Segue arquitetura moderna com `src/` folders

### Estrutura de Arquivos Completa

```
com_aniversariantes/
├── aniversariantes.xml                    # Manifest principal
├── administrator/
│   ├── access.xml                         # Definições de permissões
│   ├── config.xml                         # Configurações do componente
│   ├── services/
│   │   └── provider.php                   # Service Provider (OBRIGATÓRIO)
│   ├── src/
│   │   ├── Controller/
│   │   │   ├── DisplayController.php      # Controller principal
│   │   │   ├── AniversariantesController.php  # List controller
│   │   │   └── AniversarianteController.php   # Form controller
│   │   ├── Extension/
│   │   │   └── AniversariantesComponent.php   # Extension Component
│   │   ├── Model/                         # Models administrativos
│   │   ├── View/                          # Views administrativas
│   │   ├── Table/                         # Table classes
│   │   └── Service/                       # Services customizados
│   ├── tmpl/                              # Templates administrativos
│   ├── forms/                             # Form definitions (XML)
│   ├── sql/
│   │   ├── install.mysql.utf8.sql         # Script de instalação
│   │   ├── uninstall.mysql.utf8.sql       # Script de desinstalação
│   │   └── updates/                       # Scripts de atualização
│   ├── languages/
│   │   └── en-GB/
│   │       ├── com_aniversariantes.ini    # Strings admin
│   │       └── com_aniversariantes.sys.ini # Strings sistema
│   ├── presets/                           # Presets de configuração
│   └── assets/                            # Assets administrativos
├── site/
│   ├── src/
│   │   ├── Controller/                    # Controllers do site
│   │   ├── Model/                         # Models do site
│   │   └── View/                          # Views do site
│   ├── tmpl/                              # Templates do site
│   ├── forms/                             # Forms do site
│   └── languages/
│       └── en-GB/
│           └── com_aniversariantes.ini    # Strings frontend
├── media/
│   ├── css/                               # Estilos CSS
│   ├── js/                                # JavaScript
│   └── joomla.asset.json                  # Asset definitions
├── webservices/
│   └── src/                               # API endpoints
└── installer/
    └── index.html                         # Arquivo de segurança
```

## Implementações Obrigatórias

### 1. Service Provider (administrator/services/provider.php)

```php
<?php
defined('_JEXEC') or die;

use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use IDS\Component\[ComponentName]\Administrator\Extension\[ComponentName]Component;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(new CategoryFactory('\\IDS\\Component\\[ComponentName]'));
        $container->registerServiceProvider(new MVCFactory('\\IDS\\Component\\[ComponentName]'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\IDS\\Component\\[ComponentName]'));
        $container->registerServiceProvider(new RouterFactory('\\IDS\\Component\\[ComponentName]'));

        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new [ComponentName]Component($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                $component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
                $component->setRouterFactory($container->get(RouterFactoryInterface::class));
                return $component;
            }
        );
    }
};
```

### 2. Extension Component (administrator/src/Extension/[ComponentName]Component.php)

```php
<?php
namespace IDS\Component\[ComponentName]\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Association\AssociationServiceInterface;
use Joomla\CMS\Association\AssociationServiceTrait;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Joomla\CMS\Tag\TagServiceTrait;
use Psr\Container\ContainerInterface;
use Joomla\CMS\Categories\CategoryServiceInterface;

class [ComponentName]Component extends MVCComponent implements RouterServiceInterface, BootableExtensionInterface, CategoryServiceInterface
{
    use AssociationServiceTrait;
    use RouterServiceTrait;
    use HTMLRegistryAwareTrait;
    use CategoryServiceTrait, TagServiceTrait {
        CategoryServiceTrait::getTableNameForSection insteadof TagServiceTrait;
        CategoryServiceTrait::getStateColumnForSection insteadof TagServiceTrait;
    }

    public function boot(ContainerInterface $container)
    {
        // Inicialização do componente
        // Registrar HTML helpers, services customizados, etc.
    }

    protected function getTableNameForSection(string $section = null)
    {
        // Implementar se necessário para categorias
    }

    public function countItems(array $items, string $section)
    {
        // Implementar contagem de items para categorias
    }
}
```

### 3. Display Controller (administrator/src/Controller/DisplayController.php)

```php
<?php
namespace IDS\Component\[ComponentName]\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Router\Route;

class DisplayController extends BaseController
{
    protected $default_view = '[defaultview]';

    public function display($cachable = false, $urlparams = array())
    {
        return parent::display();
    }
}
```

## Manifest XML Padrão

### Estrutura Obrigatória (aniversariantes.xml como referência)

```xml
<?xml version="1.0" encoding="utf-8"?>
<extension type="component">
    <name>com_[componentname]</name>
    <creationDate>December 2025</creationDate>
    <copyright>2025 Sgt Souza Lima</copyright>
    <license>GNU General Public License version 2 or later; see LICENSE.txt</license>
    <author>Sgt Souza Lima</author>
    <authorEmail>lucas.lima.rk@gmail.com</authorEmail>
    <authorUrl>https://astatonn.com</authorUrl>
    <version>2.0.0</version>
    <description>COM_[COMPONENTNAME]_DESCRIPTION</description>

    <!-- Namespace para Joomla 5+ -->
    <namespace path="src">IDS\Component\[ComponentName]</namespace>

    <!-- Scripts de instalação -->
    <scriptfile>script.php</scriptfile>

    <!-- Arquivos de instalação -->
    <install>
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>

    <!-- Atualizações -->
    <update>
        <schemas>
            <schemapath type="mysql">sql/updates</schemapath>
        </schemas>
    </update>

    <!-- Desinstalação -->
    <uninstall>
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>

    <!-- Arquivos do site -->
    <files folder="site">
        <folder>src</folder>
        <folder>forms</folder>
        <folder>tmpl</folder>
    </files>

    <!-- Media files -->
    <media destination="com_[componentname]" folder="media">
        <folder>css</folder>
        <folder>js</folder>
        <filename>joomla.asset.json</filename>
    </media>

    <!-- Idiomas do site -->
    <languages folder="site/languages">
        <language tag="en-GB">en-GB/com_[componentname].ini</language>
        <language tag="pt-BR">pt-BR/com_[componentname].ini</language>
    </languages>

    <!-- Administração -->
    <administration>
        <menu>COM_[COMPONENTNAME]</menu>
        <submenu>
            <menu link="option=com_[componentname]&amp;view=[items]" view="[items]">COM_[COMPONENTNAME]_TITLE_[ITEMS]</menu>
        </submenu>

        <files folder="administrator">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <folder>forms</folder>
            <folder>src</folder>
            <folder>tmpl</folder>
            <folder>services</folder>
            <folder>presets</folder>
            <folder>sql</folder>
        </files>

        <languages folder="administrator/languages">
            <language tag="en-GB">en-GB/com_[componentname].ini</language>
            <language tag="en-GB">en-GB/com_[componentname].sys.ini</language>
            <language tag="pt-BR">pt-BR/com_[componentname].ini</language>
            <language tag="pt-BR">pt-BR/com_[componentname].sys.ini</language>
        </languages>
    </administration>

    <!-- Configurações -->
    <config>
        <fields name="params">
            <fieldset name="component">
                <field name="save_history" default="0" />
            </fieldset>
        </fields>
    </config>

    <!-- Servidor de atualizações -->
    <updateservers>
        <server type="extension" priority="1" name="[ComponentName] Updates">
            https://raw.githubusercontent.com/astatonn/ids-joomla-eb/master/updates/com_[componentname]-updates.xml
        </server>
    </updateservers>

    <!-- Changelog -->
    <changelogurl>https://raw.githubusercontent.com/astatonn/ids-joomla-eb/master/CHANGELOG.md</changelogurl>
</extension>
```

## Estrutura SQL Padrão

### Tabela Principal (sql/install.mysql.utf8.sql)

```sql
CREATE TABLE IF NOT EXISTS `#__[componentname]_[tablename]` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(255) NOT NULL,
    `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
    `descricao` TEXT,
    `publicado` tinyint(1) NOT NULL DEFAULT 1,
    `ordering` int(11) NOT NULL DEFAULT 0,
    `checked_out` int(11) unsigned,
    `checked_out_time` datetime,
    `created_by` int(11) unsigned NOT NULL DEFAULT 0,
    `modified_by` int(11) unsigned NOT NULL DEFAULT 0,
    `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `data_modificacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `params` text,
    PRIMARY KEY (`id`),
    KEY `idx_alias` (`alias`(191)),
    KEY `idx_publicado` (`publicado`),
    KEY `idx_created_by` (`created_by`),
    KEY `idx_checkout` (`checked_out`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
```

## Padrões de Idioma

### Constantes Obrigatórias (com\_[componentname].ini)

```ini
; Componente principal
COM_[COMPONENTNAME]="[Nome do Componente]"
COM_[COMPONENTNAME]_DESCRIPTION="Descrição do componente"
COM_[COMPONENTNAME]_XML_DESCRIPTION="Descrição detalhada do componente"

; Menu e navegação
COM_[COMPONENTNAME]_TITLE_[ITEMS]="Gerenciar [Items]"
COM_[COMPONENTNAME]_TITLE_[ITEM]="[Item]"

; Campos de formulário
COM_[COMPONENTNAME]_FORM_LBL_[ITEM]_ID="ID"
COM_[COMPONENTNAME]_FORM_LBL_[ITEM]_TITULO="Título"
COM_[COMPONENTNAME]_FORM_DESC_[ITEM]_TITULO="Digite o título do item"

; Ações padrão
COM_[COMPONENTNAME]_N_ITEMS_DELETED="%d itens excluídos com sucesso"
COM_[COMPONENTNAME]_N_ITEMS_PUBLISHED="%d itens publicados com sucesso"
COM_[COMPONENTNAME]_SAVE_SUCCESS="Item salvo com sucesso"

; Filtros e busca
COM_[COMPONENTNAME]_SEARCH_FILTER_SUBMIT="Buscar"
COM_[COMPONENTNAME]_SEARCH_TOOLS="Ferramentas de Busca"
COM_[COMPONENTNAME]_SEARCH_FILTER_CLEAR="Limpar filtro"
```

## Diferenças do com_servicos

### Namespace

- **com_aniversariantes**: `Astatonn\Component\Aniversariantes`
- **com_servicos**: `IDS\Component\Servicos` (padrão do projeto)

### Estrutura de Arquivos

- **com_aniversariantes**: Estrutura mais completa com webservices, media, presets
- **com_servicos**: Estrutura mais simples, focada no essencial

### Service Provider

- **com_aniversariantes**: Inclui CategoryFactory e RouterFactory
- **com_servicos**: Implementação mais básica

### Extension Component

- **com_aniversariantes**: Implementa CategoryServiceInterface e traits completos
- **com_servicos**: Implementação mais simples

## Recomendações para Novos Componentes

### 1. Usar como Base

- Use `com_aniversariantes` como estrutura de referência
- Adapte o namespace para `IDS\Component\[ComponentName]`
- Mantenha a estrutura de arquivos completa

### 2. Implementações Obrigatórias

- Service Provider completo com todas as factories
- Extension Component com traits necessários
- Estrutura SQL com campos padrão do Joomla
- Arquivos de idioma pt-BR e en-GB

### 3. Padrões de Qualidade

- Seguir PSR-4 para autoloading
- Implementar prepared statements
- Usar HTMLHelper para saídas seguras
- Implementar controle de permissões (ACL)

### 4. GovBR Design System

- Usar classes CSS do GovBR DS nos templates
- Implementar responsividade
- Seguir padrões de acessibilidade WCAG 2.1 AA

## Checklist de Desenvolvimento

### Estrutura Base

- [ ] Namespace IDS\Component\[ComponentName]
- [ ] Service Provider completo
- [ ] Extension Component com traits
- [ ] Controllers (Display, List, Form)
- [ ] Models (List, Admin, Site)
- [ ] Views (List, Form)
- [ ] Tables classes

### Arquivos Obrigatórios

- [ ] Manifest XML completo
- [ ] SQL install/uninstall
- [ ] Arquivos de idioma (pt-BR, en-GB)
- [ ] access.xml (permissões)
- [ ] config.xml (configurações)

### Integração

- [ ] Update server XML
- [ ] Asset definitions (joomla.asset.json)
- [ ] CSS/JS com classes GovBR
- [ ] Templates responsivos

### Qualidade

- [ ] Validação de dados
- [ ] Controle de permissões
- [ ] Prepared statements
- [ ] Acessibilidade WCAG 2.1 AA
- [ ] Testes em Joomla 5.4+ e 6.x

## Conclusão

O componente `com_aniversariantes` demonstra a implementação completa da arquitetura moderna Joomla 5+ e deve ser usado como referência para todos os novos componentes do projeto IDS Joomla EB. A estrutura é robusta, segue as melhores práticas e está preparada para futuras versões do Joomla.
