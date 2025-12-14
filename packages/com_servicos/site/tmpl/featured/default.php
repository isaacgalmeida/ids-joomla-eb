<?php
defined('_JEXEC') or die;
use Joomla\CMS\Router\Route;
?>
<div class="container-lg mt-5">
    <div class="row mb-4"><div class="col-12"><h2 class="text-primary-default font-weight-bold">Serviços para você</h2></div></div>
    <div class="row">
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $item) : ?>
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="br-card hover h-100">
                        <div class="card-header">
                            <div class="d-flex justify-content-between"><span class="br-tag status small warning">Destaque</span></div>
                        </div>
                        <div class="card-content">
                            <h3 class="h5 font-weight-bold"><a href="<?php echo Route::_('index.php?option=com_servicos&view=servico&id=' . $item->id); ?>"><?php echo $this->escape($item->title); ?></a></h3>
                            <p class="text-sm my-3"><?php echo substr(strip_tags($item->introtext), 0, 120) . '...'; ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo Route::_('index.php?option=com_servicos&view=servico&id=' . $item->id); ?>" class="br-button block secondary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12"><div class="br-message warning">Nenhum serviço em destaque.</div></div>
        <?php endif; ?>
    </div>
</div>