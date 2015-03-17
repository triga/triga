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

    function it_sets_query_sorting()
    {
        $this->beConstructedWith([
            'email',
        ], 'users');

        $this->setSortingColumn('name');
        $this->setSortingDirection('desc');

        $this->getQuery()->shouldReturn('SELECT email FROM users ORDER BY name DESC');
    }

    function it_allows_only_proper_sorting()
    {
        $this->beConstructedWith([
            'email',
        ], 'users');

        $this->setSortingColumn('name');

        $this->shouldThrow('\InvalidArgumentException')->during('setSortingDirection', ['foo']);
    }
}
