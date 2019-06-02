<?php

namespace tests\App\Symfony;

use App\Symfony\Test;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Test::class);
    }
}
