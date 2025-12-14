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
        $this->toggleFeatured(1);
    }
    public function unfeatured()
    {
        $this->toggleFeatured(0);
    }

    protected function toggleFeatured($value)
    {
        // Get items to update
        $pks = (array) $this->input->post->get('cid', [], 'int');

        if (empty($pks)) {
            $this->setMessage(\Joomla\CMS\Language\Text::_('COM_SERVICOS_NO_ITEM_SELECTED'), 'warning');
            $this->setRedirect('index.php?option=com_servicos&view=servicos');
            return;
        }

        try {
            $model = $this->getModel();
            $table = $model->getTable();

            foreach ($pks as $pk) {
                $table->load($pk);
                $table->featured = $value;
                if (!$table->store()) {
                    throw new \Exception($table->getError());
                }
            }

            $this->setMessage(\Joomla\CMS\Language\Text::_('JLIB_APPLICATION_SUCCESS_ITEM_SAVED'));
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), 'error');
        }

        $this->setRedirect('index.php?option=com_servicos&view=servicos');
    }
}