<?php

namespace spec\App\EventSubscriber;

use App\EventSubscriber\BeforeActionSubscriber;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class BeforeActionSubscriberSpec extends ObjectBehavior
{
    function it_should_return_null(FilterControllerEvent $event)
    {
        $this->convertJsonStringToArray($event)->shouldReturn(null);
    }
}
