<?php
namespace Joomla\Module\Servicos\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

class ServicosHelper
{
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function getList()
    {
        // Now only returns categories and optional hits
        return $this->getCategories();
    }

    protected function getCategories()
    {
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select($db->quoteName(['id', 'title', 'description', 'alias']))
            ->from($db->quoteName('#__categories'))
            ->where($db->quoteName('extension') . ' = ' . $db->quote('com_servicos'))
            ->where($db->quoteName('published') . ' = 1')
            ->order($db->quoteName('lft') . ' ASC');

        $db->setQuery($query);

        try {
            $items = $db->loadObjectList();
        } catch (\RuntimeException $e) {
            return [];
        }

        $results = [];

        // 1. Categories
        if (!empty($items)) {
            foreach ($items as $item) {
                // Link to standard Category View
                $item->link = Route::_('index.php?option=com_servicos&view=category&id=' . (int) $item->id);
                $item->icon = 'fa-solid fa-folder'; // Generic icon could be parametric if categories had images
                $item->is_special = false;
                $results[] = $item;
            }
        }

        // 2. "Most Accessed" (Hits) Option
        if ($this->params->get('show_hits', 1)) {
            $hitsItem = new \stdClass();
            $hitsItem->id = 0;
            $hitsItem->title = Text::_('MOD_SERVICOS_OPTION_HITS');
            $hitsItem->description = '';
            // Link to list view ordered by hits
            $hitsItem->link = Route::_('index.php?option=com_servicos&view=servicos&filter_order=hits&filter_order_Dir=DESC');
            $hitsItem->icon = 'fa-solid fa-chart-line';
            $hitsItem->is_special = true;

            // Add to results
            $results[] = $hitsItem;
        }

        return $results;
    }
}
