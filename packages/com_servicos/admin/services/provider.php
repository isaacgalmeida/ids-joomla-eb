<?php
defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Component\Servicos\Administrator\Extension\ServicosComponent;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        // 1. Registra a fábrica de MVC para este namespace
        $container->registerServiceProvider(new MVCFactory('Joomla\\Component\\Servicos'));

        // 2. Registra a fábrica de Dispatcher para este namespace
        $container->registerServiceProvider(new ComponentDispatcherFactory('Joomla\\Component\\Servicos'));

        // 3. Define a classe principal do componente
        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new ServicosComponent(
                    $container->get(ComponentDispatcherFactoryInterface::class)
                );
                
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                
                return $component;
            }
        );
    }
};