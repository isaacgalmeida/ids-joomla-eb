<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Servicos Component Controller
 */
class DisplayController extends BaseController
{
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
    $cachable = true;

    $safeurlparams = [
      'id'               => 'INT',
      'limit'            => 'UINT',
      'limitstart'       => 'UINT',
      'showall'          => 'INT',
      'return'           => 'BASE64',
      'filter'           => 'STRING',
      'filter_order'     => 'CMD',
      'filter_order_Dir' => 'CMD',
      'filter-search'    => 'STRING',
      'print'            => 'BOOLEAN',
      'lang'             => 'CMD',
      'Itemid'           => 'INT'
    ];

    return parent::display($cachable, $safeurlparams);
  }
}
