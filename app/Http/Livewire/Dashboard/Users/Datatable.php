<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

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
        $row = User::findOrFail($this->data_id);
        $row->delete();

        $this->emit('closeDeleteModal'); // Close model to using to jquery
    }

    public function freeze($user_id)
    {
        User::whereId($user_id)->update([
            'status' => false,
        ]);

        session()->flash('alert', __('Account Freeze Successfully.'));
    }

    public function unFreeze($user_id)
    {
        User::whereId($user_id)->update([
            'status' => true,
        ]);

        session()->flash('alert', __('Account UnFreeze Successfully.'));
    }

    public function render()
    {
        return view('livewire.dashboard.users.datatable', [
            'users' => User::when('city_id', function ($q) {
                if ($this->city_id != 'all') {
                    $q->where('city_id', $this->city_id);
                }
            })
                ->when('status', function ($q) {
                    if ($this->status != 'all') {
                        $q->where('status', $this->status);
                    }
                })
                ->where(function ($q) {
                    $q->search('name', $this->search);
                    $q->orSearch('mobile', $this->search);
                    $q->orSearch('email', $this->search);
                })
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}
