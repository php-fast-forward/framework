Getting Services
===============

Once ``FrameworkServiceProvider`` is registered, the container can resolve the framework provider
itself plus the services exposed by the aggregated HTTP stack.

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

Service retrieval example
-------------------------

.. code-block:: php

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;
   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\RequestFactoryInterface;
   use Psr\Http\Message\ServerRequestInterface;

   $requestFactory = $container->get(RequestFactoryInterface::class);
   $serverRequest = $container->get(ServerRequestInterface::class);
   $responseFactory = $container->get(ResponseFactoryInterface::class);
   $httpClient = $container->get(ClientInterface::class);

   $request = $requestFactory->createRequest('GET', 'https://example.com/health');

.. note::

   ``ServerRequestInterface`` is most useful in HTTP runtimes, because it is created from PHP
   globals. In CLI commands and tests, prefer building requests explicitly with
   ``RequestFactoryInterface`` instead of relying on ambient globals.

For a task-focused walkthrough, continue with :doc:`http-services` and :doc:`use-cases`.
