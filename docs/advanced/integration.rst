Integration
===========

Fast Forward Framework is intentionally small and integrates best when you treat it as a bootstrap
layer for the rest of your application.

Integrate with the Fast Forward container
----------------------------------------

The recommended integration path is the ``container()`` helper from ``fast-forward/container``.

.. code-block:: php

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use function FastForward\Container\container;

   $container = container(new FrameworkServiceProvider());

Integrate through configuration
-------------------------------

When you want your provider list to live in configuration, you can pass a config object into the
container helper:

.. code-block:: php

   use App\ServiceProvider\AppServiceProvider;
   use FastForward\Config\ArrayConfig;
   use FastForward\Container\ContainerInterface;
   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use function FastForward\Container\container;

   $config = new ArrayConfig([
       ContainerInterface::class => [
           FrameworkServiceProvider::class,
           AppServiceProvider::class,
       ],
   ]);

   $container = container($config);

This keeps environment-specific providers in one place and works well with the rest of the
configuration package.

HTTP runtime versus CLI runtime
-------------------------------

The framework provider registers ``Psr\Http\Message\ServerRequestInterface`` by calling
``fromGlobals()`` through the downstream HTTP factory provider. That is convenient in web
contexts, but it also means you should be deliberate in CLI commands and automated tests.

For CLI or tests, prefer explicit request creation:

.. code-block:: php

   use Psr\Http\Message\RequestFactoryInterface;

   $requestFactory = $container->get(RequestFactoryInterface::class);
   $request = $requestFactory->createRequest('GET', 'https://example.test/health');

PSR-oriented application services
---------------------------------

Because the container exposes PSR interfaces, your application code can type-hint the standard
contracts instead of framework-specific implementations:

.. code-block:: php

   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\ResponseFactoryInterface;

   final readonly class StatusPageAction
   {
       public function __construct(
           private ClientInterface $client,
           private ResponseFactoryInterface $responseFactory,
       ) {}
   }

This keeps your domain services portable even when you rely on the Fast Forward ecosystem for
bootstrap and defaults.
