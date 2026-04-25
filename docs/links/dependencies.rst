Dependencies Documentation
=========================

Below are the runtime dependencies installed by ``fast-forward/framework``. The first table is the
most important one for beginners because it separates "installed" from "registered automatically".

Direct runtime packages
-----------------------

.. list-table::
   :header-rows: 1
   :widths: 24 36 20 20

   * - Package
     - Purpose
     - Auto-registered by ``FrameworkServiceProvider``
     - Documentation
   * - ``fast-forward/container``
     - Container composition, autowiring, and service-provider support
     - No
     - `Docs <https://github.com/php-fast-forward/container>`_
   * - ``fast-forward/config``
     - Configuration objects, directory loading, and config-backed container access
     - No
     - `Docs <https://github.com/php-fast-forward/config>`_
   * - ``fast-forward/http``
     - Aggregated HTTP stack for the framework provider
     - Yes
     - `Docs <https://php-fast-forward.github.io/http/>`_
   * - ``fast-forward/event-dispatcher``
     - PSR-14 event dispatching, listener aggregation, and Symfony-contract compatibility
     - Yes
     - `Docs <https://github.com/php-fast-forward/event-dispatcher>`_
   * - ``fast-forward/defer``
     - Deferred callback execution and middleware-friendly cleanup
     - No
     - `Docs <https://github.com/php-fast-forward/defer>`_
   * - ``fast-forward/fork``
     - Parallel worker orchestration for CLI applications
     - No
     - `Docs <https://github.com/php-fast-forward/fork>`_
   * - ``fast-forward/enum``
     - Enum abstractions and value-object helpers for safer domain modeling
     - No
     - `Docs <https://github.com/php-fast-forward/enum>`_
   * - ``fast-forward/iterators``
     - Iterator utilities for chunking, grouping, lookahead, and data traversal
     - No
     - `Docs <https://github.com/php-fast-forward/iterators/tree/main/docs>`_

Notable transitive packages behind the registered stacks
--------------------------------------------------------

``fast-forward/http`` brings in additional libraries that explain many of the service identifiers
you resolve from the container:

.. list-table::
   :header-rows: 1
   :widths: 28 32 40

   * - Package
     - Role
     - Notes
   * - ``fast-forward/http-factory``
     - Registers PSR-17 and Fast Forward response/stream factories
     - This is where ``ResponseFactoryInterface`` and ``StreamFactoryInterface`` come from.
   * - ``fast-forward/http-client``
     - Registers the PSR-18 client
     - Exposes ``Psr\Http\Client\ClientInterface`` backed by Symfony HttpClient.
   * - ``fast-forward/http-message``
     - Provides PSR-7 message implementations and response classes
     - Used by the factory package for JSON, HTML, text, redirect, and empty responses.
   * - ``nyholm/psr7`` and ``nyholm/psr7-server``
     - Underlying PSR-7 implementation and server-request creation
     - Power the PSR-17 aliases and ``ServerRequestInterface`` resolution.
   * - ``symfony/http-client``
     - HTTP transport for outgoing requests
     - Used by the PSR-18 adapter registered in the HTTP client provider.

``fast-forward/event-dispatcher`` also brings in important integration layers:

.. list-table::
   :header-rows: 1
   :widths: 28 32 40

   * - Package
     - Role
     - Notes
   * - ``phly/phly-event-dispatcher``
     - Listener-provider implementations
     - Supplies the aggregate and prioritized listener-provider building blocks.
   * - ``symfony/event-dispatcher-contracts``
     - Symfony contracts bridge
     - Allows the same dispatcher to be resolved through Symfony's dispatcher interface.
   * - ``symfony/event-dispatcher``
     - Optional subscriber and attribute workflow support
     - Install it in your application if you want ``EventSubscriberInterface`` or ``#[AsEventListener]`` usage.

Related standards
-----------------

- `PSR-7: HTTP Message Interfaces <https://www.php-fig.org/psr/psr-7/>`_
- `PSR-11: Container Interface <https://www.php-fig.org/psr/psr-11/>`_
- `PSR-14: Event Dispatcher <https://www.php-fig.org/psr/psr-14/>`_
- `PSR-17: HTTP Factories <https://www.php-fig.org/psr/psr-17/>`_
- `PSR-18: HTTP Client <https://www.php-fig.org/psr/psr-18/>`_
- `RFC 2119 <https://datatracker.ietf.org/doc/html/rfc2119>`_
