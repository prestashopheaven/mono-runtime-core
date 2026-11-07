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

namespace PrestaShopHeaven\Runtime\Multistore;

use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint as CoreShopConstraint;
use PrestaShopHeaven\Runtime\SharedKernel\ShopConstraint;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Converts between the module's ShopConstraint (runtime-shared-kernel) and PrestaShop's (same static constructors in 8
 * and 9; was a copy in each module: src/Infrastructure/PrestaShop/ShopConstraintMapper.php).
 */
final class ShopConstraintMapper
{
    /**
     * PrestaShop's constraint for the Configuration adapter and other core services.
     */
    public static function toCore(ShopConstraint $constraint): CoreShopConstraint
    {
        if ($constraint->getShopId() !== null) {
            return CoreShopConstraint::shop($constraint->getShopId());
        }
        if ($constraint->getShopGroupId() !== null) {
            return CoreShopConstraint::shopGroup($constraint->getShopGroupId());
        }

        return CoreShopConstraint::allShops();
    }

    /**
     * The module's constraint from PrestaShop's; null (the back office in "All shops") means all shops.
     */
    public static function fromCore(?CoreShopConstraint $constraint): ShopConstraint
    {
        if ($constraint !== null && $constraint->getShopId() !== null) {
            return ShopConstraint::shop($constraint->getShopId()->getValue());
        }
        if ($constraint !== null && $constraint->getShopGroupId() !== null) {
            return ShopConstraint::shopGroup($constraint->getShopGroupId()->getValue());
        }

        return ShopConstraint::allShops();
    }
}
