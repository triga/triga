<?php namespace Source\DataGrid;

class DataGrid
{

    public function __construct()
    {
    }

    public function make(array $columns, $table)
    {
        var_dump($columns);
        var_dump($table);
        die;
    }
}
