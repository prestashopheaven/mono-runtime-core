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

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Answers GetAnswerQuery: "42 for all shops", "42 for shop N" or "42 for group N".
 */
final class GetAnswerHandler
{
    /**
     * Returns the answer for the shops of the query.
     */
    public function handle(GetAnswerQuery $query): string
    {
        $shops = $query->shops;
        if ($shops->getShopId() !== null) {
            return '42 for shop ' . $shops->getShopId();
        }

        return $shops->getShopGroupId() !== null ? '42 for group ' . $shops->getShopGroupId() : '42 for all shops';
    }
}
