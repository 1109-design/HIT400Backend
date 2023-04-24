<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
// use Antoineaugusti\LaravelSentimentAnalysis;
use GuzzleHttp\Client;
use OpenAI;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ComplaintController extends Controller
{
    //

    public function store(Request $request)
    {
        $sentiment = null;
        $score = null;



        // $analysis = new SentimentAnalysis();
        try {

            $complaint = new Complaint();
            $complaint->full_name = $request->input('full_name');
            $complaint->phone_number = $request->input('phone_number');
            $complaint->category = $request->input('category');
            $complaint->description = $request->input('description');
            $complaint->latitude = $request->input('latitude');
            $complaint->longitude = $request->input('longitude');

            $image = $request->file('complaintImage');
            if($image)
            {
                // Save the file to a directory
                $filename = $image->store('public/images/complaints');
                $complaint->image_url = $filename;
            }
            //add a neural network analyze the complaint description and save the persist to db
            $text = $complaint->description;
            $scriptPath = base_path('sentiment-analysis.py');
            $process = new Process(['python', $scriptPath, $text]);
            $process->run();

            if (!$process->isSuccessful()) {
                Log::info('failed to analyze');
                // throw new ProcessFailedException($process);
            }
            else{
                $output = $process->getOutput();
                if (str_contains($output, 'Positive')) {
                    $sentiment = 'Positive';
                } elseif (str_contains($output, 'Neutral')) {
                    $sentiment = 'Neutral';
                } elseif (str_contains($output, 'Negative')) {
                    $sentiment = 'Negative';
                } elseif (str_contains($output, 'Urgency')) {
                    $sentiment = 'Urgency';
                }
                preg_match('/\d+/', $output, $matches);
                if (!empty($matches)) {
                    $score = (int) $matches[0];
                }
                $complaint->sentiment = $sentiment;
                $complaint->score = $score;

            }


            $complaint->save();

            Log::info('saved successfully');



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
