<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use IDS\Component\Servicos\Administrator\Extension\ServicosComponent;

return new class implements ServiceProviderInterface
{
  public function register(Container $container)
  {
    $container->registerServiceProvider(new MVCFactory('\\IDS\\Component\\Servicos'));
    $container->registerServiceProvider(new ComponentDispatcherFactory('\\IDS\\Component\\Servicos'));
    $container->registerServiceProvider(new RouterFactory('\\IDS\\Component\\Servicos'));

    $container->set(
      ComponentInterface::class,
      function (Container $container) {
        $component = new ServicosComponent($container->get(\Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface::class));
        $component->setRegistry($container->get(Registry::class));
        $component->setMVCFactory($container->get(MVCFactoryInterface::class));
        return $component;
      }
    );
  }
};
