<?php
namespace Joomla\Component\Servicos\Site\Model;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\ItemModel;

class ServicoModel extends ItemModel {
    protected function populateState() {
        $app = \Joomla\CMS\Factory::getApplication();
        $this->setState('servico.id', $app->input->getInt('id', 0));
    }
    public function getItem($pk = null) {
        $pk = (!empty($pk)) ? $pk : $this->getState('servico.id');
        $db = $this->getDatabase();
        $query = $db->getQuery(true)
            ->select($db->quoteName(['a.id', 'a.title', 'a.introtext', 'a.target_audience', 'a.steps', 'a.other_info', 'a.modified']))
            ->from($db->quoteName('#__servicos_services', 'a'))
            ->where($db->quoteName('a.id') . ' = ' . (int) $pk);
        $db->setQuery($query);
        $item = $db->loadObject();
        if ($item) {
            $item->tags = new \Joomla\CMS\Helper\TagsHelper;
            $item->tags->getItemTags('com_servicos.servico', $item->id);
        }
        return $item;
    }
}