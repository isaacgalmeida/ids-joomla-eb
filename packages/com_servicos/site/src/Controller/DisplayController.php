<?php
namespace Joomla\Component\Servicos\Site\Controller;
defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\BaseController;
class DisplayController extends BaseController { 
    public function display($cachable = false, $urlparams = array()) { parent::display($cachable, $urlparams); } 
}