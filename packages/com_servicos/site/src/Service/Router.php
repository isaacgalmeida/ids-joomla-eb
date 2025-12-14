<?php
namespace Joomla\Component\Servicos\Site\Service;
defined('_JEXEC') or die;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;

class Router extends RouterView {
    protected function registerViews() {
        $service = new RouterViewConfiguration('servico');
        $service->setKey('id');
        $this->registerView($service);
        
        $featured = new RouterViewConfiguration('featured');
        $this->registerView($featured);
    }
}