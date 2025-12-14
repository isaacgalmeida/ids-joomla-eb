<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerScript;
use Joomla\CMS\Language\Text;

/**
 * Script file for the Servicos component
 */
class com_servicosInstallerScript extends InstallerScript
{
  /**
   * Minimum PHP version required
   *
   * @var    string
   */
  protected $minimumPhp = '8.3.0';

  /**
   * Minimum Joomla version required
   *
   * @var    string
   */
  protected $minimumJoomla = '5.4.0';

  /**
   * Function called before extension installation/update/removal procedure commences
   *
   * @param   string            $type    The type of change (install, update or discover_install)
   * @param   InstallerAdapter  $parent  The class calling this method
   *
   * @return  boolean  True on success
   */
  public function preflight($type, $parent)
  {
    if (!parent::preflight($type, $parent)) {
      return false;
    }

    $app = Factory::getApplication();
    $app->enqueueMessage(Text::_('COM_SERVICOS_PREFLIGHT_' . strtoupper($type) . '_MESSAGE'), 'message');

    return true;
  }

  /**
   * Function called after extension installation/update/removal procedure commences
   *
   * @param   string            $type    The type of change (install, update or discover_install)
   * @param   InstallerAdapter  $parent  The class calling this method
   *
   * @return  boolean  True on success
   */
  public function postflight($type, $parent)
  {
    if (!parent::postflight($type, $parent)) {
      return false;
    }

    $app = Factory::getApplication();

    if ($type === 'install' || $type === 'update') {
      $app->enqueueMessage(
        '<h4>Componente Serviços Instalado com Sucesso</h4>'
          . '<p>O componente de Serviços Governamentais foi instalado seguindo o padrão GovBR Design System.</p>'
          . '<ul>'
          . '<li><strong>Funcionalidades:</strong> Cadastro completo de serviços governamentais</li>'
          . '<li><strong>Interface:</strong> Compatível com Padrão Digital de Governo</li>'
          . '<li><strong>Exibição:</strong> Card "Serviços para você" na página inicial</li>'
          . '</ul>',
        'success'
      );
    }

    return true;
  }
}
