<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\General\ConstantController;

class Datatable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $selectedId;
    public $data_id;
    public $permission_ids;
    public $oldPermissionsIds;
    public $editMode, $name;

    public $count = 10;
    public $sortBy = 'id';
    public $sortDirection = 'DESC';

    protected $rules = [
        'name' => 'required|min:2|max:100',
        'permission_ids' => 'required|exists:permissions,id',

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
        $this->editMode = false;

        $validatedData = $this->validate();

        $role = Role::create($validatedData);

        $role->syncPermissions($validatedData['permission_ids']);

        session()->flash('alert', __('Saved Successfully.'));

        $this->emit('Modal'); // Close model to using to jquery

        $this->resetForm();
    }
    public function edit($id)
    {
        //  $this->authorize('edit roles');
        $this->editMode = true;

        $data = Role::findOrFail($id);
        $this->data_id = $id;
        $this->oldPermissionsIds = $data->permissions->pluck('id')->toArray();
        $this->name = $data->name;
    }

    public function update()
    {
        $this->editMode = true;
        $validatedData = $this->validate();

        $role = Role::find($this->data_id);
        $role->update($validatedData);
        $role->syncPermissions($validatedData['permissionsIds']);
        $this->resetForm();
        $this->emit('Modal'); // Close model to using to jquery
        session()->flash('alert', __('Saved Successfully.'));
    }
    public function confirm($id)
    {
        //  $this->authorize('delete roles');
        $this->emit('openDeleteModal');
        $this->selectedId = $id;
    }

    public function destroy()
    {
        Role::findOrFail($this->selectedId)->delete();
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
        return view('livewire.dashboard.roles.datatable', [
            'roles' => Role::with('permissions')->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
            'permissions' => Permission::get()
        ]);
    }
}
