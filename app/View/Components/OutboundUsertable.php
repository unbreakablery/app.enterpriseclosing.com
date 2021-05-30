<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OutboundUsertable extends Component
{
    public $main = null;
    public $persons = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($outboundMain, $outboundPersons)
    {
        $this->main = $outboundMain;
        $this->persons = $outboundPersons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.outbound-usertable');
    }
}
