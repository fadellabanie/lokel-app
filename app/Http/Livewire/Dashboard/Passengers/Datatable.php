<?php

namespace App\Http\Livewire\Dashboard\Passengers;

use App\Models\Passenger;
use Livewire\Component;
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
    public $suspend = 'all';
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
        $row = Passenger::findOrFail($this->data_id);
        $row->delete();

        $this->emit('closeDeleteModal'); // Close model to using to jquery
    }

    public function freeze($user_id)
    {
        Passenger::whereId($user_id)->update([
            'suspend' => true,
        ]);
        session()->flash('alert', __('Account Freeze Successfully.'));
    }

    public function unFreeze($user_id)
    {
        Passenger::whereId($user_id)->update([
            'suspend' => false,
        ]);

        session()->flash('alert', __('Account UnFreeze Successfully.'));
    }


    public function render()
    {
        return view('livewire.dashboard.passengers.datatable', [
            'passengers' => Passenger::with('city')
                ->when('city_id', function ($q) {
                    if ($this->city_id != 'all') {
                        $q->where('city_id', $this->city_id);
                    }
                })
                ->when('suspend', function ($q) {
                    if ($this->suspend != 'all') {
                        $q->where('suspend', $this->suspend);
                    }
                })
                ->where(function ($q) {
                    $q->search('full_name', $this->search);
                    $q->orSearch('mobile', $this->search);
                    $q->orSearch('email', $this->search);
                })
                ->select('id','full_name','mobile','email','suspend','status','avatar','city_id','created_at')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}
