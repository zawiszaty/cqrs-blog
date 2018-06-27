<?php

namespace spec\App\Factory;

use PhpSpec\ObjectBehavior;

class CategoryFactorySpec extends ObjectBehavior
{
    function it_create_category_object_static()
    {
        $category = $this::create('test');
        $category->getName()->shouldReturn('test');
    }
}
