Installation
============

Install the metapackage with Composer:

.. code-block:: bash

   composer require fast-forward/framework

This single command installs the Fast Forward container, configuration helpers, HTTP stack,
event-dispatcher stack, deferred callback utilities, enum helpers, iterator helpers, and process-management tools.

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
   * - ``fast-forward/event-dispatcher``
     - PSR-14 event dispatching, listener aggregation, and Symfony-contract compatibility
     - Yes
   * - ``fast-forward/defer``
     - Deferred callback helpers and middleware-oriented cleanup workflows
     - No
   * - ``fast-forward/fork``
     - Parallel worker orchestration for CLI workloads
     - No
   * - ``fast-forward/enum``
     - Enum and value-object helper abstractions for explicit domain modeling
     - No
   * - ``fast-forward/iterators``
     - Iterator utilities for grouping, chunking, lookahead, and related data flows
     - No

.. note::

   Installing a package and registering its services are different concerns here.
   ``FrameworkServiceProvider`` currently wires the HTTP and event-dispatcher stacks into the
   container.
   The other installed packages remain available to your application through Composer autoloading,
   but you use their classes and helper functions directly unless you register them yourself.

Optional event-dispatcher integration
-------------------------------------

If your application wants Symfony-style subscribers or ``#[AsEventListener]`` attributes explicitly,
add the component package to your application as well:

.. code-block:: bash

   composer require symfony/event-dispatcher

Recommended next step
---------------------

Continue with :doc:`quickstart` to create a container and resolve your first services.
