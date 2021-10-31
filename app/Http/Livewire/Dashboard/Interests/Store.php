<?php

namespace App\Http\Livewire\Dashboard\Interests;

use Livewire\Component;
use App\Models\Interest;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $name;
    public $icon, $status;
  
    protected $rules = [
        'name' => 'required|min:2|max:100',
        'status' => 'required',
        'icon' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->authorize('create interests');

        $validatedData = $this->validate();

        $validatedData['icon'] = ($this->icon) ? uploadToPublic('interests', $validatedData['icon']) : "";
         
        Interest::create($validatedData);

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));
        return redirect()->route('admin.interests.index');

    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
   
    public function render()
    {
        return view('livewire.dashboard.interests.store');
    }
}
