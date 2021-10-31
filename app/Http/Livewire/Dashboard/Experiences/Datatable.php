<?php

namespace App\Http\Livewire\Dashboard\Experiences;

use Livewire\Component;
use App\Models\Experience;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Datatable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $block_date;
    public $data_id;
    public $user_id;
    public $status = 'all';
    public $type = 'all';
    public $city_id  = 'all';
    public $count = 20;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    protected $rules = [
        'block_date' => 'required|after:today',
    ];
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

    public function confirm($id)
    {
        $this->emit('openDeleteModal'); // Open model to using to jquery

        $this->data_id = $id;
    }  
    
    public function destroy()
    {
        $row = Experience::findOrFail($this->data_id);
        $row->delete();
        
        $this->emit('closeDeleteModal'); // Close model to using to jquery
    }
    public function verify($user_id)
    {
        Experience::whereId($user_id)->update([
            'status' => Experience::ACCEPT,
        ]);
        session()->flash('alert', __('Account verify Successfully.'));
    }
    public function render()
    {
        return view('livewire.dashboard.experiences.datatable',[
            'experiences' => Experience::with('captain')->accept()->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->count),
        ]);
    }

}
