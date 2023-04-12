<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComplaintController extends Controller
{
    //

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        //add a neural network analyze the complaint description
        try {
            $complaint = new Complaint();
            $complaint->full_name = $request->input('full_name');
            $complaint->phone_number = $request->input('phone_number');
            $complaint->category = $request->input('category');
            $complaint->description = $request->input('description');
            $complaint->latitude = $request->input('latitude');
            $complaint->longitude = $request->input('longitude');

            $image = $request->file('complaintImage');
                // Save the file to a directory
            $filename = $image->store('public/images/complaints');
            $complaint->image_url = $filename;

            Log::info($filename);

            $complaint->save();


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

    public function downloadAttachment($id){
        $complaint = Complaint::whereId($id)->first();
        // return $filename;
        // Get the path to the file
        $path = storage_path('app/' . $complaint->image_url);

        // Check if the file exists
        if (!file_exists($path)) {
            abort(404);
        }

        // Set the headers for the download
        $headers = [
            'Content-Type' => 'image/jpeg', // Replace with the appropriate MIME type for your file
            'Content-Disposition' => 'attachment; filename="' . basename($path) . '"',
        ];

        // Return the response with the file contents
        return response()->download($path, basename($path), $headers);


    }
}
