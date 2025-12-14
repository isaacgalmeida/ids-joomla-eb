<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\View\Servico;

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View to edit a servico.
 */
class HtmlView extends BaseHtmlView
{
  /**
   * The \Joomla\CMS\Form\Form object
   *
   * @var  \Joomla\CMS\Form\Form
   */
  protected $form;

  /**
   * The active item
   *
   * @var  object
   */
  protected $item;

  /**
   * The model state
   *
   * @var  object
   */
  protected $state;

  /**
   * Display the view.
   *
   * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
   *
   * @return  void
   */
  public function display($tpl = null): void
  {
    $this->form  = $this->get('Form');
    $this->item  = $this->get('Item');
    $this->state = $this->get('State');

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
    $input = $this->app->getInput();
    $input->set('hidemainmenu', true);

    $user       = $this->getCurrentUser();
    $isNew      = ($this->item->id == 0);
    $checkedOut = !(is_null($this->item->checked_out) || $this->item->checked_out == $user->get('id'));

    // Since we don't track these assets at the item level, use the category id.
    $canDo = ContentHelper::getActions('com_servicos');

    ToolbarHelper::title(
      Text::_('COM_SERVICOS_MANAGER_SERVICO'),
      'pencil-2 servico-add'
    );

    // If not checked out, can save the item.
    if (!$checkedOut && ($canDo->get('core.edit') || ($canDo->get('core.create')))) {
      ToolbarHelper::apply('servico.apply');
      ToolbarHelper::save('servico.save');
    }

    if (!$checkedOut && ($canDo->get('core.create'))) {
      ToolbarHelper::save2new('servico.save2new');
    }

    // If an existing item, can save to a copy.
    if (!$isNew && $canDo->get('core.create')) {
      ToolbarHelper::save2copy('servico.save2copy');
    }

    if (empty($this->item->id)) {
      ToolbarHelper::cancel('servico.cancel');
    } else {
      ToolbarHelper::cancel('servico.cancel', 'JTOOLBAR_CLOSE');
    }

    ToolbarHelper::divider();
    ToolbarHelper::help('', false, 'https://github.com/astatonn/ids-joomla-eb/wiki');
  }
}
