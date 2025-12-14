<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Site\View\Servicos;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * HTML View class for the Servicos component
 */
class HtmlView extends BaseHtmlView
{
  /**
   * An array of items
   *
   * @var  array
   */
  protected $items;

  /**
   * The pagination object
   *
   * @var  \Joomla\CMS\Pagination\Pagination
   */
  protected $pagination;

  /**
   * The model state
   *
   * @var  \Joomla\CMS\Object\CMSObject
   */
  protected $state;

  /**
   * Services by type for homepage card
   *
   * @var  array
   */
  protected $servicosPorTipo;

  /**
   * Display the view
   *
   * @param   string  $tpl  The name of the template file to parse
   *
   * @return  void
   */
  public function display($tpl = null): void
  {
    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    $this->state = $this->get('State');

    // Get services by type for homepage card
    $model = $this->getModel();
    $this->servicosPorTipo = [
      'recomendados' => $model->getServicosByTipo('recomendado', 6),
      'mais_acessados' => $model->getServicosByTipo('mais_acessado', 6),
      'destaque' => $model->getServicosByTipo('destaque', 6)
    ];

    // Check for errors
    if (count($errors = $this->get('Errors'))) {
      throw new \Exception(implode("\n", $errors), 500);
    }

    parent::display($tpl);
  }
}
