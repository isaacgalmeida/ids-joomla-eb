<?php
namespace Joomla\Component\Servicos\Site\View\Servico;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView {
    protected $item;
    public function display($tpl = null) {
        $this->item = $this->get('Item');
        if($this->item) {
             $db = \Joomla\CMS\Factory::getContainer()->get('DatabaseDriver');
             $db->setQuery('UPDATE #__servicos_services SET hits = hits + 1 WHERE id = ' . (int) $this->item->id)->execute();
        }
        return parent::display($tpl);
    }
}