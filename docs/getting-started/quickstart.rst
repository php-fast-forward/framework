Quickstart
==========

The fastest way to start is to build a Fast Forward container and register the
``FrameworkServiceProvider``.

Minimal bootstrap
-----------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use FastForward\Http\Message\Factory\ResponseFactoryInterface;
   use Psr\EventDispatcher\EventDispatcherInterface;
   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\ServerRequestInterface;

   use function FastForward\Container\container;

   require_once __DIR__ . '/../vendor/autoload.php';

   $container = container(FrameworkServiceProvider::class);

   $request = $container->get(ServerRequestInterface::class);
   $responseFactory = $container->get(ResponseFactoryInterface::class);
   $client = $container->get(ClientInterface::class);
   $dispatcher = $container->get(EventDispatcherInterface::class);

   $response = $responseFactory->createResponseFromPayload([
       'method' => $request->getMethod(),
       'path' => $request->getUri()->getPath(),
       'http_client_ready' => $client::class,
       'event_dispatcher_ready' => $dispatcher::class,
   ]);

   // $response is now a PSR-7 response ready to be returned by your application.

What this bootstrap gives you
-----------------------------

- ``ServerRequestInterface`` resolved from the current PHP globals.
- ``FastForward\Http\Message\Factory\ResponseFactoryInterface`` for JSON, HTML, text, redirect, and empty responses.
- ``Psr\Http\Client\ClientInterface`` backed by Symfony's PSR-18 client integration.
- ``Psr\EventDispatcher\EventDispatcherInterface`` for PSR-14 event dispatching.

Why the helper looks like this
------------------------------

The container entry point comes from ``fast-forward/container`` as the ``container()`` helper
function:

.. code-block:: php

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;

   use function FastForward\Container\container;

   $container = container(FrameworkServiceProvider::class);

This is the preferred documented bootstrap for this repository because the installed container
package exposes the helper function and ``ContainerInterface``, not a ``Container`` class.
