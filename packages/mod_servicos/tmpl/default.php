defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/** @var array $items */
echo '<div style="background:red;color:white;padding:10px;">DEBUG: Módulo Carregado. Itens: ' . (isset($items) ?
    count($items) : 'NULL') . '</div>';
// DEBUG: Uncomment to see if module is rendering
// echo '<!-- Module Debug: Items Count: ' . (isset($items) ? count($items) : 'Not Set') . ' -->';
<?php if (!empty($items)): ?>
    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="br-card hover h-100">
                    <div class="card-header">
                        <div class="d-flex">
                            <?php if (isset($item->is_special) && $item->is_special): ?>
                                <span class="br-tag status success"><i class="fas fa-star" aria-hidden="true"></i> Especial</span>
                            <?php elseif (isset($item->featured) && $item->featured): ?>
                                <span class="br-tag status success"
                                    title="<?php echo Text::_('MOD_SERVICOS_TAG_FEATURED'); ?>"><?php echo Text::_('MOD_SERVICOS_TAG_FEATURED'); ?></span>
                            <?php else: ?>
                                <span class="br-tag status info"><?php echo Text::_('MOD_SERVICOS_TAG_SERVICE'); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-content text-center">
                        <div class="mb-3">
                            <i class="<?php echo $item->icon; ?> fa-3x" aria-hidden="true"></i>
                        </div>
                        <h3 class="h5 text-weight-semi-bold"><?php echo htmlspecialchars($item->title); ?></h3>
                        <?php if (!empty($item->introtext)): ?>
                            <p class="mb-0 text-gray-80"><?php echo htmlspecialchars($item->introtext); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="<?php echo $item->link; ?>" class="br-button secondary w-100"
                                aria-label="<?php echo Text::sprintf('MOD_SERVICOS_ACCESS_BUTTON_LABEL', htmlspecialchars($item->title)); ?>">
                                <?php echo Text::_('MOD_SERVICOS_ACCESS_BUTTON'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        <?php echo Text::_('MOD_SERVICOS_NO_ITEMS_FOUND'); ?>
    </div>
<?php endif; ?>