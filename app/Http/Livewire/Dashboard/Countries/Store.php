<?php

namespace App\Http\Livewire\Dashboard\Countries;

use App\Models\Country;
use App\Models\City;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $ar_name, $en_name;
    public $country_id, $icon, $status;
  
    protected $rules = [
        'ar_name' => 'required|min:4|max:100',
        'en_name' => 'required|min:4|max:100',
        'icon' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        'status' => 'required',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->authorize('create countries');

        $validatedData = $this->validate();

        $validatedData['icon'] = ($this->icon) ? uploadToPublic('countries', $validatedData['icon']) : "";
         
        Country::create($validatedData);

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));

        return redirect()->route('admin.countries.index');

    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
   
    public function render()
    {
        return view('livewire.dashboard.countries.store');
    }
}
