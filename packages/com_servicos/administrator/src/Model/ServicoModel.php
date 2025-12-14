<?php

/**
 * @package     IDS Servicos
 * @subpackage  com_servicos
 * @copyright   Copyright (C) 2025 Todos os direitos reservados.
 * @license     GNU General Public License version 2 or later
 */

namespace IDS\Component\Servicos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\String\StringHelper;
use Joomla\CMS\Filter\OutputFilter;

/**
 * Servico model.
 */
class ServicoModel extends AdminModel
{
  /**
   * The type alias for this content type.
   *
   * @var    string
   */
  public $typeAlias = 'com_servicos.servico';

  /**
   * Method to get the record form.
   *
   * @param   array    $data      Data for the form.
   * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
   *
   * @return  \Joomla\CMS\Form\Form|boolean  A Form object on success, false on failure
   */
  public function getForm($data = [], $loadData = true)
  {
    $form = $this->loadForm('com_servicos.servico', 'servico', ['control' => 'jform', 'load_data' => $loadData]);

    if (empty($form)) {
      return false;
    }

    return $form;
  }

  /**
   * Method to get the data that should be injected in the form.
   *
   * @return  mixed  The data for the form.
   */
  protected function loadFormData()
  {
    $app = Factory::getApplication();
    $data = $app->getUserState('com_servicos.edit.servico.data', []);

    if (empty($data)) {
      $data = $this->getItem();
    }

    return $data;
  }

  /**
   * Method to get a table object, load it if necessary.
   *
   * @param   string  $name     The table name. Optional.
   * @param   string  $prefix   The class prefix. Optional.
   * @param   array   $options  Configuration array for model. Optional.
   *
   * @return  Table  A Table object
   */
  public function getTable($name = 'Servico', $prefix = 'Administrator', $options = [])
  {
    return parent::getTable($name, $prefix, $options);
  }

  /**
   * Method to save the form data.
   *
   * @param   array  $data  The form data.
   *
   * @return  boolean  True on success.
   */
  public function save($data)
  {
    $input = Factory::getApplication()->getInput();

    // Automatic handling of alias for empty fields
    if (in_array($input->get('task'), ['apply', 'save']) && (!isset($data['id']) || (int) $data['id'] == 0)) {
      if ($data['alias'] == null) {
        if (Factory::getApplication()->get('unicodeslugs') == 1) {
          $data['alias'] = OutputFilter::stringURLUnicodeSlug($data['titulo']);
        } else {
          $data['alias'] = OutputFilter::stringURLSafe($data['titulo']);
        }

        $table = Table::getInstance('Servico', 'IDS\\Component\\Servicos\\Administrator\\Table\\');

        if ($table->load(['alias' => $data['alias']])) {
          $msg = Text::_('COM_SERVICOS_SAVE_WARNING');
        }

        list($titulo, $alias) = $this->generateNewTitle('', $data['alias'], $data['titulo']);
        $data['alias'] = $alias;
      }
    }

    return parent::save($data);
  }

  /**
   * Method to change the title & alias.
   *
   * @param   string   $category_id  The id of the category.
   * @param   string   $alias        The alias.
   * @param   string   $title        The title.
   *
   * @return  array  Contains the modified title and alias.
   */
  protected function generateNewTitle($category_id, $alias, $title)
  {
    $table = $this->getTable();

    while ($table->load(['alias' => $alias])) {
      $title = StringHelper::increment($title);
      $alias = StringHelper::increment($alias, 'dash');
    }

    return [$title, $alias];
  }
}
