.. Fast Forward Framework documentation master file
   See https://www.sphinx-doc.org/en/master/usage/restructuredtext/directives.html#directive-toctree

Documentation
=============

.. image:: _static/mascot.png
   :alt: Fast Forward Framework mascot
   :align: center
   :width: 220px

**Fast Forward Framework** is the metapackage entry point for the Fast Forward ecosystem.
It installs the core libraries you are most likely to need first and exposes a single
``FrameworkServiceProvider`` that bootstraps the HTTP and event-dispatcher stacks inside a
Fast Forward container.

This package is especially useful when you want one Composer dependency that gives you:

- a PSR-11 friendly container workflow
- the Fast Forward HTTP and event-dispatcher service-provider stacks
- access to supporting packages such as configuration, deferred callbacks, iterators, and process tools

What this package does
----------------------

- Installs the main Fast Forward runtime packages in one step.
- Provides ``FastForward\Framework\ServiceProvider\FrameworkServiceProvider`` as the local bootstrap class.
- Aggregates ``FastForward\Http\ServiceProvider\HttpServiceProvider`` and
  ``FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider``.

What this package does not do
-----------------------------

- It does not generate a full application skeleton or project structure.
- It does not register every installed package in the container automatically.
- It does not replace the package-level documentation of ``fast-forward/http``,
  ``fast-forward/event-dispatcher``, ``fast-forward/config``, or the other ecosystem libraries.

If you are new to the ecosystem, start with :doc:`getting-started/installation` and then move to
:doc:`getting-started/quickstart`.

Useful Links
------------

- `GitHub Repository <https://github.com/php-fast-forward/framework>`_
- `Packagist <https://packagist.org/packages/fast-forward/framework>`_
- `Issue Tracker <https://github.com/php-fast-forward/framework/issues>`_
- `Coverage Report <https://php-fast-forward.github.io/framework/coverage/index.html>`_
- `Metrics Report <https://php-fast-forward.github.io/framework/metrics/index.html>`_
- `Testdox Report <https://php-fast-forward.github.io/framework/coverage/testdox.html>`_

.. toctree::
   :maxdepth: 2
   :caption: Contents:

   getting-started/index
   usage/index
   advanced/index
   api/index
   links/index
   faq
   compatibility
