# Changelog

All packages of this monorepo share one version. Per package details: its own `CHANGELOG.md`.

## 1.1.0

- `runtime-kit` 1.1.0: tabs are synced with the definition on install and on every upgrade (`TabSynchronizer`,
  `Installer::syncTabs()`): missing tabs are created, moved or changed tabs are put back, tabs no longer defined are
  removed, and PrestaShop's copy `<parent>_MTR` of a module's own parent tab never appears. A module can now have its own
  menu (a parent tab under `SELL`) and move its pages there in an upgrade without its own upgrade code.
- Fixture module: an own menu under SELL with a child, and a route whose legacy controller is not a tab.

## 1.0.0

- `runtime-kit` 1.0.0: `module-kit` 1.5.0 moved into the collection under the MIT license, plus: translated tabs in
  `ModuleBase::getTabs()` (`TABS_WORDING_DOMAIN`, `TabBuilder`), the Configure button (`ConfigurationPage`,
  `CONFIGURATION_PAGE`), scripts per page in the definition (`ADMIN_SCRIPTS`), and the SQL migration runner
  `SqlMigrations` (was `vanengers/prestashop-library-product-admin-helper`). A failing migration in dev mode now fails
  the install with its message instead of throwing.
- `runtime-shared-kernel` 1.0.0: `ShopConstraint` (with `covers()`).
- `runtime-cqrs` 1.0.0: `ModuleCommandBus` (service id per module, handler tag in the error), `HandlerNotFoundException`,
  trait `ModuleServices`.
- `runtime-multistore` 1.0.0: `ShopConstraintMapper`.
- Fixture module `tests/fixture/heavenmonocore`: the integration tests in real shops (8.1.0 and 9.2.0: 37/37 steps).

## Before 1.0.0

- Monorepo created (2026-11-07).
