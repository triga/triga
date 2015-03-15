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
		$columns = [
            'email',
        ];

        var_dump($dataGrid->make($columns, 'users'));
        die;
	}

}
