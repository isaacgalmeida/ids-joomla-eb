# Guia de Migração para IDS Joomla EB 2.0

## 📋 Visão Geral

Este documento fornece instruções detalhadas para migrar do IDS Joomla EB 1.x para 2.0, que adiciona suporte completo ao Joomla 6.x.

## 🎯 Mudanças Principais

### Versão 2.0.0
- ✅ Compatibilidade com Joomla 5.4+ e 6.x
- ✅ Requisito mínimo: PHP 8.3.0
- ✅ Sistema de atualizações automáticas
- ✅ Versionamento semântico implementado
- ✅ Todos os manifestos XML atualizados

## 📌 Requisitos

### Antes da Migração

| Item | Versão 1.x | Versão 2.0 |
|------|-----------|-----------|
| **PHP** | 7.4.0+ | **8.3.0+** |
| **Joomla** | 4.0+ | **5.4+** ou **6.x** |
| **MySQL** | 5.6+ | 5.7+ ou 8.0+ |

### ⚠️ Importante

- Se você está no **Joomla 4.x**, atualize primeiro para **Joomla 5.4** antes de instalar esta versão
- Certifique-se de que seu servidor atende aos requisitos de **PHP 8.3+**

## 🚀 Processo de Migração

### Opção 1: Atualização Automática (Recomendado)

Se você já tem a versão 1.0 instalada:

1. **Acesse o Joomla Update System**
   ```
   Sistema → Atualizar → Extensões
   ```

2. **Verifique Atualizações**
   - Clique em "Verificar Atualizações"
   - O sistema detectará automaticamente a versão 2.0.0

3. **Revise o Changelog**
   - Leia as mudanças antes de atualizar
   - Verifique os requisitos mínimos

4. **Execute a Atualização**
   - Clique em "Atualizar"
   - Aguarde a conclusão do processo

### Opção 2: Instalação Manual

Se você não tem a versão 1.0 ou prefere instalação manual:

1. **Faça Backup**
   ```bash
   # Backup do banco de dados
   mysqldump -u usuario -p nome_bd > backup_joomla.sql

   # Backup dos arquivos
   tar -czf backup_joomla_files.tar.gz /caminho/para/joomla/
   ```

2. **Baixe o Pacote**
   - Acesse: https://github.com/astatonn/ids-joomla-eb/releases/tag/v2.0.0
   - Baixe: `pkg_ids_joomla_eb.zip`

3. **Instale via Joomla**
   ```
   Sistema → Instalar → Extensões
   ```
   - Arraste o arquivo ZIP ou navegue até ele
   - Clique em "Upload e Instalar"

4. **Verifique a Instalação**
   - Acesse: `Sistema → Gerenciar → Extensões`
   - Procure por "IDS Joomla EB Package"
   - Versão deve mostrar: **2.0.0**

## 🔧 Configurações Pós-Migração

### 1. Ativar Plugin de Compatibilidade (Joomla 6 apenas)

Se você está usando Joomla 6:

```
Sistema → Plugins → Buscar: "Backward Compatibility"
```

- Ative: **Behaviour - Backward Compatibility 6**
- Isso garante compatibilidade total com extensões de Joomla 5

### 2. Verificar Template

```
Sistema → Gerenciar → Templates de Site
```

- Verifique se "IDS Gov - Exército Brasileiro" está listado
- Versão deve mostrar: **2.0.0**
- Configure conforme necessário

### 3. Verificar Componentes

```
Sistema → Gerenciar → Extensões → Componentes
```

Verifique se estão atualizados:
- ✅ Aniversariantes - v2.0.0
- ✅ PagTesouro - v2.0.0

### 4. Verificar Módulos

```
Sistema → Gerenciar → Extensões → Módulos
```

Todos devem estar na versão **2.0.0**:
- ✅ Seção de Aniversariantes (mod_aniver)
- ✅ Popup de Imagem (mod_imagempopup)
- ✅ Feed Instagram (mod_instafeed)
- ✅ Seção de Links (mod_links)
- ✅ Botão Leia Mais (mod_readmorenews)
- ✅ Carrossel de Vídeos (mod_videosiframe)

## 📊 Versionamento Semântico

