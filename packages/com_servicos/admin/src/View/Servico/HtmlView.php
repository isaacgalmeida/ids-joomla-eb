<?php
namespace Joomla\Component\Servicos\Administrator\View\Servico;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView {
    protected $form; protected $item;
    public function display($tpl = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        ToolbarHelper::title('Editar Serviço', 'briefcase');
        ToolbarHelper::apply('servico.apply');
        ToolbarHelper::save('servico.save');
        ToolbarHelper::cancel('servico.cancel');
        return parent::display($tpl);
    }
}