<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $path = $_SERVER['PATH_INFO'];
        $path_exploded = explode('/', $path);
        // $better_path = array_slice($path_exploded, 1);
        $path_exploded[0] = 'Home';
        $this->url = $path_exploded;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
