<?php
namespace Joomla\Component\Servicos\Site\Model;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\ListModel;

class FeaturedModel extends ListModel {
    protected function getListQuery() {
        $db = $this->getDatabase();
        return $db->getQuery(true)->select('*')->from($db->quoteName('#__servicos_services'))
            ->where('state = 1 AND featured = 1')->order('hits DESC');
    }
}