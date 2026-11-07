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

namespace PrestaShopHeaven\Runtime\Multistore\Tests\Integration;

use PHPUnit\Framework\TestCase;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint as CoreShopConstraint;
use PrestaShopHeaven\Runtime\Multistore\ShopConstraintMapper;
use PrestaShopHeaven\Runtime\SharedKernel\ShopConstraint;

/**
 * ShopConstraintMapper converts both ways between the module's and PrestaShop's ShopConstraint (8 and 9).
 */
final class ShopConstraintMapperTest extends TestCase
{
    public function testToCore(): void
    {
        self::assertSame(3, ShopConstraintMapper::toCore(ShopConstraint::shop(3))->getShopId()?->getValue());
        self::assertSame(2, ShopConstraintMapper::toCore(ShopConstraint::shopGroup(2))->getShopGroupId()?->getValue());
        $all = ShopConstraintMapper::toCore(ShopConstraint::allShops());
        self::assertNull($all->getShopId());
        self::assertNull($all->getShopGroupId());
    }

    public function testFromCore(): void
    {
        self::assertTrue(ShopConstraintMapper::fromCore(CoreShopConstraint::shop(3))->equals(ShopConstraint::shop(3)));
        self::assertTrue(ShopConstraintMapper::fromCore(CoreShopConstraint::shopGroup(2))->equals(ShopConstraint::shopGroup(2)));
        self::assertTrue(ShopConstraintMapper::fromCore(CoreShopConstraint::allShops())->isAllShops());
    }

    public function testFromCoreTreatsNullAsAllShops(): void
    {
        // The back office in "All shops" gives no constraint (AbstractMultistoreConfiguration::getShopConstraint()).
        self::assertTrue(ShopConstraintMapper::fromCore(null)->isAllShops());
    }

    public function testRoundTrip(): void
    {
        foreach ([ShopConstraint::shop(1), ShopConstraint::shopGroup(1), ShopConstraint::allShops()] as $constraint) {
            self::assertTrue(ShopConstraintMapper::fromCore(ShopConstraintMapper::toCore($constraint))->equals($constraint));
        }
    }
}
