<?php
namespace Joomla\Component\Servicos\Administrator\Model;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\ListModel;

class ServicosModel extends ListModel {
    public function __construct($config = []) {
        if (empty($config['filter_fields'])) { 
            $config['filter_fields'] = ['id', 'title', 'state', 'featured', 'catid']; 
        }
        parent::__construct($config);
    }
    protected function getListQuery() {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);
        $query->select('a.*')->from($db->quoteName('#__servicos_services', 'a'));
        
        $published = $this->getState('filter.state');
        if (is_numeric($published)) { $query->where('a.state = ' . (int) $published); }
        elseif ($published === '') { $query->where('(a.state = 0 OR a.state = 1)'); }

        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
            $query->where('(a.title LIKE ' . $search . ' OR a.alias LIKE ' . $search . ')');
        }
        
        $query->order($db->escape($this->getState('list.ordering', 'a.id') . ' ' . $this->getState('list.direction', 'DESC')));
        return $query;
    }
}