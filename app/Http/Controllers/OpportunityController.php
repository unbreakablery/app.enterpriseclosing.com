<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpportunityMain;
use App\Models\OpportunityMeddpicc;
use App\Models\OpportunitySetting;
use App\Models\OpportunityOrgChart;
use App\Models\OpportunityJppSoe;
use App\Models\Task;
use Auth;

class OpportunityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getOpportunities()
    {
        $user_id = Auth::user()->id;

        $data = [];
        $oppMains = OpportunityMain::where('user', $user_id)
                                    ->get();

        foreach ($oppMains as $oppMain) {
            $oppMeddpicc = OpportunityMeddpicc::where('opp_id', $oppMain->id)
                                            ->get()
                                            ->first();
            $tasks = Task::where([
                                    ['tasks.status', '=', '0'],
                                    ['tasks.user', '=', Auth::user()->id],
                                    ['tasks.opportunity', '=', $oppMain->id]
                                ])
                            ->join('actions', 'actions.id', '=', 'tasks.action')
                            ->join('steps', 'steps.id', '=', 'tasks.step')
                            ->leftJoin('opportunities_main', 'opportunities_main.id', '=', 'tasks.opportunity')
                            ->select('tasks.*', 'actions.name AS action_name', 'steps.name AS step_name', 'opportunities_main.opportunity AS opportunity_name')
                            ->orderBy('by_date', 'ASC')
                            ->get()
                            ->all();

            $temp = new \stdClass();
            $temp->main = $oppMain;
            $temp->tasks = $tasks;
            $temp->meddpicc = $oppMeddpicc;
            $temp->salesStages = OpportunitySetting::from('opportunities_settings AS os')
                                    ->where([
                                                ['os.user', '=', Auth::user()->id],
                                                ['os.o_key', '=', 'sales-stage']
                                            ])
                                    ->where(function($query) {
                                                $query->where('os.o_value1', '=', 1)
                                                    ->orWhere('os.o_value2', '=', 1);
                                            })
                                    ->leftJoin('opportunities_sales_stage AS oss', function($join) use ($oppMain) {
                                                $join->on('oss.ss_id', '=', 'os.id')
                                                    ->where('oss.opp_id', '=', $oppMain->id);
                                            })
                                    ->orderBy('os.o_value3', 'ASC')
                                    ->orderBy('os.id', 'ASC')
                                    ->select('os.id', 'os.o_value AS ssn', 'os.o_value1 AS ssi', 'os.o_value2 AS ssp', 'oss.weak', 'oss.normal', 'oss.strong', 'oss.progress')
                                    ->get()
                                    ->all();

            $temp->orgCharts = OpportunityOrgChart::where('opp_id', $oppMain->id)
                                    ->orderBy('order', 'ASC')
                                    ->get()
                                    ->all();

            $temp->jppSoes = OpportunityJppSoe::where('opp_id', $oppMain->id)
                                    ->orderBy('no', 'ASC')
                                    ->get()
                                    ->all();
            $data[] = $temp;
        }

        $actions = getActionsForCurrentUser();
        $steps = getStepsForCurrentUser();

        $opportunityIfs = getOppInputFields();

        $nl_opportunities_class = 'active';
        // dd($data);

        return view('pages.opportunities',
                    compact(
                            'data',
                            'actions',
                            'steps',
                            'opportunityIfs',
                            'nl_opportunities_class'
                    )
                );
    }

    public function saveOpportunityMain(Request $request)
    {
        $id = storeOpportunityMain($request);
        
        return response()->json([
            'id' => $id
        ]);
    }

    public function updateOpportunityMain(Request $request)
    {
        $id = storeOpportunityMain($request);
        
        return redirect(url()->previous())->withInput();
    }

    public function saveOpportunityMeddpicc(Request $request)
    {
        $id = storeOpportunityMeddpicc($request);
        
        return redirect(url()->previous())->withInput();
    }

    public function saveTask(Request $request)
    {
        $action             = $request->action;
        $step               = $request->step;
        $person_account     = $request->person_account;
        $opportunity        = empty($request->opportunity) ? 0 : $request->opportunity;
        $note               = $request->note;
        $by_date            = $request->by_date;
        $priority           = $request->priority;

        $task = storeTask($action, $step, $person_account, $opportunity, $note, $by_date, $priority);

        // Get suggest settings
        $suggest = new \stdClass();
        $suggest->actions = getActionsForCurrentUser();
        $suggest->old_action = $action;
        $suggest->steps = getSuggestSteps($step);
        $suggest->person_account = (!empty($person_account)) ? $person_account : '';
        $suggest->opportunities = getOpportunities();
        $suggest->old_opportunity = $opportunity;
        $suggest->by_date = $by_date;
        $suggest->priority = $priority;

        return response()->json([
            'taskID' => $task->id,
            'suggest' => $suggest
        ]);
    }

    public function saveOpportunity(Request $request)
    {
        $mainId = storeOpportunityMain($request);
        $meddpiccId = storeOpportunityMeddpicc($request);

        return redirect(url()->previous())->withInput();
    }

    public function removeOrgChart(Request $request)
    {
        $orgChart = deleteOrgChart($request);

        if ($orgChart) {
            return response()->json([
                'success' => true,
                'org_chart' => $orgChart
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function saveOrgChart(Request $request)
    {
        $orgChart = storeOrgChart($request);
        $orgCharts = OpportunityOrgChart::where('opp_id', $request->opp_id)
                                    ->orderBy('order', 'ASC')
                                    ->get();

        if ($orgChart) {
            return response()->json([
                'success' => true,
                'id' => $orgChart->id,
                'orgcharts' => $orgCharts
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function uploadOrgcharts(Request $request)
    {
        $oppId = $request->id;
        $file = $request->file('upload-file');

        $uploadedRowCount = 0;
        if ($file) {
            if (($handle = fopen($file, "r")) !== FALSE) {
                $header = true;
                while ($csvLine = fgetcsv($handle, 1000, ",")) {
                    if ($header) {
                        $header = false;
                    } else {
                        $orgChart = new OpportunityOrgChart();
                        $orgChart->opp_id       = $oppId;
                        $orgChart->order        = $csvLine[0];
                        $orgChart->first_name   = $csvLine[1];
                        $orgChart->last_name    = $csvLine[2];
                        $orgChart->title        = $csvLine[3];
                        $orgChart->email        = $csvLine[4];
                        $orgChart->landline     = $csvLine[5];
                        $orgChart->mobile       = $csvLine[6];
                        $orgChart->role         = getOppDropdownValueByName('org_chart_role', $csvLine[7]);
                        $orgChart->engagement   = getOppDropdownValueByName('org_chart_engagement', $csvLine[8]);
                        $orgChart->notes        = $csvLine[9];
                                                
                        $orgChart->save();

                        $uploadedRowCount++;
                    }
                }
            }
        }

        $orgCharts = OpportunityOrgChart::where('opp_id', $oppId)
                                    ->orderBy('order', 'ASC')
                                    ->get()
                                    ->all();

        return response()->json([
            'uploadedRowCount' => $uploadedRowCount,
            'orgcharts' => $orgCharts
        ]);
    }

    public function downloadOrgcharts(Request $request)
    {
        $oppId = $request->id;
        $opportunity = OpportunityMain::where('id', $oppId)
                            ->get()
                            ->first();
        
        $fileName = 'OrgChart-' . $opportunity->opportunity . '.csv';

        $orgCharts = OpportunityOrgChart::where('opp_id', $oppId)
                            ->orderBy('order', 'ASC')
                            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order', 'First Name', 'Last Name', 
                        'Title', 'Email', 'Landline', 
                        'Mobile', 'Role', 'Engagement', 'Notes'
                    );
        $callback = function() use($orgCharts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($orgCharts as $orgChart) {
                $row['order']       = $orgChart->order;
                $row['first_name']  = $orgChart->first_name;
                $row['last_name']   = $orgChart->last_name;
                $row['title']       = $orgChart->title;
                $row['email']       = $orgChart->email;
                $row['landline']    = $orgChart->landline;
                $row['mobile']      = $orgChart->mobile;
                $row['role']        = getOppDropdownNameByValue('org_chart_role', $orgChart->role);
                $row['engagement']  = getOppDropdownNameByValue('org_chart_engagement', $orgChart->engagement);
                $row['notes']       = $orgChart->notes;
                                
                fputcsv($file, array(
                                    $row['order'], $row['first_name'], $row['last_name'],
                                    $row['title'], $row['email'], $row['landline'],
                                    $row['mobile'], $row['role'], $row['engagement'],
                                    $row['notes']
                                )
                            );
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function saveJppSoe(Request $request)
    {
        $jppSoe = storeJppSoe($request);
        return response()->json([
            'success' => true,
            'id' => $jppSoe->id
        ]);
    }

    public function removeJppSoe(Request $request)
    {
        $jppSoe = deleteJppSoe($request);

        return response()->json([
            'success' => $jppSoe
        ]);
    }

    public function downloadJppSoes(Request $request)
    {
        $oppId = $request->id;
        $opportunity = OpportunityMain::where('id', $oppId)
                            ->get()
                            ->first();
        
        $fileName = 'JppSoE-' . $opportunity->opportunity . '.csv';

        $jppSoes = OpportunityJppSoe::from('opportunities_jpp_soe AS ojs')
                            ->where('opp_id', $oppId)
                            ->leftJoin('opportunities_settings AS os', 'os.id', '=', 'ojs.task_event')
                            ->select('ojs.no', 'ojs.target_date', 'ojs.comments', 
                                    'os.o_value AS task_event', 'ojs.completed', 'ojs.ownership')
                            ->orderBy('ojs.no', 'ASC')
                            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No.', 'Task / Event', 'Ownership', 
                        'Target Date', 'Completed', 'Comments'
                    );
        $callback = function() use($jppSoes, $columns, $opportunity) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($jppSoes as $jppSoe) {
                $row['no']          = $jppSoe->no;
                $row['task_event']  = $jppSoe->task_event;
                $row['ownership']   = '';
                switch ($jppSoe->ownership) {
                    case 1:
                        $row['ownership'] = Auth::user()->organisation;
                        break;
                    case 2:
                        $row['ownership'] = $opportunity->opp_organisation;
                        break;
                    case 3:
                        $row['ownership'] = $opportunity->opp_organisation . ', ' . Auth::user()->organisation;
                        break;
                }
                $row['target_date'] = $jppSoe->target_date;
                $row['completed']   = getOppDropdownNameByValue('jpp_soe_completed', $jppSoe->completed);
                $row['comments']    = $jppSoe->comments;
                                                
                fputcsv($file, array(
                                    $row['no'], $row['task_event'], $row['ownership'],
                                    $row['target_date'], $row['completed'], $row['comments']
                                )
                            );
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
