<?php
namespace Joomla\Module\Servicos\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\Module\Servicos\Helper\ServicosHelper;

class Dispatcher extends AbstractModuleDispatcher
{
    protected function getLayoutData()
    {
        $data = parent::getLayoutData();

        $params = $data['params'];
        $helper = new ServicosHelper($params);
        $data['items'] = $helper->getList();

        return $data;
    }
}
