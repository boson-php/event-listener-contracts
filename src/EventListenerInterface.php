<?php

declare(strict_types=1);

namespace Boson\Contracts\EventListener;

use Boson\Contracts\EventListener\Subscription\CancellableSubscriptionInterface;
use Boson\Contracts\EventListener\Subscription\SubscriptionInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

interface EventListenerInterface extends ListenerProviderInterface
{
    /**
     * Adds an event listener that listens on the specified events.
     *
     * @template TArgEvent of object
     *
     * @param class-string<TArgEvent> $event the event (class) name
     * @param callable(TArgEvent):void $listener the listener callback
     *
     * @return CancellableSubscriptionInterface<TArgEvent>
     */
    public function addEventListener(string $event, callable $listener): CancellableSubscriptionInterface;

    /**
     * Removes an event listener from the specified events.
     *
     * @param CancellableSubscriptionInterface<object> $subscription an event subscription token
     */
    public function removeEventListener(SubscriptionInterface $subscription): void;

    /**
     * Removes an event listeners from the specified event class/name.
     *
     * @param class-string|object $event
     */
    public function removeListenersForEvent(object|string $event): void;

    /**
     * @template TArgEvent of object
     *
     * @param class-string<TArgEvent>|TArgEvent $event
     *
     * @return iterable<array-key, callable(TArgEvent):void> An iterable (array,
     *         iterator, or generator) of callables. Each callable MUST be
     *         type-compatible with $event.
     */
    public function getListenersForEvent(object|string $event): iterable;
}
