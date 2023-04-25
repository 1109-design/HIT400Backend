<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintHistory;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        return 'okay';
        return view('mushandirapamwe.home');
    }

    public function viewAllComplaints($status)
    {
        return view('mushandirapamwe.view-complaints', compact('status'));


    }

    public function locationsOverview()
    {
        $complaints =Complaint::select('id','latitude', 'longitude', 'status')->get();


        return view('reports.locations-overview', compact('complaints'));
    }

    public function updateStatus(Request $request)
    {
        try {
            Complaint::whereId(request('complaint-id'))->update([
                'status' => request('status')
            ]);
            if (request('comments') != null) {
                $history = new ComplaintHistory();
                $history->complaint_id = request('complaint-id');
                $history->description = request('comments');
                $history->save();

            }


            return back()->with('success', 'Complaint'.' '.request('complaint-id').' '.'Updated Successfully');


        } catch (\Exception $exception) {
            return back()->with('error', 'Failed to update');
        }
//        return $request->all();

    }

    public function complaintLocation($complaintId)
    {
       $complaint = Complaint::whereId($complaintId)->first();
//       dd($complaint);
        $latitude = $complaint->latitude;
        $longitude = $complaint->longitude;
        $status = $complaint->status;


        return view('mushandirapamwe.complaint-location', compact('latitude', 'longitude', 'status', 'complaintId'));
    }


}

