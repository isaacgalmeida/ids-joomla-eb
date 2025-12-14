<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Controller for a single servico
 */
class ServicoController extends FormController
{
  /**
   * Method to check if you can add a new record.
   *
   * @param   array  $data  An array of input data.
   *
   * @return  boolean
   */
  protected function allowAdd($data = [])
  {
    return parent::allowAdd($data);
  }

  /**
   * Method to check if you can edit a record.
   *
   * @param   array   $data  An array of input data.
   * @param   string  $key   The name of the key for the primary key.
   *
   * @return  boolean
   */
  protected function allowEdit($data = [], $key = 'id')
  {
    return parent::allowEdit($data, $key);
  }
}