O projeto agora segue [Semantic Versioning](https://semver.org/):

```
MAJOR.MINOR.PATCH
2.0.0
```

- **MAJOR** (2): Mudanças incompatíveis (PHP 8.3, Joomla 5.4+)
- **MINOR** (0): Novas funcionalidades compatíveis
- **PATCH** (0): Correções de bugs

## 🔄 Sistema de Atualizações Automáticas

### Como Funciona

1. **Verificação Automática**: Joomla verifica atualizações periodicamente
2. **Notificação**: Você será notificado quando houver atualizações
3. **Um Clique**: Atualize com um único clique
4. **Changelog**: Veja o que mudou antes de atualizar

### Verificar Manualmente

```
Sistema → Atualizar → Extensões → Verificar Atualizações
```

### Servidores de Atualização

Todas as extensões apontam para:
```
https://raw.githubusercontent.com/astatonn/ids-joomla-eb/master/updates/
```

- `ids-joomla-eb-updates.xml` - Pacote principal
- `template-govbr-updates.xml` - Template
- `com_aniversariantes-updates.xml` - Componente Aniversariantes
- `com_pagtesouro-updates.xml` - Componente PagTesouro
- `mod_*-updates.xml` - Módulos individuais

## ⚠️ Problemas Conhecidos

### Componente PagTesouro (com_pagtesouro)

**Estrutura Legacy detectada**

O componente `com_pagtesouro` usa a estrutura antiga do Joomla 3:
- Não usa namespace moderno
- Usa MVC legado (controller.php, models/, views/)

**Status:**
- ✅ Funciona corretamente no Joomla 6
- ⚠️ Recomenda-se refatoração futura

**Próximos Passos:**
- Versão 3.0 incluirá refatoração completa
- Migração para estrutura namespace
- Implementação de Service Provider

## 🐛 Solução de Problemas

### Erro: "Versão do PHP incompatível"

**Problema:** Seu servidor não tem PHP 8.3+

**Solução:**
```bash
# Verificar versão atual
php -v

# Se < 8.3, atualize o PHP no servidor
# Consulte seu provedor de hospedagem
```

### Erro: "Joomla version not compatible"

**Problema:** Você está em Joomla 4.x tentando instalar v2.0

**Solução:**
1. Atualize para Joomla 5.4 primeiro
2. Depois instale IDS Joomla EB 2.0

### Atualizações não aparecem

**Problema:** Sistema não detecta atualizações

**Solução:**
```
Sistema → Cache → Limpar Cache
Sistema → Atualizar → Extensões → Limpar Cache
Sistema → Atualizar → Extensões → Verificar Atualizações
```

### Template não aparece após atualização

**Problema:** Template sumiu após update

**Solução:**
```
Sistema → Descobrir → Descobrir
```
Selecione o template e clique em "Instalar"

## 📚 Recursos Adicionais

- **Repositório GitHub**: https://github.com/astatonn/ids-joomla-eb
- **Issues**: https://github.com/astatonn/ids-joomla-eb/issues
- **Releases**: https://github.com/astatonn/ids-joomla-eb/releases
- **Changelog**: [CHANGELOG.md](CHANGELOG.md)

## 🆘 Suporte

### Antes de Reportar

1. ✅ Verificou os requisitos mínimos?
2. ✅ Limpou o cache?
3. ✅ Ativou o plugin de compatibilidade (Joomla 6)?
4. ✅ Verificou o CHANGELOG.md?

### Reportar Problemas

Crie uma issue no GitHub:
```
https://github.com/astatonn/ids-joomla-eb/issues/new
```

Inclua:
- Versão do Joomla
- Versão do PHP
- Versão do IDS Joomla EB
- Descrição do problema
- Passos para reproduzir
- Screenshots (se aplicável)

## ✅ Checklist de Migração

Após a migração, confirme:

- [ ] PHP 8.3+ instalado
- [ ] Joomla 5.4+ ou 6.x rodando
- [ ] Backup realizado
- [ ] IDS Joomla EB 2.0.0 instalado
- [ ] Template versão 2.0.0
- [ ] Componentes versão 2.0.0
- [ ] Módulos versão 2.0.0
- [ ] Plugin de compatibilidade ativo (Joomla 6)
- [ ] Site testado e funcionando
- [ ] Sistema de atualizações verificado

## 🎉 Pronto!

Você completou a migração com sucesso! Seu site agora está pronto para o futuro com Joomla 6 e receberá atualizações automáticas.

---

**Última atualização:** 27 de Outubro de 2025
**Versão do documento:** 1.0
**Aplica-se a:** IDS Joomla EB 2.0.0
