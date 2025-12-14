# Contexto do Projeto: Catálogo de Serviços (Joomla + GOV.BR)

Este arquivo documenta as implementações e decisões arquiteturais do projeto para referência futura.

## Componente: `com_servicos`
**Descrição:** Gerencia o catálogo de serviços públicos.

*   **Estrutura de Banco de Dados:**
    *   Tabela: `#__servicos_services`
    *   Campos Chave: `title`, `introtext`, `featured`, `hits`, `catid` (integração com `#__categories`).
*   **Categorias:**
    *   Utiliza a tabela nativa `#__categories` com `extension='com_servicos'`.
    *   **Script de Instalação (`script.php`):** Verifica e cria automaticamente as categorias padrão "Recomendados" e "Destaque" na instalação/atualização. O script deve residir na raiz do pacote.
    *   **Provider (`services/provider.php`):** Registra `CategoryFactory` para integração correta com o sistema de categorias do Joomla.
*   **Admin:**
    *   Lista de Serviços (`view=servicos`): Exibe colunas de Estado, Destaque, *Acessos (Hits)* e ID.
    *   Formulário (`forms/servico.xml`): Campo de categoria utiliza `extension="com_servicos"`.

## Módulo: `mod_servicos`
**Descrição:** Exibe cards de serviços ou categorias no frontend, seguindo o Design System GOV.BR (`br-card`).

*   **Configurações Importantes (`mod_servicos.xml`):**
    *   `mode`: Alterna entre exibir "Serviços" (lista de itens) ou "Categorias" (lista de categorias).
    *   `filter_type` (Modo Serviços):
        *   `featured`: Destaques.
        *   `latest`: Recentes.
        *   `hits`: Mais Acessados.
        *   `all`: Todos.
    *   `show_hits` (Modo Categorias): Adiciona um card virtual "Mais Acessados" à lista.
*   **Lógica (`ServicosHelper.php`):**
    *   **Modo Categorias:** Busca categorias de `#__categories` (extension=com_servicos) e adiciona o item virtual de Hits se ativado.
    *   **Modo Serviços:** Aplica filtros SQL baseados na configuração.
*   **Template (`tmpl/default.php`):**
    *   Renderiza o grid de cards usando classes `br-*`.
    *   Trata exibição opcional de introtext e ícones.

## Padrões Adotados (Antigravity Rules)
1.  **Instalação de Componentes:** 
    *   Arquivo `script.php` deve estar na raiz do pacote (`packages/com_example/script.php`).
    *   No manifesto, usar `<scriptfile>script.php</scriptfile>`.
    *   Não listar `script.php` dentro da tag `<files>` de `admin` ou `site` para evitar erro de cópia.
2.  **Multilanguage:** Sempre criar arquivos `pt-BR` e `en-GB`.
3.  **GOV.BR:** Priorizar uso de classes nativas do Design System (`br-card`, `br-button`, etc.) em vez de Bootstrap.
