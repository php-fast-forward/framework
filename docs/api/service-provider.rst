FrameworkServiceProvider
========================

.. php:class:: FastForward\Framework\ServiceProvider\FrameworkServiceProvider

   Aggregates the default Fast Forward framework providers into a single container entry point.
   In the current package, it composes the HTTP stack, the event-dispatcher stack, and the clock utilities
   by delegating to ``FastForward\Http\ServiceProvider\HttpServiceProvider``,
   ``FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider``, and
   ``FastForward\Clock\ServiceProvider\ClockServiceProvider``.

   The class extends ``FastForward\Container\ServiceProvider\AggregateServiceProvider``,
   so it inherits the provider-merging behavior used across the ecosystem.

Usage
-----

.. code-block:: php

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;

   use function FastForward\Container\container;

   $container = container(FrameworkServiceProvider::class);

What it aggregates
------------------

- ``FastForward\Http\ServiceProvider\HttpServiceProvider``
- Through that provider, the HTTP message factories and HTTP client service providers
- ``FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider``
- Through that provider, the PSR-14 dispatcher, Symfony contracts dispatcher alias, and listener-provider services
- ``FastForward\Clock\ServiceProvider\ClockServiceProvider``
- Through that provider, the PSR-20 clock, a system clock implementation, and timezone factory

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

The framework provider wires three main stacks:

- HTTP (via ``HttpServiceProvider``)
- Event-dispatching (via ``EventDispatcherServiceProvider``)
- Clock/time utilities (via ``ClockServiceProvider``)

Packages such as ``fast-forward/config``, ``fast-forward/defer``, ``fast-forward/fork``, and
``fast-forward/iterators`` remain available through Composer autoloading and can be introduced
into your application as needed.
