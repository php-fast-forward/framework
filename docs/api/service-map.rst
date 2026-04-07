Service Map
===========

This page connects the single local framework class to the wider set of services and helper entry
points installed by the metapackage.

Framework-level classes and providers
-------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 40 25 35

   * - Identifier or class
     - Source
     - Responsibility
   * - ``FastForward\Framework\ServiceProvider\FrameworkServiceProvider``
     - This package
     - Main bootstrap provider for the framework metapackage
   * - ``FastForward\Http\ServiceProvider\HttpServiceProvider``
     - ``fast-forward/http``
     - Aggregates HTTP message-factory and HTTP client providers
   * - ``FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider``
     - ``fast-forward/event-dispatcher``
     - Registers the PSR-14 dispatcher, Symfony contracts alias, and listener-provider services
   * - ``FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider``
     - ``fast-forward/http-factory``
     - Registers PSR-17 factories, convenience factories, and ``ServerRequestInterface``
   * - ``FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider``
     - ``fast-forward/http-client``
     - Registers the PSR-18 client and Symfony HttpClient entry point
   * - ``FastForward\EventDispatcher\EventDispatcher``
     - ``fast-forward/event-dispatcher``
     - Concrete dispatcher implementation behind the PSR-14 and Symfony contracts interfaces
   * - ``FastForward\Clock\ServiceProvider\ClockServiceProvider``
     - ``fast-forward/clock``
     - Registers the PSR-20 clock, a system clock implementation, and timezone factory

Installed entry points outside the framework provider
-----------------------------------------------------

These classes and functions are worth knowing because they are installed together with the
framework package, even though they are not auto-registered by ``FrameworkServiceProvider``.

.. list-table::
   :header-rows: 1
   :widths: 34 26 40

   * - Entry point
     - Package
     - Typical use
   * - ``FastForward\Container\container()``
     - ``fast-forward/container``
     - Build a composed container from service providers, config objects, and PSR-11 containers
   * - ``FastForward\Config\ArrayConfig`` and ``FastForward\Config\config()``
     - ``fast-forward/config``
     - Store and load configuration with dot-notation access
   * - ``FastForward\Defer\Defer`` and ``FastForward\Defer\defer()``
     - ``fast-forward/defer``
     - Register scope-bound cleanup callbacks
   * - ``FastForward\Fork\Manager\ForkManager``
     - ``fast-forward/fork``
     - Run parallel workers in supported CLI environments
   * - ``FastForward\Iterator\ChunkedIteratorAggregate``
     - ``fast-forward/iterators``
     - Process iterable data in chunks

How to read this map
--------------------

- If you need container-resolved HTTP or event services, start with ``FrameworkServiceProvider``.
- If you need configuration, deferred callbacks, iterators, or process tools, use those packages
  directly through their own APIs.
- If you want to add more services into the container, register your own service provider after the
  framework provider.
