<?php

namespace App\Http\Livewire\Dashboard\Cities;

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
        'ar_name' => 'required|min:2|max:100',
        'en_name' => 'required|min:2|max:100',
        'country_id' => 'required',
        'status' => 'required',
        'icon' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->authorize('create cities');

        $validatedData = $this->validate();

        $validatedData['icon'] = ($this->icon) ? uploadToPublic('cities', $validatedData['icon']) : "";
         
        City::create($validatedData);

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));
        return redirect()->route('admin.cities.index');

    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
   
    public function render()
    {
        return view('livewire.dashboard.cities.store',[
            'countries' => Country::get(),
        ]);
    }
}
