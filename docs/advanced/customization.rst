Customization
=============

The framework package is intentionally small, so customization mostly happens by composing extra
providers around ``FrameworkServiceProvider``.

Add your own provider
---------------------

Register your application provider after the framework provider:

.. code-block:: php

   use App\ServiceProvider\AppServiceProvider;
   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use function FastForward\Container\container;

   $container = container(
       new FrameworkServiceProvider(),
       new AppServiceProvider(),
   );

This keeps the framework defaults while giving your application room to add domain-specific
services.

Override an existing service identifier
---------------------------------------

``AggregateServiceProvider`` merges factory arrays in provider order. In practice, that means a
later provider can replace an earlier factory when both use the same service identifier.

This is the simplest override strategy when you want to swap a default implementation entirely.

Decorate an existing service with extensions
--------------------------------------------

If you want to wrap an existing service instead of replacing it, use provider extensions:

.. code-block:: php

   use Interop\Container\ServiceProviderInterface;
   use Psr\Container\ContainerInterface;
   use Psr\Http\Client\ClientInterface;

   final class DecoratorServiceProvider implements ServiceProviderInterface
   {
       public function getFactories(): array
       {
           return [];
       }

       public function getExtensions(): array
       {
           return [
               ClientInterface::class => static function (
                   ContainerInterface $container,
                   ClientInterface $client,
               ): ClientInterface {
                   return new LoggingClient($client);
               },
           ];
       }
   }

The aggregate provider composes extensions in order, so later decorators wrap earlier ones.
Replace ``LoggingClient`` with your own decorator implementation.

Documented limitations
----------------------

- This package does not define framework-specific aliases or facades of its own.
- The convenience aliases and helper factories live in the downstream HTTP factory package.
- Listener registration for the event-dispatcher stack is driven by the
  ``Psr\EventDispatcher\ListenerProviderInterface`` configuration entry.
- If you need additional providers for config-driven applications, register them explicitly or
  list them in ``FastForward\Container\ContainerInterface::class`` inside your config object.

Customize event listener registration
-------------------------------------

You can extend the framework's event behavior without replacing the framework provider itself:

.. code-block:: php

   use FastForward\Config\ArrayConfig;
   use FastForward\Container\ContainerInterface;
   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use Psr\EventDispatcher\ListenerProviderInterface;
   use function FastForward\Container\container;

   $config = new ArrayConfig([
       ContainerInterface::class => [
           FrameworkServiceProvider::class,
       ],
       ListenerProviderInterface::class => [
           SendWelcomeEmailListener::class,
           AuditTrailListenerProvider::class,
       ],
   ]);

   $container = container($config);

This lets you mix invokable listeners, subscriber classes, attributed listeners, and custom
listener-provider implementations without replacing the framework's default dispatcher wiring.

Good customization defaults for new projects
--------------------------------------------

1. Start with ``FrameworkServiceProvider`` only.
2. Add one application provider for your own services.
3. Reach for overrides only after you know which service identifier you need to replace.
4. Use extensions when you want to decorate behavior instead of rewriting the original factory.
