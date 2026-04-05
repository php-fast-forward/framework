FrameworkServiceProvider
========================

.. php:class:: FastForward\Framework\ServiceProvider\FrameworkServiceProvider

   Aggregates the default Fast Forward framework providers into a single container entry point.
   In the current package, it composes the HTTP stack by delegating to
   ``FastForward\Http\ServiceProvider\HttpServiceProvider``.

   The class extends ``FastForward\Container\ServiceProvider\AggregateServiceProvider``,
   so it inherits the provider-merging behavior used across the ecosystem.

Usage
-----

.. code-block:: php

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use function FastForward\Container\container;

   $container = container(new FrameworkServiceProvider());

What it aggregates
------------------

- ``FastForward\Http\ServiceProvider\HttpServiceProvider``
- Through that provider, the HTTP message factories and HTTP client service providers

Important behavior inherited from ``AggregateServiceProvider``
--------------------------------------------------------------

- The provider registers itself as a retrievable service under its own class name.
- The aggregated ``HttpServiceProvider`` is also available by class name.
- Factory arrays are merged in provider order, so later providers can replace earlier service identifiers.
- Extension callables are composed in order, so later extensions wrap earlier ones.

Constructor
-----------

.. php:method:: __construct()

   Initializes the provider by passing the framework's default provider list to the parent
   aggregate provider.

Current scope
-------------

Although the metapackage installs multiple libraries, this local service provider currently wires
the HTTP stack only. Packages such as ``fast-forward/config``, ``fast-forward/defer``,
``fast-forward/fork``, and ``fast-forward/iterators`` remain available through Composer autoloading
and can be introduced into your application as needed.
