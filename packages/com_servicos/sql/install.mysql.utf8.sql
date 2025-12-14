CREATE TABLE IF NOT EXISTS `#__servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `o_que_e` text,
  `quem_pode_utilizar` text,
  `etapas` text,
  `outras_informacoes` text,
  `tags` text,
  `categoria` varchar(100) DEFAULT NULL,
  `tipo_destaque` enum('recomendado','mais_acessado','destaque') DEFAULT NULL,
  `acessos` int(11) DEFAULT 0,
  `data_modificacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publicado` tinyint(1) NOT NULL DEFAULT 1,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `checked_out` int(11) unsigned,
  `checked_out_time` datetime,
  `created_by` int(11) unsigned NOT NULL DEFAULT 0,
  `modified_by` int(11) unsigned NOT NULL DEFAULT 0,
  `params` text,
  PRIMARY KEY (`id`),
  KEY `idx_alias` (`alias`(191)),
  KEY `idx_publicado` (`publicado`),
  KEY `idx_tipo_destaque` (`tipo_destaque`),
  KEY `idx_categoria` (`categoria`),
  KEY `idx_acessos` (`acessos`),
  KEY `idx_created_by` (`created_by`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

-- Inserir dados de exemplo
INSERT INTO `#__servicos` (`titulo`, `alias`, `o_que_e`, `quem_pode_utilizar`, `etapas`, `outras_informacoes`, `tags`, `categoria`, `tipo_destaque`, `acessos`, `publicado`) VALUES
('Protocolar documentos junto ao Ministério da Gestão', 'protocolar-documentos-ministerio-gestao', 'Serviço para protocolar documentos oficiais junto ao Ministério da Gestão e da Inovação em Serviços Públicos.', 'Cidadãos, empresas e órgãos públicos que necessitem protocolar documentos oficiais.', '1. Acesse o sistema de protocolo\n2. Faça login com suas credenciais\n3. Selecione o tipo de documento\n4. Anexe os arquivos necessários\n5. Confirme o protocolo', 'Documentos devem estar em formato PDF. Tamanho máximo de 10MB por arquivo.', 'protocolo,documentos,ministério,gestão', 'Trabalho, Emprego e Previdência', 'recomendado', 1250, 1),
('Consultar Meu Imposto de Renda', 'consultar-imposto-renda', 'Consulte informações sobre sua declaração de Imposto de Renda e situação fiscal.', 'Contribuintes pessoa física e jurídica.', '1. Acesse o Portal e-CAC\n2. Faça login com certificado digital ou código de acesso\n3. Selecione "Meu Imposto de Renda"\n4. Consulte as informações desejadas', 'Serviço disponível 24 horas por dia. Necessário certificado digital ou código de acesso.', 'imposto,renda,receita,declaração', 'Justiça e Segurança', 'mais_acessado', 3450, 1),
('Cadastrar Cães e Gatos (SinPatinhas)', 'cadastrar-caes-gatos-sinpatinhas', 'Sistema nacional para cadastro e identificação de cães e gatos domésticos.', 'Proprietários de cães e gatos em todo território nacional.', '1. Acesse o sistema SinPatinhas\n2. Crie sua conta de usuário\n3. Cadastre seu pet com foto e dados\n4. Agende a aplicação do microchip\n5. Receba o certificado de cadastro', 'Serviço gratuito. Microchip aplicado por veterinário credenciado.', 'pets,cães,gatos,cadastro,microchip', 'Meio Ambiente e Clima', 'destaque', 890, 1);