<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertBootstrap extends Component
{
    public $status;
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status, $message)
    {
        $this->status   = $status;
        $this->message  = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert-bootstrap');
    }
}
