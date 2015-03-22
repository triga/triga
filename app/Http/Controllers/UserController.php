<?php namespace Triga\Http\Controllers;

use Source\DataGrid\DataGrid;
use Triga\Http\Requests;

class UserController extends AppController {

    /**
     * @param DataGrid $dataGrid
     * @return Response
     */
	public function getIndex(DataGrid $dataGrid)
	{
        $query = \DB::table('users')
            ->select('email', 'id');

        $dataGrid->query($query);

        $dataGrid->filter('email', function($query, $value) {
            $query->where('email', '=', $value);
        });

        $dataGrid->filter('name', function($query, $value) {
            $query->where(function ($q) use ($value) {
                $q->where('name', '=', $value);
                $q->orWhere('lastname', '=', $value);
            });
        });

        $dataGrid->make();
	}

}
