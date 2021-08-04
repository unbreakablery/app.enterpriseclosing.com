<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Opportunity extends Component
{
    public $main = null;
    public $ifs = null;
    public $tasks = null;
    public $meddpicc = null;
    public $salesStages = null;
    public $orgCharts = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($opportunityMain,
                                $opportunityIfs,
                                $opportunityTasks,
                                $opportunityMeddpicc,
                                $opportunitySalesStages,
                                $opportunityOrgCharts)
    {
        $this->main = $opportunityMain;
        $this->ifs = $opportunityIfs;
        $this->tasks = $opportunityTasks;
        $this->meddpicc = $opportunityMeddpicc;
        $this->salesStages = $opportunitySalesStages;
        $this->orgCharts = $opportunityOrgCharts;
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
