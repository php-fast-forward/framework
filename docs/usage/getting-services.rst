Getting Services
===============

Once ``FrameworkServiceProvider`` is registered, the container can resolve the framework provider
itself plus the services exposed by the aggregated HTTP and event-dispatcher stacks.

Most useful service identifiers
-------------------------------

.. list-table::
   :header-rows: 1
   :widths: 36 64

   * - Service identifier
     - What you get
   * - ``FastForward\Framework\ServiceProvider\FrameworkServiceProvider``
     - The framework aggregate provider instance itself
   * - ``FastForward\Http\ServiceProvider\HttpServiceProvider``
     - The downstream aggregate provider for the HTTP stack
   * - ``FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider``
     - The event-dispatcher provider aggregated directly by the framework
   * - ``Psr\Http\Message\RequestFactoryInterface``
     - A PSR-17 request factory backed by ``Nyholm\Psr7\Factory\Psr17Factory``
   * - ``Psr\Http\Message\ResponseFactoryInterface``
     - A PSR-17 response factory for low-level response creation
   * - ``FastForward\Http\Message\Factory\ResponseFactoryInterface``
     - Fast Forward convenience responses for JSON, HTML, text, redirects, and no-content responses
   * - ``Psr\Http\Message\ServerRequestInterface``
     - The current request created from PHP globals
   * - ``Psr\Http\Message\StreamFactoryInterface``
     - A PSR-17 stream factory
   * - ``FastForward\Http\Message\Factory\StreamFactoryInterface``
     - A Fast Forward stream factory with payload-aware helpers
   * - ``Psr\Http\Client\ClientInterface``
     - A PSR-18 HTTP client
   * - ``Symfony\Component\HttpClient\HttpClient``
     - The Symfony HTTP client entry point used by the PSR-18 adapter
   * - ``Psr\EventDispatcher\EventDispatcherInterface``
     - The PSR-14 dispatcher exposed by ``fast-forward/event-dispatcher``
   * - ``Symfony\Contracts\EventDispatcher\EventDispatcherInterface``
     - The same dispatcher through the Symfony contracts interface
   * - ``Psr\EventDispatcher\ListenerProviderInterface``
     - The aggregate listener provider used to resolve listeners for dispatched events

Service retrieval example
-------------------------

.. code-block:: php

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;
   use Psr\EventDispatcher\EventDispatcherInterface;
   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\RequestFactoryInterface;
   use Psr\Http\Message\ServerRequestInterface;

   $requestFactory = $container->get(RequestFactoryInterface::class);
   $serverRequest = $container->get(ServerRequestInterface::class);
   $responseFactory = $container->get(ResponseFactoryInterface::class);
   $httpClient = $container->get(ClientInterface::class);
   $dispatcher = $container->get(EventDispatcherInterface::class);

   $request = $requestFactory->createRequest('GET', 'https://example.com/health');

.. note::

   ``ServerRequestInterface`` is most useful in HTTP runtimes, because it is created from PHP
   globals. In CLI commands and tests, prefer building requests explicitly with
   ``RequestFactoryInterface`` instead of relying on ambient globals.

.. note::

   Event listeners are typically configured through the
   ``Psr\EventDispatcher\ListenerProviderInterface`` configuration key when you pass a config
   object into ``container()``.

For task-focused walkthroughs, continue with :doc:`http-services`, :doc:`event-dispatching`,
and :doc:`use-cases`.
