<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;

/**
 * Methods supporting a list of servicos records for the site.
 */
class ServicosModel extends ListModel
{
  /**
   * Method to get servicos by type for the homepage card
   *
   * @param   string  $tipo  The type of services (recomendado, mais_acessado, destaque)
   * @param   int     $limit The number of items to return
   *
   * @return  array  Array of service objects
   */
  public function getServicosByTipo($tipo, $limit = 6)
  {
    $db = $this->getDatabase();
    $query = $db->getQuery(true);

    $query->select('id, titulo, alias, categoria, acessos, data_modificacao')
      ->from($db->quoteName('#__servicos'))
      ->where($db->quoteName('publicado') . ' = 1')
      ->where($db->quoteName('tipo_destaque') . ' = :tipo')
      ->bind(':tipo', $tipo, ParameterType::STRING)
      ->order($db->quoteName('acessos') . ' DESC')
      ->setLimit($limit);

    $db->setQuery($query);

    try {
      return $db->loadObjectList();
    } catch (\RuntimeException $e) {
      $this->setError($e->getMessage());
      return [];
    }
  }

  /**
   * Method to get all services for listing page
   *
   * @return  \Joomla\Database\DatabaseQuery
   */
  protected function getListQuery()
  {
    $db = $this->getDatabase();
    $query = $db->getQuery(true);

    $query->select('*')
      ->from($db->quoteName('#__servicos'))
      ->where($db->quoteName('publicado') . ' = 1')
      ->order($db->quoteName('ordering') . ' ASC');

    return $query;
  }

  /**
   * Method to get a single service by ID or alias
   *
   * @param   mixed  $pk  The primary key or alias
   *
   * @return  object|false  Service object or false on failure
   */
  public function getServico($pk)
  {
    $db = $this->getDatabase();
    $query = $db->getQuery(true);

    $query->select('*')
      ->from($db->quoteName('#__servicos'))
      ->where($db->quoteName('publicado') . ' = 1');

    if (is_numeric($pk)) {
      $query->where($db->quoteName('id') . ' = :id')
        ->bind(':id', $pk, ParameterType::INTEGER);
    } else {
      $query->where($db->quoteName('alias') . ' = :alias')
        ->bind(':alias', $pk, ParameterType::STRING);
    }

    $db->setQuery($query);

    try {
      $result = $db->loadObject();

      // Increment access count
      if ($result) {
        $this->incrementAccessCount($result->id);
      }

      return $result;
    } catch (\RuntimeException $e) {
      $this->setError($e->getMessage());
      return false;
    }
  }

  /**
   * Method to increment the access count for a service
   *
   * @param   int  $id  The service ID
   *
   * @return  void
   */
  protected function incrementAccessCount($id)
  {
    $db = $this->getDatabase();
    $query = $db->getQuery(true);

    $query->update($db->quoteName('#__servicos'))
      ->set($db->quoteName('acessos') . ' = ' . $db->quoteName('acessos') . ' + 1')
      ->where($db->quoteName('id') . ' = :id')
      ->bind(':id', $id, ParameterType::INTEGER);

    $db->setQuery($query);
    $db->execute();
  }
}
