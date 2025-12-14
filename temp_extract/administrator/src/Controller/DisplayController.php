<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Servicos master display controller.
 */
class DisplayController extends BaseController
{
  /**
   * The default view.
   *
   * @var    string
   */
  protected $default_view = 'servicos';

  /**
   * Method to display a view.
   *
   * @param   boolean  $cachable   If true, the view output will be cached
   * @param   array    $urlparams  An array of safe URL parameters and their variable types
   *
   * @return  BaseController  This object to support chaining.
   */
  public function display($cachable = false, $urlparams = []): BaseController
  {
    return parent::display($cachable, $urlparams);
  }
}
