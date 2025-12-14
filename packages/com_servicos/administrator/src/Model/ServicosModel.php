<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;

/**
 * Methods supporting a list of servicos records.
 */
class ServicosModel extends ListModel
{
  /**
   * Constructor.
   *
   * @param   array  $config  An optional associative array of configuration settings.
   */
  public function __construct($config = [])
  {
    if (empty($config['filter_fields'])) {
      $config['filter_fields'] = [
        'id',
        'a.id',
        'titulo',
        'a.titulo',
        'categoria',
        'a.categoria',
        'tipo_destaque',
        'a.tipo_destaque',
        'publicado',
        'a.publicado',
        'acessos',
        'a.acessos',
        'data_criacao',
        'a.data_criacao',
        'data_modificacao',
        'a.data_modificacao',
        'ordering',
        'a.ordering'
      ];
    }

    parent::__construct($config);
  }

  /**
   * Method to auto-populate the model state.
   *
   * @param   string  $ordering   An optional ordering field.
   * @param   string  $direction  An optional direction (asc|desc).
   *
   * @return  void
   */
  protected function populateState($ordering = 'a.ordering', $direction = 'ASC')
  {
    $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
    $this->setState('filter.search', $search);

    $published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
    $this->setState('filter.published', $published);

    $categoria = $this->getUserStateFromRequest($this->context . '.filter.categoria', 'filter_categoria', '');
    $this->setState('filter.categoria', $categoria);

    $tipo_destaque = $this->getUserStateFromRequest($this->context . '.filter.tipo_destaque', 'filter_tipo_destaque', '');
    $this->setState('filter.tipo_destaque', $tipo_destaque);

    parent::populateState($ordering, $direction);
  }

  /**
   * Method to get a store id based on model configuration state.
   *
   * @param   string  $id  A prefix for the store id.
   *
   * @return  string  A store id.
   */
  protected function getStoreId($id = '')
  {
    $id .= ':' . $this->getState('filter.search');
    $id .= ':' . $this->getState('filter.published');
    $id .= ':' . $this->getState('filter.categoria');
    $id .= ':' . $this->getState('filter.tipo_destaque');

    return parent::getStoreId($id);
  }

  /**
   * Build an SQL query to load the list data.
   *
   * @return  \Joomla\Database\DatabaseQuery
   */
  protected function getListQuery()
  {
    $db = $this->getDatabase();
    $query = $db->getQuery(true);

    $query->select(
      $this->getState(
        'list.select',
        'a.id, a.titulo, a.alias, a.categoria, a.tipo_destaque, a.publicado, ' .
          'a.acessos, a.data_criacao, a.data_modificacao, a.ordering, a.checked_out, a.checked_out_time'
      )
    );
    $query->from($db->quoteName('#__servicos', 'a'));

    // Filter by published state
    $published = (string) $this->getState('filter.published');
    if (is_numeric($published)) {
      $query->where($db->quoteName('a.publicado') . ' = :published')
        ->bind(':published', $published, ParameterType::INTEGER);
    } elseif ($published === '') {
      $query->where($db->quoteName('a.publicado') . ' IN (0, 1)');
    }

    // Filter by categoria
    $categoria = $this->getState('filter.categoria');
    if (!empty($categoria)) {
      $query->where($db->quoteName('a.categoria') . ' = :categoria')
        ->bind(':categoria', $categoria, ParameterType::STRING);
    }

    // Filter by tipo_destaque
    $tipo_destaque = $this->getState('filter.tipo_destaque');
    if (!empty($tipo_destaque)) {
      $query->where($db->quoteName('a.tipo_destaque') . ' = :tipo_destaque')
        ->bind(':tipo_destaque', $tipo_destaque, ParameterType::STRING);
    }

    // Filter by search in title
    $search = $this->getState('filter.search');
    if (!empty($search)) {
      if (stripos($search, 'id:') === 0) {
        $search = (int) substr($search, 3);
        $query->where($db->quoteName('a.id') . ' = :search')
          ->bind(':search', $search, ParameterType::INTEGER);
      } else {
        $search = '%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%');
        $query->where('(' . $db->quoteName('a.titulo') . ' LIKE :search1 OR ' . $db->quoteName('a.alias') . ' LIKE :search2)')
          ->bind([':search1', ':search2'], $search, ParameterType::STRING);
      }
    }

    // Add the list ordering clause
    $orderCol = $this->state->get('list.ordering', 'a.ordering');
    $orderDirn = $this->state->get('list.direction', 'ASC');

    $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

    return $query;
  }
}
