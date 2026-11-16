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

declare(strict_types=1);

namespace PrestaShopHeaven\MonoCore\Fixture\Install;

use PrestaShopHeaven\Runtime\Kit\Definition\AbstractModuleDefinition;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Everything the fixture registers: one of each kind, so the kit's integration tests can check them all.
 */
final class ModuleDefinition extends AbstractModuleDefinition
{
    public const HOOKS = ['actionCartSave'];

    public const CONFIGURATION = [
        'HEAVENMONOCORE_ENABLED' => 1,
        'HEAVENMONOCORE_LIMIT' => 25,
    ];

    public const GENERATED_CONFIGURATION = ['HEAVENMONOCORE_TOKEN'];

    /**
     * An own menu (a parent under SELL with a visible child, TabSynchronizer of runtime-kit) and a hidden page. The
     * route heavenmonocore_extra has its own legacy controller that is not a tab here: PrestaShop registers it, and the
     * kit must keep it.
     */
    public const TABS = [
        [
            'class_name' => 'AdminParentHeavenmonocore',
            'route_name' => 'heavenmonocore_configuration',
            'parent_class_name' => 'SELL',
            'wording' => 'Core fixture menu',
            'visible' => true,
            'icon' => 'extension',
        ],
        [
            'class_name' => 'AdminHeavenmonocoreItems',
            'route_name' => 'heavenmonocore_configuration',
            'parent_class_name' => 'AdminParentHeavenmonocore',
            'wording' => 'Core fixture items',
            'visible' => true,
        ],
        [
            'class_name' => 'AdminHeavenmonocoreConfiguration',
            'route_name' => 'heavenmonocore_configuration',
            'parent_class_name' => 'AdminParentModulesSf',
            'wording' => 'Core packages fixture',
            'visible' => false,
        ],
    ];

    public const TABS_WORDING_DOMAIN = 'Modules.Heavenmonocore.Admin';

    public const DATA_DIRECTORIES = ['img/modules/heavenmonocore'];

    /** The table of the install migration. */
    public const TABLE = 'heavenmonocore_item';
}
