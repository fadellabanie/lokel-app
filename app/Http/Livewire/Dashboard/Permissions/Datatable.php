<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\General\ConstantController;

class Datatable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $data_id;
    public $editMode, $name;
    
    public $count = ConstantController::LARGE_NUMBER_OF_PAGINATE;
    public $sortBy = 'id';
    public $sortDirection = ConstantController::SORT_ASC;

    protected $rules = [
        'name' => 'required|min:2|max:100',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
        $this->authorize('create permissions');
        $this->editMode = false;

        $validatedData = $this->validate();

        Permission::create($validatedData);

        session()->flash('alert', __('Saved Successfully.'));

        $this->emit('Modal'); // Close model to using to jquery

        $this->resetForm();
    }
    public function edit($id)
    {
        $this->authorize('edit permissions');
        $this->editMode = true;

        $data = Permission::findOrFail($id);
        $this->data_id = $id;
        $this->name = $data->name;
    }

    public function update()
    {
        $this->editMode = true;
        $validatedData = $this->validate();

        $permission = Permission::find($this->data_id);

        $permission->update($validatedData);

        $this->resetForm();

        $this->emit('Modal'); // Close model to using to jquery

        session()->flash('alert', __('Saved Successfully.'));
    }
    public function confirm($id)
    {
        $this->authorize('delete permissions');
        $this->emit('deleteModalOpen');
        $this->data_id = $id;
    }

    public function destroy()
    {
        $permission = Permission::findOrFail($this->data_id);
        $permission->delete();


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

    public function render()
    {
        return view('livewire.permissions.datatable',[
            'permissions' => Permission::orderBy($this->sortBy, $this->sortDirection)
                            ->paginate($this->count)
        ]);
    }
}
