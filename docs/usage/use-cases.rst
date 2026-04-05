Use Cases
=========

This page shows common scenarios for the metapackage. The goal is to help you distinguish
between:

- services resolved from the container by ``FrameworkServiceProvider``
- installed libraries that you use directly through Composer autoloading

Bootstrap an application container
----------------------------------

.. code-block:: php

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use function FastForward\Container\container;

   $container = container(new FrameworkServiceProvider());

This is the default starting point for web applications and small prototypes.

Register your application services next to the framework
--------------------------------------------------------

.. code-block:: php

   use App\ServiceProvider\AppServiceProvider;
   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use function FastForward\Container\container;

   $container = container(
       new FrameworkServiceProvider(),
       new AppServiceProvider(),
   );

The later provider can add new services or override existing ones when it uses the same
service identifiers.

Drive container setup from configuration
----------------------------------------

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

This pattern is helpful when you want environment-specific provider lists or a central config file.

Use the additional installed packages directly
----------------------------------------------

The metapackage also installs useful runtime libraries that are not registered automatically by
``FrameworkServiceProvider``.

Configuration example:

.. code-block:: php

   use function FastForward\Config\config;

   $appConfig = config([
       'app' => [
           'name' => 'Demo',
           'debug' => true,
       ],
   ]);

   $debug = $appConfig->get('app.debug');

Deferred cleanup example:

.. code-block:: php

   use function FastForward\Defer\defer;

   $cleanup = defer();
   $cleanup(static fn() => print "Closing resources\n");

Iterator utility example:

.. code-block:: php

   use FastForward\Iterator\ChunkedIteratorAggregate;

   foreach (new ChunkedIteratorAggregate(range(1, 6), 2) as $chunk) {
       // [1, 2], [3, 4], [5, 6]
   }

Parallel CLI workload example:

.. code-block:: php

   use FastForward\Fork\Manager\ForkManager;
   use FastForward\Fork\Worker\WorkerInterface;

   $manager = new ForkManager();

   $workers = $manager->fork(
       static fn(WorkerInterface $worker): int => 0,
       2,
   );

   $workers->wait();

.. warning::

   ``fast-forward/fork`` is meant for Unix-like CLI environments with ``pcntl`` and ``posix``
   support. It is not a feature you should expect to work inside a regular PHP-FPM web request.
