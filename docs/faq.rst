FAQ
===

What is this package?
---------------------

It is the Fast Forward metapackage. It installs the main ecosystem libraries and provides one
local bootstrap class, ``FastForward\Framework\ServiceProvider\FrameworkServiceProvider``.

Is this a full-stack application skeleton?
------------------------------------------

No. It gives you the package set and the framework service provider, but it does not generate a
project structure, router, console kernel, or deployment setup for you.

Which PHP version is required?
------------------------------

This repository currently requires PHP ``^8.3``.

How do I install it?
--------------------

Run:

.. code-block:: bash

   composer require fast-forward/framework

What does ``FrameworkServiceProvider`` register automatically?
--------------------------------------------------------------

Today it registers the Fast Forward HTTP and event-dispatcher stacks by aggregating
``FastForward\Http\ServiceProvider\HttpServiceProvider`` and
``FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider``.

Are all installed packages automatically available from the container?
---------------------------------------------------------------------

No. ``fast-forward/config``, ``fast-forward/defer``, ``fast-forward/fork``, and
``fast-forward/iterators`` and ``fast-forward/enum`` are installed, but they are not
automatically registered in the container by ``FrameworkServiceProvider``.

How do I build the container?
-----------------------------

Use the helper function from ``fast-forward/container``:

.. code-block:: php

   use FastForward\Framework\ServiceProvider\FrameworkServiceProvider;

   use function FastForward\Container\container;

   $container = container(FrameworkServiceProvider::class);

How do I access the current request?
------------------------------------

Resolve ``Psr\Http\Message\ServerRequestInterface`` from the container. The downstream HTTP factory
provider builds it from PHP globals.

How do I create JSON, HTML, text, or redirect responses?
--------------------------------------------------------

Resolve ``FastForward\Http\Message\Factory\ResponseFactoryInterface`` from the container and use its
convenience methods such as ``createResponseFromPayload()``, ``createResponseFromHtml()``,
``createResponseFromText()``, ``createResponseRedirect()``, and ``createResponseNoContent()``.

How do I dispatch events?
-------------------------

Resolve ``Psr\EventDispatcher\EventDispatcherInterface`` or
``Symfony\Contracts\EventDispatcher\EventDispatcherInterface`` from the container and call
``dispatch($event)``.

How do I register listeners?
----------------------------

Pass a config object into ``container()`` and place your listeners under the
``Psr\EventDispatcher\ListenerProviderInterface`` key. The event-dispatcher package classifies the
configured entries automatically.

Do I need extra dependencies for Symfony subscribers or ``#[AsEventListener]``?
--------------------------------------------------------------------------------

If your application uses ``Symfony\Component\EventDispatcher\EventSubscriberInterface`` or
``#[AsEventListener]`` explicitly, add ``symfony/event-dispatcher`` to your application.

Can I send outgoing HTTP requests?
----------------------------------

Yes. Resolve ``Psr\Http\Client\ClientInterface`` and ``Psr\Http\Message\RequestFactoryInterface``
from the container to create and send PSR-18 requests.

Can I add my own services or override existing ones?
----------------------------------------------------

Yes. Register your own service provider after ``FrameworkServiceProvider``. Later factories can
replace earlier service identifiers, and extensions can decorate existing services.

Can I use the framework package in CLI commands or tests?
---------------------------------------------------------

Yes, but you should create requests explicitly in CLI and test contexts instead of relying on
``ServerRequestInterface`` from globals.

Does ``fast-forward/fork`` work everywhere?
-------------------------------------------

No. It is intended for Unix-like CLI environments that expose ``pcntl`` and ``posix`` support.

Where should I look for package-specific details?
-------------------------------------------------

Start with :doc:`links/dependencies`. When you need deeper detail about one subsystem, continue to
that package's own documentation, especially ``fast-forward/http``,
``fast-forward/event-dispatcher``, ``fast-forward/http-factory``, and ``fast-forward/container``.
