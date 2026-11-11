
Aggregates core framework service providers into a unified service provider.

This class MUST be used to encapsulate all foundational service providers
required to initialize the application container.

This class SHALL implement the ServiceProviderInterface and MUST delegate
its service discovery responsibilities to an internal AggregateServiceProvider.

***

* Full name: `\FastForward\Framework\ServiceProvider\FrameworkServiceProvider`
* Parent class: [`AggregateServiceProvider`](../../Container/ServiceProvider/AggregateServiceProvider)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* \FastForward\Container\ServiceProvider\AggregateServiceProvider - for composing multiple service providers into one
* \FastForward\Http\ServiceProvider\HttpServiceProvider - for HTTP handling and middleware support
* \FastForward\EventDispatcher\ServiceProvider\EventDispatcherServiceProvider - for PSR-14 and Symfony-compatible event dispatching
* \FastForward\Clock\ServiceProvider\ClockServiceProvider - for time and scheduling utilities

## Methods

### __construct

Creates a new FrameworkServiceProvider instance.

```php
public __construct(): mixed
```

This constructor MUST initialize the aggregate service provider using
a composition of essential framework service providers.

***
