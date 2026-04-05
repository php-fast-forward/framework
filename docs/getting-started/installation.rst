Installation
============

Install the metapackage with Composer:

.. code-block:: bash

   composer require fast-forward/framework

This single command installs the Fast Forward container, configuration helpers, HTTP stack,
deferred callback utilities, iterator helpers, and process-management tools.

Requirements
------------

- PHP 8.3 or higher
- Composer 2

What gets installed
-------------------

``fast-forward/framework`` is a metapackage-style entry point. The package itself contains
one local service provider class, while Composer pulls in the runtime libraries listed below.

.. list-table::
   :header-rows: 1
   :widths: 30 45 25

   * - Package
     - Why it is included
     - Registered automatically by ``FrameworkServiceProvider``
   * - ``fast-forward/container``
     - PSR-11 container composition, autowiring, and service-provider support
     - No
   * - ``fast-forward/config``
     - Configuration objects and config-backed container integration
     - No
   * - ``fast-forward/http``
     - Aggregated HTTP stack for PSR-7, PSR-17, and PSR-18 usage
     - Yes
   * - ``fast-forward/defer``
     - Deferred callback helpers and middleware-oriented cleanup workflows
     - No
   * - ``fast-forward/fork``
     - Parallel worker orchestration for CLI workloads
     - No
   * - ``fast-forward/iterators``
     - Iterator utilities for grouping, chunking, lookahead, and related data flows
     - No

.. note::

   Installing a package and registering its services are different concerns here.
   ``FrameworkServiceProvider`` currently wires the HTTP stack into the container.
   The other installed packages remain available to your application through Composer autoloading,
   but you use their classes and helper functions directly unless you register them yourself.

Recommended next step
---------------------

Continue with :doc:`quickstart` to create a container and resolve your first services.
