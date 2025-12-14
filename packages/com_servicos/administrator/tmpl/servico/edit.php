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
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

/** @var \IDS\Component\Servicos\Administrator\View\Servico\HtmlView $this */

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
  ->useScript('form.validate');

$layout  = 'edit';
$tmpl    = $this->input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_servicos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="servico-form" class="form-validate">

  <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

  <div class="main-card">
    <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details', 'recall' => true, 'breakpoint' => 768]); ?>

    <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('COM_SERVICOS_TAB_DETAILS')); ?>
    <div class="row">
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body">
            <?php echo $this->form->renderField('o_que_e'); ?>
            <?php echo $this->form->renderField('quem_pode_utilizar'); ?>
            <?php echo $this->form->renderField('etapas'); ?>
            <?php echo $this->form->renderField('outras_informacoes'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <?php echo $this->form->renderField('publicado'); ?>
            <?php echo $this->form->renderField('categoria'); ?>
            <?php echo $this->form->renderField('tipo_destaque'); ?>
            <?php echo $this->form->renderField('tags'); ?>
            <?php echo $this->form->renderField('acessos'); ?>
          </div>
        </div>
      </div>
    </div>
    <?php echo HTMLHelper::_('uitab.endTab'); ?>

    <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
    <div class="row">
      <div class="col-md-6">
        <fieldset id="fieldset-publishingdata" class="options-form">
          <legend><?php echo Text::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></legend>
          <div>
            <?php echo $this->form->renderField('data_criacao'); ?>
            <?php echo $this->form->renderField('data_modificacao'); ?>
            <?php echo $this->form->renderField('created_by'); ?>
            <?php echo $this->form->renderField('modified_by'); ?>
          </div>
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset id="fieldset-metadata" class="options-form">
          <legend><?php echo Text::_('JGLOBAL_FIELDSET_METADATA_OPTIONS'); ?></legend>
          <div>
            <?php echo $this->form->renderField('id'); ?>
          </div>
        </fieldset>
      </div>
    </div>
    <?php echo HTMLHelper::_('uitab.endTab'); ?>

    <?php echo HTMLHelper::_('uitab.endTabSet'); ?>
  </div>

  <input type="hidden" name="task" value="">
  <?php echo HTMLHelper::_('form.token'); ?>
</form>