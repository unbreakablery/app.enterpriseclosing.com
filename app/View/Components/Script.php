<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Script extends Component
{
    public $main = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($scriptMain)
    {
        $this->main = $scriptMain;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.script');
    }
}
