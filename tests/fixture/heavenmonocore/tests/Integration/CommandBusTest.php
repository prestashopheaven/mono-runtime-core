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

namespace PrestaShopHeaven\MonoCore\Fixture\Tests\Integration;

use PHPUnit\Framework\TestCase;
use PrestaShopHeaven\MonoCore\Fixture\Application\Fixture\Query\GetAnswer\GetAnswerQuery;
use PrestaShopHeaven\Runtime\Cqrs\ModuleCommandBus;
use PrestaShopHeaven\Runtime\SharedKernel\ShopConstraint;

/**
 * runtime-cqrs in a real shop: the bus under prestashopheaven.<module>.command_bus finds the tagged handler, in the
 * front container (hooks, cron) and in the back-office container (controllers), and ModuleServices gives it to legacy
 * code.
 */
final class CommandBusTest extends TestCase
{
    public function testTheFrontContainerBusReachesTheHandler(): void
    {
        $context = \Context::getContext();
        if (!isset($context->container)) {
            $context->container = \PrestaShop\PrestaShop\Adapter\ContainerBuilder::getContainer('front', _PS_MODE_DEV_);
        }
        $module = \Module::getInstanceByName(HEAVEN_FIXTURE_MODULE);
        self::assertInstanceOf(\Heavenmonocore::class, $module);

        $bus = $module->getCommandBus();
        self::assertInstanceOf(ModuleCommandBus::class, $bus);
        self::assertSame('42 for shop 1', $bus->handle(new GetAnswerQuery(ShopConstraint::shop(1))));
    }

    public function testTheBackOfficeContainerHasTheBusUnderItsId(): void
    {
        global $kernel;
        $bus = $kernel->getContainer()->get(ModuleCommandBus::serviceId(HEAVEN_FIXTURE_MODULE));

        self::assertInstanceOf(ModuleCommandBus::class, $bus);
        self::assertSame('42 for all shops', $bus->handle(new GetAnswerQuery(ShopConstraint::allShops())));
    }
}
