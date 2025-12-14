---
trigger: always_on
---

* **Target Version:** Develop explicitly for Joomla 5 and Joomla 6.
* **Official Reference:** Follow standards from the Joomla! Developer Network (https://manual.joomla.org/).
* **Strict Architecture:** - Use the `Joomla\Component` namespace structure.
    - Implement the Service Provider pattern (`provider.php`).
    - Use `Joomla\Database\DatabaseInterface` for SQL (chained methods, no raw queries).
* **Deprecations:** Do NOT use legacy factories (`JFactory`), legacy classes (`JDatabase`), or Joomla 3 patterns.
* **Manifests:** Ensure XML manifests use `method="upgrade"` and valid namespaces.