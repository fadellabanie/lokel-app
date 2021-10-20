<?php

namespace App\Http\Livewire\Dashboard\RealEstates;

use Livewire\Component;
use App\Models\RealEstate;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Jobs\NotifyUnActiveRealEstate;

class Datatable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $is_active = 'all';
    public $city_id = 'all';
    public $contract_type_id = 'all';
    public $realestate_type_id = 'all';
    public $data_id;
    public $count = 20;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

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
        $this->authorize('delete real estates');

        $this->emit('openDeleteModal'); // Open model to using to jquery

        $this->data_id = $id;
    }

    public function destroy()
    {
        $row = RealEstate::findOrFail($this->data_id);
        $row->delete();

        $this->emit('closeDeleteModal'); // Close model to using to jquery
        session()->flash('alert', __('Saved Deleted.'));
    }

    public function review($id)
    {
        $row = RealEstate::whereId($id)->first();

        if ($row->status == false) {
            $row->update([
                'status' => true,
                'review_at' => now(),
                'review_by' => Auth::user()->id . "-" . Auth::user()->name,
            ]);
        }
        session()->flash('alert', __('Reviewed Successfully.'));
    }
    public function changeActive($id)
    {
        $row = RealEstate::whereId($id)->first();

        if ($row->is_active == true) {
            $row->update([
                'is_active' => false,
                'end_date'  => now()->subDay(1),
            ]);
        } else {
            $row->update([
                'is_active' => true,
                'end_date'  => now()->addDays(30),
            ]);
        }


        session()->flash('alert', __('Change Active Successfully.'));
    }
    public function NotifyUnActiveRealEstate()
    {

        $title = __("RealEstate");
        $body = __("please Active your RealEstate");
        NotifyUnActiveRealEstate::dispatch($title, $body); ##Queue


        session()->flash('alert', __('Send Notification Successfully.'));
    }

    public function render()
    {
        return view('livewire.dashboard.real-estates.datatable', [

            'realEstates' => RealEstate::with([
                'realestateType' => function ($q) {
                    return $q->select('id', 'en_name');
                }, 'contractType'
                => function ($q) {
                    return $q->select('id', 'en_name');
                }, 'city', 'user'
            ])

                ->when($this->city_id != 'all', function ($q) {
                    $q->where('city_id', $this->city_id);
                })
                ->when($this->contract_type_id != 'all', function ($q) {
                    $q->where('contract_type_id', $this->contract_type_id);
                })
                ->when($this->realestate_type_id != 'all', function ($q) {
                    $q->where('realestate_type_id', $this->realestate_type_id);
                })
                ->when($this->is_active != 'all', function ($q) {
                    if ($this->is_active == 1) {
                        $q->where('is_active', $this->is_active);
                        $q->where('end_date', '>=', now());
                    } else {
                        $q->where('is_active', $this->is_active);
                        $q->where('end_date', '<', now());
                    }
                })
                ->search('name', $this->search)
                ->orSearch('address', $this->search)
                ->orSearch('price', $this->search)
                ->orSearch('space', $this->search)

                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}
