<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OppJppSoeRow extends Component
{
    public $row = null;
    public $taskEvents = null;
    public $ownships = null;
    public $completes = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($row)
    {
        $this->row = $row;
        $this->taskEvents = getOppTaskEventsSettings();
        $this->completes  = config('app_setting.opportunities.dropdown_values.jpp_soe_completed');
        
        if (!empty($row)) {
            $this->ownships = getOppJppSoeOwnerships($row->opp_id);
        } else {
            $this->ownships = getOppJppSoeOwnerships();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.opp-jpp-soe-row');
    }
}
