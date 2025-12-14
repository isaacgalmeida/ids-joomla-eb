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
use Joomla\CMS\Router\Route;

/** @var \IDS\Component\Servicos\Site\View\Servicos\HtmlView $this */

// Load GovBR Design System CSS (assumindo que está carregado no template)
$wa = $this->document->getWebAssetManager();
?>

<div class="servicos-para-voce">
  <div class="container-lg">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center mb-5">Serviços para você</h2>
      </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="br-tab" data-counter="true" data-panel="true">
      <nav class="tab-nav">
        <ul>
          <li class="tab-item">
            <button class="tab-btn active" type="button" data-panel="recomendados">
              <i class="fas fa-thumbs-up" aria-hidden="true"></i>
              <span class="tab-label">Recomendados</span>
            </button>
          </li>
          <li class="tab-item">
            <button class="tab-btn" type="button" data-panel="mais-acessados">
              <i class="fas fa-fire" aria-hidden="true"></i>
              <span class="tab-label">Mais Acessados</span>
            </button>
          </li>
          <li class="tab-item">
            <button class="tab-btn" type="button" data-panel="destaque">
              <i class="fas fa-star" aria-hidden="true"></i>
              <span class="tab-label">Destaque</span>
            </button>
          </li>
        </ul>
      </nav>

      <!-- Tab Panels -->
      <div class="tab-content">
        <!-- Recomendados -->
        <div class="tab-panel active" id="recomendados">
          <div class="row">
            <?php if (!empty($this->servicosPorTipo['recomendados'])) : ?>
              <?php foreach ($this->servicosPorTipo['recomendados'] as $servico) : ?>
                <div class="col-sm-6 col-lg-4 mb-4">
                  <div class="br-card">
                    <div class="card-header">
                      <div class="d-flex">
                        <div class="mr-3">
                          <i class="fas fa-file-alt fa-2x text-primary-default" aria-hidden="true"></i>
                        </div>
                        <div class="ml-3">
                          <h5 class="card-title">
                            <a href="<?php echo Route::_('index.php?option=com_servicos&view=servico&id=' . $servico->id . ':' . $servico->alias); ?>" class="text-decoration-none">
                              <?php echo $this->escape($servico->titulo); ?>
                            </a>
                          </h5>
                          <?php if ($servico->categoria) : ?>
                            <p class="card-info text-muted small">
                              <?php echo $this->escape($servico->categoria); ?>
                            </p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="col-12">
                <div class="br-message info">
                  <div class="icon">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                  </div>
                  <div class="content">
                    <span class="message-title">Nenhum serviço recomendado encontrado</span>
                    <span class="message-body">Não há serviços marcados como recomendados no momento.</span>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Mais Acessados -->
        <div class="tab-panel" id="mais-acessados">
          <div class="row">
            <?php if (!empty($this->servicosPorTipo['mais_acessados'])) : ?>
              <?php foreach ($this->servicosPorTipo['mais_acessados'] as $servico) : ?>
                <div class="col-sm-6 col-lg-4 mb-4">
                  <div class="br-card">
                    <div class="card-header">
                      <div class="d-flex">
                        <div class="mr-3">
                          <i class="fas fa-file-alt fa-2x text-primary-default" aria-hidden="true"></i>
                        </div>
                        <div class="ml-3">
                          <h5 class="card-title">
                            <a href="<?php echo Route::_('index.php?option=com_servicos&view=servico&id=' . $servico->id . ':' . $servico->alias); ?>" class="text-decoration-none">
                              <?php echo $this->escape($servico->titulo); ?>
                            </a>
                          </h5>
                          <?php if ($servico->categoria) : ?>
                            <p class="card-info text-muted small">
                              <?php echo $this->escape($servico->categoria); ?>
                            </p>
                          <?php endif; ?>
                          <div class="d-flex align-items-center mt-2">
                            <i class="fas fa-eye text-muted mr-1" aria-hidden="true"></i>
                            <span class="text-muted small"><?php echo number_format($servico->acessos); ?> acessos</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="col-12">
                <div class="br-message info">
                  <div class="icon">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                  </div>
                  <div class="content">
                    <span class="message-title">Nenhum serviço mais acessado encontrado</span>
                    <span class="message-body">Não há serviços marcados como mais acessados no momento.</span>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Destaque -->
        <div class="tab-panel" id="destaque">
          <div class="row">
            <?php if (!empty($this->servicosPorTipo['destaque'])) : ?>
              <?php foreach ($this->servicosPorTipo['destaque'] as $servico) : ?>
                <div class="col-sm-6 col-lg-4 mb-4">
                  <div class="br-card">
                    <div class="card-header">
                      <div class="d-flex">
                        <div class="mr-3">
                          <i class="fas fa-file-alt fa-2x text-primary-default" aria-hidden="true"></i>
                        </div>
                        <div class="ml-3">
                          <h5 class="card-title">
                            <a href="<?php echo Route::_('index.php?option=com_servicos&view=servico&id=' . $servico->id . ':' . $servico->alias); ?>" class="text-decoration-none">
                              <?php echo $this->escape($servico->titulo); ?>
                            </a>
                          </h5>
                          <?php if ($servico->categoria) : ?>
                            <p class="card-info text-muted small">
                              <?php echo $this->escape($servico->categoria); ?>
                            </p>
                          <?php endif; ?>
                          <div class="mt-2">
                            <span class="br-tag info small">
                              <i class="fas fa-star mr-1" aria-hidden="true"></i>
                              Novo
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="col-12">
                <div class="br-message info">
                  <div class="icon">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                  </div>
                  <div class="content">
                    <span class="message-title">Nenhum serviço em destaque encontrado</span>
                    <span class="message-body">Não há serviços marcados como destaque no momento.</span>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Simple tab functionality following GovBR DS patterns
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach(button => {
      button.addEventListener('click', function() {
        const targetPanel = this.getAttribute('data-panel');

        // Remove active class from all buttons and panels
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabPanels.forEach(panel => panel.classList.remove('active'));

        // Add active class to clicked button and corresponding panel
        this.classList.add('active');
        document.getElementById(targetPanel).classList.add('active');
      });
    });
  });
</script>