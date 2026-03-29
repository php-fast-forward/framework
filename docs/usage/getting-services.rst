Getting Services
===============

Once the `FrameworkServiceProvider` is registered, you can retrieve services from the container as needed:

.. code-block:: php

   $httpHandler = $container->get(RequestFactoryInterface::class);

Refer to the documentation of each core package for available service names and usage details.
