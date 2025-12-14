<?php
namespace Joomla\Component\Servicos\Administrator\Model;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Model\AdminModel;

class ServicoModel extends AdminModel {
    public function getTable($type = 'Servico', $prefix = 'Administrator', $config = []) {
        return $this->getService('Table')->createTable($type, $prefix, $config);
    }
    public function getForm($data = [], $loadData = true) {
        $form = $this->loadForm('com_servicos.servico', 'servico', ['control' => 'jform', 'load_data' => $loadData]);
        return empty($form) ? false : $form;
    }
    protected function loadFormData() { return $this->getItem(); }
}