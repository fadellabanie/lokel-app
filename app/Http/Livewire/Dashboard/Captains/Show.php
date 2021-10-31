<?php

namespace App\Http\Livewire\Dashboard\Captains;

use App\Models\Captain;
use Livewire\Component;
use App\Models\Experience;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $count = 20;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    public $captain;

    public function mount(Captain $captain)
    {
        $this->captain = $captain;
    }
    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
        return $this->sortBy = $field;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.dashboard.captains.show', [
            'experiences' => Experience::where('captain_id', $this->captain->id)->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}
