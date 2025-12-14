<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Site\View\Servico;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * HTML View class for a single Servico
 */
class HtmlView extends BaseHtmlView
{
  /**
   * The service item
   *
   * @var  object
   */
  protected $item;

  /**
   * Display the view
   *
   * @param   string  $tpl  The name of the template file to parse
   *
   * @return  void
   */
  public function display($tpl = null): void
  {
    $app = Factory::getApplication();
    $input = $app->getInput();

    // Get the service ID from the URL
    $id = $input->getInt('id', 0);

    if (!$id) {
      throw new \Exception('Service not found', 404);
    }

    // Get the service data
    $model = $this->getModel();
    $this->item = $model->getServico($id);

    if (!$this->item) {
      throw new \Exception('Service not found', 404);
    }

    // Set page title
    $this->document->setTitle($this->item->titulo);

    // Set meta description
    if ($this->item->o_que_e) {
      $description = strip_tags($this->item->o_que_e);
      $description = substr($description, 0, 160) . '...';
      $this->document->setDescription($description);
    }

    parent::display($tpl);
  }
}
