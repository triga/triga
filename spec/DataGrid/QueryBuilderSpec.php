<?php

namespace spec\Source\DataGrid;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueryBuilderSpec extends ObjectBehavior
{
    function it_should_format_base_query()
    {
        $this->beConstructedWith([
            'email',
        ], 'users');

        $this->getQuery()->shouldReturn('SELECT email FROM users');
    }
}
