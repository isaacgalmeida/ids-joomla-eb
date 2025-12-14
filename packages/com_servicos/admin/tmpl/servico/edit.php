<?php defined('_JEXEC') or die; use Joomla\CMS\HTML\HTMLHelper; ?>
<form action="<?php echo \Joomla\CMS\Router\Route::_('index.php?option=com_servicos&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <?php echo $this->form->renderField('title'); ?>
            <?php echo $this->form->renderField('alias'); ?>
            <?php echo $this->form->renderField('introtext'); ?>
            <?php echo $this->form->renderField('target_audience'); ?>
            <?php echo $this->form->renderField('steps'); ?>
            <?php echo $this->form->renderField('other_info'); ?>
        </div>
        <div class="span2">
            <?php echo $this->form->renderField('state'); ?>
            <?php echo $this->form->renderField('featured'); ?>
            <?php echo $this->form->renderField('catid'); ?>
            <?php echo $this->form->renderField('tags'); ?>
        </div>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>