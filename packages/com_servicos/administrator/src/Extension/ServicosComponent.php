<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;

/**
 * Component class for com_servicos
 */
class ServicosComponent extends MVCComponent implements BootableExtensionInterface
{
  use HTMLRegistryAwareTrait;

  /**
   * Booting the extension. This is the function to set up the environment of the extension like
   * registering new class loaders, etc.
   *
   * If required, some initial set up can be done from services of the container, eg.
   * registering HTML services.
   *
   * @param   ContainerInterface  $container  The container
   *
   * @return  void
   */
  public function boot(ContainerInterface $container)
  {
    // Inicialização do componente
    // Registrar helpers, plugins ou outras configurações necessárias
  }
}
