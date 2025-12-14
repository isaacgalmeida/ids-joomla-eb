# Desenvolvimento de Componentes Joomla 5+ com GovBR Design System

## Diretrizes Gerais

### Arquitetura Moderna Joomla 5+

- **Sempre** use a arquitetura moderna do Joomla 5+ baseada em namespaces
- **Sempre** implemente Service Provider pattern
- **Sempre** use estrutura `src/` para organização de classes
- **Nunca** use estrutura legacy (admin/, site/, helpers/)

### Namespace Padrão

- **Formato**: `IDS\Component\[ComponentName]`
- **Exemplo**: `IDS\Component\PagTesouro`, `IDS\Component\Aniversariantes`
- **Consistência**: Manter padrão IDS para todos os componentes do projeto

## Estrutura de Arquivos Obrigatória

### Estrutura Moderna (Joomla 5+)

```
com_[name]/
├── [name].xml                           # Manifest do componente
├── script.php                          # Script de instalação
├── administrator/
│   ├── services/
│   │   └── provider.php                # Service Provider (OBRIGATÓRIO)
│   ├── src/
│   │   ├── Controller/                 # Controllers administrativos
│   │   ├── Model/                      # Models administrativos
│   │   ├── View/                       # Views administrativas
│   │   ├── Table/                      # Table classes
│   │   └── Extension/                  # Extension Component
│   ├── tmpl/                          # Templates administrativos
│   └── language/                      # Arquivos de idioma admin
├── components/
│   └── com_[name]/
│       ├── src/
│       │   ├── Controller/            # Controllers do site
│       │   ├── Model/                 # Models do site
│       │   └── View/                  # Views do site
│       ├── tmpl/                      # Templates do site
│       └── language/                  # Arquivos de idioma site
└── sql/                               # Scripts SQL
    ├── install.mysql.utf8.sql
    └── uninstall.mysql.utf8.sql
```

## Implementação Obrigatória

### 1. Service Provider (administrator/services/provider.php)

```php
<?php
defined('_JEXEC') or die;

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use IDS\Component\[ComponentName]\Administrator\Extension\[ComponentName]Component;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(new MVCFactory('\\IDS\\Component\\[ComponentName]'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\IDS\\Component\\[ComponentName]'));
        $container->registerServiceProvider(new RouterFactory('\\IDS\\Component\\[ComponentName]'));

        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new [ComponentName]Component($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
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

defined('_JEXEC') or die;

use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;

class [ComponentName]Component extends MVCComponent implements BootableExtensionInterface
{
    use HTMLRegistryAwareTrait;

    public function boot(ContainerInterface $container)
    {
        // Inicialização do componente
    }
}
```

## GovBR Design System Integration

### CSS Classes Obrigatórias

- **Sempre** use classes do GovBR DS: `br-button`, `br-card`, `br-table`, `br-form`
- **Sempre** implemente responsividade com grid system do GovBR
- **Sempre** use tokens de design (cores, tipografia, espaçamento)

### Componentes UI Padrão

```html
<!-- Botões -->
<button class="br-button primary">Ação Principal</button>
<button class="br-button secondary">Ação Secundária</button>

<!-- Cards -->
<div class="br-card">
  <div class="card-header">
    <h3 class="card-title">Título</h3>
  </div>
  <div class="card-content">
    <!-- Conteúdo -->
  </div>
</div>

<!-- Formulários -->
<div class="br-input">
  <label for="input-id">Label</label>
  <input id="input-id" type="text" placeholder="Placeholder" />
</div>

<!-- Tabelas -->
<div class="br-table">
  <table>
    <thead>
      <tr>
        <th>Coluna 1</th>
        <th>Coluna 2</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Dados</td>
        <td>Dados</td>
      </tr>
    </tbody>
  </table>
</div>
```

## Padrões de Código

### Controllers

```php
<?php
namespace IDS\Component\[ComponentName]\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
    protected $default_view = 'dashboard';

    public function display($cachable = false, $urlparams = []): BaseController
    {
        return parent::display($cachable, $urlparams);
    }
}
```

### Models

```php
<?php
namespace IDS\Component\[ComponentName]\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;

class ItemsModel extends ListModel
{
    protected function getListQuery()
    {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('*')
              ->from($db->quoteName('#__[component]_items'));

        return $query;
    }
}
```

### Views

```php
<?php
namespace IDS\Component\[ComponentName]\Administrator\View\Items;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
    protected $items;
    protected $pagination;
    protected $state;

    public function display($tpl = null): void
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar(): void
    {
        ToolbarHelper::title('Gerenciar Items');
        ToolbarHelper::addNew('item.add');
        ToolbarHelper::editList('item.edit');
        ToolbarHelper::deleteList('', 'items.delete');
    }
}
```

## Manifest XML Padrão

### Estrutura Obrigatória

