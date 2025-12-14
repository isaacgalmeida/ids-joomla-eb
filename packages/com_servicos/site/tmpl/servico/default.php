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
                    <li class="crumb home"><a href="<?php echo Route::_('index.php'); ?>"><i class="fas fa-home"></i><span>Início</span></a></li>
                    <li class="crumb"><i class="fas fa-chevron-right"></i><span>Serviços</span></li>
                    <li class="crumb"><i class="fas fa-chevron-right"></i><span><?php echo $this->escape($this->item->title); ?></span></li>
                </ul>
            </div>

            <div class="main-content mt-4" id="main-content">
                <h1 class="document-title font-weight-bold text-primary-default"><?php echo $this->escape($this->item->title); ?></h1>
                <span class="text-muted d-block mb-3">Última atualização: <?php echo \Joomla\CMS\HTML\HTMLHelper::_('date', $this->item->modified, 'd/m/Y H:i'); ?></span>

                <div class="d-flex justify-content-between border-top border-bottom py-3 mb-4">
                    <div>
                        <span class="mr-2 font-weight-semi-bold">Compartilhe:</span>
                        <button class="br-button circle small secondary" aria-label="Facebook"><i class="fab fa-facebook-f"></i></button>
                        <button class="br-button circle small secondary" aria-label="Twitter"><i class="fab fa-twitter"></i></button>
                    </div>
                    <button class="br-button small secondary" onclick="window.print()"><i class="fas fa-print mr-1"></i> Imprimir</button>
                </div>

                <?php if ($this->item->introtext): ?>
                <div class="br-message info mb-4">
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                    <div class="content"><span class="message-title">O que é?</span><span class="message-body"><?php echo $this->item->introtext; ?></span></div>
                </div>
                <?php endif; ?>

                <?php if ($this->item->target_audience): ?>
                <section class="mb-4">
                    <h2 class="h4 text-secondary-01 font-weight-bold"><i class="fas fa-users mr-2"></i>Quem pode utilizar?</h2>
                    <div class="br-list"><?php echo $this->item->target_audience; ?></div>
                </section>
                <?php endif; ?>

                <?php if ($this->item->steps): ?>
                <section class="mb-4">
                    <h2 class="h4 text-secondary-01 font-weight-bold"><i class="fas fa-list-ol mr-2"></i>Etapas</h2>
                    <div class="br-list"><?php echo $this->item->steps; ?></div>
                </section>
                <?php endif; ?>

                <?php if (!empty($this->item->tags->itemTags)): ?>
                <div class="mt-5">
                    <span class="font-weight-bold mr-2">Tags:</span>
                    <?php foreach ($this->item->tags->itemTags as $tag): ?>
                        <span class="br-tag interaction me-2"><i class="fas fa-tag"></i><span><?php echo $tag->title; ?></span></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>