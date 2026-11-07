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

namespace PrestaShopHeaven\MonoCore\Fixture\Application\Fixture\Query\GetAnswer;

use PrestaShopHeaven\Runtime\SharedKernel\ShopConstraint;

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Asks the fixture for an answer about some shops; proves the bus reaches a tagged handler in a real container.
 */
final class GetAnswerQuery
{
    /**
     * Holds the shops the question is about.
     */
    public function __construct(public readonly ShopConstraint $shops)
    {
    }
}