```xml
<?xml version="1.0" encoding="utf-8"?>
<extension type="component" method="upgrade">
    <name>COM_[COMPONENTNAME]</name>
    <creationDate>October 2025</creationDate>
    <author>Sgt Souza Lima</author>
    <authorEmail>lucas.lima.rk@gmail.com</authorEmail>
    <authorUrl>https://astatonn.com</authorUrl>
    <copyright>Copyright (C) 2025 Todos os direitos reservados.</copyright>
    <license>GNU General Public License version 2 or later</license>
    <version>2.0.0</version>
    <description>COM_[COMPONENTNAME]_XML_DESCRIPTION</description>

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

    <!-- Arquivos de desinstalação -->
    <uninstall>
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>

    <!-- Arquivos administrativos -->
    <administration>
        <menu>COM_[COMPONENTNAME]</menu>
        <files folder="administrator">
            <folder>services</folder>
            <folder>src</folder>
            <folder>tmpl</folder>
            <folder>language</folder>
        </files>
        <languages folder="administrator/language">
            <language tag="en-GB">en-GB/com_[componentname].ini</language>
            <language tag="en-GB">en-GB/com_[componentname].sys.ini</language>
            <language tag="pt-BR">pt-BR/com_[componentname].ini</language>
            <language tag="pt-BR">pt-BR/com_[componentname].sys.ini</language>
        </languages>
    </administration>

    <!-- Arquivos do site -->
    <files folder="components/com_[componentname]">
        <folder>src</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>

    <!-- Servidor de atualizações -->
    <updateservers>
        <server type="extension" priority="1" name="[ComponentName] Updates">
            https://raw.githubusercontent.com/astatonn/ids-joomla-eb/master/updates/com_[componentname]-updates.xml
        </server>
    </updateservers>
</extension>
```

## Requisitos de Qualidade

### Segurança

- **Sempre** use prepared statements com ParameterType
- **Sempre** valide e sanitize inputs
- **Sempre** implemente CSRF protection
- **Sempre** use JAccess para controle de permissões

### Performance

- **Sempre** implemente paginação em listas
- **Sempre** use cache quando apropriado
- **Sempre** otimize queries SQL
- **Sempre** minimize chamadas ao banco

### Acessibilidade (GovBR)

- **Sempre** implemente ARIA labels
- **Sempre** garanta navegação por teclado
- **Sempre** use contraste adequado (WCAG 2.1 AA)
- **Sempre** implemente skip links

## Idiomas Obrigatórios

### Arquivos de Idioma

- **pt-BR**: Idioma principal (brasileiro)
- **en-GB**: Idioma secundário (inglês britânico)

### Constantes Padrão

```ini
; Constantes obrigatórias
COM_[COMPONENTNAME]="Nome do Componente"
COM_[COMPONENTNAME]_DESCRIPTION="Descrição do componente"
COM_[COMPONENTNAME]_MENU="Menu Principal"
COM_[COMPONENTNAME]_SUBMENU_ITEMS="Gerenciar Items"

; Ações padrão
COM_[COMPONENTNAME]_NEW="Novo"
COM_[COMPONENTNAME]_EDIT="Editar"
COM_[COMPONENTNAME]_DELETE="Excluir"
COM_[COMPONENTNAME]_SAVE="Salvar"
COM_[COMPONENTNAME]_CANCEL="Cancelar"

; Mensagens
COM_[COMPONENTNAME]_SUCCESS_SAVE="Item salvo com sucesso"
COM_[COMPONENTNAME]_SUCCESS_DELETE="Item excluído com sucesso"
COM_[COMPONENTNAME]_ERROR_SAVE="Erro ao salvar item"
```

## Checklist de Desenvolvimento

### Antes de Começar

- [ ] Definir namespace seguindo padrão IDS
- [ ] Criar estrutura de pastas moderna
- [ ] Implementar Service Provider
- [ ] Configurar Extension Component

### Durante o Desenvolvimento

- [ ] Usar classes CSS do GovBR Design System
- [ ] Implementar responsividade
- [ ] Seguir padrões de segurança
- [ ] Criar arquivos de idioma pt-BR e en-GB
- [ ] Implementar validação de dados

### Antes de Finalizar

- [ ] Testar em Joomla 5.4+ e 6.x
- [ ] Validar acessibilidade
- [ ] Verificar performance
- [ ] Criar XML de atualizações
- [ ] Documentar funcionalidades

## Referências

- **Joomla 5+ MVC**: https://docs.joomla.org/J4.x:Developing_an_MVC_Component/Introduction
- **GovBR Design System**: https://www.gov.br/ds/home
- **Namespace Joomla**: https://docs.joomla.org/J4.x:Setting_Up_Your_Local_Environment
- **Service Provider**: https://docs.joomla.org/J4.x:Dependency_Injection_in_Joomla_4
