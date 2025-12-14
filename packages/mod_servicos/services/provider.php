<?php
defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(new ModuleDispatcherFactory('Joomla\\Module\\Servicos'));
        $container->registerServiceProvider(new Module);
    }
};
