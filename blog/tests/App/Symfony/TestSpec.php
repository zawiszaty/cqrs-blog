<?php

declare(strict_types=1);

namespace tests\App\Symfony;

use App\Symfony\Test;
use PhpSpec\ObjectBehavior;

class TestSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Test::class);
    }
}
