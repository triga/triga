<?php

namespace spec\Source\DataGrid;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueryBuilderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([
            'email',
        ], 'users');
    }

    function it_should_format_base_query()
    {
        $this->getQuery()->shouldReturn('SELECT email FROM users');
    }

    function it_sets_query_sorting()
    {
        $this->setSortingColumn('name');
        $this->setSortingDirection('desc');

        $this->getQuery()->shouldReturn('SELECT email FROM users ORDER BY name DESC');
    }

    function it_allows_only_proper_sorting()
    {
        $this->setSortingColumn('name');

        $this->shouldThrow('\InvalidArgumentException')->during('setSortingDirection', ['foo']);
    }

    function it_sets_query_limits()
    {
        $this->setSortingColumn('name');
        $this->setSortingDirection('desc');
        $this->setOffset(30);
        $this->setLimit(10);

        $this->getQuery()->shouldReturn('SELECT email FROM users ORDER BY name DESC LIMIT 30,10');
    }
}
