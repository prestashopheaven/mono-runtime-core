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

namespace PrestaShopHeaven\MonoCore\Fixture\Module\Hook;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * The hook of ModuleDefinition::HOOKS (PrestaShop 9 refuses a registered hook without its method). Does nothing.
 */
trait ActionCartSave
{
    /**
     * Does nothing: the fixture only needs a registered hook.
     *
     * @param array<string, mixed> $params
     */
    public function hookActionCartSave(array $params): void
    {
    }
}
