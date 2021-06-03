<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutboundMain;
use App\Models\OutboundPerson;
use Auth;

class OutboundController extends Controller
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
    
    public function getOutbound()
    {
        $user_id = Auth::user()->id;

        $data = [];
        $outboundMains = OutboundMain::where('user', $user_id)
                                    ->get();

        foreach ($outboundMains as $outboundMain) {
            $outboundPersons = OutboundPerson::where('o_id', $outboundMain->id)
                                            ->get();
            $temp = new \stdClass();
            $temp->main = $outboundMain;
            $temp->persons = $outboundPersons;
            $data[] = $temp;
        }

        $nl_outbound_class = 'active';
        
        $actions = getActions();
        $steps = getSteps();

        return view('pages.outbound', compact('data', 'actions', 'steps', 'nl_outbound_class'));
    }

    public function saveOutboundMain(Request $request)
    {
        $id = storeOutboundMain($request);
        
        return response()->json([
            'id' => $id
        ]);
    }

    public function saveOutboundPerson(Request $request)
    {
        $id = storeOutboundPerson($request);
        
        return response()->json([
            'id' => $id
        ]);
    }

    public function removeOutboundMain(Request $request)
    {
        $result = deleteOutboundMain($request->id);
        
        return response()->json([
            'result' => $result
        ]);
    }

    public function removeOutboundPerson(Request $request)
    {
        $result = deleteOutboundPerson($request->id);
        
        return response()->json([
            'result' => $result
        ]);
    }

    public function downloadPersons(Request $request)
    {
        $oId = $request->id;
        $outbound = OutboundMain::where('id', $oId)
                            ->get()
                            ->first();
        
        $fileName = $outbound->account_name . '.csv';

        $persons = OutboundPerson::where('o_id', $oId)
                            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('First Name', 'Last Name', 'Title', 'Phone', 
                        'Mobile', 'Email', 'Calls', 'Result',
                        'LI Connected', 'Notes', 'LI Address'
                    );
        $callback = function() use($persons, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($persons as $person) {
                $row['First Name']  = $person->first_name;
                $row['Last Name']  = $person->last_name;
                $row['Title']  = $person->title;
                $row['Phone']  = $person->phone;
                $row['Mobile']  = $person->mobile;
                $row['Email']  = $person->email;
                $row['Calls']  = $person->calls;
                $row['Result']  = $person->result;
                $row['LI Connected']  = $person->li_connected;
                $row['Notes']  = $person->notes;
                $row['LI Address']  = $person->li_address;
                
                fputcsv($file, array(
                                    $row['First Name'], $row['Last Name'], $row['Title'],
                                    $row['Phone'], $row['Mobile'], $row['Email'],
                                    $row['Calls'], $row['Result'], $row['LI Connected'],
                                    $row['Notes'], $row['LI Address']
                                )
                            );
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function uploadPersons(Request $request)
    {
        $oId = $request->id;
        $file = $request->file('upload-file');

        $uploadedRowCount = 0;
        if ($file) {
            if (($handle = fopen($file, "r")) !== FALSE) {
                $header = true;
                while ($csvLine = fgetcsv($handle, 1000, ",")) {
                    if ($header) {
                        $header = false;
                    } else {
                        $person = new OutboundPerson();
                        $person->o_id = $oId;
                        $person->first_name = $csvLine[0];
                        $person->last_name = $csvLine[1];
                        $person->title = $csvLine[2];
                        $person->phone = $csvLine[3];
                        $person->mobile = $csvLine[4];
                        $person->email = $csvLine[5];
                        $person->calls = $csvLine[6];
                        $person->result = $csvLine[7];
                        $person->li_connected = $csvLine[8];
                        $person->notes = $csvLine[9];
                        $person->li_address = $csvLine[10];
                        $person->save();

                        $uploadedRowCount++;
                    }
                }
            }
        }

        $persons = getOutboundPersonsAsArray($oId);

        return response()->json([
            'uploadedRowCount' => $uploadedRowCount,
            'persons' => $persons
        ]);
    }

    public function saveTask(Request $request)
    {
        $action             = $request->action;
        $step               = $request->step;
        $person_account     = $request->person_account;
        $opportunity        = $request->opportunity;
        $note               = $request->note;
        $by_date            = $request->by_date;
        $priority           = $request->priority;

        $task = storeTask($action, $step, $person_account, $opportunity, $note, $by_date, $priority);

        return response()->json([
            'taskID' => $task->id
        ]);
    }
}