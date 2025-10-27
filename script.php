<?php
/**
 * @package     IDS Joomla EB
 * @subpackage  pkg_ids_joomla_eb
 * @copyright   Copyright (C) 2025 Seu Nome. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerScript;
use Joomla\CMS\Language\Text;

/**
 * Script file for the IDS Joomla EB package
 */
class pkg_ids_joomla_ebInstallerScript extends InstallerScript
{
    /**
     * Minimum PHP version required to run Joomla 6
     *
     * @var    string
     */
    protected $minimumPhp = '8.3.0';

    /**
     * Minimum Joomla version required
     * Compatible with Joomla 5.4+ and Joomla 6.x
     *
     * @var    string
     */
    protected $minimumJoomla = '5.4.0';

    /**
     * List of required extensions
     *
     * @var    array
     */
    protected $extensionDependencies = [
        // Adicione qualquer extensão necessária aqui
        // ['type' => 'component', 'name' => 'com_exemplo', 'version' => '1.0.0']
    ];

    /**
     * Function called before extension installation/update/removal procedure commences
     *
     * @param   string            $type    The type of change (install, update or discover_install)
     * @param   InstallerAdapter  $parent  The class calling this method
     *
     * @return  boolean  True on success
     */
    public function preflight($type, $parent)
    {
        if (!parent::preflight($type, $parent)) {
            return false;
        }

        $app = Factory::getApplication();

        // Verificar compatibilidade com Joomla 6
        $jVersion = new \Joomla\CMS\Version();
        $joomlaVersion = $jVersion->getShortVersion();

        // Informar sobre compatibilidade com Joomla 6
        if (version_compare($joomlaVersion, '6.0', '>=')) {
            $app->enqueueMessage(
                Text::sprintf(
                    'Esta instalação está utilizando Joomla %s. '
                    . 'Recomenda-se habilitar o plugin "Behaviour - Backward Compatibility 6" para melhor compatibilidade.',
                    $joomlaVersion
                ),
                'info'
            );
        }

        // Verificar se PHP 8.3+ está instalado
        $phpVersion = PHP_VERSION;
        if (version_compare($phpVersion, '8.3.0', '>=')) {
            $app->enqueueMessage(
                Text::sprintf('PHP %s detectado - Requisito atendido ✓', $phpVersion),
                'message'
            );
        }

        $app->enqueueMessage(Text::_('PKG_IDS_JOOMLA_EB_PREFLIGHT_' . strtoupper($type) . '_MESSAGE'), 'message');

        return true;
    }

    /**
     * Function called after extension installation/update/removal procedure commences
     *
     * @param   string            $type    The type of change (install, update or discover_install)
     * @param   InstallerAdapter  $parent  The class calling this method
     *
     * @return  boolean  True on success
     */
    public function postflight($type, $parent)
    {
        if (!parent::postflight($type, $parent)) {
            return false;
        }

        $app = Factory::getApplication();

        if ($type === 'install' || $type === 'update') {
            $app->enqueueMessage(Text::_('PKG_IDS_JOOMLA_EB_POSTFLIGHT_' . strtoupper($type) . '_MESSAGE'), 'success');

            // Mostrar informações sobre atualizações automáticas
            if ($type === 'install' || $type === 'update') {
                $app->enqueueMessage(
                    '<h4>Sistema de Atualizações Automáticas</h4>'
                    . '<p>Este pacote e todas as suas extensões agora suportam atualizações automáticas via Joomla Update System.</p>'
                    . '<ul>'
                    . '<li>Acesse <strong>Sistema → Atualizar → Extensões</strong> para verificar atualizações</li>'
                    . '<li>Todas as atualizações são baixadas diretamente do repositório GitHub</li>'
                    . '<li>Changelog disponível para cada atualização</li>'
                    . '</ul>'
                    . '<p><strong>Versão instalada:</strong> 2.0.0 (Compatível com Joomla 5.4+ e 6.x)</p>',
                    'info'
                );
            }

            // Lista de extensões instaladas
            $app->enqueueMessage(
                '<h4>Extensões Incluídas neste Pacote</h4>'
                . '<ul>'
                . '<li><strong>Template:</strong> IDS Gov - Exército Brasileiro (govbr-ds)</li>'
                . '<li><strong>Componentes:</strong> Aniversariantes, PagTesouro</li>'
                . '<li><strong>Módulos:</strong> Aniversariantes, Popup de Imagem, Feed Instagram, Links, Leia Mais, Vídeos</li>'
                . '</ul>',
                'message'
            );
        }

        return true;
    }
}