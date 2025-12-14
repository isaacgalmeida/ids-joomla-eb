<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var \IDS\Component\Servicos\Site\View\Servico\HtmlView $this */

$item = $this->item;
$currentUrl = Uri::getInstance()->toString();
$shareUrl = urlencode($currentUrl);
$shareTitle = urlencode($item->titulo);
?>

<div class="servico-detalhes">
  <div class="container-lg">
    <!-- Breadcrumb -->
    <nav class="br-breadcrumb" aria-label="Breadcrumbs">
      <ol class="crumb-list" role="list">
        <li class="crumb home">
          <a class="br-button circle" href="<?php echo Uri::root(); ?>">
            <span class="sr-only">Página inicial</span>
            <i class="fas fa-home"></i>
          </a>
        </li>
        <li class="crumb">
          <i class="icon fas fa-chevron-right"></i>
          <a href="<?php echo Uri::root(); ?>">Serviços</a>
        </li>
        <li class="crumb" data-active="active">
          <i class="icon fas fa-chevron-right"></i>
          <span><?php echo $this->escape($item->titulo); ?></span>
        </li>
      </ol>
    </nav>

    <div class="row">
      <div class="col-lg-8">
        <!-- Service Header -->
        <header class="servico-header mb-4">
          <h1 class="servico-titulo"><?php echo $this->escape($item->titulo); ?></h1>

          <div class="servico-meta d-flex flex-wrap align-items-center mb-3">
            <?php if ($item->categoria) : ?>
              <span class="br-tag primary mr-2 mb-2">
                <?php echo $this->escape($item->categoria); ?>
              </span>
            <?php endif; ?>

            <?php if ($item->data_modificacao) : ?>
              <span class="text-muted small">
                <i class="fas fa-clock mr-1" aria-hidden="true"></i>
                Última atualização: <?php echo HTMLHelper::_('date', $item->data_modificacao, 'd/m/Y'); ?>
              </span>
            <?php endif; ?>
          </div>

          <!-- Share and Print Links -->
          <div class="servico-actions mb-4">
            <div class="br-list horizontal">
              <div class="col-auto">
                <button class="br-button secondary small" onclick="window.print()">
                  <i class="fas fa-print mr-1" aria-hidden="true"></i>
                  Imprimir
                </button>
              </div>
              <div class="col-auto">
                <div class="br-dropdown">
                  <button class="br-button secondary small" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-share-alt mr-1" aria-hidden="true"></i>
                    Compartilhar
                  </button>
                  <div class="br-list">
                    <a class="br-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareUrl; ?>" target="_blank" rel="noopener">
                      <i class="fab fa-facebook-f mr-2" aria-hidden="true"></i>
                      Facebook
                    </a>
                    <a class="br-item" href="https://twitter.com/intent/tweet?url=<?php echo $shareUrl; ?>&text=<?php echo $shareTitle; ?>" target="_blank" rel="noopener">
                      <i class="fab fa-twitter mr-2" aria-hidden="true"></i>
                      Twitter
                    </a>
                    <a class="br-item" href="https://wa.me/?text=<?php echo $shareTitle; ?>%20<?php echo $shareUrl; ?>" target="_blank" rel="noopener">
                      <i class="fab fa-whatsapp mr-2" aria-hidden="true"></i>
                      WhatsApp
                    </a>
                    <button class="br-item" onclick="copyToClipboard('<?php echo $currentUrl; ?>')">
                      <i class="fas fa-link mr-2" aria-hidden="true"></i>
                      Copiar link
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>

        <!-- Service Content -->
        <div class="servico-conteudo">
          <?php if ($item->o_que_e) : ?>
            <section class="mb-5">
              <h2 class="h4 mb-3">
                <i class="fas fa-info-circle text-primary-default mr-2" aria-hidden="true"></i>
                O que é?
              </h2>
              <div class="br-card">
                <div class="card-content">
                  <?php echo $item->o_que_e; ?>
                </div>
              </div>
            </section>
          <?php endif; ?>

          <?php if ($item->quem_pode_utilizar) : ?>
            <section class="mb-5">
              <h2 class="h4 mb-3">
                <i class="fas fa-users text-primary-default mr-2" aria-hidden="true"></i>
                Quem pode utilizar este serviço?
              </h2>
              <div class="br-card">
                <div class="card-content">
                  <?php echo $item->quem_pode_utilizar; ?>
                </div>
              </div>
            </section>
          <?php endif; ?>

          <?php if ($item->etapas) : ?>
            <section class="mb-5">
              <h2 class="h4 mb-3">
                <i class="fas fa-list-ol text-primary-default mr-2" aria-hidden="true"></i>
                Etapas para a realização deste serviço
              </h2>
              <div class="br-card">
                <div class="card-content">
                  <?php echo $item->etapas; ?>
                </div>
              </div>
            </section>
          <?php endif; ?>

          <?php if ($item->outras_informacoes) : ?>
            <section class="mb-5">
              <h2 class="h4 mb-3">
                <i class="fas fa-exclamation-triangle text-primary-default mr-2" aria-hidden="true"></i>
                Outras Informações
              </h2>
              <div class="br-card">
                <div class="card-content">
                  <?php echo $item->outras_informacoes; ?>
                </div>
              </div>
            </section>
          <?php endif; ?>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <aside class="servico-sidebar">
          <!-- Tags -->
          <?php if ($item->tags) : ?>
            <div class="br-card mb-4">
              <div class="card-header">
                <h3 class="card-title h5">
                  <i class="fas fa-tags mr-2" aria-hidden="true"></i>
                  Tags relacionadas
                </h3>
              </div>
              <div class="card-content">
                <div class="tag-list">
                  <?php
                  $tags = explode(',', $item->tags);
                  foreach ($tags as $tag) :
                    $tag = trim($tag);
                    if ($tag) :
                  ?>
                      <span class="br-tag secondary mr-1 mb-1"><?php echo $this->escape($tag); ?></span>
                  <?php
                    endif;
                  endforeach;
                  ?>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <!-- Service Stats -->
          <div class="br-card mb-4">
            <div class="card-header">
              <h3 class="card-title h5">
                <i class="fas fa-chart-bar mr-2" aria-hidden="true"></i>
                Estatísticas
              </h3>
            </div>
            <div class="card-content">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Acessos:</span>
                <span class="badge bg-primary"><?php echo number_format($item->acessos); ?></span>
              </div>
              <?php if ($item->data_criacao) : ?>
                <div class="d-flex justify-content-between align-items-center">
                  <span>Criado em:</span>
                  <span class="text-muted small"><?php echo HTMLHelper::_('date', $item->data_criacao, 'd/m/Y'); ?></span>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Help Card -->
          <div class="br-card">
            <div class="card-header">
              <h3 class="card-title h5">
                <i class="fas fa-question-circle mr-2" aria-hidden="true"></i>
                Precisa de ajuda?
              </h3>
            </div>
            <div class="card-content">
              <p class="small text-muted mb-3">
                Se você não encontrou o que procurava ou tem dúvidas sobre este serviço, entre em contato conosco.
              </p>
              <a href="#" class="br-button primary small block">
                <i class="fas fa-envelope mr-1" aria-hidden="true"></i>
                Fale conosco
              </a>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</div>

<script>
  function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
      // Show success message using GovBR message component
      const message = document.createElement('div');
      message.className = 'br-message success';
      message.innerHTML = `
            <div class="icon">
                <i class="fas fa-check-circle" aria-hidden="true"></i>
            </div>
            <div class="content">
                <span class="message-title">Link copiado!</span>
                <span class="message-body">O link foi copiado para a área de transferência.</span>
            </div>
        `;

      document.body.appendChild(message);

      // Remove message after 3 seconds
      setTimeout(function() {
        document.body.removeChild(message);
      }, 3000);
    }).catch(function(err) {
      console.error('Erro ao copiar link: ', err);
    });
  }
</script>