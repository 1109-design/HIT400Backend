<?php

namespace App\Http\Livewire;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class ComplaintsTable extends Component
{

    use WithPagination;

    public $search = '';
    public $filter = '';
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
            $complaints = Complaint::query()
                ->when($this->search, function ($query, $search) {
                    return $query->where('full_name', 'like', '%'.$search.'%')
                        ->orWhere('status', 'like', '%'.$search)
                        ->orWhere('category', 'like', '%'.$search)
                        ->orWhere('sentiment', 'like', '%'.$search)
                    ->orWhere('id', 'like', '%' . $search)
                        ;
                })
                ->when($this->filter, function ($query, $filter) {
                    return $query->where('sentiment', $filter);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        else{
            $complaints = Complaint::query()
                ->when($this->search, function ($query, $search) {
                    return $query->where('full_name', 'like', '%'.$search.'%')
                    ->orWhere('id', 'like', '%' . $search)
                    ->orWhere('category', 'like', '%' . $search)
                    ->orWhere('sentiment', 'like', '%' . $search);
                })
                ->when($this->filter, function ($query, $filter) {
                    return $query->where('sentiment', $filter);
                })
                ->orderBy('created_at', 'desc')
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
