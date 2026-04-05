HTTP Services
=============

``FrameworkServiceProvider`` is mainly about making the HTTP stack available quickly. This page
shows the most practical workflows that become possible immediately after registration.

Read the incoming request
-------------------------

``Psr\Http\Message\ServerRequestInterface`` is created from PHP globals by the downstream HTTP
factory provider.

.. code-block:: php

   use Psr\Http\Message\ServerRequestInterface;

   $request = $container->get(ServerRequestInterface::class);

   $method = $request->getMethod();
   $path = $request->getUri()->getPath();

Create framework-friendly responses
-----------------------------------

Fast Forward exposes a convenience response factory in addition to the standard PSR-17 one.

.. code-block:: php

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;

   $responseFactory = $container->get(ResponseFactoryInterface::class);

   $json = $responseFactory->createResponseFromPayload([
       'status' => 'ok',
   ]);

   $html = $responseFactory->createResponseFromHtml('<h1>Hello</h1>');
   $text = $responseFactory->createResponseFromText('Plain text output');
   $redirect = $responseFactory->createResponseRedirect('/login');
   $empty = $responseFactory->createResponseNoContent();

Create streams explicitly
------------------------

When you need to attach files or construct response bodies manually, resolve the stream factory:

.. code-block:: php

   use FastForward\Http\Message\Factory\StreamFactoryInterface;
   use Psr\Http\Message\ResponseFactoryInterface as PsrResponseFactoryInterface;

   $streamFactory = $container->get(StreamFactoryInterface::class);
   $responseFactory = $container->get(PsrResponseFactoryInterface::class);

   $stream = $streamFactory->createStreamFromFile(__DIR__ . '/report.csv');

   $response = $responseFactory
       ->createResponse(200)
       ->withHeader('Content-Type', 'text/csv')
       ->withBody($stream);

Send an outgoing HTTP request
-----------------------------

The aggregated HTTP client provider exposes a PSR-18 client:

.. code-block:: php

   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\RequestFactoryInterface;

   $requestFactory = $container->get(RequestFactoryInterface::class);
   $client = $container->get(ClientInterface::class);

   $request = $requestFactory->createRequest('GET', 'https://example.com/health');
   $response = $client->sendRequest($request);

Beginner-friendly rule of thumb
-------------------------------

- Use ``Psr\Http\Message\ResponseFactoryInterface`` when you only need a blank PSR-17 response.
- Use ``FastForward\Http\Message\Factory\ResponseFactoryInterface`` when you want the ergonomic
  helpers for JSON, HTML, text, redirects, and empty responses.
