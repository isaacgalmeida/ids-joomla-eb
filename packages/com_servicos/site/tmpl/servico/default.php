<?php
defined('_JEXEC') or die;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
?>
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
                        <div class="item active">
                            <button class="header" type="button" aria-controls="id-what" aria-expanded="true"
                                data-toggle="accordion" data-target="id-what" data-group="accordion-servico">
                                <span class="icon"><i class="fas fa-info-circle"></i></span>
                                <span class="title">O que é?</span>
                            </button>
                            <div class="content" id="id-what" aria-hidden="false">
                                <div class="front-padding">
                                    <?php echo $this->item->introtext; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->item->target_audience): ?>
                        <div class="item">
                            <button class="header" type="button" aria-controls="id-who" aria-expanded="false"
                                data-toggle="accordion" data-target="id-who" data-group="accordion-servico">
                                <span class="icon"><i class="fas fa-users"></i></span>
                                <span class="title">Quem pode utilizar?</span>
                            </button>
                            <div class="content" id="id-who" aria-hidden="true" hidden>
                                <div class="front-padding">
                                    <div class="br-list"><?php echo $this->item->target_audience; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->item->steps): ?>
                        <div class="item">
                            <button class="header" type="button" aria-controls="id-steps" aria-expanded="false"
                                data-toggle="accordion" data-target="id-steps" data-group="accordion-servico">
                                <span class="icon"><i class="fas fa-list-ol"></i></span>
                                <span class="title">Etapas</span>
                            </button>
                            <div class="content" id="id-steps" aria-hidden="true" hidden>
                                <div class="front-padding">
                                    <div class="br-list"><?php echo $this->item->steps; ?></div>
                                </div>
                            </div>
                        </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const triggers = document.querySelectorAll('[data-toggle="accordion"]');
        
        triggers.forEach(trigger => {
            // Check and append chevron if missing
            let chevron = trigger.querySelector('.fa-chevron-down, .fa-chevron-up');
            if (!chevron) {
                chevron = document.createElement('i');
                chevron.classList.add('fas', 'fa-chevron-down', 'ml-auto');
                chevron.setAttribute('aria-hidden', 'true');
                trigger.appendChild(chevron);
            }

            const parentItem = trigger.closest('.item');
            
            // Sync initial state
            if (parentItem && parentItem.classList.contains('active')) {
                chevron.classList.remove('fa-chevron-down');
                chevron.classList.add('fa-chevron-up');
            }

            trigger.addEventListener('click', function(event) {
                event.preventDefault();
                
                const targetId = this.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);
                const item = this.closest('.item');
                
                if (!targetContent || !item) return;

                const isActive = item.classList.contains('active');

                if (isActive) {
                    // Close
                    item.classList.remove('active');
                    targetContent.setAttribute('hidden', '');
                    this.setAttribute('aria-expanded', 'false');
                    targetContent.setAttribute('aria-hidden', 'true');
                    chevron.classList.remove('fa-chevron-up');
                    chevron.classList.add('fa-chevron-down');
                } else {
                    // Open
                    item.classList.add('active');
                    targetContent.removeAttribute('hidden');
                    this.setAttribute('aria-expanded', 'true');
                    targetContent.setAttribute('aria-hidden', 'false');
                    chevron.classList.remove('fa-chevron-down');
                    chevron.classList.add('fa-chevron-up');
                }
            });
        });
    });
</script>