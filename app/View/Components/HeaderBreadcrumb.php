<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class HeaderBreadcrumb extends Component
{
    
    public $header;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header)
    {
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.header-breadcrumb');
    }

    public function boot()
    {
        Blade::component('header-breadcrumb', HeaderBreadcrumb::class);
    }
}
