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
    public $data_id;
    public $price_from = 500;
    public $price_to = 3000;
    public $status = 'all';
    public $type = 'all';
    public $city_id  = 'all';
    public $country_id  = 'all';
    public $captain_id  = 'all';
    public $count = 21;
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
    public function decrease($field)
    {
        $this->$field -= 500;
    }
    public function increase($field)
    {
        //dd($this->$field);
        $this->$field += 500;
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

    public function render()
    {
        return view('livewire.dashboard.experiences.datatable', [
            'experiences' => Experience::with('captain:id,first_name,last_name,avatar')
                ->without(['medias'])
                ->accept()
                ->when($this->search, function ($q) {
                    $q->where(function ($q) {
                        $q->search('title', $this->search);
                        $q->orSearch('code', $this->search);
                        $q->orSearch('description', $this->search);
                    });
                })->when($this->price_from && $this->price_to, function ($q) {
                    $q->whereBetween('price', [$this->price_from, $this->price_to]);
                })
                ->when('city_id', function ($q) {
                    if ($this->city_id != 'all') {
                        $q->where('city_id', $this->city_id);
                    }
                })->when('country_id', function ($q) {
                    if ($this->country_id != 'all') {
                        $q->where('country_id', $this->country_id);
                    }
                })
                ->when('captain_id', function ($q) {
                    if ($this->captain_id != 'all') {
                        $q->where('captain_id', $this->captain_id);
                    }
                })
                ->when('status', function ($q) {
                    if ($this->status != 'all') {
                        $q->where('status', $this->status);
                    }
                })
                ->select('id', 'title', 'description', 'code', 'price', 'captain_id', 'country_id', 'icon', 'city_id', 'status', 'created_at')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}
