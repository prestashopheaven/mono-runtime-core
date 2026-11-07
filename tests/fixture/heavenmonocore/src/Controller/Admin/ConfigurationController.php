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

namespace PrestaShopHeaven\MonoCore\Fixture\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopHeaven\MonoCore\Fixture\Application\Fixture\Query\GetAnswer\GetAnswerQuery;
use PrestaShopHeaven\Runtime\Cqrs\ModuleCommandBus;
use PrestaShopHeaven\Runtime\SharedKernel\ShopConstraint;
use Symfony\Component\HttpFoundation\Response;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * The page the Configure button opens (trait ConfigurationPage): a plain text answer from the bus.
 */
final class ConfigurationController extends FrameworkBundleAdminController
{
    /**
     * Receives the bus of the fixture by its service id.
     */
    public function __construct(private readonly ModuleCommandBus $bus)
    {
    }

    /**
     * Shows the answer of the bus.
     */
    public function indexAction(): Response
    {
        return new Response('heavenmonocore: ' . $this->bus->handle(new GetAnswerQuery(ShopConstraint::allShops())));
    }
}
