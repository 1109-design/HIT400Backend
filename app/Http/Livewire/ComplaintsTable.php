<?php

namespace App\Http\Livewire;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class ComplaintsTable extends Component
{
    public $status;
    private Complaint $complaint;
    use WithPagination;
    public function mount(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function render()
    {
        if ($this->status != 'All') {
            $complaints = Complaint::where('status', $this->status)->orderBy('id', 'DESC')->paginate(10);

        }
        else{
            $complaints = Complaint::where('status', '!=', 'PoorAlternative')->orderBy('id', 'DESC')
                ->paginate(10);
        }
        return view('livewire.complaints-table', compact('complaints'));
    }
    public function updated($propertyName)
    {
        if ($propertyName === 'complaint') {
            $this->emit('refreshComponent');
        }
    }
}
