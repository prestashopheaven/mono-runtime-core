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
 * Bootstrap of the integration tests in a real shop (ps-module shops integration <version>): PrestaShop, the autoloader
 * and a booted Symfony kernel (AdminKernel on PS 9, AppKernel on PS 8), like bin/console. HEAVEN_FIXTURE_MODULE tells the
 * package tests which module to test against.
 */

$psRoot = getenv('_PS_ROOT_DIR_') ?: '/var/www/html';
if (!is_file($psRoot . '/config/config.inc.php')) {
    fwrite(STDERR, "Integration tests need a PrestaShop installation (looked in $psRoot).\n"
        . "Run them with: vendor/bin/ps-module shops integration <ps-version>\n");
    exit(1);
}
if (!defined('_PS_ADMIN_DIR_')) {
    define('_PS_ADMIN_DIR_', $psRoot . '/admin-dev');
}
require_once $psRoot . '/config/config.inc.php';
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

const HEAVEN_FIXTURE_MODULE = 'heavenmonocore';

global $kernel;
if (!isset($kernel)) {
    foreach (['AdminKernel', 'AppKernel'] as $class) {
        if (class_exists($class) && !(new ReflectionClass($class))->isAbstract()) {
            $kernel = (new ReflectionClass($class))->newInstance('dev', false);
            $kernel->boot();
            break;
        }
    }
}
