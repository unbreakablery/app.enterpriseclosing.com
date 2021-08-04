<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OppOrgChartRow extends Component
{
    public $row = null;
    public $roles = null;
    public $engagements = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($row)
    {
        $this->row          = $row;
        $this->roles        = config('app_setting.opportunities.dropdown_values.org_chart_role');
        $this->engagements  = config('app_setting.opportunities.dropdown_values.org_chart_engagement');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.opp-org-chart-row');
    }
}
