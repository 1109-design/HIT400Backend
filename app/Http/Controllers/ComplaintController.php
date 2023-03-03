<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    //

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        //add a neural network analyze the complaint description
        try {
            $yes = 0;
            $complaint = Complaint::create($request->json()->all());
            return response()->json([
                "code" => 200,
                "message" => request('full_name')
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "code" => 500,
                "message" => $exception->getMessage()

            ]);
        }
    }

    public function retrieveComplaints()
    {
        $complaints = Complaint::orderBy('id', 'desc')->get();
        return response()->json($complaints);
    }
    public function markAsResolved($complaintId)
    {
        try {
            Complaint::where('id', $complaintId)->update(['status' => 'Resolved']);
            return response()->json([
                "code" => 200,
                "message" => 'Updated successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "code" => 500,
                "message" => $exception->getMessage()

            ]);
        }
    }
}
