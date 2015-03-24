<?php namespace Triga\Http\Controllers;

use Illuminate\View\Factory as ViewFactory;

/**
 * Base AppController.
 *
 * @package Triga\Http\Controllers
 */
class AppController extends Controller
{

    /**
     * @var string Layout to be used.
     */
    protected $layout = '_layouts.base';

    /**
     * @var ViewFactory
     */
    protected $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * Renders the layout using passed vars.
     *
     * @param array $vars
     * @return \Illuminate\View\View
     */
    protected function render(array $vars = null)
    {
        return $this->view->make($this->layout, $vars);
    }

}
