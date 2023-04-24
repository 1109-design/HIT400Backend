<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Search extends Component
{
    public $searchTerm;
    public $searchResults = "test\n me";
    // public $loading = false;


    public function search()
    {
        Log::info($this->searchTerm);
        $this->searchResults = "hie";
        try {
            $scriptPath = base_path('query.py');
            $process = new Process(['python', $scriptPath, $this->searchTerm]);
            $process->run();
            $output = $process->getOutput();
            // dd($output);
            // Set the search results
            $this->searchResults = $output;


            Log::info($output);
        } catch (\Exception $e) {
            $this->searchResults = 'An error occurred while processing your request. Please try again later.';
            Log::error($e->getMessage());
        }
    }
    public function render()
    {

        return view('livewire.search');
    }
}
