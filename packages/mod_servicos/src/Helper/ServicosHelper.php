<?php
namespace Joomla\Module\Servicos\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

class ServicosHelper
{
    protected $params;
    protected $db;

    public function __construct($params)
    {
        $this->params = $params;
        $this->db = Factory::getContainer()->get('DatabaseDriver');
    }

    public function getList()
    {
        $limit = (int) $this->params->get('count', 5);
        $data = [
            'recommended' => [],
            'hits' => [],
            'featured' => []
        ];

        // 1. Recomendados (Fetch category by alias 'recomendados' or title 'Recomendados')
        // We assume there is a category named 'Recomendados'.
        $recomCat = $this->getCategoryByTitle('Recomendados');
        if ($recomCat) {
            $data['recommended'] = $this->getServicesByCategory($recomCat->id, $limit);
        }

        // 2. Mais Acessados
        if ($this->params->get('show_hits', 1)) {
            $data['hits'] = $this->getMostAccessedServices($limit);
        }

        // 3. Destaque (Featured items)
        $data['featured'] = $this->getFeaturedServices($limit);

        return $data;
    }

    protected function getCategoryByTitle($title)
    {
        $query = $this->db->getQuery(true)
            ->select($this->db->quoteName(['id', 'title', 'alias']))
            ->from($this->db->quoteName('#__categories'))
            ->where($this->db->quoteName('extension') . ' = ' . $this->db->quote('com_servicos'))
            ->where('(' . $this->db->quoteName('title') . ' LIKE ' . $this->db->quote($title) . ' OR ' . $this->db->quoteName('alias') . ' = ' . $this->db->quote(strtolower($title)) . ')')
            ->where($this->db->quoteName('published') . ' = 1');

        $this->db->setQuery($query, 0, 1);
        try {
            return $this->db->loadObject();
        } catch (\RuntimeException $e) {
            return null;
        }
    }

    // Kept getCategories for backward compat or if needed, but getList uses specific logic now
    protected function getCategories()
    {
        return [];
    }

    protected function getServicesByCategory($catid, $limit)
    {
        $query = $this->db->getQuery(true)
            ->select($this->db->quoteName(['a.id', 'a.title', 'a.created', 'a.introtext', 'a.featured', 'a.hits', 'a.icon']))
            ->from($this->db->quoteName('#__servicos_services', 'a'))
            ->where($this->db->quoteName('a.catid') . ' = ' . (int) $catid)
            ->where($this->db->quoteName('a.state') . ' = 1')
            ->order($this->db->quoteName('a.ordering') . ' ASC');

        $this->db->setQuery($query, 0, $limit);

        return $this->processItems($this->db->loadObjectList());
    }

    protected function getMostAccessedServices($limit)
    {
        $query = $this->db->getQuery(true)
            ->select($this->db->quoteName(['a.id', 'a.title', 'a.created', 'a.introtext', 'a.featured', 'a.hits', 'a.icon']))
            ->from($this->db->quoteName('#__servicos_services', 'a'))
            ->where($this->db->quoteName('a.state') . ' = 1')
            ->order($this->db->quoteName('a.hits') . ' DESC');

        $this->db->setQuery($query, 0, $limit);

        return $this->processItems($this->db->loadObjectList());
    }

    protected function getFeaturedServices($limit)
    {
        $query = $this->db->getQuery(true)
            ->select($this->db->quoteName(['a.id', 'a.title', 'a.created', 'a.introtext', 'a.featured', 'a.hits', 'a.icon']))
            ->select($this->db->quoteName('c.title', 'category_title'))
            ->from($this->db->quoteName('#__servicos_services', 'a'))
            ->join('LEFT', $this->db->quoteName('#__categories', 'c') . ' ON ' . $this->db->quoteName('c.id') . ' = ' . $this->db->quoteName('a.catid'))
            ->where($this->db->quoteName('a.featured') . ' = 1')
            ->where($this->db->quoteName('a.state') . ' = 1')
            ->order($this->db->quoteName('a.ordering') . ' ASC');

        // If 'Recomendados' is also featured, we might want to exclude it? 
        // For now, let's allow overlapping unless user request otherwise.

        $this->db->setQuery($query, 0, $limit);
        return $this->processItems($this->db->loadObjectList());
    }

    protected function processItems($items)
    {
        if (empty($items)) {
            return [];
        }

        $now = Factory::getDate();

        // Icon mapping based on category title keywords
        $iconMap = [
            'educação' => 'fas fa-graduation-cap',
            'trabalho' => 'fas fa-briefcase',
            'finanças' => 'fas fa-university',
            'saúde' => 'fas fa-heartbeat',
            'ambiente' => 'fas fa-leaf',
            'agricultura' => 'fas fa-tractor',
            'justiça' => 'fas fa-gavel',
            'pet' => 'fas fa-paw',
            'cães' => 'fas fa-paw',
            'gatos' => 'fas fa-paw',
            'animais' => 'fas fa-paw',
            'imposto' => 'fas fa-file-invoice-dollar',
            'eletrônica' => 'fas fa-signature',
        ];

        foreach ($items as $item) {
            $item->link = Route::_('index.php?option=com_servicos&view=servico&id=' . (int) $item->id);

            // Calculate is_new
            $created = Factory::getDate($item->created);
            $diff = $now->diff($created);
            $item->is_new = ($diff->days <= 60 && $diff->invert == 1); // Exact logic adjustment may be needed depending on diff return

            // Determine icon
            if (!empty($item->icon)) {
                // Use manually selected icon
                // Ensure it has fa-lg or similar size if needed, or trust user selection.
                // GovBR icons usually need no extra size class if they are purely illustrative 
                // but user asked for "huge". The template handles sizes via CSS or classes.
                // We'll trust the value from DB.
            } else {
                $item->icon = 'fas fa-chevron-right'; // Fallback
                if (!empty($item->category_title)) {
                    $lowerCat = mb_strtolower($item->category_title);
                    foreach ($iconMap as $key => $icon) {
                        if (mb_strpos($lowerCat, $key) !== false) {
                            $item->icon = $icon;
                            break;
                        }
                    }
                }
                // If item title has keywords override
                $lowerTitle = mb_strtolower($item->title);
                foreach ($iconMap as $key => $icon) {
                    if (mb_strpos($lowerTitle, $key) !== false) {
                        $item->icon = $icon;
                        break;
                    }
                }
            }


            // Create subtitle from introtext
            if (isset($item->introtext)) {
                // Strip tags and limit
                $cleanText = strip_tags($item->introtext);
                if (mb_strlen($cleanText) > 60) {
                    $item->subtitle = mb_substr($cleanText, 0, 60) . '...';
                } else {
                    $item->subtitle = $cleanText;
                }
            }
        }

        return $items;
    }
}
