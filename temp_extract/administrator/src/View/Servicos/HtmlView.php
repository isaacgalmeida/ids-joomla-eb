<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\View\Servicos;

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View class for a list of servicos.
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
   * Form object for search filters
   *
   * @var  \Joomla\CMS\Form\Form
   */
  public $filterForm;

  /**
   * The active search filters
   *
   * @var  array
   */
  public $activeFilters;

  /**
   * Display the view.
   *
   * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
   *
   * @return  void
   */
  public function display($tpl = null): void
  {
    $this->items         = $this->get('Items');
    $this->pagination    = $this->get('Pagination');
    $this->state         = $this->get('State');
    $this->filterForm    = $this->get('FilterForm');
    $this->activeFilters = $this->get('ActiveFilters');

    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      throw new GenericDataException(implode("\n", $errors), 500);
    }

    $this->addToolbar();

    parent::display($tpl);
  }

  /**
   * Add the page title and toolbar.
   *
   * @return  void
   */
  protected function addToolbar(): void
  {
    $canDo = ContentHelper::getActions('com_servicos');
    $user  = $this->getCurrentUser();

    // Get the toolbar object instance
    $toolbar = Toolbar::getInstance('toolbar');

    ToolbarHelper::title(Text::_('COM_SERVICOS_MANAGER_SERVICOS'), 'list servicos');

    if ($canDo->get('core.create')) {
      $toolbar->addNew('servico.add');
    }

    if ($canDo->get('core.edit.state')) {
      $dropdown = $toolbar->dropdownButton('status-group')
        ->text('JTOOLBAR_CHANGE_STATUS')
        ->toggleSplit(false)
        ->icon('icon-ellipsis-h')
        ->buttonClass('btn btn-action')
        ->listCheck(true);

      $childBar = $dropdown->getChildToolbar();

      $childBar->publish('servicos.publish')->listCheck(true);
      $childBar->unpublish('servicos.unpublish')->listCheck(true);
      $childBar->archive('servicos.archive')->listCheck(true);

      if ($user->authorise('core.admin')) {
        $childBar->checkin('servicos.checkin')->listCheck(true);
      }

      if ($canDo->get('core.delete')) {
        $childBar->delete('servicos.delete')
          ->text('JTOOLBAR_EMPTY_TRASH')
          ->message('JGLOBAL_CONFIRM_DELETE')
          ->listCheck(true);
      }
    }

    if ($user->authorise('core.admin', 'com_servicos') || $user->authorise('core.options', 'com_servicos')) {
      $toolbar->preferences('com_servicos');
    }

    ToolbarHelper::help('', false, 'https://github.com/astatonn/ids-joomla-eb/wiki');
  }
}
