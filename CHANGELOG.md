# Changelog

Todas as mudanças notáveis neste projeto serão documentadas neste arquivo.

O formato é baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/),
e este projeto adere ao [Versionamento Semântico](https://semver.org/lang/pt-BR/).

## [3.0.0] - 2025-10-27

### 🎉 Lançamento - Refatoração Completa do com_pagtesouro

Esta versão marca a refatoração completa do componente PagTesouro para arquitetura moderna do Joomla 6.

### ✨ Adicionado

- **Componente PagTesouro 3.0** - Arquitetura moderna:
  - Namespace: `IDS\Component\PagTesouro`
  - Service Provider implementado (services/provider.php)
  - Extension Component (Extension/PagTesouroComponent.php)
  - Estrutura src/ moderna para todas as classes

- **MVC Moderno**:
  - Controllers com tipagem forte
  - Models com prepared statements e ParameterType
  - Views HtmlView separadas por contexto
  - Tables com validação robusta

- **Segurança e Performance**:
  - Tipagem forte em todos os métodos
  - Prepared statements em todas as queries
  - Proteção contra SQL Injection
  - Código otimizado para PHP 8.3+

### 🔄 Alterado

- **Componente PagTesouro (com_pagtesouro)**:
  - Versão: 2.0.0 → **3.0.0** (BREAKING CHANGES)
  - Migração de estrutura legacy para moderna
  - Namespace: nenhum → `IDS\Component\PagTesouro`
  - Structure: admin/ e site/ → administrator/src/ e components/src/
  - Service Provider adicionado
  - Script de instalação atualizado com detecção de migração

### 🔧 Implementações Técnicas

**Service Provider (administrator/services/provider.php)**:
- CategoryFactory registrado
- MVCFactory registrado
- ComponentDispatcherFactory registrado
- RouterFactory registrado
- ComponentInterface configurado

**Extension Component**:
- BootableExtensionInterface implementado
- CategoryServiceInterface implementado
- Contextos definidos para uasg e servico

**Models Refatorados**:
- UasgsModel: List model com filtros e busca
- UasgModel: Admin model para edição
- ServicosModel: List model com join em UASGs
- ServicoModel: Admin model para edição

**Controllers Refatorados**:
- DisplayController: Controller principal
- UasgsController: Lista de UASGs
- UasgController: Edição de UASG
- ServicosController: Lista de Serviços
- ServicoController: Edição de Serviço

**Tables Refatorados**:
- UasgTable: Validação de órgão, UG e descrição
- ServicoTable: Validação de UASG, código e descrição

**Views Refatorados**:
- Uasgs/HtmlView: Lista com toolbar
- Uasg/HtmlView: Formulário de edição
- Servicos/HtmlView: Lista com toolbar e filtro
- Servico/HtmlView: Formulário de edição

### ⚠️ Breaking Changes

**Estrutura de Arquivos**:
- ❌ admin/pagtesouro.php (removido)
- ❌ admin/controller.php (removido)
- ❌ admin/helpers/ (removido)
- ❌ admin/tables/ (movido para src/Table/)
- ✅ administrator/services/provider.php (novo)
- ✅ administrator/src/ (nova estrutura)

**Namespace**:
- Classes antigas sem namespace não funcionam mais
- Todas as classes agora usam `IDS\Component\PagTesouro`

**Requisitos**:
- PHP: 7.4+ → **8.3+** (obrigatório)
- Joomla: 3.0+ → **5.4+** (obrigatório)

### 📝 Notas de Migração

**Migração Automática**:
- Dados do banco preservados (sem alteração nas tabelas)
- Estrutura de arquivos completamente substituída
- Script de instalação detecta versão antiga automaticamente

**Compatibilidade**:
- Banco de dados: 100% compatível (mesmas tabelas)
- API: Incompatível (nova estrutura MVC)
- Templates: Incompatível (novos paths)

## [2.0.0] - 2025-10-27

### 🎉 Lançamento Principal - Compatibilidade com Joomla 6.x

Esta versão marca uma atualização importante com compatibilidade total para Joomla 6.x.

### ✨ Adicionado

- **Sistema de Atualizações Automáticas**: Todas as extensões agora suportam atualizações automáticas via Joomla Update System
  - Servidor de atualizações centralizado no GitHub
  - XMLs de atualização individuais para cada extensão
  - Changelog integrado nas notificações de atualização

- **Suporte ao Joomla 6.x**:
  - Compatibilidade total com Joomla 6.0+
  - Suporte ao plugin "Behaviour - Backward Compatibility 6"
  - Manifests XML atualizados para o formato Joomla 6

- **Namespace Modernos**:
  - Template: `IDS\Template\GovBRDS`
  - Package: `IDS\Package\IDSJoomlaEB`
  - Componentes mantêm seus namespaces existentes

- **Arquivos de Idioma Completos**:
  - Suporte aprimorado para en-GB e pt-BR
  - Constantes de idioma para todas as mensagens do sistema

### 🔄 Alterado

- **Requisitos Mínimos Atualizados**:
  - PHP: 8.3.0+ (anteriormente 7.4.0)
  - Joomla: 5.4.0+ (anteriormente 4.0.0)
  - Compatibilidade: Joomla 5.4+ e 6.x

- **Template IDS Gov - Exército Brasileiro (novpadraoegov)**:
  - Versão atualizada: 1.3.3 → 2.0.0
  - Removido atributo `method="upgrade"` do manifest
  - Removido atributo `version="4.0"` do manifest
  - Descrição atualizada com informações sobre Joomla 6
  - Adicionado servidor de atualizações
  - Data de criação atualizada para Outubro 2025

- **Componente Aniversariantes (com_aniversariantes)**:
  - Versão atualizada: 1.0.0 → 2.0.0
  - Manifest simplificado para Joomla 6
  - Removido updateserver do Component Creator
  - Adicionado servidor de atualizações próprio
  - Adicionado changelogurl

- **Componente PagTesouro (com_pagtesouro)**:
  - Versão atualizada: 1.0.0 → 2.0.0
  - Manifest atualizado de `version="3.0"` para formato Joomla 6
  - Correção de duplicação de arquivos de idioma en-GB
  - Adicionado servidor de atualizações
  - Nota adicionada sobre estrutura legacy

- **Todos os Módulos** (6 módulos):
  - Versões atualizadas: 1.x.x → 2.0.0
  - Manifests simplificados (removido `method` e `version`)
  - Data de criação atualizada
  - Servidores de atualizações adicionados
  - Módulos afetados:
    - mod_aniver (Seção de Aniversariantes)
    - mod_imagempopup (Popup de Imagem)
    - mod_instafeed (Feed do Instagram)
    - mod_links (Seção de Links)
    - mod_readmorenews (Botão Leia Mais)
    - mod_videosiframe (Carrossel de Vídeos)

- **Pacote Principal (pkg_ids_joomla_eb)**:
  - Versão atualizada: 1.0.0 → 2.0.0
  - Manifest simplificado (removido atributo `version="4.0"`)
  - Namespace adicionado para estrutura moderna
  - Arquivos de idioma referenciados no manifest
  - Scriptfile declarado no manifest

- **Script de Instalação (script.php)**:
  - Requisito PHP mínimo: 7.4.0 → 8.3.0
  - Requisito Joomla mínimo: 4.0.0 → 5.4.0
  - Documentação atualizada nos comentários

- **Update Server XML**:
  - Targetplatform atualizado: `4.[0-9]` → `(5\.(4|5|6|7|8|9)|6\.[0-9]+)`
  - PHP_minimum: 7.4.0 → 8.3.0
  - Changelog completo adicionado
  - Entrada histórica para versão 1.0.0 mantida

### 🔧 Corrigido

- Correção de arquivo de idioma duplicado: `en-BG` → `en-GB`
- Correção de referências duplicadas no manifest do com_pagtesouro
- Padronização de nomes de autores em todas as extensões
- Consistência de copyright e licenças

### 📚 Documentação

- CHANGELOG.md criado seguindo Keep a Changelog
- README.md atualizado (assumindo atualização futura)
- Comentários aprimorados em arquivos de configuração

### 🛠️ Infraestrutura

- Sistema de build automatizado com scripts bash
- Processo de reempacotamento de extensões
- Estrutura de diretório `.work/extracted` para desenvolvimento
- Scripts de atualização em massa para módulos

### ⚠️ Notas de Migração

**Para usuários do Joomla 4.x:**
- Atualize primeiro para Joomla 5.4 antes de atualizar para esta versão
- Certifique-se de que seu servidor atende aos requisitos mínimos (PHP 8.3+)

**Para usuários do Joomla 5.x:**
- A atualização pode ser feita diretamente
- Habilite o plugin "Behaviour - Backward Compatibility 6" no Joomla 6

**Componente com_pagtesouro:**
- Este componente usa estrutura legacy (Joomla 3.x)
- Funciona com Joomla 6 mas recomenda-se refatoração futura
- Considere migração para estrutura namespace moderna

### 🔮 Próximos Passos

- Refatoração do com_pagtesouro para estrutura namespace moderna
- Testes extensivos em ambientes Joomla 6
- Implementação de testes automatizados
- Melhorias de acessibilidade contínuas

---

## [1.0.0] - 2025-04-XX

### Adicionado

- Lançamento inicial do pacote IDS Joomla EB
- Template IDS Gov baseado no Padrão Digital de Governo
- Componente Aniversariantes (com_aniversariantes)
- Componente PagTesouro (com_pagtesouro)
- 6 módulos customizados para sites governamentais
- Compatibilidade com Joomla 4.x
- Suporte para PHP 7.4+

---

## Tipos de Mudanças

- `✨ Adicionado` para novas funcionalidades
- `🔄 Alterado` para mudanças em funcionalidades existentes
- `❌ Depreciado` para funcionalidades que serão removidas
- `🗑️ Removido` para funcionalidades removidas
- `🔧 Corrigido` para correções de bugs
- `🔒 Segurança` para correções de vulnerabilidades

## Links de Comparação

- [2.0.0]: https://github.com/astatonn/ids-joomla-eb/compare/v1.0.0...v2.0.0
- [1.0.0]: https://github.com/astatonn/ids-joomla-eb/releases/tag/v1.0.0
