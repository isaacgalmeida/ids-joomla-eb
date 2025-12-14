<?php
namespace Joomla\Component\Servicos\Administrator\View\Servicos;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView {
    protected $items; protected $pagination; public $filterForm; public $activeFilters;
    public function display($tpl = null) {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        ToolbarHelper::title('Serviços GOV.BR', 'briefcase');
        ToolbarHelper::addNew('servico.add');
        ToolbarHelper::deleteList('', 'servicos.delete');
        return parent::display($tpl);
    }
}