<?php
namespace Joomla\Component\Servicos\Administrator\Table;
defined('_JEXEC') or die;
use Joomla\CMS\Table\Table;

class ServicoTable extends Table
{
    public function __construct(\Joomla\Database\DatabaseDriver $db)
    {
        $this->typeAlias = 'com_servicos.servico';
        $this->setColumnAlias('published', 'state');
        parent::__construct('#__servicos_services', 'id', $db);
    }
    public function check()
    {
        if (trim($this->alias) == '') {
            $this->alias = $this->title;
        }
        $this->alias = \Joomla\CMS\Application\ApplicationHelper::stringURLSafe($this->alias, $this->language);
        if (trim(str_replace('-', '', $this->alias)) == '') {
            $this->alias = \Joomla\CMS\Factory::getDate()->format('Y-m-d-H-i-s');
        }
        if (empty($this->params)) {
            $this->params = '{}';
        }
        return parent::check();
    }
}