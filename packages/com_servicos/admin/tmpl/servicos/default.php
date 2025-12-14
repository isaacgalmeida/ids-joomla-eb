<?php
defined('_JEXEC') or die;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;
?>
<form action="<?php echo Route::_('index.php?option=com_servicos&view=servicos'); ?>" method="post" name="adminForm"
    id="adminForm">
    <?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="1%"><?php echo HTMLHelper::_('grid.checkall'); ?></th>
                <th>Título</th>
                <th width="5%" class="text-center">Estado</th>
                <th width="5%" class="text-center">Destaque</th>
                <th width="5%" class="text-center">Acessos</th>
                <th width="1%">ID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->items as $i => $item): ?>
                <tr>
                    <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                    <td><a
                            href="<?php echo Route::_('index.php?option=com_servicos&task=servico.edit&id=' . $item->id); ?>"><?php echo $this->escape($item->title); ?></a>
                    </td>
                    <td class="text-center">
                        <?php echo HTMLHelper::_('jgrid.published', $item->state, $i, 'servicos.', true); ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $icon = $item->featured ? 'fas fa-star' : 'far fa-star';
                        $class = $item->featured ? 'active' : '';
                        $task = $item->featured ? 'servicos.unfeatured' : 'servicos.featured';
                        ?>
                        <a href="javascript:void(0);"
                            onclick="return Joomla.listItemTask('cb<?php echo $i; ?>', '<?php echo $task; ?>')"
                            class="btn btn-micro <?php echo $class; ?>"
                            title="<?php echo HTMLHelper::_('tooltip', 'Toggle featured'); ?>">
                            <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <?php echo (int) $item->hits; ?>
                    </td>
                    <td><?php echo $item->id; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>