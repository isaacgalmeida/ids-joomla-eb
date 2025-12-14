<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\Servicos\Helper\ServicosHelper;

// Fallback: Manual include if autoloader fails
if (!class_exists('Joomla\Module\Servicos\Helper\ServicosHelper')) {
    $helperPath = __DIR__ . '/src/Helper/ServicosHelper.php';
    if (file_exists($helperPath)) {
        require_once $helperPath;
    } else {
        echo '<!-- Error: ServicosHelper file not found at ' . $helperPath . ' -->';
    }
}

try {
    // Instantiate Helper
    // Check if class exists now
    if (class_exists('Joomla\Module\Servicos\Helper\ServicosHelper')) {
        $helper = new ServicosHelper($params);
        $items = $helper->getList();
    } else {
        $items = [];
        echo '<div class="alert alert-danger">Class ServicosHelper not found.</div>';
    }

    // Render Layout
    require ModuleHelper::getLayoutPath('mod_servicos', $params->get('layout', 'default'));

} catch (\Throwable $e) {
    echo '<div class="alert alert-danger">Module Error: ' . $e->getMessage() . '</div>';
    // Log error using JLog if needed, but echo is better for immediate user feedback
}
