Event Dispatching
=================

``FrameworkServiceProvider`` also aggregates
``FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider``. That means the
framework container can resolve a PSR-14 dispatcher immediately, even before you configure any
listeners.

Resolve dispatcher services
---------------------------

.. code-block:: php

   use Psr\EventDispatcher\EventDispatcherInterface;
   use Psr\EventDispatcher\ListenerProviderInterface;
   use Symfony\Contracts\EventDispatcher\EventDispatcherInterface as SymfonyEventDispatcherInterface;

   $dispatcher = $container->get(EventDispatcherInterface::class);
   $symfonyDispatcher = $container->get(SymfonyEventDispatcherInterface::class);
   $listenerProvider = $container->get(ListenerProviderInterface::class);

The PSR-14 and Symfony contracts interfaces resolve to the same dispatcher implementation.

Register listeners through configuration
----------------------------------------

The most practical way to add listeners is to provide them under the
``Psr\EventDispatcher\ListenerProviderInterface`` configuration key.

.. code-block:: php

   use FastForward\Config\ArrayConfig;
   use FastForward\Container\ContainerInterface;
   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use Psr\EventDispatcher\EventDispatcherInterface;
   use Psr\EventDispatcher\ListenerProviderInterface;

   use function FastForward\Container\container;

   final readonly class UserRegistered
   {
       public function __construct(public string $email) {}
   }

   final class SendWelcomeEmailListener
   {
       public function __invoke(UserRegistered $event): void
       {
           echo 'Sending welcome email to ' . $event->email . PHP_EOL;
       }
   }

   $config = new ArrayConfig([
       ContainerInterface::class => [
           FrameworkServiceProvider::class,
       ],
       ListenerProviderInterface::class => [
           SendWelcomeEmailListener::class,
       ],
   ]);

   $container = container($config);
   $dispatcher = $container->get(EventDispatcherInterface::class);

   $dispatcher->dispatch(new UserRegistered('demo@example.com'));

Named events and Symfony subscribers
------------------------------------

If your project uses Symfony subscribers or ``#[AsEventListener]`` attributes, add
``symfony/event-dispatcher`` to your application dependencies.

.. code-block:: php

   use FastForward\Config\ArrayConfig;
   use FastForward\Container\ContainerInterface;
   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use Psr\EventDispatcher\ListenerProviderInterface;
   use Symfony\Component\EventDispatcher\EventSubscriberInterface;
   use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

   use function FastForward\Container\container;

   final readonly class PaymentReceived
   {
       public function __construct(public string $invoiceId) {}
   }

   final class BillingSubscriber implements EventSubscriberInterface
   {
       public static function getSubscribedEvents(): array
       {
           return [
               'billing.payment_received' => 'onPaymentReceived',
           ];
       }

       public function onPaymentReceived(PaymentReceived $event): void
       {
           echo 'Payment confirmed for invoice ' . $event->invoiceId . PHP_EOL;
       }
   }

   $config = new ArrayConfig([
       ContainerInterface::class => [
           FrameworkServiceProvider::class,
       ],
       ListenerProviderInterface::class => [
           BillingSubscriber::class,
       ],
   ]);

   $container = container($config);
   $dispatcher = $container->get(EventDispatcherInterface::class);

   $dispatcher->dispatch(
       new PaymentReceived('INV-2026-0001'),
       'billing.payment_received',
   );

Listener classification rules
-----------------------------

The event-dispatcher integration classifies configured entries automatically:

- invokable listeners and plain callables are routed to the reflection-based listener provider
- Symfony subscribers are routed to the event-subscriber listener provider
- listeners using ``#[AsEventListener]`` are routed to the prioritized listener provider
- custom listener-provider classes are added to the aggregate provider directly
