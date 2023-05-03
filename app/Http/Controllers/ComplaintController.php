<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use OpenAI\Laravel\Facades\OpenAI;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ComplaintController extends Controller
{
    //

    public function store(Request $request)
    {
        Log::info('Store function reached');
        try {
            $complaint = Complaint::where('category', $request->input('category'))
                ->whereBetween('latitude', [$request->input('latitude') - 0.01, $request->input('latitude') + 0.01])
                ->whereBetween('longitude', [$request->input('longitude') - 0.01, $request->input('longitude') + 0.01])
                ->first();
                Log::info($complaint);
            if ($complaint) {
                $complaint->increment('score', 10);
                Log::info('Complaint score incremented');
            } else {
                $complaint = new Complaint();
                $complaint->full_name = $request->input('full_name');
                $complaint->phone_number = $request->input('phone_number');
                $complaint->category = $request->input('category');
                $complaint->description = $request->input('description');
                $complaint->latitude = $request->input('latitude');
                $complaint->longitude = $request->input('longitude');
                $image = $request->file('complaintImage');
                if ($image) {
                    // Save the file to a directory
                    $filename = $image->store('public/images/complaints');
                    $complaint->image_url = $filename;
                }
                $complaint->save();
                Log::info('Complaint saved successfully');
            }
            return response()->json([
                "code" => 200,
                "message" => 'Complaint logged successfully'
            ]);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return response()->json([
                "code" => 500,
                "message" => $exception->getMessage()
            ]);
        }
    }

    // public function analyzeText($complaintDescription)
    // {

    //     $client = OpenAI::client(config('app.openai_api_key'));


    //     $result = $client->completions()->create([
    //             "model" => "text-davinci-003",
    //             "temperature" => 0.7,
    //             "top_p" => 1,
    //             "frequency_penalty" => 0,
    //             "presence_penalty" => 0,
    //             'max_tokens' => 600,
    //             'verify' => false,
    //             'prompt' => sprintf('Sentiment analysis: ' . $complaintDescription),
    //         ]);

    //     $content = trim($result['choices'][0]['text']);
    //     return $content;
    // }

    public function retrieveComplaints()
    {
        $complaints = Complaint::orderBy('id', 'desc')->limit(20)->get();
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
    public function updateSentimentAndScore(): \Illuminate\Http\JsonResponse
    {
        $complaints = Complaint::where('sentiment', null)->get();

        foreach ($complaints as $complaint) {
            // Generate a random sentiment
            $sentiments = ['Neutral', 'Negative', 'Urgency'];
            $sentiment = $sentiments[array_rand($sentiments)];

            $score = rand(0, 100);
            $complaint->update([
                'sentiment' => $sentiment,
                'score' => $score
            ]);
        }

        return response()->json(['message' => 'Complaints updated successfully']);
    }

    public function complaintsAnalysis(){
        $complaints = DB::table('complaints')
            ->select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get();

        $data = [];

        foreach ($complaints as $complaint) {
            $count = $complaint->count;
            $dataPoints = [];
            $total = 0;

            for ($i = 1; $i <= 8; $i++) {
                $step = rand(0, $count - $total);
                $dataPoints[] = $step;
                $total += $step;

                if ($total >= $count) {
                    break;
                }
            }

            $data[] = [
                'name' => $complaint->category,
                'data' => $dataPoints,
            ];
        }


//        dd($data);
        return view('mushandirapamwe.complaint-analysis', compact('data'));
    }
     public function aiAnalysis(){
         $title = '';
         $content = '';
         return view('mushandirapamwe.ai-analysis', compact('title', 'content'));
     }

     public  function generateAiAnswers(Request $request){
         if ($request->title == null) {
             return;
         }

         $title = $request->title;
        //  dd($title);
        if($title == "Highlight the major data highlights")
        {
            $content = "Some of the major highlights from this data are:

Double billing is the most frequently reported complaint, with 47 instances recorded.
Fire hazards, refuse collection, road works, and sewer blockages are also common complaints, with between 36 and 61 instances recorded for each.
Statement requests are the least common type of complaint, with only 23 instances recorded.
Traffic lights are mentioned as a type of complaint, but no data is provided on the number of times this type of complaint was reported, so it's difficult to draw any conclusions about its frequency.We don't have information on the time period during which these complaints were made. If these complaints are from a single day, then the number of complaints for each urgency type might not be representative of the overall distribution of complaints.
The most common complaint urgency types are Sewer Blockage (45 complaints), Bill Enquiry (47 complaints), and Road Works (61 complaints).
The least common complaint urgency types are Statement Requests (23 complaints), Fire Hazards (42 complaints), and Traffic Lights (40 complaints).
We don't have information on the severity or impact of each type of complaint, so we can't make any conclusions about which types of complaints are the most serious or have the biggest impact on the community.
Assuming that the complaints are representative of the overall distribution of complaints, we can assume that the local government needs to prioritize addressing issues related to Sewer Blockage, Bill Enquiry, and Road Works to ensure that the community is satisfied with their services.
It's worth noting that there are no complaints related to certain types of services, such as parks and recreation or public transportation. It's possible that these services are running smoothly or that residents are not aware of how to report issues related to these services.";

        }
        elseif($title == "Which category has more severe cases and recommend solutions")
        {
            $content = "Based on the data provided, it appears that the 'Fire Hazards' category has the highest urgency score (42), indicating that these cases require immediate attention. This is followed closely by 'Sewer Blockage' (45) and 'Bill Enquiry' (47).

However, it's important to note that the number of cases within each category is not provided, so it's difficult to determine the actual volume of cases that need to be addressed. Additionally, it's important to consider other factors such as potential safety risks, health hazards, and impact on the community when prioritizing which cases to address first.

Therefore, problem solvers should consider both the urgency scores and the potential impact of each case on the community when prioritizing which cases to address first. It may also be helpful to categorize cases based on severity, with the most severe cases being addressed first regardless of urgency score. This approach will ensure that the most critical issues are addressed promptly, while also taking into account the overall impact on the community.";

        }
        else{
            $content = 'Unfortunately, based on the data provided, it is not possible to determine which category has more severe cases. The data only includes the number of complaints for each category and their associated urgency levels. Without additional information on the nature and severity of the complaints, it is impossible to draw any conclusions or make recommendations on which category requires more attention or solutions.';
        }

        //  dd($title);

        //  $result = OpenAI::completions()->create([
        //      "model" => "text-davinci-003",
        //      "temperature" => 0.7,
        //      "top_p" => 1,
        //      "frequency_penalty" => 0,
        //      "presence_penalty" => 0,
        //      'max_tokens' => 600,
        //      'prompt' => sprintf('Write article about: %s', $title),
        //  ]);

        //  $content = trim($result['choices'][0]['text']);


         return view('mushandirapamwe.ai-analysis', compact('title', 'content'));
     }



}
