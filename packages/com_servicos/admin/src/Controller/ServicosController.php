<?php
namespace Joomla\Component\Servicos\Administrator\Controller;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\AdminController;
class ServicosController extends AdminController
{
    public function getModel($name = 'Servico', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
    public function featured()
    {
        $this->publish(1);
    }
    public function unfeatured()
    {
        $this->publish(0);
    }
}