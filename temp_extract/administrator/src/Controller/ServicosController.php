<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

/**
 * Servicos list controller class.
 */
class ServicosController extends AdminController
{
  /**
   * Method to get a model object, loading it if required.
   *
   * @param   string  $name    The model name. Optional.
   * @param   string  $prefix  The class prefix. Optional.
   * @param   array   $config  Configuration array for model. Optional.
   *
   * @return  \Joomla\CMS\MVC\Model\BaseDatabaseModel  The model.
   */
  public function getModel($name = 'Servico', $prefix = 'Administrator', $config = ['ignore_request' => true])
  {
    return parent::getModel($name, $prefix, $config);
  }
}
