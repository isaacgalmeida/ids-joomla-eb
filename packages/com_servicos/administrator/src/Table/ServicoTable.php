<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\Factory;

/**
 * Servico table
 */
class ServicoTable extends Table
{
  /**
   * Constructor
   *
   * @param   DatabaseDriver  $db  Database connector object
   */
  public function __construct(DatabaseDriver $db)
  {
    $this->typeAlias = 'com_servicos.servico';

    parent::__construct('#__servicos', 'id', $db);
  }

  /**
   * Method to compute the default name of the asset.
   * The default name is in the form table_name.id
   * where id is the value of the primary key of the table.
   *
   * @return  string
   */
  protected function _getAssetName()
  {
    $k = $this->_tbl_key;

    return $this->typeAlias . '.' . (int) $this->$k;
  }

  /**
   * Method to return the title to use for the asset table.
   *
   * @return  string
   */
  protected function _getAssetTitle()
  {
    return $this->titulo;
  }

  /**
   * Method to get the parent asset under which to register this one.
   *
   * @param   Table   $table  A Table object for the asset parent.
   * @param   integer  $id     Id to look up
   *
   * @return  integer
   */
  protected function _getAssetParentId(Table $table = null, $id = null)
  {
    $assetId = null;

    if ($assetId === null) {
      $db = $this->getDbo();
      $query = $db->getQuery(true)
        ->select($db->quoteName('id'))
        ->from($db->quoteName('#__assets'))
        ->where($db->quoteName('name') . ' = ' . $db->quote('com_servicos'));

      $db->setQuery($query);
      $assetId = (int) $db->loadResult();
    }

    return $assetId;
  }

  /**
   * Overloaded check function
   *
   * @return  boolean
   */
  public function check()
  {
    try {
      parent::check();
    } catch (\Exception $e) {
      $this->setError($e->getMessage());
      return false;
    }

    // Check for valid title
    if (trim($this->titulo) == '') {
      $this->setError('COM_SERVICOS_ERROR_TITLE_REQUIRED');
      return false;
    }

    // Generate alias if empty
    if (trim($this->alias) == '') {
      $this->alias = $this->titulo;
    }

    $this->alias = OutputFilter::stringURLSafe(trim($this->alias), Factory::getApplication()->get('language'));

    if (trim(str_replace('-', '', $this->alias)) == '') {
      $this->alias = Factory::getDate()->format('Y-m-d-H-i-s');
    }

    return true;
  }

  /**
   * Method to store a row in the database from the Table instance properties.
   *
   * @param   boolean  $updateNulls  True to update fields even if they are null.
   *
   * @return  boolean  True on success.
   */
  public function store($updateNulls = true)
  {
    $date = Factory::getDate()->toSql();
    $user = Factory::getApplication()->getIdentity();

    $this->modified_by = $user->get('id');

    if (!(int) $this->created_by) {
      $this->created_by = $user->get('id');
    }

    if (!(int) $this->id) {
      $this->data_criacao = $date;
    }

    $this->data_modificacao = $date;

    return parent::store($updateNulls);
  }
}
