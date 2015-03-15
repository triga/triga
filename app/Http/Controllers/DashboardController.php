<?php namespace Triga\Http\Controllers;

use Triga\Http\Requests;

use Illuminate\Http\Request;

class DashboardController extends AppController
{

    /**
     * @return Response
     */
    public function index()
    {
        return $this->render();
    }

}
