FrameworkServiceProvider
========================

.. php:class:: FastForward\Framework\ServiceProvider\FrameworkServiceProvider

   Aggregates all core service providers required to initialize the application container.

   **Usage:**

   .. code-block:: php

      use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;
      use FastForward\Container\Container;

      $container = new Container([
          new FrameworkServiceProvider(),
      ]);

   **Constructor:**

   .. php:method:: __construct()

      Initializes the aggregate service provider with all essential framework service providers (e.g., HTTP, logging, caching, etc.).

   **Extends:**

   - :php:class:`FastForward\Container\ServiceProvider\AggregateServiceProvider`
