<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Opportunity extends Component
{
    public $main = null;
    public $tasks = null;
    public $meddpicc = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($opportunityMain, $opportunityTasks, $opportunityMeddpicc)
    {
        $this->main = $opportunityMain;
        $this->tasks = $opportunityTasks;
        $this->meddpicc = $opportunityMeddpicc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.opportunity');
    }
}
