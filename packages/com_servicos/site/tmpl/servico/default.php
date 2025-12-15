<?php
defined('_JEXEC') or die;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
?>
<style>
    .br-accordion .item:not([active]) .content {
        display: none !important;
    }

    /* Hide native summary marker */
    .br-accordion details.item > summary {
        list-style: none;
    }
    .br-accordion details.item > summary::-webkit-details-marker {
        display: none;
    }

    /* Target open state for rotation */
    .br-accordion details.item[open] .header .icon {
        transform: rotate(180deg) !important;
    }

    /* Ensure content is visible when open (overriding any potential display:none) */
    .br-accordion details.item[open] .content {
        display: block !important;
    }

    /* Ensure styles match GovBR DS for the header */
    .br-accordion .item .header {
        display: flex; /* Ensure it stays flex as summary might default to list-item */
        align-items: center;
        width: 100%;
        border: none;
        background: none;
        padding: 1rem;
        cursor: pointer;
        text-align: left;
        outline: none; /* Focus ring handled by theme or browser */
    }

    .br-accordion .item .header .icon {
        margin-right: 1rem;
        transition: transform 0.3s;
    }
</style>
<div class="container-lg my-5">
    <div class="row">
        <div class="col-12">
            <div class="br-breadcrumb">
                <ul class="crumb-list">
                    <li class="crumb home"><a href="<?php echo \Joomla\CMS\Uri\Uri::root(); ?>"><i
                                class="fas fa-home"></i><span>Início</span></a></li>
                    <li class="crumb"><i class="fas fa-chevron-right"></i><span>Serviços</span></li>
                    <li class="crumb"><i
                            class="fas fa-chevron-right"></i><span><?php echo $this->escape($this->item->title); ?></span>
                    </li>
                </ul>
            </div>

            <div class="main-content mt-4" id="main-content">
                <h1 class="document-title font-weight-bold text-primary-default">
                    <?php echo $this->escape($this->item->title); ?>
                </h1>
                <span class="text-muted d-block mb-3">Última atualização:
                    <?php echo \Joomla\CMS\HTML\HTMLHelper::_('date', $this->item->modified, 'd/m/Y H:i'); ?></span>

                <div class="d-flex justify-content-between border-top border-bottom py-3 mb-4">
                    <div>
                        <span class="mr-2 font-weight-semi-bold">Compartilhe:</span>
                        <button class="br-button circle small secondary" aria-label="Facebook"><i
                                class="fab fa-facebook-f"></i></button>
                        <button class="br-button circle small secondary" aria-label="Twitter"><i
                                class="fab fa-twitter"></i></button>
                    </div>
                    <button class="br-button small secondary" onclick="window.print()"><i class="fas fa-print mr-1"></i>
                        Imprimir</button>
                </div>

                <div class="br-accordion" id="accordion-servico">

                    <?php if ($this->item->introtext): ?>
                        <details class="item" open>
                            <summary class="header">
                                <span class="icon"><i class="fas fa-info-circle"></i></span>
                                <span class="title">O que é?</span>
                            </summary>
                            <div class="content">
                                <div class="front-padding">
                                    <?php echo $this->item->introtext; ?>
                                </div>
                            </div>
                        </details>
                    <?php endif; ?>

                    <?php if ($this->item->target_audience): ?>
                        <details class="item">
                            <summary class="header">
                                <span class="icon"><i class="fas fa-users"></i></span>
                                <span class="title">Quem pode utilizar?</span>
                            </summary>
                            <div class="content">
                                <div class="front-padding">
                                    <div class="br-list"><?php echo $this->item->target_audience; ?></div>
                                </div>
                            </div>
                        </details>
                    <?php endif; ?>

                    <?php if ($this->item->steps): ?>
                        <details class="item">
                            <summary class="header">
                                <span class="icon"><i class="fas fa-list-ol"></i></span>
                                <span class="title">Etapas</span>
                            </summary>
                            <div class="content">
                                <div class="front-padding">
                                    <div class="br-list"><?php echo $this->item->steps; ?></div>
                                </div>
                            </div>
                        </details>
                    <?php endif; ?>

                </div>

                <?php if (!empty($this->item->tags->itemTags)): ?>
                    <div class="mt-5">
                        <span class="font-weight-bold mr-2">Tags:</span>
                        <?php foreach ($this->item->tags->itemTags as $tag): ?>
                            <span class="br-tag interaction me-2"><i
                                    class="fas fa-tag"></i><span><?php echo $tag->title; ?></span></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure chevrons exist (using browser native behavior, but visual icon is ours)
         const details = document.querySelectorAll('.br-accordion details.item');
         details.forEach(detail => {
            const summary = detail.querySelector('summary');
            let chevron = summary.querySelector('.fa-chevron-down, .fa-chevron-up');
            if (!chevron) {
                chevron = document.createElement('i');
                chevron.classList.add('fas', 'fa-chevron-down', 'ml-auto');
                chevron.setAttribute('aria-hidden', 'true');
                summary.appendChild(chevron);
            }
         });
    });
</script>