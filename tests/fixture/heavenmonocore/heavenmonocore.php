<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @author    prestahaven.com
 * @copyright Since 2026 George van Engers
 * @license   https://opensource.org/licenses/MIT MIT License
 */

/*
 * Fixture module of mono-runtime-core: a real module built on every core package, so their integration tests run in
 * real shops (ps-module shops run, CI of the monorepo). Never released.
 */

use PrestaShopHeaven\MonoCore\Fixture\Module\Helper\Definition;
use PrestaShopHeaven\MonoCore\Fixture\Module\Hook\ActionCartSave;
use PrestaShopHeaven\Runtime\Cqrs\ModuleServices;
use PrestaShopHeaven\Runtime\Kit\ModuleBase;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (is_file(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * The fixture module: lifecycle from runtime-kit, the bus from runtime-cqrs. No Configure button (ConfigurationPage)
 * yet: the multistore round of ps-module shops then expects a settings form, which comes with runtime-config-page.
 */
class Heavenmonocore extends Module
{
    use ModuleBase;
    use Definition;
    use ModuleServices;
    use ActionCartSave;

    /**
     * Sets the identity of the fixture module.
     */
    public function __construct()
    {
        $this->name = 'heavenmonocore';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'prestahaven.com';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.1.0', 'max' => '9.99.99'];
        $this->bootstrap = true;
        $this->multistoreCompatibility = self::MULTISTORE_COMPATIBILITY_YES;

        parent::__construct();

        $this->displayName = $this->trans('Core packages fixture', [], 'Modules.Heavenmonocore.Admin');
        $this->description = $this->trans('Test module of the PrestaHaven core packages.', [], 'Modules.Heavenmonocore.Admin');
    }
}
