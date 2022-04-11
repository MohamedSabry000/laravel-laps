<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $message;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
