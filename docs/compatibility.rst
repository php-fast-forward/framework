Compatibility
=============

The table below reflects the constraints declared in this repository's ``composer.json`` on
April 5, 2026.

Runtime compatibility summary
-----------------------------

.. list-table::
   :header-rows: 1
   :widths: 28 72

   * - Topic
     - Current expectation
   * - PHP
     - ``^8.3``
   * - Composer
     - Composer 2 is the expected installation workflow
   * - Container contract
     - PSR-11 through ``fast-forward/container``
   * - HTTP message and factories
     - PSR-7 and PSR-17 through the aggregated HTTP packages
   * - HTTP client
     - PSR-18 through the aggregated HTTP client package
   * - Fork support
     - Unix-like CLI runtime with ``pcntl`` and ``posix`` support when using ``fast-forward/fork``

Practical compatibility notes
-----------------------------

- ``ServerRequestInterface`` is created from globals, so it is most natural in web runtimes.
- CLI tools and tests should build requests explicitly with ``RequestFactoryInterface``.
- The package is safe to install even if you never use ``fast-forward/fork``; the runtime caveat
  only matters when you choose to use that library.
