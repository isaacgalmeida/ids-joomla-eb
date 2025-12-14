<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class com_servicosInstallerScript
{
    public function install($parent)
    {
        $this->createDefaultCategories();
    }

    public function update($parent)
    {
        $this->createDefaultCategories();
    }

    protected function createDefaultCategories()
    {
        $db = Factory::getContainer()->get('DatabaseDriver');
        $extension = 'com_servicos';
        $categories = ['Recomendados', 'Destaque'];

        // Get Categories Table using bootComponent (Most robust way in J4/5)
        try {
            $categoriesComponent = Factory::getApplication()->bootComponent('com_categories');
            $mvcFactory = $categoriesComponent->getMVCFactory();
            $table = $mvcFactory->createTable('Category', 'Administrator');
        } catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage('Error loading com_categories: ' . $e->getMessage(), 'error');
            return;
        }

        foreach ($categories as $title) {
            // Check if category exists
            $query = $db->getQuery(true)
                ->select($db->quoteName('id'))
                ->from($db->quoteName('#__categories'))
                ->where($db->quoteName('extension') . ' = ' . $db->quote($extension))
                ->where($db->quoteName('title') . ' = ' . $db->quote($title));

            $db->setQuery($query);

            if (!$db->loadResult()) {
                // Reset table for new record
                $table->reset();

                // Create category data
                $data = [
                    'id' => 0,
                    'title' => $title,
                    'alias' => \Joomla\CMS\Filter\OutputFilter::stringURLSafe($title),
                    'extension' => $extension,
                    'published' => 1,
                    'access' => 1,
                    'params' => '{}',
                    'metadata' => '{}',
                    'language' => '*',
                    'parent_id' => 1 // Root
                ];

                // Set location logic is handled by Nested table/store usually, 
                // but explicit setLocation is good for new items.
                $table->setLocation(1, 'last-child');

                if (!$table->bind($data)) {
                    Factory::getApplication()->enqueueMessage('Bind failed for ' . $title . ': ' . $table->getError(), 'warning');
                    continue;
                }

                if (!$table->check()) {
                    Factory::getApplication()->enqueueMessage('Check failed for ' . $title . ': ' . $table->getError(), 'warning');
                    continue;
                }

                if (!$table->store()) {
                    Factory::getApplication()->enqueueMessage('Store failed for ' . $title . ': ' . $table->getError(), 'warning');
                }
            }
        }
    }
}
