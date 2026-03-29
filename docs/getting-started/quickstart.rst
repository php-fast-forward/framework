Quickstart
==========

After installing the framework, you can start building your application by registering the `FrameworkServiceProvider` in your container:

.. code-block:: php

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
   use FastForward\Container\Container;

   $container = new Container([
       new FrameworkServiceProvider(),
   ]);

This will aggregate all core service providers and initialize your application infrastructure.
