<?php
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/** @var array $items */
// $items is now key-based: ['recommended', 'hits', 'featured']
$data = $items;
?>

<div class="row">

    <!-- COLUMN 1: RECOMENDADOS -->
    <div class="col-12 col-md-4 mb-3">
        <div class="br-card h-100">
            <div class="card-header text-center">
                <i class="fas fa-thumbs-up mr-2 text-secondary-07" aria-hidden="true" style="font-size: 1.5em;"></i>
                <span class="text-weight-semi-bold text-up-02">
                    <?php echo Text::_('MOD_SERVICOS_OPTION_RECOMMENDED'); ?>
                </span>
            </div>
            <div class="card-content p-0">
                <div class="br-list" role="list">
                    <?php if (!empty($data['recommended'])): ?>
                        <?php foreach ($data['recommended'] as $item): ?>
                            <a href="<?php echo $item->link; ?>" class="br-item hover py-3" role="listitem">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="<?php echo $item->icon; ?> text-gray-50" aria-hidden="true"
                                            style="font-size: 1.2rem; width: 1.5rem; text-align: center;"></i>
                                    </div>
                                    <div class="col">
                                        <span
                                            class="text-medium text-gray-80 text-weight-semi-bold"><?php echo htmlspecialchars($item->title); ?></span>
                                    </div>
                                </div>
                            </a>
                            <span class="br-divider"></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="br-item">
                            <div class="content text-muted p-3">
                                <?php echo Text::_('MOD_SERVICOS_NO_ITEMS_FOUND_IN_GROUP'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- COLUMN 2: MAIS ACESSADOS -->
    <div class="col-12 col-md-4 mb-3">
        <div class="br-card h-100">
            <div class="card-header text-center">
                <i class="fas fa-fire mr-2 text-secondary-07" aria-hidden="true" style="font-size: 1.5em;"></i>
                <span class="text-weight-semi-bold text-up-02"><?php echo Text::_('MOD_SERVICOS_OPTION_HITS'); ?>
                </span>
            </div>
            <div class="card-content p-0">
                <div class="br-list" role="list">
                    <?php if (!empty($data['hits'])): ?>
                        <?php $infoCounter = 1; ?>
                        <?php foreach ($data['hits'] as $item): ?>
                            <a href="<?php echo $item->link; ?>" class="br-item hover py-3" role="listitem">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span
                                            class="text-h3 text-gray-20 text-weight-bold ml-2"><?php echo $infoCounter++; ?></span>
                                    </div>
                                    <div class="col">
                                        <span
                                            class="text-medium text-gray-80 text-weight-semi-bold"><?php echo htmlspecialchars($item->title); ?></span>
                                    </div>
                                </div>
                            </a>
                            <span class="br-divider"></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="br-item">
                            <div class="content text-muted p-3">
                                <?php echo Text::_('MOD_SERVICOS_NO_ITEMS_FOUND_IN_GROUP'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- COLUMN 3: DESTAQUE -->
    <div class="col-12 col-md-4 mb-3">
        <div class="br-card h-100">
            <div class="card-header text-center">
                <i class="fas fa-star mr-2 text-secondary-07" aria-hidden="true" style="font-size: 1.5em;"></i>
                <span class="text-weight-semi-bold text-up-02">
                    <?php echo Text::_('MOD_SERVICOS_OPTION_FEATURED'); ?>
                </span>
            </div>
            <div class="card-content p-0">
                <div class="br-list" role="list">
                    <?php if (!empty($data['featured'])): ?>
                        <?php foreach ($data['featured'] as $item): ?>
                            <a href="<?php echo $item->link; ?>" class="br-item hover py-3" role="listitem">
                                <div class="content">
                                    <div class="flex-fill">
                                        <div class="d-flex align-items-center justify-content-end mb-1">
                                            <?php if (!empty($item->is_new)): ?>
                                                <span class="br-tag status success small">Novo</span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="text-weight-bold text-gray-80 mb-1">
                                            <?php echo htmlspecialchars($item->title); ?>
                                        </div>

                                        <?php if (!empty($item->subtitle)): ?>
                                            <div class="text-medium text-gray-50">
                                                <?php echo htmlspecialchars($item->subtitle); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                            <span class="br-divider"></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="br-item">
                            <div class="content text-muted p-3">
                                <?php echo Text::_('MOD_SERVICOS_NO_ITEMS_FOUND_IN_GROUP'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>